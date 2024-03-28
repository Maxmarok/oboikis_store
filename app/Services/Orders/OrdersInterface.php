<?php

namespace App\Services\Orders;

use Illuminate\Http\JsonResponse;

interface OrdersInterface
{
    /**
     * Get orders list
     */
    public function getOrders(): JsonResponse;


    /**
     * Send payment link to client
     */
    public function sendPaymentLink(string $id): JsonResponse;

    /**
     * Order confirmation by admin 
     */
    public function confirmOrder(string $id): JsonResponse;

    /** 
     * Order canceling by admin
     */
    public function cancelOrder(string $id): JsonResponse;

    /**
     * Order compliting by admin
     */
    public function completeOrder(string $id): JsonResponse;
}
