<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/v1',
    'as' => 'api.',
], function(){

    Route::prefix('info')->group(function(){
        Route::get('/', [App\Http\Controllers\API\InfoController::class, 'getInfo']);
    });

    Route::prefix('items')->group(function(){
        Route::post('/', [App\Http\Controllers\API\ItemsController::class, 'getItems']);
    });

    Route::prefix('item')->group(function(){
        Route::post('/', [App\Http\Controllers\API\ItemsController::class, 'getItem']);
    });

    Route::prefix('cart')->group(function(){
        Route::post('/', [App\Http\Controllers\API\CartController::class, 'getCart']);
    });

    Route::prefix('order')->group(function(){
        Route::post('/', [App\Http\Controllers\API\CartController::class, 'getOrder']);
    });

    Route::prefix('slider')->group(function(){
        Route::get('/', [App\Http\Controllers\API\ItemsController::class, 'getItemsForSlider']);
    });

    Route::prefix('delivery')->group(function(){
        Route::post('/', [App\Http\Controllers\API\CartController::class, 'sendForm']);
    });


    Route::prefix('dashboard')->as('dashboard.')->group(function(){
        Route::prefix('orders')->as('orders.')->group(function(){
            Route::get('/', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'getOrders']);
            Route::get('/confirm/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'confirmOrder'])->name('confirm');
            Route::get('/cancel/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'cancelOrder'])->name('cancel');
            Route::get('/complete/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'completeOrder'])->name('complete');
        });

        Route::prefix('items')->as('items.')->group(function(){
            Route::get('/', [App\Http\Controllers\API\Dashboard\ItemsController::class, 'getItems']);
        });

        Route::prefix('info')->as('info.')->group(function(){
            Route::get('/', [App\Http\Controllers\API\Dashboard\InfoController::class, 'getInfo']);
            Route::post('/update', [App\Http\Controllers\API\Dashboard\InfoController::class, 'updateInfo']);
        });
    });
    
});