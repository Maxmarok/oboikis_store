<?php

namespace App\Services\Catalog;

use App\Models\Catalogs;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CatalogService implements CatalogInterface {

    public function getCatalog(): JsonResponse
    {
        if(!Cache::has('catalog')) {
            Cache::put('catalog', Catalogs::get(), 5000);
        }

        return response()->json([
            'success' => true,
            'data' => Cache::get('catalog'),
        ]);
    }
}