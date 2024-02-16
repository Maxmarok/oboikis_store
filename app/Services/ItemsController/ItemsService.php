<?php

namespace App\Services\ItemsController;

use App\Models\Catalogs;
use App\Models\Items;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ItemsService {

    private const APPENDS = [
        'title', 
        'type', 
        'description', 
        'has_discount', 
        'discount_price', 
        'discount_percent', 
        'catalog_url',
    ];

    public function getItems(array $data): \Illuminate\Http\JsonResponse
    {
        $limit = 9;
        $page = $data['page'] ?: 0;

        $catalogUrl = $data['catalog'];

        $items = Items::skip($limit * $page)->take($limit);

        if($catalogUrl) {
            $catalog = Catalogs::where('url', $catalogUrl)->first();

            $items = $items->whereHas('catalog', function($q) use($catalogUrl) {
                $q->where('url', $catalogUrl);
            });
        }

        if(isset($data['filters'])) {
            $filters = array_filter($data['filters'], function ($v) {
                return $v !== null;
            });

            foreach($filters as $k => $v) {
                $items = $items->where($k, 'like', '%'.$v.'%');
            }
        }

        if($data['sales']) $items = $items->where('discount', '>', 0);

        $items = $items->get()->each->setAppends(Items::APPENDS);

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

        $title = $catalog->name ?: 'Обои';
        if($title === 'Клей') $title .= ' для обоев';

        return response()->json([
            'success' => true,
            'sections' => $sections,
            'data' => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => 'Купить <span> '. $title .' </span> в Перми',
        ]);
    }

    public function getItem(array $data): \Illuminate\Http\JsonResponse
    {
        $itemId = $data['id'];

        $item = Items::where('id', $itemId)->first()->setAppends(self::APPENDS);

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

    public function getItemsForSlider(): \Illuminate\Http\JsonResponse
    {
        if(!Cache::has('slider_popular')) {
            $popular = Items::where('stock', '>', 0)->take(8)->get()->each->setAppends(self::APPENDS);
            Cache::put('slider_popular', $popular, 6000);
        }

        if(!Cache::has('slider_sales')) {
            $sales = Items::where('discount', '>', 0)->where('stock', '>', 0)->take(8)->get()->each->setAppends(self::APPENDS);
            Cache::put('slider_sales', $sales, 6000);
        }

        return response()->json([
            'success' => true,
            'popular' => Cache::get('slider_popular'),
            'sales' => Cache::get('slider_sales'),
        ]);
    }
}