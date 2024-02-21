<?php

namespace App\Services\Items;

use Illuminate\Http\JsonResponse;

interface ItemsInterface {

    public function getItemsForAdmin(): JsonResponse;

    public function getItemsForUser(array $data): JsonResponse;

    public function getItemsForSlider(): JsonResponse;

    public function getItem(array $data): JsonResponse;

    public function addItems(): JsonResponse;

    public function updateItem(string $id): JsonResponse;
}