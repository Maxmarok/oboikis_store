<?php

namespace App\Services\Cart;

use Illuminate\Http\JsonResponse;

interface CartInterface {
    
    /**
    * Return items in cart and breadcrumbs for cart page
    */
    public function getCart(array $data): JsonResponse;

    /**
    * Return items from order
    */
    public function getOrder(array $data): JsonResponse;

    /**
    * Create order from form
    */
    public function createOrder(array $data): JsonResponse;
}