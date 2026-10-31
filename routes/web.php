<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ============================================
// RUTAS PÚBLICAS
// ============================================

// Home
Route::get('/', function () {
    $categorias = \App\Models\Category::where('active', true)->take(4)->get();
    $destacados = \App\Models\Product::with('category')
        ->where('active', true)
        ->where('featured', true)
        ->take(4)
        ->get();
    $recientes = \App\Models\Product::with('category')
        ->where('active', true)
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

    return view('home', compact('categorias', 'destacados', 'recientes'));
})->name('home');

// Catálogo de productos
Route::get('/productos', function () {
    $productos = \App\Models\Product::with('category')
        ->where('active', true)
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    $categorias = \App\Models\Category::where('active', true)->get();

    return view('products.index', compact('productos', 'categorias'));
})->name('productos.index');

// Detalle de producto
Route::get('/producto/{id}', function ($id) {
    $producto = \App\Models\Product::with(['category', 'reviews'])
        ->where('active', true)
        ->findOrFail($id);

    $relacionados = \App\Models\Product::with('category')
        ->where('active', true)
        ->where('category_id', $producto->category_id)
        ->where('id', '!=', $producto->id)
        ->take(4)
        ->get();

    return view('products.show', compact('producto', 'relacionados'));
})->name('productos.show');

// Categorías
Route::get('/categorias', function () {
    $categorias = \App\Models\Category::where('active', true)
        ->withCount('products')
        ->orderBy('name')
        ->get();

    return view('pages.categories', compact('categorias'));
})->name('categorias');

// Productos por categoría
Route::get('/categoria/{slug}', function ($slug) {
    $categoria = \App\Models\Category::where('slug', $slug)
        ->where('active', true)
        ->firstOrFail();

    $productos = \App\Models\Product::with('category')
        ->where('active', true)
        ->where('category_id', $categoria->id)
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    return view('products.category', compact('categoria', 'productos'));
})->name('categoria.show');

// Carrito
Route::get('/carrito', function () {
    return view('cart.index');
})->name('carrito.index');

// Checkout
Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout.index');

// Confirmación de pedido
Route::get('/pedido/confirmacion', function () {
    return view('checkout.success');
})->name('pedido.confirmacion');

// Contacto
Route::get('/contacto', function () {
    return view('pages.contact');
})->name('contacto');

// Sobre nosotros
Route::get('/nosotros', function () {
    return view('pages.about');
})->name('nosotros');

// FAQ
Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

// Páginas legales
Route::get('/terminos', function () {
    return view('pages.legal.terms');
})->name('terminos');

Route::get('/privacidad', function () {
    return view('pages.legal.privacy');
})->name('privacidad');

Route::get('/envios', function () {
    return view('pages.legal.shipping');
})->name('envios');

Route::get('/devoluciones', function () {
    return view('pages.legal.returns');
})->name('devoluciones');

// Clientes 
Route::get('/clientes', function () {
    return view('admin.clients.index');
})->name('admin.clients.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/mi-cuenta', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');
});

// ============================================
// RUTAS DE ADMIN (protegidas)
// ============================================

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Gestión de productos
    Route::get('/productos', function () {
        return view('admin.products.index');
    })->name('admin.products.index');

    Route::get('/productos/crear', function () {
        return view('admin.products.create');
    })->name('admin.products.create');

    Route::get('/productos/{id}/editar', function ($id) {
        return view('admin.products.edit', ['id' => $id]);
    })->name('admin.products.edit');

    Route::get('/productos/{id}', function ($id) {
        return view('admin.products.show', ['id' => $id]);
    })->name('admin.products.show');

    Route::get('/categorias', function () {
    return view('admin.categories.index');
    })->name('admin.categories.index');

    Route::get('/cupones', function () {
    return view('admin.coupons.index');
    })->name('admin.coupons.index');

    Route::get('/direcciones', function () {
    return view('admin.addresses.index');
    })->name('admin.addresses.index');

    Route::get('/reportes', function () {
    return view('admin.reports.index');
    })->name('admin.reports.index');

    // Gestión de pedidos
    Route::get('/pedidos', function () {
        return view('admin.orders.index');
    })->name('admin.orders.index');

    Route::get('/pedidos/{id}', function ($id) {
        return view('admin.orders.show', ['id' => $id]);
    })->name('admin.orders.show');

    // Gestión de clientes
    Route::get('/clientes', function () {
        return view('admin.clients.index');
    })->name('admin.clients.index');

    // Reportes
    Route::get('/reportes', function () {
        return view('admin.reports.index');
    })->name('admin.reports.index');
});

// ============================================
// RUTAS DE AUTENTICACIÓN (Breeze)
// ============================================

require __DIR__.'/auth.php';