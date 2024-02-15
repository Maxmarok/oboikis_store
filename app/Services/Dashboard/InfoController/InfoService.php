<?php

namespace App\Services\Dashboard\InfoController;

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
        $data = Info::first();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
    * Update information and information cache 
    */
    public function updateInfo(array $data)
    {
        $info = $data['info'];

        Info::first()->update($info);

        Cache::put('info', Info::first(), 5000);

        return response()->json([
            'success' => true,
        ]);
    }
}