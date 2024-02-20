<?php

namespace App\Services\Sbis;

interface SbisInterface
{
    public function updateItem(string $name): \Illuminate\Http\JsonResponse;

    public function addItems(int $page = 0): void;

    public function insertItems(array $data): void;

    public function getItems(int $page = 0, string $search = null): array;
}