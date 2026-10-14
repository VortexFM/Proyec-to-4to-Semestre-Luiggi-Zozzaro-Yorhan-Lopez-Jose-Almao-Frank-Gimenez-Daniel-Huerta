<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::query();

        if ($request->filled('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        if ($request->has('active')) {
            $query->where('active', $request->boolean('active'));
        }

        $coupons = $query->orderBy('created_at', 'desc')->paginate(12);

        return response()->json([
            'success' => true,
            'data'    => $coupons,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'        => 'required|string|max:50|unique:coupons,code',
            'discount'    => 'required|numeric|min:0|max:100',
            'min_amount'  => 'nullable|numeric|min:0',
            'valid_from'  => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'max_uses'    => 'nullable|integer|min:1',
            'active'      => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
            ], 400);
        }

        $coupon = Coupon::create([
            'created_by'  => $request->user()?->id,
            'code'        => strtoupper($request->code),
            'discount'    => $request->discount,
            'min_amount'  => $request->min_amount ?? 0,
            'valid_from'  => $request->valid_from,
            'valid_until' => $request->valid_until,
            'max_uses'    => $request->max_uses,
            'uses'        => 0,
            'active'      => $request->active ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cupón creado correctamente',
            'data'    => $coupon,
        ], 201);
    }

    public function show($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $coupon,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón no encontrado',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'code'        => 'sometimes|required|string|max:50|unique:coupons,code,' . $id,
            'discount'    => 'sometimes|required|numeric|min:0|max:100',
            'min_amount'  => 'nullable|numeric|min:0',
            'valid_from'  => 'sometimes|required|date',
            'valid_until' => 'sometimes|required|date|after_or_equal:valid_from',
            'max_uses'    => 'nullable|integer|min:1',
            'active'      => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $request->all();
        if ($request->filled('code')) {
            $data['code'] = strtoupper($request->code);
        }

        $coupon->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Cupón actualizado correctamente',
            'data'    => $coupon,
        ], 200);
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón no encontrado',
            ], 404);
        }

        $coupon->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cupón eliminado correctamente',
        ], 200);
    }

    /**
     * POST /api/cupones/validate
     * Validar cupón contra un monto (para checkout)
     */
    public function validate_coupon(Request $request)
    {
        $request->validate([
            'code'   => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Cupón inválido o expirado',
            ], 400);
        }

        $discount = $coupon->calculateDiscount($request->amount);

        if ($discount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'El monto no alcanza el mínimo requerido ($' . $coupon->min_amount . ')',
            ], 400);
        }

        return response()->json([
            'success'  => true,
            'discount' => $discount,
            'total'    => $request->amount - $discount,
        ], 200);
    }
}