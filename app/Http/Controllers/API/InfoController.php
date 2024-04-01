<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
}
