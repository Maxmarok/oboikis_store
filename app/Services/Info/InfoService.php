<?php

namespace App\Services\Info;

use App\Models\Info;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InfoService implements InfoInterface {

    public function __construct()
    {
        
    }

    /**
    * Return all information
    */
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

    /**
    * Update information and information cache 
    */
    public function updateInfo(array $data): JsonResponse
    {
        Info::first()->update($data);

        Cache::put('info', Info::first(), 5000);

        return $this->getInfo();
    }

    /**
    * Upload file in storage
    */
    public function uploadFile(array $data): JsonResponse
    {
        $storage = Storage::disk('docs');
        $file = $data['file'];
        $type = $data['type'];
        $fileName = $file->getClientOriginalName();

        $this->deleteFile($type);

        $storage->put($fileName, file_get_contents($file));
        $url = $storage->url($fileName);

        Log::debug($url);

        $info = [
            $type => $fileName
        ];

        return $this->updateInfo($info);
    }

    /**
     * Delete file from storage
     */
    private function deleteFile(string $type)
    {
        $info = Cache::get('info');

        if($info) {
            $file = $info[$type];

            if(Storage::disk('docs')->exists($file)){
                Storage::disk('docs')->delete($file);
            }
        }
    }
}