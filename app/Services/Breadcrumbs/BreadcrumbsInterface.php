<?php

namespace App\Services\Breadcrumbs;

use App\Services\Items\ItemsInterface;

interface BreadcrumbsInterface {

    /**
     * Get breadcrumbs array
     */
    public function get(array $catalog): array;
}