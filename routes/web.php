<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $title = 'Главная';
    $short_description  = 'Главная страница магазина "Обойкис"';

    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});

Route::get('/about', function () {
    $title = 'О компании "Обойкис"';
    $short_description  = 'О компании "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});


Route::get('/contacts', function () {
    $title = 'Контакты "Обойкис"';
    $short_description  = 'Контакты магазина "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});

Route::get('/catalog', function () {
    $title = 'Каталог "Обойкис"';
    $short_description  = 'Каталог магазина "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});

Route::get('/catalog/{section}', function () {
    $title = 'Каталог "Обойкис"';
    $short_description  = 'Каталог магазина "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});

Route::get('/catalog/{section}/{id}', function () {
    $title = 'Каталог "Обойкис"';
    $short_description  = 'Каталог магазина "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
})->name('catalog_item');

Route::get('/dashboard', function () {
    $title = 'Админка "Обойкис"';
    $short_description  = 'Админка "Обойкис"';
    
    return view('dashboard', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});

Route::get('/catalog/cart', function () {
    $title = 'Корзина';
    $short_description  = 'Корзина в магазине "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});

Route::get('/catalog/cart/order', function () {
    $title = 'Оформление заказа';
    $short_description  = 'Оформление заказа в магазине "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});


Route::get('/payment', function () {
    $title = 'Способы оплаты';
    $short_description  = 'Способы оплаты в магазине "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});


Route::get('/delivery', function () {
    $title = 'Условия доставки';
    $short_description  = 'Условия доставки "Обойкис"';
    
    return view('index', [
        'title' => $title,
        'short_description' => $short_description,
    ]);
});