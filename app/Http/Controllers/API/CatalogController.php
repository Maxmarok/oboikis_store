<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Catalog\CatalogInterface;
use Illuminate\Http\JsonResponse;

class CatalogController extends Controller
{
    public function getCatalog(CatalogInterface $service): JsonResponse
    {
        return $service->getCatalog();
    }
}
