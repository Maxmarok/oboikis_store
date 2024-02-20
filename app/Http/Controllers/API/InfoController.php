<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Info\InfoInterface;

class InfoController extends Controller
{
    public function getInfo(InfoInterface $service): \Illuminate\Http\JsonResponse
    {
        return $service->getInfo();
    }
}
