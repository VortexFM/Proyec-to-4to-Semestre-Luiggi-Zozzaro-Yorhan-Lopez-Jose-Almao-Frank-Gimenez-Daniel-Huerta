@extends('layouts.app')

@section('title', $categoria->name . ' - Mi Tienda')

@section('content')

    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">{{ $categoria->name }}</h1>
            <p class="page-header__subtitle">{{ $categoria->description }}</p>
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

            {{-- PRODUCTOS --}}
            <main class="catalog-content">

                <section class="catalog-toolbar">
                    <p>Mostrando <strong>{{ $productos->total() }}</strong> productos de <strong>{{ $categoria->name }}</strong></p>
                </section>

                <section class="grid grid--3">
                    @forelse ($productos as $producto)
                        <x-product-card
                            :nombre="$producto->name"
                            :descripcion="$producto->description"
                            :precio="$producto->price"
                            :precio-oferta="$producto->sale_price"
                        />
                    @empty
                        <p>No hay productos en esta categoría.</p>
                    @endforelse
                </section>

                {{ $productos->links() }}

            </main>

        </section>
    </section>

@endsection