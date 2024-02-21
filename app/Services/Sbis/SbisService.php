<?php

namespace App\Services\Sbis;

use App\Jobs\AddItemsJob;
use App\Models\Catalogs;
use App\Models\Items;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SbisService implements SbisInterface
{
    private const PAGE_SIZE = 100;
    private string $date;
    private Client $client;

    public function __construct(Client $client)
    {
        $this->date = now()->format('Y.M.D');
        $this->client = $client;
        self::checkCache();
    }

    public function updateItem(string $name): JsonResponse
    {
        $data = self::getItems(0, $name);

        if(count($data) > 0) {
            $item = $data[0];

            $arr = [
                'description_simple' => $item['description_simple'],
                'price' => $item['cost'],
                'stock' => $item['balance'],
            ];

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
                'message' => 'Товар с именем '.$name.' не найден',
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
            Cache::delete('slider_popular');
            Cache::delete('slider_sales');
        }
    }

    public function insertItems(array $data): void
    {
        $arr = [];
        $catalog = Catalogs::select('id', 'name')->get();

        foreach($data as $item) {
            $arr[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'description_simple' => $item['description_simple'],
                'sbis_id' => $item['nomNumber'],
                'price' => $item['cost'],
                'catalog_id' => self::getCatalogId($item['name'], $catalog),
                'stock' => $item['balance'],
            ];
        }

        Items::insert($arr);
    }

    public function getItems(int $page = 0, string $search = null): array
    {
        $data = [];

        $query = [
            'headers' => self::getAuthHeader(),
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

            Log::debug($response);

        } catch (GuzzleException $exception){
            // return match ($exception->getCode()) {
            //     default => Log::debug($exception->getMessage())
            // };
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
                self::setPoint();
            }

            Log::error($exception->getMessage());
            Log::debug($exception->getMessage());
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

    private function getCatalogId(string $item, Collection $catalog): int
    {
        $data = $catalog->toArray();
        $id = $data[0]['id'];

        $names = $catalog->pluck('name')->toArray();
        
        foreach($names as $name) {
            if(str_contains($item, $name)) {
                
                $index = array_search($name, array_column($data, 'name'));
                if($index !== false) $id = $data[$index]['id'];
            }
        }
        
        return $id;
    }
}