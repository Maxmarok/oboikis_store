<?php

namespace App\Services\Orders;

interface OrdersInterface
{
    /**
     * Get orders list
     */
    public function getOrders(): \Illuminate\Http\JsonResponse;
    /**
     * Order confirmation by admin 
     */
    public function confirmOrder(string $id): \Illuminate\Http\JsonResponse;

    /** 
     * Order canceling by admin
     */
    public function cancelOrder(string $id): \Illuminate\Http\JsonResponse;

    /**
     * Order compliting by admin
     */
    public function completeOrder(string $id): \Illuminate\Http\JsonResponse;
}
