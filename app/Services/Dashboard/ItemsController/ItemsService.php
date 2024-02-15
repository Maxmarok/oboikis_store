<?php

namespace App\Services\Dashboard\ItemsController;

use App\Models\Items;

class ItemsService
{
    public function __construct()
    {
        
    }

    public function getItems(): \Illuminate\Http\JsonResponse
    {
        $orders = Items::orderBy('id', 'desc')->paginate(10);

        if($orders) $orders->data = $orders->getCollection()->each->setAppends(Items::APPENDS);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }

    public function addItems(): \Illuminate\Http\JsonResponse
    {

        return response()->json([
            'success' => true,
        ]); 
    }
}
