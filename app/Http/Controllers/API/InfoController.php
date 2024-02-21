<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Info\InfoInterface;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    public function getInfo(InfoInterface $service): JsonResponse
    {
        return $service->getInfo();
    }
}
