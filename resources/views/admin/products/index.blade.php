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

    {{-- MODAL DE CREAR/ EDITAR PRODUCTO --}}
  
        <section class="modal-overlay" id="modal-product" aria-hidden="true">
            <section class="modal">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-product-title">Nuevo Producto</h2>
                    <button type="button" class="modal__close" data-modal-close aria-label="Cerrar">✕</button>
                </header>

            <form id="product-form">
                <section class="modal__body">
                    <section class="form-group">
                        <label class="form-label" for="product-name">Nombre *</label>
                        <input type="text" id="product-name" name="name" class="form-input" required>
                    </section>

                <section class="form-group">
                    <label class="form-label" for="product-category">Categoría *</label>
                    <select id="product-category" name="category_id" class="form-select" required>
                        <option value="">Seleccionar categoría</option>
                        @foreach (\App\Models\Category::where('active', true)->get() as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                        @endforeach
                    </select>
                </section>

                <section class="form-group">
                    <label class="form-label" for="product-description">Descripción *</label>
                    <textarea id="product-description" name="description" class="form-textarea" rows="3" required></textarea>
                </section>

                <section class="form-grid">
                    <section class="form-group">
                        <label class="form-label" for="product-price">Precio *</label>
                        <input type="number" id="product-price" name="price" class="form-input" step="0.01" min="0" required>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="product-sale-price">Precio de oferta</label>
                        <input type="number" id="product-sale-price" name="sale_price" class="form-input" step="0.01" min="0">
                    </section>
                </section>

                <section class="form-grid">
                    <section class="form-group">
                        <label class="form-label" for="product-stock">Stock *</label>
                        <input type="number" id="product-stock" name="stock" class="form-input" min="0" required>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="product-sku">SKU</label>
                        <input type="text" id="product-sku" name="sku" class="form-input">
                    </section>
                </section>

                <section class="form-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" id="product-featured" name="featured" class="form-checkbox">
                        <span>Producto destacado</span>
                    </label>
                </section>

                <section class="form-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" id="product-active" name="active" class="form-checkbox" checked>
                        <span>Producto activo</span>
                    </label>
                </section>
            </section>

            <footer class="modal__footer">
                <button type="button" class="btn btn--ghost" data-modal-close>Cancelar</button>
                <button type="submit" class="btn btn--primary" id="product-submit">Guardar producto</button>
            </footer>
        </form>
    </section>
</section>

    



        
@endsection