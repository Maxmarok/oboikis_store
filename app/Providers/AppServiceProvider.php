<?php

namespace App\Providers;

use App\Services\Breadcrumbs\BreadcrumbsInterface, App\Services\Breadcrumbs\BreadcrumbsService;
use App\Services\Catalog\CatalogInterface, App\Services\Catalog\CatalogService;
use App\Services\Cart\CartInterface, App\Services\Cart\CartService;
use App\Services\Info\InfoInterface, App\Services\Info\InfoService;
use App\Services\Items\ItemsInterface, App\Services\Items\ItemsService;
use App\Services\Orders\OrdersInterface, App\Services\Orders\OrdersService;
use App\Services\Sbis\SbisInterface, App\Services\Sbis\SbisService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BreadcrumbsInterface::class, BreadcrumbsService::class);
        $this->app->bind(CatalogInterface::class, CatalogService::class);
        $this->app->bind(CartInterface::class, CartService::class);
        $this->app->bind(InfoInterface::class, InfoService::class);
        $this->app->bind(ItemsInterface::class, ItemsService::class);
        $this->app->bind(OrdersInterface::class, OrdersService::class);
        $this->app->bind(SbisInterface::class, SbisService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
