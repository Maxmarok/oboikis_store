<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Items;

class ItemsController extends Controller
{
    public function getItems()
    {
        $orders = Items::orderBy('id', 'desc')->paginate(10);

        $orders->data = $orders->getCollection()->each->setAppends(Items::APPENDS);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }
}
