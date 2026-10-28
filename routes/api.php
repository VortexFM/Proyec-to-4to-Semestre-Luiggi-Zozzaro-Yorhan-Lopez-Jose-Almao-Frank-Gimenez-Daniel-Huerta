<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;

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

// CRUD de Cupones
Route::post('cupones/validate', [CouponController::class, 'validate_coupon']);
Route::apiResource('cupones', CouponController::class);

// CRUD de Direcciones
Route::get('direcciones/estados', [AddressController::class, 'estados']);
Route::apiResource('direcciones', AddressController::class);

// Reportes
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

// CARRITO Y CHECKOUT (Usando middleware web para que no se pierda la sesión)
Route::middleware('web')->group(function () {
    
    // Rutas del Carrito
    Route::prefix('carrito')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/agregar', [CartController::class, 'add']);
        Route::put('/actualizar', [CartController::class, 'update']);
        Route::delete('/eliminar/{id}', [CartController::class, 'remove']);
        Route::delete('/vaciar', [CartController::class, 'clear']);
    });

    // Ruta del Checkout
    Route::post('/checkout/procesar', [CheckoutController::class, 'procesar']);
});

Route::get('pedidos', [OrderController::class, 'index']);
Route::get('pedidos/{id}', [OrderController::class, 'show']);
Route::put('pedidos/{id}/estado', [OrderController::class, 'updateStatus']);
Route::apiResource('usuarios', UserController::class);


