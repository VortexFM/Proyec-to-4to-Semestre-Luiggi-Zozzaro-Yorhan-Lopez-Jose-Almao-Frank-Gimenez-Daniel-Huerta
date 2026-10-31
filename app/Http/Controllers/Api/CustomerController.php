<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Obtener los datos del cliente logueado y sus pedidos
    public function dashboard(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        // Traemos los pedidos del cliente con sus items y productos
        $orders = $user->orders()
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'orders' => $orders
            ]
        ], 200);
    }
}