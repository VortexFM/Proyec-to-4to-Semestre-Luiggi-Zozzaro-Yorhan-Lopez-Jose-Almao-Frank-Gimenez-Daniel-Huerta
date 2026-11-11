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
use App\Http\Controllers\Api\ExportController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\AdvancedReportController;

// Ruta de prueba
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CRUDs Básicos
Route::apiResource('productos', ProductController::class);
Route::apiResource('categorias', CategoryController::class);
Route::post('cupones/validate', [CouponController::class, 'validate_coupon']);
Route::apiResource('cupones', CouponController::class);
Route::get('direcciones/estados', [AddressController::class, 'estados']);
Route::apiResource('direcciones', AddressController::class);

// Reportes Simples (Gráficos de la vista de reportes básica)
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

// Carrito y Checkout
Route::middleware('web')->group(function () {
    Route::prefix('carrito')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/agregar', [CartController::class, 'add']);
        Route::put('/actualizar', [CartController::class, 'update']);
        Route::delete('/eliminar/{id}', [CartController::class, 'remove']);
        Route::delete('/vaciar', [CartController::class, 'clear']);
    });
    Route::post('/checkout/procesar', [CheckoutController::class, 'procesar']);
});

// Pedidos y Usuarios
Route::get('pedidos', [OrderController::class, 'index']);
Route::get('pedidos/{id}', [OrderController::class, 'show']);
Route::put('pedidos/{id}/status', [OrderController::class, 'updateStatus']);
Route::apiResource('usuarios', UserController::class);

// Exportaciones Excel/PDF/Word
Route::get('/exportar/excel', [ExportController::class, 'excel']);
Route::get('/exportar/pdf', [ExportController::class, 'pdf']);
Route::get('/exportar/word', [ExportController::class, 'word']);
Route::get('/exportar/ventas', [ExportController::class, 'salesExcel']);
Route::get('/exportar/pedidos', [ExportController::class, 'ordersExcel']);
Route::get('/exportar/direcciones', [ExportController::class, 'addressesExcel']);
Route::get('/exportar/clientes', [ExportController::class, 'usersExcel']);

// Mi Cuenta (Cliente)
Route::middleware('web')->get('/mi-cuenta', [CustomerController::class, 'dashboard']);

// ==========================================
// REPORTES AVANZADOS Y GRÁFICOS
// ==========================================
Route::prefix('reportes/avanzados')->group(function () {
    // Datos para los KPIs
    Route::get('/estrategico', [AdvancedReportController::class, 'strategic']);
    Route::get('/marketing', [AdvancedReportController::class, 'marketing']);
    Route::get('/tactico', [AdvancedReportController::class, 'tactical']);
    Route::get('/operativo', [AdvancedReportController::class, 'operational']);
    
    // Datos para Exportaciones
    Route::get('/exportar-estrategico', [AdvancedReportController::class, 'exportStrategic']);
    Route::get('/exportar-marketing', [AdvancedReportController::class, 'exportMarketing']);
    Route::get('/exportar-estancados', [AdvancedReportController::class, 'exportStagnant']);
    Route::get('/exportar-crecimiento', [AdvancedReportController::class, 'exportClientGrowth']);
    Route::get('/exportar-ticket', [AdvancedReportController::class, 'exportAverageTicket']);
    Route::get('/estancados', [AdvancedReportController::class, 'stagnantProducts']);
    Route::get('/crecimiento', [AdvancedReportController::class, 'clientGrowth']);
    Route::get('/ticket-promedio', [AdvancedReportController::class, 'averageTicket']);

    // 👇 DATOS PARA LOS GRÁFICOS (Aquí estaba el error, ahora están dentro del grupo) 👇
    Route::get('/revenue-chart', [AdvancedReportController::class, 'revenueChart']);
    Route::get('/status-chart', [AdvancedReportController::class, 'statusChart']);
    Route::get('/low-stock-chart', [AdvancedReportController::class, 'lowStockChart']);
    Route::get('/coupons-chart', [AdvancedReportController::class, 'couponsChart']);
    Route::get('/categories-chart', [AdvancedReportController::class, 'categoriesChart']);
});