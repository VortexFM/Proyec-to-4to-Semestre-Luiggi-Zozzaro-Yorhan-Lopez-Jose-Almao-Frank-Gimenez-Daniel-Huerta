<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/productos', function (){
    return view('Products.index');
})->name('productos.index');

Route::get('/producto/{id}', function ($id) {
    return view('products.show', ['id' => $id]);
})->name('productos.show');

Route::get('/carrito', function () {
    return view('cart.index');
})->name('carrito.index');

Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout.index');
