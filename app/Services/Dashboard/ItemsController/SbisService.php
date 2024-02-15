<?php

namespace App\Services\Dashboard\ItemsController;

use App\Jobs\AddItemsJob;
use App\Models\Items;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SbisService
{
    private $app_client_id;
    private $login;
    private $password;
    private $url_token;
    private $url_point;
    private $url_price;
    private $url_items;

    private const PAGE_SIZE = 100;

    private string $date;
    private Client $client;

    public function __construct()
    {
        $this->app_client_id = config('sbis.app_client_id');
        $this->login = config('sbis.login');
        $this->password = config('sbis.password');
        $this->url_token = config('sbis.url.token');
        $this->url_point = config('sbis.url.point');
        $this->url_price = config('sbis.url.price');
        $this->url_items = config('sbis.url.items');

        $this->date = now()->format('Y.M.D');
        $this->client = new Client();
        self::checkCache();
    }

    public function addItems(int $page = 0): void
    {
        $data = self::getItems($page);
        

        if(count($data) > 0) {
            self::insertItems($data);
            $page++;
            AddItemsJob::dispatchAfterResponse($page);
        }
    }

    public function insertItems(array $data): void
    {
        $arr = [];

        foreach($data as $item) {
            $arr[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'material' => $item['description_simple'],
                'sbis_id' => $item['nomNumber'],
                'price' => $item['cost'],
                'catalog_id' => 1,
            ];
        }

        Items::insert($arr);
    }

    public function getItems(int $page = 0, int $pageSize = self::PAGE_SIZE): array
    {
        $data = [];

        $arr = http_build_query([
            'headers' => self::getAuthHeader(),
            'pointId' => Cache::get('sbis_point'),
            'priceListId' => Cache::get('sbis_price'),
            'page' => $page,
            'pageSize' => $pageSize,
        ]);

        $url = $this->url_items . chr(077) . $arr;

        try {
            $request = $this->client->request('GET', $url, [
                'headers' => self::getAuthHeader(),
                'pointId' => Cache::get('sbis_point'),
                'priceListId' => Cache::get('sbis_price'),
                'page' => $page,
                'pageSize' => $pageSize,
            ]);

            $response = json_decode($request->getBody(), true);

            if($response['outcome']['hasMore']) {
                $data = $response['nomenclatures'];
            }
           

        } catch (GuzzleException $exception){
            // return match ($exception->getCode()) {
            //     default => Log::debug($exception->getMessage())
            // };
            Log::debug($exception->getMessage());
        }

        return $data;
    }

    public function setPrice(): void
    {
        $arr = http_build_query(['actualDate' => $this->date]);
        $url = $this->url_price . chr(077) . $arr;

        try {
            $request = $this->client->request('GET', $url, [
                'headers' => self::getAuthHeader(),
            ]);

            $response = json_decode($request->getBody(), true);

            Cache::put('sbis_price', $response['priceLists'][0]['id']);

        } catch (GuzzleException $exception){
            // return match ($exception->getCode()) {
            //     default => Log::debug($exception->getMessage())
            // };
            Log::debug($exception->getMessage());
        }
    }

    public function setPoint(): void
    {
        try {
            $request = $this->client->request('GET', $this->url_point, [
                "headers" => self::getAuthHeader()
            ]);

            $response = json_decode($request->getBody(), true);

            Cache::put('sbis_point', $response['salesPoints'][0]['id']);

        } catch (GuzzleException $exception){
            // return match ($exception->getCode()) {
            //     default => Log::debug($exception->getMessage())
            // };
            Log::debug($exception->getMessage());
        }
    }

    public function setToken(): void
    {
        try {
            $request = $this->client->request('POST', $this->url_token, [
                'json' => [
                    'app_client_id' => $this->app_client_id,
                    'login' => $this->login,
                    'password' => $this->password,
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
        return ["X-SBISAccessToken" => Cache::get('sbis_token')];
    }
}
