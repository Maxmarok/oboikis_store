<?php

namespace App\Services\Items;

use App\Models\Catalogs;
use App\Models\Items;
use App\Services\Sbis\SbisService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ItemsService implements ItemsInterface {

    protected SbisService $service;

    public function __construct(SbisService $service)
    {
        $this->service = $service;
    }

    public function getItemsForUser(array $data): JsonResponse
    {
        $catalogUrl = $data['catalog'];

        $items = new Items();

        if($catalogUrl) {
            $catalog = Catalogs::where('url', $catalogUrl)->first();

            $items = $items->whereHas('catalog', function($q) use($catalogUrl) {
                $q->where('url', $catalogUrl);
            });
        }

        if(isset($data['filters']) && $data['filters']) {
            $filters = array_filter($data['filters'], function ($v) {
                return $v !== null;
            });

            foreach($filters as $k => $v) {
                $items = $items->where($k, 'like', '%'.$v.'%');
            }
        }

        if(isset($data['search']) && $data['search']) {
            $search = $data['search'];
            $items = $items->where('name', 'like', '%'.$search.'%');
        }

        if($data['sales']) $items = $items->where('discount', '>', 0);

        $items = $items->paginate(6);

        $sections = [];

        foreach(Items::SECTIONS as $k => $v) {

            $key = $k;
            $title = $v;

            $values = Items::groupBy('items.'.$key)->select($key);

            if($catalogUrl) {
                $values = $values->whereHas('catalog', function($q) use($catalogUrl) {
                    $q->where('url', $catalogUrl);
                });
            }

            $values = array_filter($values->get()->pluck($key)->toArray());

            if(count($values) > 0) {
                $sections[] = [
                    'title' => $title,
                    'key' => $key,
                    'values' => $values
                ];
            }
        }

        $breadcrumbs = [
            [
                'title' => 'Главная', 
                'link' => '/',
            ],
            [
                'title' => 'Каталог', 
                'link' => null,
            ],
        ];

        $title = $catalog->seo_title;

        return response()->json([
            'success' => true,
            'sections' => $sections,
            'data' => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => $title,
        ]);
    }

    public function getItem(array $data): JsonResponse
    {
        $itemId = $data['id'];

        $item = Items::where('id', $itemId)->first();

        $breadcrumbs = [
            [
                'title' => 'Главная', 
                'link' => '/',
            ],
            [
                'title' => 'Каталог', 
                'link' => '/catalog',
            ],
            [
                'title' => $item->title,
                'link' => null,
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $item,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function getItemsForSlider(): JsonResponse
    {
        if(!Cache::has('slider_popular')) {
            $popular = Items::where('stock', '>', 0)->take(8)->get();
            Cache::put('slider_popular', $popular, 6000);
        }

        if(!Cache::has('slider_sales')) {
            $sales = Items::where('discount', '>', 0)->where('stock', '>', 0)->take(8)->get();
            Cache::put('slider_sales', $sales, 6000);
        }

        return response()->json([
            'success' => true,
            'popular' => Cache::get('slider_popular'),
            'sales' => Cache::get('slider_sales'),
        ]);
    }


    public function updateItem(string $id): JsonResponse
    {
        $item = Items::find($id);

        if($item) {
            return $this->service->updateItem($item->name);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Товар не найден',
            ]); 
        }
    }

    public function getItemsForAdmin(): JsonResponse
    {
        $orders = Items::orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }

    public function addItems(): JsonResponse
    {
        return response()->json([
            'success' => true,
        ]); 
    }
}