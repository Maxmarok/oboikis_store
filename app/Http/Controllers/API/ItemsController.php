<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Catalogs;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function getItems(Request $request)
    {
        $catalogUrl = $request->catalog;

        $catalog = Catalogs::where('url', $catalogUrl)->first();

        $items = Items::whereHas('catalog', function($q) use($catalogUrl) {
            $q->where('url', $catalogUrl);
        })->skip(0)->take(30)->get();

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
                'title' => $catalog->name, 
                'link' => null,
            ],
        ];

        return response()->json([
            "success" => true,
            "data" => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => 'Купить <span> Обои </span> в Перми',
        ]);
    }

    public function getItem(Request $request)
    {
        $itemId = $request->id;

        $item = Items::where('id', $itemId)->first();

        return response()->json([
            "success" => true,
            "data" => $item,
        ]);
    }
}
