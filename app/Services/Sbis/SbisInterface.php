<?php

namespace App\Services\Sbis;

use App\Models\Orders;
use Illuminate\Http\JsonResponse;

interface SbisInterface
{
    public function updateItem(string $name): JsonResponse;

    public function addItems(int $page = 0): void;

    public function getItems(int $page = 0, string $search = null): array;

    public function createOrder(Orders $order): void;

    public function checkOrder(string $id): array;

    public function checkPayment(string $id): array;

    public function cancelOrder(string $id): array;

    public function getPaymentLink(string $id): string;
}