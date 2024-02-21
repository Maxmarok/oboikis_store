<?php

namespace App\Services\Breadcrumbs;

class BreadcrumbsService implements BreadcrumbsInterface {

    private array $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = [
            [
                'title' => 'Главная', 
                'link' => '/',
            ],
        ];
    }

    public function get(array $catalog): array
    {
        self::build($catalog);
        return $this->breadcrumbs;
    }

    private function build(array $catalog): void
    {
        foreach($catalog as $k => $v) {
            array_push($this->breadcrumbs, [
                'title' => $k,
                'link' => $v,
            ]);
        }
    }
}