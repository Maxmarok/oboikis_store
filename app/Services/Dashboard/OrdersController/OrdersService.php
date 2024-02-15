<?php

namespace App\Services\Dashboard\OrdersController;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersService
{
    public function __construct()
    {
        
    }

    public function getOrders(): \Illuminate\Http\JsonResponse
    {
        $orders = Orders::with(['order_items', 'user'])->orderByRaw('FIELD(status, 0,1,3,2)')->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }

    public function confirmOrder(string $id): \Illuminate\Http\JsonResponse
    {
        $order = self::changeStatus($id, 1);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function cancelOrder(string $id): \Illuminate\Http\JsonResponse
    {
        $order = self::changeStatus($id, 2);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function completeOrder(string $id): \Illuminate\Http\JsonResponse
    {
        $order = self::changeStatus($id, 3);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    protected function changeStatus($id, $status): \App\Models\Orders
    {
        $order = Orders::find($id);
        $order->status = $status;
        $order->save();

        return $order;
    }
}
