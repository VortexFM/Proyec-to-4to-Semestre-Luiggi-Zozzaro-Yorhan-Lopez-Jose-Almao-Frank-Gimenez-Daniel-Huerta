@extends('layouts.admin')

@section('title', 'Gestión de Clientes - Panel de Administración')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="admin-header">
        <section>
            <h1 class="admin-header__title">Clientes</h1>
            <p class="admin-header__subtitle">Gestiona los clientes registrados en la tienda</p>
        </section>
    </header>

    {{-- TARJETAS DE ESTADÍSTICAS --}}
    <section class="stats-grid">

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--primary">👥</span>
            <section>
                <p class="stat-card__value">18</p>
                <p class="stat-card__label">Clientes totales</p>
            </section>
        </article>

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--success">✨</span>
            <section>
                <p class="stat-card__value">5</p>
                <p class="stat-card__label">Nuevos este mes</p>
            </section>
        </article>

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--warning">⭐</span>
            <section>
                <p class="stat-card__value">3</p>
                <p class="stat-card__label">Clientes frecuentes</p>
            </section>
        </article>

        <article class="stat-card">
            <span class="stat-card__icon stat-card__icon--info">💰</span>
            <section>
                <p class="stat-card__value">$450.00</p>
                <p class="stat-card__label">Gasto promedio</p>
            </section>
        </article>

    </section>

    {{-- BARRA DE FILTROS --}}
    <section class="admin-toolbar" aria-label="Filtros de búsqueda">
        <search class="admin-toolbar__search">
            <input type="text" class="form-input" placeholder="Buscar por nombre o correo...">
        </search>
        <form class="admin-toolbar__filters">
            <select class="form-select" aria-label="Filtrar por tipo">
                <option>Todos los clientes</option>
                <option>Nuevos</option>
                <option>Frecuentes</option>
                <option>Inactivos</option>
            </select>
            <select class="form-select" aria-label="Ordenar por">
                <option>Más recientes</option>
                <option>Más antiguos</option>
                <option>Mayor gasto</option>
                <option>Más pedidos</option>
            </select>
        </form>
    </section>

    {{-- TABLA DE CLIENTES --}}
    <section class="admin-table-container" aria-label="Lista de clientes">
        <table class="admin-table">
            <thead>
                <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Registro</th>
                    <th scope="col">Pedidos</th>
                    <th scope="col">Total gastado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 8; $i++)
                    <tr>
                        <td>
                            <address class="client-cell">
                                <figure class="client-cell__avatar">
                                    {{ strtoupper(substr('Cliente ' . $i, 0, 1)) }}{{ $i }}
                                </figure>
                                <section class="client-cell__info">
                                    <strong>Cliente {{ $i }}</strong>
                                    <small>cliente{{ $i }}@correo.com</small>
                                </section>
                            </address>
                        </td>
                        <td>0412-12345{{ $i }}7</td>
                        <td>
                            <time datetime="2026-09-22">22/09/2026</time>
                        </td>
                        <td>
                            <span class="badge badge--primary">{{ $i + 1 }}</span>
                        </td>
                        <td><strong>${{ 25.00 * ($i + 1) }}</strong></td>
                        <td>
                            <nav class="admin-table__actions" aria-label="Acciones del cliente">
                                <a href="#" class="admin-table__action admin-table__action--edit" title="Ver cliente">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span class="sr-only">Ver cliente {{ $i }}</span>
                                </a>
                                <a href="#" class="admin-table__action admin-table__action--edit" title="Editar cliente">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    <span class="sr-only">Editar cliente {{ $i }}</span>
                                </a>
                            </nav>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </section>

    {{-- PAGINACIÓN --}}
    <nav class="pagination" aria-label="Paginación de clientes">
        <a href="#" class="pagination__link">Anterior</a>
        <a href="#" class="pagination__link pagination__link--active" aria-current="page">1</a>
        <a href="#" class="pagination__link">2</a>
        <a href="#" class="pagination__link">Siguiente</a>
    </nav>

@endsection