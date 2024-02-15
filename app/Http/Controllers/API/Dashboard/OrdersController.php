<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Services\Dashboard\OrdersController\OrdersService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private OrdersService $service;

    public function __construct()
    {
        $this->service = new OrdersService();
    }

    public function getOrders(): \Illuminate\Http\JsonResponse
    {
        return $this->service->getOrders();
    }

    public function confirmOrder(string $id): \Illuminate\Http\JsonResponse
    {
        return $this->service->confirmOrder($id);
    }

    public function cancelOrder(string $id): \Illuminate\Http\JsonResponse
    {
        return $this->service->cancelOrder($id);
    }

    public function completeOrder(string $id): \Illuminate\Http\JsonResponse
    {
        return $this->service->completeOrder($id);
    }
}
