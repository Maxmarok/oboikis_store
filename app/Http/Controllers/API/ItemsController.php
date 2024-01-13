<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function get(Request $request)
    {
        $catalogUrl = $request->catalog;

        $items = Items::whereHas('catalog', function($q) use($catalogUrl) {
            $q->where('url', $catalogUrl);
        })->skip(0)->take(30)->get();

        return response()->json([
            "success" => true,
            "data" => $items,
        ]);
    }
}
