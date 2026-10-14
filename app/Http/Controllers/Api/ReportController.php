<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * GET /api/reportes/resumen
     * Tarjetas KPI del dashboard
     */
    public function resumen()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_productos'     => Product::count(),
                'productos_activos'   => Product::where('active', true)->count(),
                'total_categorias'    => Category::count(),
                'total_clientes'      => User::where('role', 'cliente')->count(),
                'total_direcciones'   => Address::count(),
                'total_cupones'       => Coupon::count(),
                'cupones_activos'     => Coupon::where('active', true)
                                            ->where('valid_until', '>=', now())
                                            ->count(),
                'total_pedidos'       => Order::count(),
                'ventas_totales'      => Order::where('status', 'entregado')->sum('total'),
            ],
        ], 200);
    }

    /**
     * GET /api/reportes/productos-por-categoria
     * Gráfico de barras: cuántos productos hay en cada categoría
     */
    public function productosPorCategoria()
    {
        $data = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(8)
            ->get()
            ->map(function ($cat) {
                return [
                    'categoria' => $cat->name,
                    'cantidad'  => $cat->products_count,
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $data,
        ], 200);
    }

    /**
     * GET /api/reportes/productos-estado
     * Gráfico dona: productos activos vs inactivos
     */
    public function productosEstado()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'activos'    => Product::where('active', true)->count(),
                'inactivos'  => Product::where('active', false)->count(),
            ],
        ], 200);
    }

    /**
     * GET /api/reportes/cupones-estado
     * Gráfico dona: cupones activos, vencidos, inactivos
     */
    public function cuponesEstado()
    {
        $total = Coupon::count();

        $activos = Coupon::where('active', true)
            ->where('valid_until', '>=', now())
            ->where('valid_from', '<=', now())
            ->count();

        $vencidos = Coupon::where('valid_until', '<', now())->count();

        $inactivos = $total - $activos - $vencidos;

        return response()->json([
            'success' => true,
            'data' => [
                'activos'   => $activos,
                'vencidos'  => $vencidos,
                'inactivos' => max($inactivos, 0),
            ],
        ], 200);
    }

    /**
     * GET /api/reportes/direcciones-por-estado
     * Gráfico barras horizontales: direcciones agrupadas por estado
     */
    public function direccionesPorEstado()
    {
        $data = Address::select('estado', DB::raw('COUNT(*) as total'))
            ->groupBy('estado')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $data,
        ], 200);
    }

    /**
     * GET /api/reportes/top-productos
     * Tabla: los 5 productos más caros
     */
    public function topProductos()
    {
        $data = Product::with('category')
            ->orderBy('price', 'desc')
            ->take(5)
            ->get()
            ->map(function ($p) {
                return [
                    'id'         => $p->id,
                    'name'       => $p->name,
                    'price'      => $p->price,
                    'stock'      => $p->stock,
                    'categoria'  => $p->category ? $p->category->name : '—',
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $data,
        ], 200);
    }

    /**
     * GET /api/reportes/bajo-stock
     * Tabla: productos con stock menor a 10
     */
    public function bajoStock()
    {
        $data = Product::with('category')
            ->where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get()
            ->map(function ($p) {
                return [
                    'id'        => $p->id,
                    'name'      => $p->name,
                    'stock'     => $p->stock,
                    'categoria' => $p->category ? $p->category->name : '—',
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $data,
        ], 200);
    }

    /**
     * GET /api/reportes/ultimos-clientes
     * Tabla: los 5 clientes más recientes
     */
    public function ultimosClientes()
    {
        $data = User::where('role', 'cliente')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($u) {
                return [
                    'id'         => $u->id,
                    'name'       => $u->name,
                    'email'      => $u->email,
                    'created_at' => $u->created_at->format('d/m/Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $data,
        ], 200);
    }
}