<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StrategicExport;
use App\Exports\MarketingExport;
use App\Exports\StagnantProductsExport;
use App\Exports\ClientGrowthExport;
use App\Exports\AverageTicketExport;

class AdvancedReportController extends Controller
{
    // ==========================================
    // DATOS PARA LOS KPIs
    // ==========================================
    public function strategic()
    {
        $total_revenue = Order::where('status', '!=', 'cancelado')->sum('total');
        $inventory_value = Product::sum(DB::raw('price * stock'));
        $total_clients = User::where('role', 'cliente')->count();
        $orders_completed = Order::where('status', 'entregado')->count();
        $orders_pending = Order::where('status', 'pendiente')->count();

        return response()->json([
            'success' => true,
            'data' => compact('total_revenue', 'inventory_value', 'total_clients', 'orders_completed', 'orders_pending')
        ], 200);
    }

    public function marketing()
    {
        $usedCoupons = Coupon::where('uses', '>', 0)->orderBy('uses', 'desc')->get();
        $totalDiscountsGiven = Order::sum(DB::raw('subtotal - total'));
        return response()->json(['success' => true, 'data' => compact('usedCoupons', 'totalDiscountsGiven')], 200);
    }

    public function tactical()
    {
        $categories = Category::withCount('products')->withSum('products as inventory_value', DB::raw('price * stock'))->orderBy('products_count', 'desc')->get();
        return response()->json(['success' => true, 'data' => $categories], 200);
    }

    public function operational()
    {
        $lowStockProducts = Product::where('stock', '<', 10)->orderBy('stock', 'asc')->get();
        $pendingOrders = Order::where('status', 'pendiente')->orderBy('created_at', 'asc')->get();
        return response()->json(['success' => true, 'data' => compact('lowStockProducts', 'pendingOrders')], 200);
    }

    public function stagnantProducts()
    {
        $productos = Product::where('stock', '>', 10)->whereDoesntHave('orderItems')->get();
        return response()->json(['success' => true, 'data' => $productos]);
    }

    public function clientGrowth()
    {
        $esteMes = User::where('role', 'cliente')->whereMonth('created_at', now()->month)->count();
        $mesPasado = User::where('role', 'cliente')->whereMonth('created_at', now()->subMonth()->month)->count();
        return response()->json([
            'success' => true, 
            'data' => ['este_mes' => $esteMes, 'mes_pasado' => $mesPasado]
        ]);
    }

    public function averageTicket()
    {
        $totalVentas = Order::where('status', '!=', 'cancelado')->sum('total');
        $cantidadPedidos = Order::where('status', '!=', 'cancelado')->count();
        return response()->json([
            'success' => true, 
            'data' => ['ticket_promedio' => $cantidadPedidos > 0 ? $totalVentas / $cantidadPedidos : 0]
        ]);
    }

    // ==========================================
    // DATOS PARA LOS GRÁFICOS
    // ==========================================
    public function revenueChart(Request $request)
    {
        $query = Order::where('status', '!=', 'cancelado');
        if ($request->filled('from')) $query->whereDate('created_at', '>=', $request->from);
        if ($request->filled('to')) $query->whereDate('created_at', '<=', $request->to);

        $data = $query->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total'))
            ->groupBy('month')->orderBy('month')->get();

        return response()->json([
            'success' => true,
            'data' => ['labels' => $data->map(fn($d) => 'Mes ' . $d->month), 'values' => $data->pluck('total')]
        ]);
    }

    public function statusChart()
    {
        $data = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $data->pluck('status'),
                'values' => $data->pluck('total')->map(fn($val) => (int) $val) // 👈 Forzamos a entero
            ]
        ]);
    }

    public function lowStockChart()
    {
        $products = Product::where('stock', '<', 10)->orderBy('stock', 'asc')->take(5)->get();
        return response()->json([
            'success' => true,
            'data' => ['labels' => $products->pluck('name'), 'values' => $products->pluck('stock')]
        ]);
    }

    public function couponsChart()
    {
        $coupons = Coupon::orderBy('uses', 'desc')->take(5)->get();
        return response()->json([
            'success' => true,
            'data' => ['labels' => $coupons->pluck('code'), 'values' => $coupons->pluck('uses')]
        ]);
    }

    public function categoriesChart()
    {
        $categories = Category::withCount('products')->get();
        return response()->json([
            'success' => true,
            'data' => ['labels' => $categories->pluck('name'), 'values' => $categories->pluck('products_count')]
        ]);
    }

    // ==========================================
    // EXPORTACIONES A EXCEL
    // ==========================================
    public function exportStrategic() {
        return Excel::download(new StrategicExport, 'reporte_estrategico_' . date('Y-m-d') . '.xlsx');
    }

    public function exportMarketing() {
        return Excel::download(new MarketingExport, 'reporte_marketing_' . date('Y-m-d') . '.xlsx');
    }

    public function exportStagnant() {
        return Excel::download(new StagnantProductsExport, 'reporte_estancados_' . date('Y-m-d') . '.xlsx');
    }

    public function exportClientGrowth() {
        return Excel::download(new ClientGrowthExport, 'reporte_crecimiento_' . date('Y-m-d') . '.xlsx');
    }

    public function exportAverageTicket() {
        return Excel::download(new AverageTicketExport, 'reporte_ticket_' . date('Y-m-d') . '.xlsx');
    }
}