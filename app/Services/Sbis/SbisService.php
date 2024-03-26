<?php

namespace App\Services\Sbis;

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
    private Client $client;

    public function __construct(Client $client)
    {
        $this->date = now()->format('Y.M.D');
        $this->client = $client;
        self::checkCache();
    }

    public function createOrder(Orders $order)
    {
        $url = config('sbis.url.order');

        $items = [];
        $pointId = (int)Cache::get('sbis_point');
        $priceId = (int) Cache::get('sbis_price');

        foreach($order->order_items as $item) {
            $items[] = (object) [
                'id' => $item->item->id,
                'nomNumber' => $item->item->nomNumber,
                'count' => $item->count,
                'priceListId' => $priceId,
            ];
        }

        $arr = (object) [
            'product' => 'delivery',
            'pointId' => $pointId,
            'customer' => (object) [
                'name' => $order->name,
                'phone' => $order->phone,
                'email' => $order->user->email,
            ],
            'datetime' => now()->addHours(6)->format('Y-m-d H:i:s'),
            'nomenclatures' => $items,
            'delivery' => (object) [
                'paymentType' => 'online',
                'shopURL' => config('sbis.url.shop'),
                'successURL' => config('sbis.url.success'),
                'errorURL' => config('sbis.url.error'),
            ],
        ];

        $arr->delivery->isPickup = $order->delivery === 'pickup';

        if(!$arr->delivery->isPickup) {
            $arr->delivery->addressFull = $order->recieve;
        }
 
        Log::debug($arr);

        try {
            $request = $this->client->request('POST', $url, [
                'headers' => self::getAuthHeader(),
                'json' => $arr
            ]);

            $response = json_decode($request->getBody(), true);

            Log::debug($response->getBody());

        } catch (RequestException $exception) {
            if($exception->getCode() === 401) {
                self::checkToken();
                self::createOrder($order);
            }
            Log::error($exception->getResponse()->getBody());
        }
        
    }

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

    public function addItems(int $page = 0): void
    {
        $data = self::getItems($page);
        
        if(count($data) > 0) {
            self::insertItems($data);
            $page++;
            AddItemsJob::dispatch($page)->delay(now()->addSeconds(10));
        }
    }

    public function insertItems(array $data): void
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

    public function getImage(string $param, string $id): string|null
    {
        $data = null;

        $url = config('sbis.url.image') . $param;

        try {
            $request = $this->client->request('GET', $url, [
                "headers" => self::getAuthHeader()
            ]);

            $response = $request->getBody();

            if($response) $data = self::uploadFile($response, $id);

        } catch (GuzzleException $exception){
            if($exception->getCode() === 401) {
                self::checkToken();
                self::getImage($param, $id);
            }
            Log::debug($exception->getMessage());
        }

        return $data;
    }

    public function getItems(int $page = 0, string $search = null): array
    {
        $data = [];

        $query = [
            'pointId' => Cache::get('sbis_point'),
            'priceListId' => Cache::get('sbis_price'),
            'page' => $page,
            'pageSize' => self::PAGE_SIZE,
            'withBalance' => 'true',
        ];

        if($search) $query['searchString'] = $search;

        $url = config('sbis.url.items') . chr(077) . http_build_query($query);

        try {
            $request = $this->client->request('GET', $url, [
                'headers' => self::getAuthHeader(),
            ]);

            $response = json_decode($request->getBody(), true);

            $data = $response['nomenclatures'];

        } catch (GuzzleException $exception){
            if($exception->getCode() === 401) {
                self::checkToken();
                self::getItems($page, $search);
            }
            Log::debug($exception->getMessage());
        }

        return $data;
    }

    private function setPrice(): void
    {
        $arr = http_build_query(['actualDate' => $this->date]);
        $url = config('sbis.url.price') . chr(077) . $arr;

        try {
            $request = $this->client->request('GET', $url, [
                'headers' => self::getAuthHeader(),
            ]);

            $response = json_decode($request->getBody(), true);

            Cache::put('sbis_price', $response['priceLists'][0]['id']);

        } catch (GuzzleException $exception){
            if($exception->getCode() === 401) {
                self::checkToken();
                self::setPrice();
            }

            Log::error($exception->getMessage());
        }
    }

    private function setPoint(): void
    {
        try {
            $request = $this->client->request('GET', config('sbis.url.point'), [
                "headers" => self::getAuthHeader()
            ]);

            $response = json_decode($request->getBody(), true);

            Cache::put('sbis_point', $response['salesPoints'][0]['id']);

        } catch (GuzzleException $exception){
            if($exception->getCode() === 401) {
                self::checkToken();
                self::setPoint();
            }

            Log::error($exception->getMessage());
        }
    }

    private function setToken(): void
    {
        try {
            $request = $this->client->request('POST', config('sbis.url.token'), [
                'json' => [
                    'app_client_id' => config('sbis.app_client_id'),
                    'login' => config('sbis.login'),
                    'password' => config('sbis.password'),
                ]
            ]);

            $response = json_decode($request->getBody(), true);

            Cache::put('sbis_token', $response['access_token'], 3000);

        } catch (GuzzleException $exception) {
            // return match ($exception->getCode()) {
            //     default => Log::debug($exception->getMessage())
            // };
            Log::debug($exception->getMessage());
        }

    }

    private function checkCache(): void
    {
        self::checkToken();
        self::checkPoint();
        self::checkPrice();
    }

    private function checkToken(): void
    {
        if(!Cache::has('sbis_token')) {
            self::setToken();
        }
    }

    private function checkPoint(): void
    {
        if(!Cache::has('sbis_point')) {
            self::setPoint();
        }
    }

    private function checkPrice(): void
    {
        if(!Cache::has('sbis_price')) {
            self::setPrice();
        }
    }

    private function getAuthHeader(): array
    {
        return [
            'X-SBISAccessToken' => Cache::get('sbis_token')   
        ];
    }

    private function getCatalogId(string $item, Collection $catalog): int|null
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