@extends('layouts.app')

@section('title', 'Catálogo de Productos - Mi Tienda')

@section('content')

    {{-- ENCABEZADO --}}
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Catálogo de Productos</h1>
            <p class="page-header__subtitle">Explora todos los productos disponibles</p>
        </div>
    </section>

    {{-- CONTENIDO PRINCIPAL --}}
    <section class="section container">
        <section class="catalog-layout">

            {{-- SIDEBAR DE FILTROS --}}
            <aside class="catalog-sidebar">
                <section class="sidebar">
                    <h2 class="sidebar__title">Filtros</h2>

                    {{-- Búsqueda --}}
                    <section class="form-group">
                        <label class="form-label" for="search">Buscar</label>
                        <input type="text" id="search" class="form-input" placeholder="Nombre del producto...">
                    </section>

                    {{-- Categorías --}}
                    <section class="form-group">
                        <label class="form-label">Categorías</label>
                        <ul class="filter-list">
                            @foreach ($categorias as $categoria)
                                <li>
                                    <label class="filter-checkbox">
                                        <input type="checkbox" class="form-checkbox" value="{{ $categoria->id }}">
                                        <span>{{ $categoria->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    {{-- Rango de precio --}}
                    <section class="form-group">
                        <label class="form-label">Rango de precio</label>
                        <section class="price-range">
                            <input type="number" class="form-input" placeholder="Min">
                            <input type="number" class="form-input" placeholder="Max">
                        </section>
                    </section>

                    {{-- Ordenar --}}
                    <section class="form-group">
                        <label class="form-label" for="sort">Ordenar por</label>
                        <select id="sort" class="form-select">
                            <option>Más recientes</option>
                            <option>Precio: menor a mayor</option>
                            <option>Precio: mayor a menor</option>
                            <option>Más vendidos</option>
                        </select>
                    </section>

                    <button class="btn btn--primary btn--block">Aplicar filtros</button>
                </section>
            </aside>

            {{-- LISTA DE PRODUCTOS --}}
            <main class="catalog-content">

                {{-- Toolbar --}}
                <section class="catalog-toolbar">
                    <p>Mostrando <strong>{{ $productos->total() }}</strong> productos</p>
                    <select class="form-select">
                        <option>12 por página</option>
                        <option>24 por página</option>
                        <option>48 por página</option>
                    </select>
                </section>

                {{-- Grid de productos --}}
                <section class="grid grid--3">
                    @forelse ($productos as $producto)
                        <x-product-card
                            :nombre="$producto->name"
                            :descripcion="$producto->description"
                            :precio="$producto->price"
                        />
                        @empty
                            <p> No hay productos disponibles.</p>
                    @endforelse
                </section>

                {{-- Paginación --}}
                {{ $productos->links() }}

            </main>

        </section>
    </section>

@endsection