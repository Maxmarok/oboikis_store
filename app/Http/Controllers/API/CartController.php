<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetCartRequest;
use App\Http\Requests\GetOrderRequest;
use App\Services\Cart\CartInterface;

class CartController extends Controller
{
    /**
    * Get items from cart
    */
    public function getCart(CartInterface $service, GetCartRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->getCart($request->validated());
    }

    /**
    * Get info about order
    */
    public function getOrder(CartInterface $service, GetOrderRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->getOrder($request->validated());
    }

    /**
    * Make order
    */
    public function createOrder(CartInterface $service, CreateOrderRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->createOrder($request->validated());
    }
}
