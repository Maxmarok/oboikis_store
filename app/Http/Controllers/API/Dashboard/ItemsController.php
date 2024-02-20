<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ItemsService;
use App\Services\Items\ItemsInterface;

class ItemsController extends Controller
{
    public function updateItem(ItemsInterface $service, string $id): \Illuminate\Http\JsonResponse
    {
        return $service->updateItem($id);
    }

    public function getItems(ItemsInterface $service): \Illuminate\Http\JsonResponse
    {
        return $service->getItemsForAdmin();
    }

    public function addItems(ItemsInterface $service): \Illuminate\Http\JsonResponse
    {
        return $service->addItems();
    }
}
