<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InfoController extends Controller
{
    public function getInfo()
    {
        if(!Cache::has('info')) {
            Cache::put('info', Info::first(), 5000);
        }

        return response()->json([
            'success' => true,
            'data' => Cache::get('info'),
        ]);
    }
}
