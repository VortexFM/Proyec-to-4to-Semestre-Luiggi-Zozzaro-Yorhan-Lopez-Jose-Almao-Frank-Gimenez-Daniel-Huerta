<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Ruta de prueba
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CRUD de Productos
Route::apiResource('productos', ProductController::class);

// CRUD de Categorías
Route::apiResource('categorias', CategoryController::class);

Route::post('cupones/validate', [CouponController::class, 'validate_coupon']);
Route::apiResource('cupones', CouponController::class);