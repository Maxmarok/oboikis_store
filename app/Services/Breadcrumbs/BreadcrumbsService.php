<?php

namespace App\Services;

class BreadcrumbsService {

    private array $breadcrumbs;

    public function __construct(array $catalog)
    {
        $this->breadcrumbs = [
            [
                'title' => 'Главная', 
                'link' => '/',
            ],
        ];
    }

    public static function get()
    {
        return self::$breadcrumbs;
    }
}