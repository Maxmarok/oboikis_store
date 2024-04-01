<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Catalog\CatalogInterface;
use Illuminate\Http\JsonResponse;

class CatalogController extends Controller
{
    public function __construct(
        private CatalogInterface $service
    ){}

    public function getCatalog(): JsonResponse
    {
        return $this->service->getCatalog();
    }
}
