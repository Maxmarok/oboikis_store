<?php

namespace App\Services\InfoController;

use App\Models\Info;
use Illuminate\Support\Facades\Cache;

class InfoService {

    public function __construct()
    {
        
    }

    /**
    * Return all information
    */
    public function getInfo(): \Illuminate\Http\JsonResponse
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