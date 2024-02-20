<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Orders\OrdersInterface;

class OrdersController extends Controller
{
    /**
     * Get orders list
     */
    public function getOrders(OrdersInterface $service): \Illuminate\Http\JsonResponse
    {
        return $service->getOrders();
    }

    /**
     * Order confirmation by admin 
     */
    public function confirmOrder(OrdersInterface $service, string $id): \Illuminate\Http\JsonResponse
    {
        return $service->confirmOrder($id);
    }

    /** 
     * Order canceling by admin
     */
    public function cancelOrder(OrdersInterface $service, string $id): \Illuminate\Http\JsonResponse
    {
        return $service->cancelOrder($id);
    }

    /**
     * Order compliting by admin
     */
    public function completeOrder(OrdersInterface $service, string $id): \Illuminate\Http\JsonResponse
    {
        return $service->completeOrder($id);
    }
}
