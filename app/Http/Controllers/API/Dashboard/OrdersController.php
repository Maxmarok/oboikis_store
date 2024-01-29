<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getOrders()
    {
        $orders = Orders::with(['order_items', 'user'])->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }
}
