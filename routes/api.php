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

    Route::prefix('items')->group(function(){
        Route::post('/', [App\Http\Controllers\API\ItemsController::class, 'getItems']);
    });

    Route::prefix('item')->group(function(){
        Route::post('/', [App\Http\Controllers\API\ItemsController::class, 'getItem']);
    });

    Route::prefix('cart')->group(function(){
        Route::post('/', [App\Http\Controllers\API\CartController::class, 'getCart']);
    });

    Route::prefix('slider')->group(function(){
        Route::get('/', [App\Http\Controllers\API\ItemsController::class, 'getItemsForSlider']);
    });

    Route::prefix('delivery')->group(function(){
        Route::post('/', [App\Http\Controllers\API\CartController::class, 'sendForm']);
    });
    
});