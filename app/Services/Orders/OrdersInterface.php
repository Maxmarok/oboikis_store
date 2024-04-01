<?php

namespace App\Services\Orders;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

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
     * Check order
     */
    public function checkOrder(string $id): JsonResponse;

    /**
     * Check payment
     */
    public function checkPayment(string $id): JsonResponse;
    
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

    /**
     * Return init status
     */
    public function returnOrder(string $id): JsonResponse;

    /**
     * @param string $id MD5 Hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function successPayment(string $id): RedirectResponse;
}
