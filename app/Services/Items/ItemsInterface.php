<?php

namespace App\Services\Items;

interface ItemsInterface {

    public function getItemsForUser(array $data): \Illuminate\Http\JsonResponse;
    
    public function getItem(array $data): \Illuminate\Http\JsonResponse;

    public function getItemsForSlider(): \Illuminate\Http\JsonResponse;

    public function updateItem(string $id): \Illuminate\Http\JsonResponse;

    public function getItemsForAdmin(): \Illuminate\Http\JsonResponse;

    public function addItems(): \Illuminate\Http\JsonResponse;
}