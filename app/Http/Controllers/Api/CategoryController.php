<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * GET /api/categorias
     * Listar todas las categorías
     */
    public function index(Request $request)
    {
        $query = Category::withCount('products');

        // Filtro por búsqueda
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtro por estado
        if ($request->has('active')) {
            $query->where('active', $request->active);
        }

        // Ordenamiento
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $categorias = $query->paginate(12);

        return response()->json([
            'success' => true,
            'data' => $categorias,
        ], 200);
    }

    /**
     * GET /api/categorias/{id}
     * Ver una categoría específica
     */
    public function show($id)
    {
        $categoria = Category::withCount('products')->find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $categoria,
        ], 200);
    }

    /**
     * POST /api/categorias
     * Crear una nueva categoría
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 400);
        }

        $categoria = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
            'active' => $request->active ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Categoría creada correctamente',
            'data' => $categoria,
        ], 201);
    }

    /**
     * PUT /api/categorias/{id}
     * Actualizar una categoría
     */
    public function update(Request $request, $id)
    {
        $categoria = Category::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->all();
        if ($request->has('name')) {
            $data['slug'] = Str::slug($request->name);
        }
        $categoria->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Categoría actualizada correctamente',
            'data' => $categoria,
        ], 200);
    }

    /**
     * DELETE /api/categorias/{id}
     * Eliminar una categoría
     */
    public function destroy($id)
    {
        $categoria = Category::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada',
            ], 404);
        }

        // Verificar si tiene productos asociados
        if ($categoria->products()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar la categoría porque tiene productos asociados',
            ], 400);
        }

        $categoria->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada correctamente',
        ], 200);
    }
}