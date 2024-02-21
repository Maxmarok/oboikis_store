<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ItemsService;
use App\Services\Items\ItemsInterface;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
    public function updateItem(ItemsInterface $service, string $id): JsonResponse
    {
        return $service->updateItem($id);
    }

    public function getItems(ItemsInterface $service): JsonResponse
    {
        return $service->getItemsForAdmin();
    }

    public function addItems(ItemsInterface $service): JsonResponse
    {
        return $service->addItems();
    }
}
