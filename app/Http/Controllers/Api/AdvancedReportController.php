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

        // 1. SUPERVISIÓN: Rendimiento de Cupones (¿Estamos gastando mucho en descuentos?)
    public function supervisionCoupons()
    {
        $coupons = Coupon::where('uses', '>', 0)->get();
        $totalDiscount = Order::sum(DB::raw('subtotal - total'));
        
        return response()->json([
            'success' => true,
            'data' => [
                'cupones_usados' => $coupons,
                'dinero_perdido_en_descuentos' => $totalDiscount
            ]
        ]);
    }

    // 2. SUPERVISIÓN: Productos Estancados (Stock alto, ventas 0)
    public function supervisionStagnantProducts()
    {
        // Buscamos productos con stock > 10 que no aparezcan en order_items
        $productosEstancados = Product::where('stock', '>', 10)
            ->whereDoesntHave('orderItems') // Asumiendo que tienes esta relación
            ->get();

        return response()->json(['success' => true, 'data' => $productosEstancados]);
    }

        // 1. GERENCIAL: Crecimiento de Clientes
    public function managerialClientGrowth()
    {
        $clientesEsteMes = User::where('role', 'cliente')
            ->whereMonth('created_at', now()->month)
            ->count();
            
        $clientesMesPasado = User::where('role', 'cliente')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'este_mes' => $clientesEsteMes,
                'mes_pasado' => $clientesMesPasado,
                'crecimiento_porcentual' => $clientesMesPasado > 0 ? (($clientesEsteMes - $clientesMesPasado) / $clientesMesPasado) * 100 : 0
            ]
        ]);
    }

    // 2. GERENCIAL: Ticket Promedio
    public function managerialAverageTicket()
    {
        $totalVentas = Order::where('status', '!=', 'cancelado')->sum('total');
        $cantidadPedidos = Order::where('status', '!=', 'cancelado')->count();
        
        $ticketPromedio = $cantidadPedidos > 0 ? $totalVentas / $cantidadPedidos : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'ticket_promedio' => $ticketPromedio,
                'total_pedidos' => $cantidadPedidos
            ]
        ]);
    }

        // --- REPORTES DE SUPERVISIÓN ---

    // Supervisión: Productos Estancados (Stock > 10 y sin ventas)
    public function stagnantProducts()
    {
        $productos = Product::where('stock', '>', 10)
            ->whereDoesntHave('orderItems') // Asumimos que tienes esta relación en el modelo Product
            ->get();
        return response()->json(['success' => true, 'data' => $productos]);
    }

    // Supervisión: Rendimiento de Categorías (Táctico)
    public function tacticalPerformance()
    {
        // Ya lo tenías, pero lo dejamos aquí para que el JS lo consuma
        $categories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();
        return response()->json(['success' => true, 'data' => $categories]);
    }

    // --- REPORTES GERENCIALES ---

    // Gerencial: Crecimiento de Clientes
    public function clientGrowth()
    {
        $esteMes = User::where('role', 'cliente')->whereMonth('created_at', now()->month)->count();
        $mesPasado = User::where('role', 'cliente')->whereMonth('created_at', now()->subMonth()->month)->count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'este_mes' => $esteMes,
                'mes_pasado' => $mesPasado,
                'crecimiento' => $mesPasado > 0 ? (($esteMes - $mesPasado) / $mesPasado) * 100 : 0
            ]
        ]);
    }

    // Gerencial: Ticket Promedio
    public function averageTicket()
    {
        $totalVentas = Order::where('status', '!=', 'cancelado')->sum('total');
        $cantidadPedidos = Order::where('status', '!=', 'cancelado')->count();
        
        return response()->json([
            'success' => true,
            'data' => [
                'ticket_promedio' => $cantidadPedidos > 0 ? $totalVentas / $cantidadPedidos : 0,
                'total_pedidos' => $cantidadPedidos
            ]
        ]);
    }

    public function exportStrategic()
    {
        return Excel::download(new StrategicExport, 'reporte_estrategico_' . date('Y-m-d') . '.xlsx');
    }

    public function exportMarketing()
    {
        return Excel::download(new \App\Exports\MarketingExport, 'reporte_marketing_' . date('Y-m-d') . '.xlsx');
    }

    public function exportStagnant() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\StagnantProductsExport, 'reporte_estancados_' . date('Y-m-d') . '.xlsx');
    }

    public function exportClientGrowth() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ClientGrowthExport, 'reporte_crecimiento_' . date('Y-m-d') . '.xlsx');
    }

    public function exportAverageTicket() {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AverageTicketExport, 'reporte_ticket_' . date('Y-m-d') . '.xlsx');
    }
}