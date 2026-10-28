<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * GET /api/pedidos
     * Listar todos los pedidos (con filtros)
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por número de orden o nombre
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('order_number', 'like', "%$s%")
                  ->orWhere('shipping_name', 'like', "%$s%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data'    => $orders,
        ], 200);
    }

    /**
     * GET /api/pedidos/{id}
     * Ver el detalle de un pedido
     */
    public function show($id)
    {
        // Cargamos los items y el producto de cada item
        $order = Order::with(['user', 'items.product'])->find($id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pedido no encontrado'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $order,
        ], 200);
    }

    /**
     * PUT /api/pedidos/{id}/estado
     * Cambiar el estado de un pedido
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pendiente,confirmado,preparando,enviado,entregado,cancelado'
        ]);

        $order = Order::find($id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Pedido no encontrado'], 404);
        }

        $order->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado a: ' . $request->status,
            'data'    => $order
        ], 200);
    }
}