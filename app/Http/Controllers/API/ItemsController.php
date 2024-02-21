<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetItemRequest;
use App\Http\Requests\GetItemsRequest;
use App\Services\Items\ItemsInterface;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
    public function getItems(ItemsInterface $service, GetItemsRequest $request): JsonResponse
    {
        return $service->getItemsForUser($request->validated());
    }

    public function getItem(ItemsInterface $service, GetItemRequest $request): JsonResponse
    {
        return $service->getItem($request->validated());
    }

    public function getItemsForSlider(ItemsInterface $service): JsonResponse
    {
        return $service->getItemsForSlider();
    }
}
