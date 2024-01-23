<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Catalogs;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ItemsController extends Controller
{
    protected $appends = ['title', 'type', 'description', 'has_discount', 'discount_price', 'discount_percent', 'catalog_url'];

    const SECTIONS = [
        'country' => 'Страна',
        'producer' => 'Производитель',
        'size' => 'Размер',
        'material' => 'Материал'
    ];

    public function getItems(Request $request)
    {
        $limit = 9;
        $page = $request->page ?: 0;

        $catalogUrl = $request->catalog;

        $items = Items::skip($limit * $page)->take($limit);

        if($catalogUrl) {
            $catalog = Catalogs::where('url', $catalogUrl)->first();

            $items = $items->whereHas('catalog', function($q) use($catalogUrl) {
                $q->where('url', $catalogUrl);
            });
        }

        if($request->filters) {
            $filters = array_filter($request->filters, function ($v) {
                return $v !== null;
            });

            foreach($filters as $k => $v) {
                $items = $items->where($k, 'like', '%'.$v.'%');
            }
        }

        if($request->sales) $items = $items->where('discount', '>', 0);

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

            $values = $values->get()->pluck($key);

            $sections[] = [
                'title' => $title,
                'key' => $key,
                'values' => $values
            ];
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
            // [
            //     'title' => isset($catalog) ? $catalog->name : 'Меню', 
            //     'link' => null,
            // ],
        ];

        $title = isset($catalog) && $catalog ? $catalog->name : 'Обои';

        return response()->json([
            'success' => true,
            'sections' => $sections,
            'data' => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => 'Купить <span> '. $title .' </span> в Перми',
        ]);
    }

    public function getItem(Request $request)
    {
        $itemId = $request->id;

        $item = Items::where('id', $itemId)->first()->setAppends($this->appends);

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

    public function getItemsForSlider()
    {
        if(!Cache::has('slider_popular')) {
            $popular = Items::take(8)->get()->each->setAppends($this->appends);
            Cache::put('slider_popular', $popular, 6000);
        }

        if(!Cache::has('slider_sales')) {
            $sales = Items::where('discount', '>', 0)->take(8)->get()->each->setAppends($this->appends);
            Cache::put('slider_sales', $sales, 6000);
        }
        
        return [
            'popular' => Cache::get('slider_popular'),
            'sales' => Cache::get('slider_sales'),
        ];
    }
}
