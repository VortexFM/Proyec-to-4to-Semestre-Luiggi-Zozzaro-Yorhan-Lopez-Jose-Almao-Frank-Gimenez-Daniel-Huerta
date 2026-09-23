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
                            <li>
                                <label class="filter-checkbox">
                                    <input type="checkbox" class="form-checkbox">
                                    <span>Ropa</span>
                                </label>
                            </li>
                            <li>
                                <label class="filter-checkbox">
                                    <input type="checkbox" class="form-checkbox">
                                    <span>Artesanía</span>
                                </label>
                            </li>
                            <li>
                                <label class="filter-checkbox">
                                    <input type="checkbox" class="form-checkbox">
                                    <span>Alimentos</span>
                                </label>
                            </li>
                            <li>
                                <label class="filter-checkbox">
                                    <input type="checkbox" class="form-checkbox">
                                    <span>Libros</span>
                                </label>
                            </li>
                            <li>
                                <label class="filter-checkbox">
                                    <input type="checkbox" class="form-checkbox">
                                    <span>Accesorios</span>
                                </label>
                            </li>
                        </ul>
                    </div>

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
                    <p>Mostrando <strong>12</strong> productos</p>
                    <select class="form-select">
                        <option>12 por página</option>
                        <option>24 por página</option>
                        <option>48 por página</option>
                    </select>
                </section>

                {{-- Grid de productos --}}
                <section class="grid grid--3">
                    @for ($i = 1; $i <= 12; $i++)
                        <x-product-card
                            :nombre="'Producto ' . $i"
                            :descripcion="'Descripción breve del producto ' . $i"
                            :precio="25.00 + $i"
                        />
                    @endfor
                </section>

                {{-- Paginación --}}
                <nav class="pagination">
                    <a href="#" class="pagination__link">Anterior</a>
                    <a href="#" class="pagination__link pagination__link--active">1</a>
                    <a href="#" class="pagination__link">2</a>
                    <a href="#" class="pagination__link">3</a>
                    <a href="#" class="pagination__link">Siguiente</a>
                </nav>

            </main>

        </section>
    </section>

@endsection