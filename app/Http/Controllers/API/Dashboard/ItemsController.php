<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\ItemsService;
use App\Services\Items\ItemsInterface;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
    public function __construct(
        private ItemsInterface $service
    ){}

    public function updateItem(string $id): JsonResponse
    {
        return $this->service->updateItem($id);
    }

    public function getItems(): JsonResponse
    {
        return $this->service->getItemsForAdmin();
    }

    public function addItems(): JsonResponse
    {
        return $this->service->addItems();
    }
}
