<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Coupon;
use App\Exports\MarketingExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StrategicExport;

class AdvancedReportController extends Controller
{
    // 1. REPORTE ESTRATÉGICO (Balance General)
    public function strategic()
    {
        // Solo sumamos ventas que no estén canceladas
        $totalRevenue = Order::where('status', '!=', 'cancelado')->sum('total');
        
        // Valor del inventario actual (Precio * Stock)
        $inventoryValue = Product::sum(DB::raw('price * stock'));
        
        // Conteo de clientes
        $totalClients = User::where('role', 'cliente')->count();
        
        // Conteo de pedidos
        $ordersCompleted = Order::where('status', 'entregado')->count();
        $ordersPending = Order::where('status', 'pendiente')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_revenue' => $totalRevenue,
                'inventory_value' => $inventoryValue,
                'total_clients' => $totalClients,
                'orders_completed' => $ordersCompleted,
                'orders_pending' => $ordersPending,
            ]
        ], 200);
    }

    // 2. REPORTE DE MARKETING (Rendimiento de Cupones)
    public function marketing()
    {
        // Traemos los cupones que han sido usados al menos 1 vez
        $usedCoupons = Coupon::where('uses', '>', 0)
            ->orderBy('uses', 'desc')
            ->get();

        // Contamos cuántos pedidos se hicieron con descuento (aquí asumimos que si total < subtotal, hubo descuento)
        // Nota: En tu sistema actual, no guardas el ID del cupón en la orden, así que estimaremos el impacto
        $totalDiscountsGiven = Order::sum(DB::raw('subtotal - total'));

        return response()->json([
            'success' => true,
            'data' => [
                'used_coupons' => $usedCoupons,
                'total_discounts_given' => $totalDiscountsGiven
            ]
        ], 200);
    }

    // 3. REPORTE TÁCTICO (Rendimiento por Categoría)
    public function tactical()
    {
        // Traemos las categorías con el conteo de sus productos y el valor total de su inventario
        $categories = Category::withCount('products')
            ->withSum('products as inventory_value', DB::raw('price * stock'))
            ->orderBy('products_count', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    // 4. REPORTE OPERATIVO (Alertas)
    public function operational()
    {
        // Productos con stock crítico (menos de 10)
        $lowStockProducts = Product::where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->get();

        // Pedidos que están pendientes y necesitan procesarse
        $pendingOrders = Order::where('status', 'pendiente')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'low_stock_products' => $lowStockProducts,
                'pending_orders' => $pendingOrders
            ]
        ], 200);
    }

    public function exportStrategic()
    {
        return Excel::download(new StrategicExport, 'reporte_estrategico_' . date('Y-m-d') . '.xlsx');
    }

    public function exportMarketing()
    {
        return Excel::download(new \App\Exports\MarketingExport, 'reporte_marketing_' . date('Y-m-d') . '.xlsx');
    }
}