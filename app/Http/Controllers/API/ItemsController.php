<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Catalogs;
use App\Models\Items;
use App\Services\ItemsController\ItemsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ItemsController extends Controller
{
    private ItemsService $service;

    public function __construct()
    {
        $this->service = new ItemsService();
    }

    public function getItems(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'page' => 'required|int',
            'catalog' => 'required|string',
            'filters' => 'sometimes|array',
            'sales' => 'required|bool',
        ]);

        return $this->service->getItems($data);
    }

    public function getItem(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'id' => 'required|int',
        ]);

        return $this->service->getItem($data);
    }

    public function getItemsForSlider(): \Illuminate\Http\JsonResponse
    {
        return $this->service->getItemsForSlider();
    }
}
