@extends('layouts.admin')

@section('title', 'Reportes - Panel de Administración')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="admin-header">
        <section>
            <h1 class="admin-header__title">Reportes</h1>
            <p class="admin-header__subtitle">Análisis de ventas y rendimiento de la tienda</p>
        </section>
        <button type="button" class="btn btn--outline">
            📥 Exportar reporte
        </button>
    </header>

    {{-- FILTROS DE FECHA --}}
    <section class="admin-toolbar" aria-label="Filtros de fecha">
        <form class="admin-toolbar__filters">
            <select class="form-select" aria-label="Rango de fechas">
                <option>Últimos 7 días</option>
                <option selected>Últimos 30 días</option>
                <option>Este mes</option>
                <option>Este año</option>
                <option>Rango personalizado</option>
            </select>
            <input type="date" class="form-input" aria-label="Fecha de inicio">
            <input type="date" class="form-input" aria-label="Fecha de fin">
            <button type="submit" class="btn btn--primary">Aplicar</button>
        </form>
    </section>

    {{-- TARJETAS DE RESUMEN --}}
    <section class="stats-grid">

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--primary">💰</span>
            <section>
                <p class="stat-card__value">$1,250.00</p>
                <p class="stat-card__label">Ventas totales</p>
            </section>
        </article>

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--success">✅</span>
            <section>
                <p class="stat-card__value">32</p>
                <p class="stat-card__label">Pedidos completados</p>
            </section>
        </article>

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--warning">📦</span>
            <section>
                <p class="stat-card__value">145</p>
                <p class="stat-card__label">Productos vendidos</p>
            </section>
        </article>

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--info">👥</span>
            <section>
                <p class="stat-card__value">18</p>
                <p class="stat-card__label">Clientes nuevos</p>
            </section>
        </article>

    </section>

    {{-- GRÁFICO DE VENTAS --}}
    <article class="admin-card">
        <header class="admin-card__header">
            <h2 class="admin-card__title">Ventas de los últimos 7 días</h2>
        </header>

        {{-- Gráfico de barras (simulado con CSS) --}}
        <section class="chart" aria-label="Gráfico de ventas de los últimos 7 días">
            <article class="chart__bar" style="--height: 45%;">
                <span class="chart__value">$45</span>
                <span class="chart__label">Lun</span>
            </article>
            <article class="chart__bar" style="--height: 65%;">
                <span class="chart__value">$65</span>
                <span class="chart__label">Mar</span>
            </article>
            <article class="chart__bar" style="--height: 35%;">
                <span class="chart__value">$35</span>
                <span class="chart__label">Mié</span>
            </article>
            <article class="chart__bar" style="--height: 85%;">
                <span class="chart__value">$85</span>
                <span class="chart__label">Jue</span>
            </article>
            <article class="chart__bar" style="--height: 70%;">
                <span class="chart__value">$70</span>
                <span class="chart__label">Vie</span>
            </article>
            <article class="chart__bar" style="--height: 95%;">
                <span class="chart__value">$95</span>
                <span class="chart__label">Sáb</span>
            </article>
            <article class="chart__bar" style="--height: 55%;">
                <span class="chart__value">$55</span>
                <span class="chart__label">Dom</span>
            </article>
        </section>
    </article>

    {{-- PRODUCTOS MÁS VENDIDOS --}}
    <article class="admin-card">
        <header class="admin-card__header">
            <h2 class="admin-card__title">Productos más vendidos</h2>
            <a href="{{ url('/admin/productos') }}" class="btn btn--ghost btn--sm">Ver todos</a>
        </header>

        <table class="admin-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Vendidos</th>
                    <th scope="col">Ingresos</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $productos = [
                        ['nombre' => 'Camisa estampada', 'categoria' => 'Ropa', 'vendidos' => 32, 'ingresos' => '$800.00'],
                        ['nombre' => 'Taza personalizada', 'categoria' => 'Accesorios', 'vendidos' => 28, 'ingresos' => '$560.00'],
                        ['nombre' => 'Bolso artesanal', 'categoria' => 'Artesanía', 'vendidos' => 21, 'ingresos' => '$630.00'],
                        ['nombre' => 'Libro de arte', 'categoria' => 'Libros', 'vendidos' => 18, 'ingresos' => '$450.00'],
                        ['nombre' => 'Gorra bordada', 'categoria' => 'Ropa', 'vendidos' => 15, 'ingresos' => '$300.00'],
                    ];
                @endphp

                @foreach ($productos as $i => $producto)
                    <tr>
                        <td><strong>{{ $i + 1 }}</strong></td>
                        <td>
                            <section class="product-cell">
                                <figure class="product-cell__image">IMG</figure>
                                <section class="product-cell__info">
                                    <strong>{{ $producto['nombre'] }}</strong>
                                </section>
                            </section>
                        </td>
                        <td>{{ $producto['categoria'] }}</td>
                        <td><span class="badge badge--primary">{{ $producto['vendidos'] }}</span></td>
                        <td><strong>{{ $producto['ingresos'] }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </article>

@endsection