@extends('layouts.admin')

@section('title', 'Gestión de Pedidos - Panel de Administración')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="admin-header">
        <section>
            <h1 class="admin-header__title">Pedidos</h1>
            <p class="admin-header__subtitle">Gestiona los pedidos de los clientes</p>
        </section>
    </header>

    {{-- BARRA DE FILTROS --}}
    <section class="admin-toolbar" aria-label="Filtros de búsqueda">
        <search class="admin-toolbar__search">
            <input type="text" class="form-input" placeholder="Buscar por número o cliente...">
        </search>
        <form class="admin-toolbar__filters">
            <select class="form-select" aria-label="Filtrar por estado">
                <option>Todos los estados</option>
                <option>Pendiente</option>
                <option>Confirmado</option>
                <option>En preparación</option>
                <option>Enviado</option>
                <option>Entregado</option>
                <option>Cancelado</option>
            </select>
            <select class="form-select" aria-label="Filtrar por fecha">
                <option>Últimos 30 días</option>
                <option>Últimos 7 días</option>
                <option>Este mes</option>
                <option>Este año</option>
            </select>
        </form>
    </section>

    {{-- TABLA DE PEDIDOS --}}
    <section class="admin-table-container" aria-label="Lista de pedidos">
        <table class="admin-table">
            <thead>
                <tr>
                    <th scope="col">Pedido</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $estados = [
                        ['label' => 'Pendiente', 'class' => 'order-status--pending'],
                        ['label' => 'Confirmado', 'class' => 'order-status--confirmed'],
                        ['label' => 'En preparación', 'class' => 'order-status--preparing'],
                        ['label' => 'Enviado', 'class' => 'order-status--shipped'],
                        ['label' => 'Entregado', 'class' => 'order-status--delivered'],
                        ['label' => 'Cancelado', 'class' => 'order-status--cancelled'],
                    ];
                @endphp

                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $estado = $estados[($i - 1) % count($estados)];
                    @endphp
                    <tr>
                        <td>
                            <strong>#00{{ $i }}</strong>
                        </td>
                        <td>
                            <address class="order-client">
                                <strong>Cliente {{ $i }}</strong>
                                <small>cliente{{ $i }}@correo.com</small>
                            </address>
                        </td>
                        <td>
                            <time datetime="2026-09-22">22/09/2026</time>
                        </td>
                        <td><strong>$25.00</strong></td>
                        <td>
                            <span class="order-status {{ $estado['class'] }}">
                                {{ $estado['label'] }}
                            </span>
                        </td>
                        <td>
                            <nav class="admin-table__actions" aria-label="Acciones del pedido">
                                <a href="{{ url('/admin/pedidos/' . $i) }}" class="admin-table__action admin-table__action--edit" title="Ver pedido">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span class="sr-only">Ver pedido #00{{ $i }}</span>
                                </a>
                            </nav>
                        </td>
                    </tr>
                @endfor

            </tbody>
        </table>
    </section>

    {{-- PAGINACIÓN --}}
    <nav class="pagination" aria-label="Paginación de pedidos">
        <a href="#" class="pagination__link">Anterior</a>
        <a href="#" class="pagination__link pagination__link--active" aria-current="page">1</a>
        <a href="#" class="pagination__link">2</a>
        <a href="#" class="pagination__link">3</a>
        <a href="#" class="pagination__link">Siguiente</a>
    </nav>

@endsection