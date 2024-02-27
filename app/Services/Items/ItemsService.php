<?php

namespace App\Services\Items;

use App\Jobs\AddItemsJob;
use App\Models\Catalogs;
use App\Models\Items;
use App\Services\Breadcrumbs\BreadcrumbsInterface;
use App\Services\Sbis\SbisInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ItemsService implements ItemsInterface {

    private SbisInterface $service;
    private BreadcrumbsInterface $breadcrumbs;

    public function __construct(SbisInterface $service, BreadcrumbsInterface $breadcrumbs)
    {
        $this->service = $service;
        $this->breadcrumbs = $breadcrumbs;
    }

    public function getItemsForUser(array $data): JsonResponse
    {
        // Get parent catalog
        $catalog = Catalogs::where('url', $data['catalog'])->first();

        // Get sections for filter
        $sections = self::getSections($catalog);

        // Make builder for items with catalog url 
        $items = Items::itemsWithUrl($catalog->url);

        // Get only discount items if we have sales checkbox
        if($data['sales']) $items = $items->where('discount', '>', 0);

        // Search values field from filters
        if(isset($data['filters']) && $data['filters']) {
            $filters = array_filter($data['filters'], function ($v) {
                return $v !== null;
            });

            foreach($filters as $k => $v) {
                $items = self::searchQuery($items, $k, $v);
            }
        }

        // Search value in items name
        if(!empty($data['search'])) $items = self::searchQuery($items, 'name', $data['search']);

        $items = $items->paginate(6);

        // Make breadcrumbs
        $breadcrumbs = $this->breadcrumbs->get([
            $catalog->name => null
        ]);

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
                'title' => $item->catalog->name, 
                'link' => "/catalog/{$item->catalog->url}",
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
            $popular = Items::where('stock', '>', 0)->whereNotNull('image')->take(8)->get();
            Cache::put('slider_popular', $popular, 6000);
        }

        if(!Cache::has('slider_sales')) {
            $sales = Items::where('discount', '>', 0)->whereNotNull('image')->where('stock', '>', 0)->take(8)->get();
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
        AddItemsJob::dispatchAfterResponse();

        return response()->json([
            'success' => true,
        ]); 
    }

    /**
     * Make search query
     */
    private function searchQuery(Builder $query, string $field, string $search): Builder
    {
        return $query->where($field, 'like', '%'.$search.'%');
    }

    /**
     * Make sections array for filter 
     */
    private function getSections(Catalogs $catalog): array
    {
        $sections = [];

        foreach(Items::SECTIONS as $k => $v) {

            $key = $k;
            $title = $v;

            $values = Items::groupBy('items.'.$key)->select($key);

            if($catalog) {
                $values = $values->itemsWithUrl($catalog->url);
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

        return $sections;
    }
}