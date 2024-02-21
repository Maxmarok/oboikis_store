<?php

namespace App\Services\Info;

use App\Models\Info;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class InfoService implements InfoInterface {

    public function __construct()
    {
        
    }

    public function getInfo(): JsonResponse
    {
        if(!Cache::has('info')) {
            Cache::put('info', Info::first(), 5000);
        }

        return response()->json([
            'success' => true,
            'data' => Cache::get('info'),
        ]);
    }

    public function updateInfo(array $data): JsonResponse
    {
        Info::first()->update($data);

        Cache::put('info', Info::first(), 5000);

        return $this->getInfo();
    }

    public function uploadFile(array $data): JsonResponse
    {
        $file = $data['file'];
        $type = $data['type'];
        //$this->deleteFile($type);

        $upload = Storage::put('public/docs', $file);
        $file = Storage::url($upload);

        $info = [
            $type => $file
        ];

        return $this->updateInfo($info);
    }
}