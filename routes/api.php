<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ReportController;


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

Route::get('direcciones/estados', [AddressController::class, 'estados']);
Route::apiResource('direcciones', AddressController::class);

Route::prefix('reportes')->group(function () {
    Route::get('resumen',                 [ReportController::class, 'resumen']);
    Route::get('productos-por-categoria', [ReportController::class, 'productosPorCategoria']);
    Route::get('productos-estado',        [ReportController::class, 'productosEstado']);
    Route::get('cupones-estado',          [ReportController::class, 'cuponesEstado']);
    Route::get('direcciones-por-estado',  [ReportController::class, 'direccionesPorEstado']);
    Route::get('top-productos',           [ReportController::class, 'topProductos']);
    Route::get('bajo-stock',              [ReportController::class, 'bajoStock']);
    Route::get('ultimos-clientes',        [ReportController::class, 'ultimosClientes']);
});
