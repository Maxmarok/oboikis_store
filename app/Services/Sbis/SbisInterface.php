<?php

namespace App\Services\Sbis;

use Illuminate\Http\JsonResponse;

interface SbisInterface
{
    public function updateItem(string $name): JsonResponse;

    public function addItems(int $page = 0): void;

    public function insertItems(array $data): void;

    public function getItems(int $page = 0, string $search = null): array;
}