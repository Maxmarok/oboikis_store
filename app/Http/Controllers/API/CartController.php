<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\MakeOrderJob;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function getCart(Request $request)
    {
        $ids = $request->ids;

        $items = Items::whereIn('id', $ids)->get()->each->setAppends(Items::APPENDS);

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
            'success' => true,
            'data' => $items,
            'breadcrumbs' => $breadcrumbs,
            'title' => '<span>Корзина</span> товаров',
        ]);
    }

    public function sendForm(Request $request)
    {
        $form = $request->validate([
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

        $user = User::firstOrCreate(
            ['email' => $form['email']],
            ['email' => $form['email']],
        );

        $order = $user->order()->create([
            'user_id' => $user->id,
            'name' => $form['name'],
            'phone' => $form['phone'],
            'comment' => $form['comment'],
            'reciever' => $form['reciever'],
            'delivery' => $form['delivery'],
            'city' => $form['city'],
            'address' => $form['address'],
        ]);

        $arr = [];
        $items = $form['items'];
       
        foreach($items as $item) {
            $arr[] = [
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['count'],
            ];
        }

        OrderItems::insert($arr);

        $order_items = OrderItems::where('order_id', $order->id)->get();
        MakeOrderJob::dispatch($order, $order_items);

        return response()->json([
            'success' => true,
            'order' => $order,
            'items' => $order_items,
        ]);
    }
}
