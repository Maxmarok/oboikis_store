<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Http\Requests\InfoUpdateRequest;
use App\Services\Info\InfoInterface;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    public function __construct(
        private InfoInterface $service
    ){}

    public function getInfo(): JsonResponse
    {
        return $this->service->getInfo();
    }

    public function updateInfo(InfoUpdateRequest $request): JsonResponse
    {
        return $this->service->updateInfo($request->validated());
    }

    public function uploadFile(FileUploadRequest $request): JsonResponse
    {
        return $this->service->uploadFile($request->validated());
    }
}
