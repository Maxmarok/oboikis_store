<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetItemRequest;
use App\Http\Requests\GetItemsRequest;
use App\Services\Items\ItemsInterface;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
    public function __construct(
        private ItemsInterface $service
    ){}

    public function getItems(GetItemsRequest $request): JsonResponse
    {
        return $this->service->getItemsForUser($request->validated());
    }

    public function getItem(GetItemRequest $request): JsonResponse
    {
        return $this->service->getItem($request->validated());
    }

    public function getItemsForSlider(): JsonResponse
    {
        return $this->service->getItemsForSlider();
    }
}
