<?php

namespace App\Services\Cart;

use App\Jobs\MakeOrderJob;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\User;
use App\Services\Breadcrumbs\BreadcrumbsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartService implements CartInterface {

    private BreadcrumbsInterface $breadcrumbs;

    public function __construct(BreadcrumbsInterface $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function getCart(array $data): JsonResponse
    {
        $ids = $data['ids'];

        $items = Items::whereIn('id', $ids)->get();

        $title = 'Корзина товаров';

        $breadcrumbs = $this->breadcrumbs->get([
            'Корзина' => null
        ]);

        return response()->json([
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'data' => $items,
        ]);
    }

    public function getOrder(array $data): JsonResponse
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

        $title = 'Оформление заказа';

        $breadcrumbs = $this->breadcrumbs->get([
            'Корзина' => '/cart',
            $title => null,
        ]);

        return response()->json([
            'title' => $title,
            'breadcrumbs' => $breadcrumbs,
            'success' => true,
            'price' => $price,
        ]);
    }

    public function createOrder(array $data): JsonResponse
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
                'count' => $item['count'],
            ];
        }

        OrderItems::insert($arr);
        MakeOrderJob::dispatchAfterResponse($order, $items);

        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }
}