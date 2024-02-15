<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Info;
use App\Services\InfoController\InfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InfoController extends Controller
{
    private InfoService $service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->service = new InfoService();
    }

    public function getInfo(): \Illuminate\Http\JsonResponse
    {
        return $this->service->getInfo();
    }
}
