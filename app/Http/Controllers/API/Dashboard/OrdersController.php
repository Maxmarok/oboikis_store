<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getOrders()
    {
        $orders = Orders::with(['order_items', 'user'])->orderByRaw('FIELD(status, 0,1,3,2)')->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }

    public function confirmOrder($id)
    {
        $order = $this->changeStatus($id, 1);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function cancelOrder($id)
    {
        $order = $this->changeStatus($id, 2);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function completeOrder($id)
    {
        $order = $this->changeStatus($id, 3);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    protected function changeStatus($id, $status)
    {
        $order = Orders::find($id);
        $order->status = $status;
        $order->save();

        return $order;
    }
}
