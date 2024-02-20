<?php

namespace App\Services\Cart;

use App\Jobs\MakeOrderJob;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\User;
use Illuminate\Http\Request;

class CartService implements CartInterface {

    public function __construct()
    {
        
    }

    public function getCart(array $data): \Illuminate\Http\JsonResponse
    {
        $ids = $data['ids'];

        $items = Items::whereIn('id', $ids)->get();

        $breadcrumbs = [
            [
                'title' => 'Главная', 
                'link' => '/',
            ],
            [
                'title' => 'Каталог', 
                'link' => '/catalog',
            ],
            [
                'title' => 'Корзина', 
                'link' => null,
            ],
        ];

        return response()->json([
            'data' => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => '<span>Корзина</span> товаров',
        ]);
    }

    public function getOrder(array $data): \Illuminate\Http\JsonResponse
    {
        $data = $data['items'];
        
        $ids = [];

        foreach($data as $item) {
            $ids[] = $item['id'];
        }

        $items = Items::whereIn('id', $ids)->select('id', 'price', 'discount')->get();

        $price = 0;

        foreach($items as $item) {

            $index = array_search($item->id, array_column($data, 'id'));

            if(isset($data[$index])) $price += ($item->price - $item->discount) * $data[$index]['count'];
        }

        return response()->json([
            'success' => true,
            'price' => $price,
        ]);
    }

    public function createOrder(array $data): \Illuminate\Http\JsonResponse
    {
        $user = User::firstOrCreate(
            ['email' => $data['email']],
            ['email' => $data['email']],
        );

        $order = $user->order()->create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'comment' => $data['comment'],
            'reciever' => $data['reciever'],
            'delivery' => $data['delivery'],
            'city' => $data['city'],
            'address' => $data['address'],
        ]);

        $arr = [];
        $items = $data['items'];
       
        foreach($items as $item) {
            $arr[] = [
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['count'],
            ];
        }

        OrderItems::insert($arr);
        MakeOrderJob::dispatchAfterResponse($order);

        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }
}