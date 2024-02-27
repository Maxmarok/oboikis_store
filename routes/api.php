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

    Route::get('/catalog', [App\Http\Controllers\API\CatalogController::class, 'getCatalog']);
    Route::get('/info', [App\Http\Controllers\API\InfoController::class, 'getInfo']);
    Route::post('/items', [App\Http\Controllers\API\ItemsController::class, 'getItems']);
    Route::post('/item', [App\Http\Controllers\API\ItemsController::class, 'getItem']);
    Route::post('/cart', [App\Http\Controllers\API\CartController::class, 'getCart']);
    Route::post('/order', [App\Http\Controllers\API\CartController::class, 'getOrder']);
    Route::get('/slider', [App\Http\Controllers\API\ItemsController::class, 'getItemsForSlider']);
    Route::post('/delivery', [App\Http\Controllers\API\CartController::class, 'createOrder']);
   

    Route::prefix('dashboard')->as('dashboard.')->group(function(){

        Route::post('/login', [App\Http\Controllers\API\Dashboard\AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function() {
            Route::prefix('orders')->as('orders.')->group(function(){
                Route::get('/', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'getOrders']);
                Route::get('/confirm/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'confirmOrder'])->name('confirm');
                Route::get('/cancel/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'cancelOrder'])->name('cancel');
                Route::get('/complete/{id}', [App\Http\Controllers\API\Dashboard\OrdersController::class, 'completeOrder'])->name('complete');
            });

            Route::prefix('items')->as('items.')->group(function(){
                Route::get('/', [App\Http\Controllers\API\Dashboard\ItemsController::class, 'getItems']);
                Route::get('/update/{id}', [App\Http\Controllers\API\Dashboard\ItemsController::class, 'updateItem']);
                Route::get('/sync', [App\Http\Controllers\API\Dashboard\ItemsController::class, 'addItems']);
            });

            Route::prefix('info')->as('info.')->group(function(){
                Route::get('/', [App\Http\Controllers\API\Dashboard\InfoController::class, 'getInfo']);
                Route::post('/update', [App\Http\Controllers\API\Dashboard\InfoController::class, 'updateInfo']);
                Route::post('/upload', [App\Http\Controllers\API\Dashboard\InfoController::class, 'uploadFile']);
            });
        });
    });
    
});