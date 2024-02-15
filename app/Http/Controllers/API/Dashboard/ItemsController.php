<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Services\Dashboard\ItemsController\ItemsService;

class ItemsController extends Controller
{
    private ItemsService $service;

    public function __construct()
    {
        $this->service = new ItemsService();
    }

    public function getItems(): \Illuminate\Http\JsonResponse
    {
        return $this->service->getItems();
    }

    public function addItems()
    {
        return $this->service->addItems();
    }
}
