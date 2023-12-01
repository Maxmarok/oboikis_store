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
    return view('pages.index');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contacts', function () {
    return view('pages.contacts');
});

Route::get('/catalog', function () {
    return view('pages.catalog');
});

Route::get('/filter', function () {
    return view('pages.filter');
});

Route::get('/item', function () {
    return view('pages.item');
});

Route::get('/cart', function () {
    return view('pages.cart');
});

Route::get('/delivery', function () {
    return view('pages.delivery');
});