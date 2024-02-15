<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\MakeOrderJob;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\User;
use App\Services\CartController\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private CartService $service;

    public function __construct()
    {
        $this->service = new CartService();
    }

    /**
    * Get items from cart
    */
    public function getCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'ids' => 'sometimes|array',
        ]);

        return $this->service->getCart($data);
    }

    /**
    * Get info about order
    */
    public function getOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'items' => 'sometimes|array',
        ]);

        return $this->service->getOrder($data);
    }

    /**
    * Make order
    */
    public function createOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'comment' => 'sometimes',
            'reciever' => 'sometimes',
            'delivery' => 'sometimes',
            'city' => 'required_if:delivery,=,ship',
            'address' => 'required_if:delivery,=,ship',
            'items' => 'required|array',
            'rules' => 'accepted',
        ]);

        return $this->service->createOrder($data);
    }
}
