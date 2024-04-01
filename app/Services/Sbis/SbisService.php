<?php

namespace App\Services\Sbis;

use App\Enums\StatusEnum;
use App\Jobs\AddItemsJob;
use App\Models\Catalogs;
use App\Models\Items;
use App\Models\Orders;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SbisService implements SbisInterface
{
    private const PAGE_SIZE = 200;
    private string $date;

    public function __construct(
        private Client $client
    )
    {
        $this->date = now()->format('Y.M.D');
        self::checkCache();
    }

    /**
     * Отправить запрос на создание заказа на доставку в сбис
     * 
     * @param Orders $order
     * 
     * @return void
     */
    public function createOrder(Orders $order): void
    {
        $url = config('sbis.url.order.create');

        $items = [];
        $pointId = (int) Cache::get('sbis_point');
        $priceId = (int) Cache::get('sbis_price');

        foreach($order->order_items as $item) {
            $items[] = (object) [
                'id' => $item->item->id,
                'nomNumber' => $item->item->nomNumber,
                'count' => $item->count,
                'priceListId' => $priceId,
            ];
        }

        $successUrl = route('success', ['id' => md5($order->id)]);

        Log::debug($successUrl);

        $arr = (object) [
            'product' => 'delivery',
            'pointId' => $pointId,
            'comment' => $order->comment_delivery,
            'customer' => (object) [
                'name' => $order->name,
                'phone' => $order->phone,
                'email' => $order->user->email,
            ],
            'datetime' => now()->addHours(6)->format('Y-m-d H:i:s'),
            'nomenclatures' => $items,
            'delivery' => (object) [
                'isPickUp' => false,
                'paymentType' => 'online',
                'shopURL' => config('sbis.url.shop'),
                'successURL' => $successUrl,
                'errorURL' => config('sbis.url.error'),
            ],
        ];

        // $arr->delivery->isPickup = $order->delivery === 'pickup';

        // if(!$arr->delivery->isPickup) {
        //     $arr->delivery->addressJSON = self::getAddressJSON($order->recieve);
        // }

        $response = self::makeRequest($url, 'POST', $arr);
        $response = json_decode($response, true);

        Log::debug($response);

        $order->update([
            'saleKey' => $response['saleKey'],
            'paymentRef' => $response['paymentRef'],
            'status' => StatusEnum::REGISTERED,
            'orderNumber' => $response['orderNumber'],
        ]);
    }

    public function checkOrder(string $id): array
    {
        $url = config('sbis.url.order.check');
        $url = strtr($url, ['{$id}' => $id]);

        $response = self::makeRequest($url, 'GET');
        $response = json_decode($response, true);

        return $response;
    }

    public function checkPayment(string $id): array
    {
        $url = config('sbis.url.order.state');
        $url = strtr($url, ['{$id}' => $id]);

        $response = self::makeRequest($url, 'GET');
        $response = json_decode($response, true);

        return $response;
    }

    public function cancelOrder(string $id): array
    {
        $url = config('sbis.url.order.cancel');
        $url = strtr($url, ['{$id}' => $id]);

        $response = self::makeRequest($url, 'PUT');
        $response = json_decode($response, true);

        return $response;
    }

    public function getPaymentLink(string $id): string|null
    {
        // $query = [
        //     'shopURL' => config('sbis.url.shop'),
        //     'successURL' => config('sbis.url.success'),
        //     'errorURL' => config('sbis.url.error'),
        // ];

        $url = config('sbis.url.payment');
        $url = strtr($url, ['{$id}' => $id]);
        //$url = $url . chr(077) . http_build_query($query);

        $response = self::makeRequest($url, 'GET');

        $response = json_decode($response, true);

        Log::debug($response);

        if(!empty($response['link'])) {
            return $response['link'];
        } else {
            return null;
        }
    }

    /** 
     * Получить скорректированный адрес для оформления доставки в сбис
     * @param string $address
     * @return string
     */
    private function getAddressJSON(string $address): string
    {
        $query = [
            'enteredAddress' => $address,
        ];

        $url = config('sbis.url.address') . chr(077) . http_build_query($query);

        $response = self::makeRequest($url, 'GET');
        $response = json_decode($response, true);

        if(!empty($response['addresses'][0]['addressJSON'])) {
            return $response['addresses'][0]['addressJSON'];
        } 
    }

    /**
     * Запросить новую информацию о товаре из каталога сбис
     * @param string $name
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateItem(string $name): JsonResponse
    {
        $data = self::getItems(0, $name);

        if(count($data) > 0) {
            $item = $data[0];

            $arr = [
                'description_simple' => $item['description_simple'],
                'price' => $item['cost'],
                'balance' => $item['balance'],
            ];

            if($item['images'] && count($item['images']) > 0) {
                $arr['image'] = self::getImage($item['images'][0], $item['id']);
            }

            $item = Items::where('name', $name);
            $item->update($arr);

            $item = $item->first();

            return response()->json([
                'success' => true,
                'item' => $item,
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => "Товар с именем {$name} не найден",
            ]); 
        }
    }

    /**
     * Добавить товары из каталога в сбис  
     * Цепочка AddItemsJob
     * 
     * @param int $page
     * @return void
     */
    public function addItems(int $page = 0): void
    {
        $data = self::getItems($page);
        
        if(count($data) > 0) {
            self::insertItems($data);
            $page++;
            AddItemsJob::dispatch($page)->delay(now()->addSeconds(10));
        }
    }

    /**
     * Получить список товаров из каталога сбис
     * 
     * @param int $page Номер страницы пагинации
     * @param string $search Строчка для поиска
     * 
     * @return array
     */
    public function getItems(int $page = 0, string $search = null): array
    {
        $query = [
            'pointId' => Cache::get('sbis_point'),
            'priceListId' => Cache::get('sbis_price'),
            'page' => $page,
            'pageSize' => self::PAGE_SIZE,
            'withBalance' => 'true',
        ];

        if($search) $query['searchString'] = $search;

        $url = config('sbis.url.items') . chr(077) . http_build_query($query);

        $response = self::makeRequest($url, 'GET');

        $response = json_decode($response, true);

        if(!empty($response['nomenclatures'])) {
            return $response['nomenclatures'];
        }
    }

    /**
     * Запросить изображение товара по ссылке сбис  
     * И сохранить его в storage
     * 
     * @param string $param
     * @param string $id
     * 
     * @return string
     */
    private function getImage(string $param, string $id): string
    {
        $url = config('sbis.url.image') . $param;

        $response = self::makeRequest($url, 'GET');

        return self::uploadFile($response, $id);
    }

    /**
     * Запросить список прайс-листов и установить
     * в кеш первый прайс-лист
     * 
     * @return void
     */
    private function setPrice(): void
    {
        $arr = http_build_query(['actualDate' => $this->date]);
        $url = config('sbis.url.price') . chr(077) . $arr;

        $response = self::makeRequest($url, 'GET');

        $response = json_decode($response, true);

        if(!empty($response['priceLists'][0]['id'])) {
            Cache::put('sbis_price', $response['priceLists'][0]['id']);
        }
    }

    /**
     * Запросить список точен продаж и установить
     * в кеш первую точку продаж
     * 
     * @return void
     */
    private function setPoint(): void
    {
        $url = config('sbis.url.point');

        $response = self::makeRequest($url, 'GET');

        $response = json_decode($response, true);

        $index = array_search(config('sbis.point'), array_column($response['salesPoints'], 'name'));
        Cache::put('sbis_point', $response['salesPoints'][$index]['id']);

        // if(!empty($response['salesPoints'][0]['id'])) {
        //     Cache::put('sbis_point', $response['salesPoints'][0]['id']);
        // }
    }

    /** 
     * Запросить новый токен для аутентификации из сбис  
     * для последующих запросов
     * 
     * @return void
     */
    private function setToken(): void
    {
        $url = config('sbis.url.token');
        $data = (object) [
            'app_client_id' => config('sbis.app_client_id'),
            'login' => config('sbis.login'),
            'password' => config('sbis.password'),
        ];

        $response = self::makeRequest($url, 'POST', $data);

        $response = json_decode($response, true);

        if(!empty($response['access_token'])) {
            Cache::put('sbis_token', $response['access_token'], 3000);
        }
    }

    /** 
     * Осуществить запрос к сервису сбис
     * 
     * @param string $url Адрес запроса к серверу сбис
     * @param string $method Метод запроса GET, POST
     * @param object $data Данные для отправки методом POST
     * @param bool $auth
     * 
     * @return string
     */
    private function makeRequest(
        string $url = '', 
        string $method = 'GET', 
        ?object $data = null,
    ): string|null
    {
        try {
            $arr = [
                'headers' => self::getAuthHeader(),
            ];

            if($data) $arr['json'] = $data;

            $request = $this->client->request($method, $url, $arr);

            if($request) {
                return $request->getBody();
            } else {
                return null;
            }

        } catch (RequestException $exception){
            if($exception->getCode() === 401) {
                self::checkToken();

                return self::makeRequest($url, $method, $data);
            } else {
                if($exception->getResponse()) Log::error($exception->getResponse()->getBody());

                return null;
            }

            
        }
    }

    private function checkCache(): void
    {
        self::checkToken();
        self::checkPoint();
        self::checkPrice();
    }

    /**
     * Проверить кеш на наличие токена
     * Если отсутствует, запросить новый
     * @return void
     */
    private function checkToken(): void
    {
        if(!Cache::has('sbis_token')) {
            self::setToken();
        }
    }

    /**
     * Проверить кеш на наличие точки продаж
     * Если отсутствует, запросить новый
     * @return void
     */
    private function checkPoint(): void
    {
        if(!Cache::has('sbis_point')) {
            self::setPoint();
        }
    }

    /**
     * Проверить кеш на наличие прайс-листа
     * Если отсутствует, запросить новый
     * @return void
     */
    private function checkPrice(): void
    {
        if(!Cache::has('sbis_price')) {
            self::setPrice();
        }
    }

    /**
     * Сформировать хедер с токеном для запросов сбис
     * @return array
     */
    private function getAuthHeader(): array
    {
        return [
            'X-SBISAccessToken' => Cache::get('sbis_token')   
        ];
    }

    /**
     * Добавить обновленный список товаров, полученный из сбис, в базу
     * @param array $data
     * @return void
     */
    private function insertItems(array $data): void
    {
        $arr = [];
        $ids = [];

        $catalog = Catalogs::select('id', 'name')->get();

        foreach($data as $item) {
            $ids[] = $item['id'];
        }

        $ids = Items::whereIn('id', $ids)->get()->pluck('id')->toArray();

        foreach($data as $item) {
            $catalog_id = self::getCatalogId($item['name'], $catalog);

            if($catalog_id) {
                $value = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description_simple' => $item['description_simple'],
                    'nomNumber' => $item['nomNumber'],
                    'price' => $item['cost'],
                    'balance' => $item['balance'],
                    'catalog_id' => $catalog_id,
                    'image' => null,
                ];

                if($item['images'] && count($item['images']) > 0) {
                    $value['image'] = self::getImage($item['images'][0], $item['id']);
                }

                if(in_array($item['id'], $ids)) {
                    Items::where('id', $item['id'])->update($value);
                } else {
                    array_push($arr, $value);
                }
            }
        }

        if(count($arr) > 0) Items::insert($arr);
    }

    /**
     * Получить ID каталога по наличию названия каталога в товаре из сбис  
     * Например: 0 (если в названии Обои) или 1 (если Фотообои)  
     * 
     * @param string $item
     * @param \Illuminate\Database\Eloquent\Collection $catalog
     * 
     * @return int|null
     */
    private function getCatalogId(string $item, Collection $catalog): ?int
    {
        $data = $catalog->toArray();
        $id = null;

        if(count($data) > 0) {
            $id = $data[0]['id'];

            $names = $catalog->pluck('name')->toArray();
            
            foreach($names as $name) {
                if(str_contains($item, $name)) {
                    
                    $index = array_search($name, array_column($data, 'name'));
                    if($index !== false) $id = $data[$index]['id'];
                }
            }
        }
        
        return $id;
    }

    /**
     * Upload file in storage
     * @param string $data
     * @param string $id
     * @return string
     */
    public function uploadFile(string $data, string $id): string
    {
        $storage = Storage::disk('images');
        $fileName = Str::uuid(10).'.'.'jpg';

        $this->deleteFile($id);
        $storage->put($fileName, $data);

        return $fileName;
    }

    /**
     * Delete file from storage
     * @param string $id
     * @return void
     */
    private function deleteFile(string $id): void
    {
        $item = Items::where('id', $id)->first();

        if($item) {
            $path = $item->image;
            
            if($path) {
                if(Storage::disk('images')->exists($path)){
                    Storage::disk('images')->delete($path);
                }
            }
        }
    }
}