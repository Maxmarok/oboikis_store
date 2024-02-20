<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\InfoUpdateRequest;
use App\Services\Info\InfoInterface;

class InfoController extends Controller
{
    public function getInfo(InfoInterface $service): \Illuminate\Http\JsonResponse
    {
        return $service->getInfo();
    }

    public function updateInfo(InfoInterface $service, InfoUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->updateInfo($request->validated());
    }

    public function uploadFile(InfoInterface $service, FileUploadRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->uploadFile($request->validated());
    }
}
