@extends('layouts.admin')

@section('title', 'Dashboard - Panel de Administración')

@section('content')

    <section class="admin-header">
        <h1 class="admin-header__title">Dashboard</h1>
        <p class="admin-header__subtitle">Resumen general de la tienda</p>
    </section>

    {{-- TARJETAS DE ESTADÍSTICAS --}}
    <section class="stats-grid">

        <article class="stat-card">
            <section class="stat-card__icon stat-card__icon--primary">💰</section>
            <section>
                <p class="stat-card__value">$1,250.00</p>
                <p class="stat-card__label">Ventas totales</p>
            </section>
        </article>

        <article class="stat-card">
            <section class="stat-card__icon stat-card__icon--success">🛒</div>
            <section>
                <p class="stat-card__value">32</p>
                <p class="stat-card__label">Pedidos</p>
            </section>
        </article>

        <article class="stat-card">
            <section class="stat-card__icon stat-card__icon--warning">👥</section>
            <section>
                <p class="stat-card__value">18</p>
                <p class="stat-card__label">Clientes</p>
            </section>
        </article>

        <article class="stat-card">
            <section class="stat-card__icon stat-card__icon--info">📦</section>
            <section>
                <p class="stat-card__value">45</p>
                <p class="stat-card__label">Productos</p>
            </section>
        </article>

    </section>

    {{-- SECCIÓN DE PEDIDOS RECIENTES --}}
    <section class="admin-header" style="margin-top: 2rem;">
        <h2 class="admin-header__title">Pedidos Recientes</h2>
        <a href="{{ url('/admin/pedidos') }}" class="btn btn--ghost btn--sm">Ver todos</a>
    </section>

    <section class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td><strong>#00{{ $i }}</strong></td>
                        <td>Cliente {{ $i }}</td>
                        <td>22/09/2026</td>
                        <td>$25.00</td>
                        <td>
                            <span class="order-status order-status--delivered">Entregado</span>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </section>

@endsection