<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
        public function procesar(Request $request)
    {
        // 1. Validar que haya productos en el carrito
        $cart = $request->input('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'El carrito está vacío'], 400);
        }

        $user = Auth::user();
        
        DB::beginTransaction();
        try {
            $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
            
            // 2. Creamos la orden mapeando los datos del formulario a las columnas en inglés
            $order = Order::create([
                'user_id' => $user ? $user->id : 1,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                
                // Datos de envío (Laravel recibe en español, guarda en inglés)
                'shipping_name' => $request->shipping_name ?? 'Cliente',
                'shipping_phone' => $request->shipping_phone ?? '000',
                'shipping_state' => $request->shipping_estado ?? 'Por definir',
                'shipping_municipality' => 'Por definir', 
                'shipping_parish' => 'Por definir',
                'shipping_city' => $request->shipping_ciudad ?? 'Por definir',
                'shipping_street' => $request->shipping_direccion ?? 'Sin dirección',
                
                // Totales y Estado
                'subtotal' => $subtotal,
                'shipping' => 5.00,
                'tax' => 0,
                'total' => $subtotal + 5.00,
                'status' => 'pendiente',
                'payment_method' => $request->payment_method ?? 'transferencia',
                'notes' => $request->notes ?? null,
            ]);

            // 3. Guardar los productos del carrito
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                // Descontar stock
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => '¡Compra realizada con éxito!',
                'order_number' => $order->order_number
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al procesar: ' . $e->getMessage()], 500);
        }
    }
}