<?php

namespace App\Services\Dashboard\ItemsController;

use App\Jobs\UpdateItemJob;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsService
{
    public SbisService $service;

    public function __construct()
    {
        $this->service = new SbisService();
    }

    public function updateItem(string $id): \Illuminate\Http\JsonResponse
    {
        $item = Items::find($id);

        if($item) {
            //UpdateItemJob::dispatch($item->name)->delay(now()->addSeconds(5));
            return $this->service->updateItem($item->name);
            
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Товар с именем '.$item->name .' не найден',
            ]); 
        }
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
