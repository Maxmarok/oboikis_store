<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\InfoUpdateRequest;
use App\Services\Info\InfoInterface;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    public function getInfo(InfoInterface $service): JsonResponse
    {
        return $service->getInfo();
    }

    public function updateInfo(InfoInterface $service, InfoUpdateRequest $request): JsonResponse
    {
        return $service->updateInfo($request->validated());
    }

    public function uploadFile(InfoInterface $service, FileUploadRequest $request): JsonResponse
    {
        return $service->uploadFile($request->validated());
    }
}
