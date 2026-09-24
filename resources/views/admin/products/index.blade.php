@extends('layouts.admin')

@section('title', 'Gestión de Productos - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Productos</h1>
            <p class="admin-header__subtitle">Gestiona el catálogo de productos</p>
        </section>
        <a href="{{ url('/admin/productos/' . $i . '/editar') }}" class="admin-table_action admin-table_action--edit" title="Editar">
            + Nuevo producto
        </a>
    </section>

    {{-- BARRA DE BÚSQUEDA Y FILTROS --}}
    <section class="admin-toolbar">
        <section class="admin-toolbar__search">
            <input type="text" class="form-input" placeholder="Buscar producto...">
        </section>
        <section class="admin-toolbar__filters">
            <select class="form-select">
                <option>Todas las categorías</option>
                <option>Ropa</option>
                <option>Artesanía</option>
                <option>Alimentos</option>
                <option>Libros</option>
            </select>
            <select class="form-select">
                <option>Todos los estados</option>
                <option>Activo</option>
                <option>Inactivo</option>
                <option>Agotado</option>
            </select>
        </section>
    </section>

    {{-- TABLA DE PRODUCTOS --}}
    <section class="admin-table-container">
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
            <tbody>
                @for ($i = 1; $i <= 8; $i++)
                    <tr>
                        <td>
                            <section class="product-cell">
                                <section class="product-cell__image">IMG</section>
                                <section class="product-cell__info">
                                    <strong>Producto {{ $i }}</strong>
                                    <small>SKU-00{{ $i }}</small>
                                </section>
                            </section>
                        </td>
                        <td>Ropa</td>
                        <td><strong>$25.00</strong></td>
                        <td>15</td>
                        <td>
                            <span class="badge badge--success">Activo</span>
                        </td>
                        <td>
                            <section class="admin-table__actions">
                                <a href="#" class="admin-table__action admin-table__action--edit" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <button class="admin-table__action admin-table__action--delete" title="Eliminar" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                </button>
                            </section>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </section>

    {{-- PAGINACIÓN --}}
    <nav class="pagination">
        <a href="#" class="pagination__link">Anterior</a>
        <a href="#" class="pagination__link pagination__link--active">1</a>
        <a href="#" class="pagination__link">2</a>
        <a href="#" class="pagination__link">3</a>
        <a href="#" class="pagination__link">Siguiente</a>
    </nav>

@endsection