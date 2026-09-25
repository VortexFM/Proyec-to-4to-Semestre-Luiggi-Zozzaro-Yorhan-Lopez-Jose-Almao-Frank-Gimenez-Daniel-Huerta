@extends('layouts.app')

@section('title', 'Categoría - Mi Tienda')

@section('content')

    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">Categoría: {{ ucfirst($slug) }}</h1>
            <p class="page-header__subtitle">Productos disponibles en esta categoría</p>
        </section>
    </header>

    <section class="section container">
        <section class="catalog-layout">

            {{-- SIDEBAR DE FILTROS --}}
            <aside class="catalog-sidebar">
                <section class="sidebar">
                    <h2 class="sidebar__title">Filtros</h2>

                    <section class="form-group">
                        <label class="form-label" for="search">Buscar</label>
                        <input type="text" id="search" class="form-input" placeholder="Nombre del producto...">
                    </section>

                    <section class="form-group">
                        <label class="form-label">Rango de precio</label>
                        <section class="price-range">
                            <input type="number" class="form-input" placeholder="Min">
                            <input type="number" class="form-input" placeholder="Max">
                        </section>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="sort">Ordenar por</label>
                        <select id="sort" class="form-select">
                            <option>Más recientes</option>
                            <option>Precio: menor a mayor</option>
                            <option>Precio: mayor a menor</option>
                        </select>
                    </section>

                    <button class="btn btn--primary btn--block">Aplicar filtros</button>
                </section>
            </aside>

            {{-- LISTA DE PRODUCTOS --}}
            <main class="catalog-content">

                <section class="catalog-toolbar">
                    <p>Mostrando <strong>8</strong> productos de <strong>{{ ucfirst($slug) }}</strong></p>
                    <select class="form-select">
                        <option>12 por página</option>
                        <option>24 por página</option>
                    </select>
                </section>

                <section class="grid grid--3">
                    @for ($i = 1; $i <= 8; $i++)
                        <x-product-card
                            :nombre="ucfirst($slug) . ' ' . $i"
                            :descripcion="'Producto de la categoría ' . $slug"
                            :precio="25.00 + $i"
                        />
                    @endfor
                </section>

                <nav class="pagination" aria-label="Paginación">
                    <a href="#" class="pagination__link">Anterior</a>
                    <a href="#" class="pagination__link pagination__link--active">1</a>
                    <a href="#" class="pagination__link">2</a>
                    <a href="#" class="pagination__link">Siguiente</a>
                </nav>

            </main>

        </section>
    </section>

@endsection