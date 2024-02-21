<?php

namespace App\Services\Catalog;

use Illuminate\Http\JsonResponse;

interface CatalogInterface {

    /**
     * Get Catalog items
     */
    public function getCatalog(): JsonResponse;
}