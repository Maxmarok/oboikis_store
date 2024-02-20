<?php

namespace App\Services\Cart;

interface CartInterface {
    
    /**
    * Return items in cart and breadcrumbs for cart page
    */
    public function getCart(array $data): \Illuminate\Http\JsonResponse;

    /**
    * Return items from order
    */
    public function getOrder(array $data): \Illuminate\Http\JsonResponse;

    /**
    * Create order from form
    */
    public function createOrder(array $data): \Illuminate\Http\JsonResponse;
}