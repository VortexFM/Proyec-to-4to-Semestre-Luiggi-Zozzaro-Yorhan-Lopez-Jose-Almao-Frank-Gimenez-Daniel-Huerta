<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * GET /api/productos
     * Listar todos los productos (paginados)
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filtro por categoría
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filtro por búsqueda
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtro por estado (Activo/Inactivo)
        if($request->has('active') && $request->active !== ''){
            $query->where('active', $request->boolean('active'));
        }

        // Filtro por destacados
        if ($request->has('featured') && $request->featured) {
            $query->where('featured', true);
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $productos = $query->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $productos,
        ], 200);
    }

    /**
     * GET /api/productos/{id}
     * Ver un producto específico
     */
    public function show($id)
    {
        $producto = Product::with(['category', 'reviews'])->find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $producto,
        ], 200);
    }

    /**
     * POST /api/productos
     * Crear un nuevo producto
     */
    public function store(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:50|unique:products,sku',
            'images' => 'nullable|array',
            'featured' => 'boolean',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Crear producto
        $producto = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'images' => $request->images,
            'featured' => $request->featured ?? false,
            'active' => $request->active ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado correctamente',
            'data' => $producto,
        ], 201);
    }

    /**
     * PUT /api/productos/{id}
     * Actualizar un producto
     */
    public function update(Request $request, $id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        // Validación
        $validator = Validator::make($request->all(), [
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|max:150',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'sku' => 'nullable|string|max:50|unique:products,sku,' . $id,
            'images' => 'nullable|array',
            'featured' => 'boolean',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Actualizar producto
        $data = $request->all();
        if ($request->has('name')) {
            $data['slug'] = Str::slug($request->name);
        }
        $producto->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado correctamente',
            'data' => $producto,
        ], 200);
    }

    /**
     * DELETE /api/productos/{id}
     * Eliminar un producto
     */
    public function destroy($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado correctamente',
        ], 200);
    }
}