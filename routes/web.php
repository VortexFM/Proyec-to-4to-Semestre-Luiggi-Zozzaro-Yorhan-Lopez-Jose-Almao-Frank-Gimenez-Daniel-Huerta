<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/productos', function () {
    $productos = \App\Models\Product::with('category')
        ->where('active', true)
        ->orderBy('created_at', 'desc')
        ->paginate(12);

    $categorias = \App\Models\Category::where('active', true)->get();

    return view('products.index', compact('productos', 'categorias'));
})->name('productos.index');

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

Route::get('/carrito', function () {
    return view('cart.index');
})->name('carrito.index');

Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/perfil', function () {
    return view('profile.index');
})->name('perfil.index');

Route::get('/contacto', function () {
    return view('pages.contact');
})->name('contacto');

Route::get('/nosotros', function () {
    return view('pages.about');
})->name('nosotros');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

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

Route::get('/categorias', function () {
    return view('pages.categories');
})->name('categorias');

Route::get('/categoria/{slug}', function ($slug) {
    return view('products.category', ['slug' => $slug]);
})->name('categoria.show');

// Rutas del panel de administración
Route::get('/admin/productos/crear', function () {
    return view('admin.products.create');
})->name('admin.products.create');

Route::get('/admin/productos/{id}/editar', function ($id) {
    return view('admin.products.edit', ['id' => $id]);
})->name('admin.products.edit');

Route::get('/admin/productos/{id}', function ($id) {
    return view('admin.products.show', ['id' => $id]);
})->name('admin.products.show');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/productos', function () {
    return view('admin.products.index');
})->name('admin.products.index');

Route::get('/admin/pedidos', function () {
    return view('admin.orders.index');
})->name('admin.orders.index');

Route::get('/admin/clientes', function () {
    return view('admin.clients.index');
})->name('admin.clients.index');

Route::get('/admin/reportes', function () {
    return view('admin.reports.index');
})->name('admin.reports.index');

Route::get('/admin/productos', function () {
    return view('admin.products.index');
})->name('admin.products.index');

Route::get('/admin/productos/{id}/editar', function ($id) {
    return view('admin.products.edit', ['id' => $id]);
})->name('admin.products.edit');

Route::get('/admin/pedidos', function () {
    return view('admin.orders.index');
})->name('admin.orders.index');

Route::get('/admin/pedidos/{id}', function ($id) {
    return view('admin.orders.show', ['id' => $id]);
})->name('admin.orders.show');

Route::get('/admin/clientes', function () {
    return view('admin.clients.index');
})->name('admin.clients.index');

Route::get('/admin/reportes', function () {
    return view('admin.reports.index');
})->name('admin.reports.index');

Route::get('/pedido/confirmacion', function () {
    return view('checkout.success');
})->name('pedido.confirmacion');
