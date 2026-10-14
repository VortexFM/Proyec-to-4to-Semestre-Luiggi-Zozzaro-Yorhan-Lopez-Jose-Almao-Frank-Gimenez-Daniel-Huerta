<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * GET /api/direcciones
     */
    public function index(Request $request)
    {
        $query = Address::with('user:id,name,email');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
                  ->orWhere('urbanizacion', 'like', "%$s%")
                  ->orWhere('ciudad', 'like', "%$s%")
                  ->orWhere('estado', 'like', "%$s%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->has('default') && $request->default !== '') {
            $query->where('default', $request->boolean('default'));
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $addresses = $query->orderBy('default', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->paginate(15);

        return response()->json([
            'success' => true,
            'data'    => $addresses,
        ], 200);
    }

    /**
     * GET /api/direcciones/{id}
     */
    public function show($id)
    {
        $address = Address::with('user:id,name,email')->find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Dirección no encontrada',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $address,
        ], 200);
    }

    /**
     * POST /api/direcciones
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required|exists:users,id',
            'name'              => 'required|string|max:100',
            'phone'             => 'required|string|max:20',
            'estado'            => 'required|string|max:100',
            'municipio'         => 'required|string|max:100',
            'parroquia'         => 'required|string|max:100',
            'ciudad'            => 'required|string|max:100',
            'urbanizacion'      => 'nullable|string|max:150',
            'calle'             => 'nullable|string|max:150',
            'casa'              => 'nullable|string|max:50',
            'punto_referencia'  => 'nullable|string',
            'codigo_postal'     => 'nullable|string|max:10',
            'default'           => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
            ], 400);
        }

        if ($request->boolean('default')) {
            Address::where('user_id', $request->user_id)
                   ->update(['default' => false]);
        }

        $address = Address::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Dirección creada correctamente',
            'data'    => $address,
        ], 201);
    }

    /**
     * PUT /api/direcciones/{id}
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Dirección no encontrada',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'              => 'sometimes|required|string|max:100',
            'phone'             => 'sometimes|required|string|max:20',
            'estado'            => 'sometimes|required|string|max:100',
            'municipio'         => 'sometimes|required|string|max:100',
            'parroquia'         => 'sometimes|required|string|max:100',
            'ciudad'            => 'sometimes|required|string|max:100',
            'urbanizacion'      => 'nullable|string|max:150',
            'calle'             => 'nullable|string|max:150',
            'casa'              => 'nullable|string|max:50',
            'punto_referencia'  => 'nullable|string',
            'codigo_postal'     => 'nullable|string|max:10',
            'default'           => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
            ], 422);
        }

        if ($request->boolean('default')) {
            Address::where('user_id', $address->user_id)
                   ->where('id', '!=', $id)
                   ->update(['default' => false]);
        }

        $address->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Dirección actualizada correctamente',
            'data'    => $address,
        ], 200);
    }

    /**
     * DELETE /api/direcciones/{id}
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Dirección no encontrada',
            ], 404);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dirección eliminada correctamente',
        ], 200);
    }

    /**
     * GET /api/direcciones/estados
     */
    public function estados()
    {
        $estados = Address::select('estado')
                          ->distinct()
                          ->orderBy('estado')
                          ->pluck('estado');

        return response()->json([
            'success' => true,
            'data'    => $estados,
        ], 200);
    }
}