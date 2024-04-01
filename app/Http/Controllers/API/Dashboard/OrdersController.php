<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Orders\OrdersInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class OrdersController extends Controller
{
    public function __construct(
        private OrdersInterface $service
    ){}

    /**
     * Get orders list
     */
    public function getOrders(): JsonResponse
    {
        return $this->service->getOrders();
    }

    /**
     * Send payment link
     */
    public function sendPaymentLink(string $id): JsonResponse
    {
        return $this->service->sendPaymentLink($id);
    }

    /**
     * Check order
     */
    public function checkOrder(string $id): JsonResponse
    {
        return $this->service->checkOrder($id);
    }

    /**
     * Check payment
     */
    public function checkPayment(string $id): JsonResponse
    {
        return $this->service->checkPayment($id);
    }

    /**
     * Order confirmation by admin 
     */
    public function confirmOrder(string $id): JsonResponse
    {
        return $this->service->confirmOrder($id);
    }

    /** 
     * Order canceling by admin
     */
    public function cancelOrder(string $id): JsonResponse
    {
        return $this->service->cancelOrder($id);
    }

    /**
     * Order compliting by admin
     */
    public function completeOrder(string $id): JsonResponse
    {
        return $this->service->completeOrder($id);
    }

    /** 
     * Init status for order by admin
     */
    public function returnOrder(string $id): JsonResponse
    {
        return $this->service->returnOrder($id);
    }

    public function successPayment(string $id): RedirectResponse
    {
        return $this->service->successPayment($id);
    }
}
