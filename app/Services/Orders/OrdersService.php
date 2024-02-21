<?php

namespace App\Services\Orders;

use App\Models\Orders;
use Illuminate\Http\JsonResponse;

class OrdersService implements OrdersInterface
{
    public function __construct()
    {
        
    }

    public function getOrders(): JsonResponse
    {
        $orders = Orders::with(['order_items', 'user'])->orderByRaw('FIELD(status, 0,1,3,2)')->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }

    public function confirmOrder(string $id): JsonResponse
    {
        $order = self::changeStatus($id, 1);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function cancelOrder(string $id): JsonResponse
    {
        $order = self::changeStatus($id, 2);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function completeOrder(string $id): JsonResponse
    {
        $order = self::changeStatus($id, 3);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    private function changeStatus($id, $status): Orders
    {
        $order = Orders::find($id);
        $order->status = $status;
        $order->save();

        return $order;
    }
}
