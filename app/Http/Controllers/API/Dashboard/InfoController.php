<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Services\Dashboard\InfoController\InfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InfoController extends Controller
{
    private InfoService $service;

    public function __construct()
    {
        $this->service = new InfoService();
    }

    public function getInfo(): \Illuminate\Http\JsonResponse
    {
        return $this->service->getInfo();
    }

    public function updateInfo(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'phone' => 'sometimes|string',
            'email' => 'sometimes|string',
            'vk' => 'sometimes|string',
            'telegram' => 'sometimes|string',
            'whatsapp' => 'sometimes|string',
            'viber' => 'sometimes|string',
            'instagram' => 'sometimes|string',
        ]);

        return $this->service->updateInfo($data);
    }

    public function uploadFile(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'file' => 'required|file',
            'type' => 'required|string',
        ]);

        return $this->service->uploadFile($data);
    }
    
}
