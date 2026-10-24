<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * GET /api/carrito
     * Devuelve el contenido del carrito
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'items' => array_values($cart),
                'total' => $total,
                'count' => count($cart) // Cantidad de productos distintos
            ]
        ]);
    }

    /**
     * POST /api/carrito/agregar
     * Agrega un producto al carrito
     */
        public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock < $request->quantity) {
            return response()->json(['success' => false, 'message' => 'No hay suficiente stock disponible.'], 400);
        }

        return response()->json([
            'success' => true,
            'product' => [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->sale_price ?? $product->price,
                'quantity' => $request->quantity,
                'category' => $product->category ? $product->category->name : 'Sin categoría',
                'stock'    => $product->stock,
                'image'    => null
            ]
        ], 200);
    }

    /**
     * PUT /api/carrito/actualizar
     * Actualiza la cantidad de un producto
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            // Verificar stock
            $product = Product::find($request->product_id);
            if ($product && $product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay suficiente stock.'
                ], 400);
            }

            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cantidad actualizada'
        ]);
    }

    /**
     * DELETE /api/carrito/eliminar/{id}
     * Elimina un producto del carrito
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado'
        ]);
    }

    /**
     * DELETE /api/carrito/vaciar
     * Vacía el carrito completo
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Carrito vaciado'
        ]);
    }
}