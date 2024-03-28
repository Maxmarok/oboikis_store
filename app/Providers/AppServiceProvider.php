<?php

namespace App\Providers;

use App\Services\Auth\AuthInterface, App\Services\Auth\AuthService;
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
        $this->app->singleton(AuthInterface::class, AuthService::class);
        $this->app->singleton(BreadcrumbsInterface::class, BreadcrumbsService::class);
        $this->app->singleton(CatalogInterface::class, CatalogService::class);
        $this->app->singleton(CartInterface::class, CartService::class);
        $this->app->singleton(InfoInterface::class, InfoService::class);
        $this->app->singleton(ItemsInterface::class, ItemsService::class);
        $this->app->singleton(OrdersInterface::class, OrdersService::class);
        $this->app->singleton(SbisInterface::class, SbisService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
