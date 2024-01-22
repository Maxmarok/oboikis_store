<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        $ids = $request->ids;

        $items = Items::whereIn('id', $ids)->get();

        $breadcrumbs = [
            [
                'title' => 'Главная', 
                'link' => '/',
            ],
            [
                'title' => 'Корзина', 
                'link' => null,
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => '<span>Корзина</span> товаров',
        ]);
    }
}
