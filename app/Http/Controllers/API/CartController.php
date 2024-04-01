<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetCartRequest;
use App\Http\Requests\GetOrderRequest;
use App\Services\Cart\CartInterface;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function __construct(
        private CartInterface $service
    ){}
    
    /**
    * Get items from cart
    */
    public function getCart(GetCartRequest $request): JsonResponse
    {
        return $this->service->getCart($request->validated());
    }

    /**
    * Get info about order
    */
    public function getOrder(GetOrderRequest $request): JsonResponse
    {
        return $this->service->getOrder($request->validated());
    }

    /**
    * Make order
    */
    public function createOrder(CreateOrderRequest $request): JsonResponse
    {
        return $this->service->createOrder($request->validated());
    }
}
