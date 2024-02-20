<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetItemRequest;
use App\Http\Requests\GetItemsRequest;
use App\Services\Items\ItemsInterface;

class ItemsController extends Controller
{
    public function getItems(ItemsInterface $service, GetItemsRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->getItemsForUser($request->validated());
    }

    public function getItem(ItemsInterface $service, GetItemRequest $request): \Illuminate\Http\JsonResponse
    {
        return $service->getItem($request->validated());
    }

    public function getItemsForSlider(ItemsInterface $service): \Illuminate\Http\JsonResponse
    {
        return $service->getItemsForSlider();
    }
}
