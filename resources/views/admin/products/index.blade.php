@extends('layouts.admin')

@section('title', 'Gestión de Productos - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Productos</h1>
            <p class="admin-header__subtitle">Gestiona el catálogo de productos</p>
        </section>
        <a href="{{ url('/admin/productos/crear') }}" class="btn btn--primary">
            + Nuevo producto
        </a>
    </section>

    {{-- BARRA DE FILTROS --}}
    <section class="admin-toolbar">
        <section class="admin-toolbar__search">
            <input type="text" class="form-input" placeholder="Buscar producto..." id="search-product">
        </section>
        <section class="admin-toolbar__filters">
            <select class="form-select" id="filter-category">
                <option value="">Todas las categorías</option>
                @foreach (\App\Models\Category::where('active', true)->get() as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                @endforeach
            </select>
            <select class="form-select" id="filter-status">
                <option value="">Todos los estados</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </section>
    </section>

    {{-- ESTADO DE CARGA --}}
    <section id="products-loading" style="display: none; text-align: center; padding: 2rem;">
        <div class="spinner"></div>
        <p>Cargando productos...</p>
    </section>

    {{-- ESTADO DE ERROR --}}
    <section id="products-error" style="display: none;"></section>

    {{-- TABLA DE PRODUCTOS --}}
    <section class="admin-table-container" id="products-table">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="products-tbody">
                {{-- Los productos se cargan dinámicamente desde la API --}}
            </tbody>
        </table>
    </section>

@endsection