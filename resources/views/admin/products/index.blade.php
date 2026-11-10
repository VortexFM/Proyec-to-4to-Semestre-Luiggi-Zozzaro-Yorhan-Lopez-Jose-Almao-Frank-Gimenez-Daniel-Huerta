@extends('layouts.admin')

@section('title', 'Gestión de Productos - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Productos</h1>
            <p class="admin-header__subtitle">Gestiona el catálogo de productos</p>
        </section>
        <a href="{{ url('/admin/productos/crear') }}" class="btn btn--primary" id="btn-new-product">
            + Nuevo producto
        </a>
    </section>

    {{-- BARRA DE FILTROS --}}
    <section class="admin-toolbar" style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
        <input type="text" class="form-input" placeholder="Buscar producto..." id="filter-search" style="max-width: 300px;">
        
        <select class="form-input" id="filter-category" style="max-width: 200px;">
            <option value="">Todas las categorías</option>
            {{-- Las categorías se cargarán dinámicamente con JS --}}
        </select>
        
        <select class="form-input" id="filter-status" style="max-width: 200px;">
            <option value="">Todos los estados</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button type="button" id="btn-apply-filters" class="btn btn--primary">
            Filtrar
        </button>
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
    {{-- MODAL DE CREAR/ EDITAR PRODUCTO --}}
    <section class="modal-overlay" id="modal-product" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(3px);">
        <article class="modal-product" style="background-color: #ffffff !important; border-radius: 12px; max-width: 600px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            
            <header style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <h2 id="modal-product-title" style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #1f2937 !important;">Editar Producto</h2>
                <button type="button" data-modal-close style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280 !important;">✕</button>
            </header>

            <form id="product-form">
                <section style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    
                    <div>
                        <label for="product-name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Nombre del Producto *</label>
                        <input type="text" id="product-name" name="name" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div>
                        <label for="product-category" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Categoría *</label>
                        <select id="product-category" name="category_id" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                            <option value="">Cargando categorías...</option>
                        </select>
                    </div>

                    <div>
                        <label for="product-description" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Descripción *</label>
                        <textarea id="product-description" name="description" rows="3" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important; resize: vertical;"></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="product-price" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Precio ($) *</label>
                            <input type="number" step="0.01" id="product-price" name="price" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="product-sale-price" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Precio de Oferta ($)</label>
                            <input type="number" step="0.01" id="product-sale-price" name="sale_price" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="product-stock" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Stock *</label>
                            <input type="number" id="product-stock" name="stock" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="product-sku" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">SKU</label>
                            <input type="text" id="product-sku" name="sku" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 1.5rem; margin-top: 0.5rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #374151 !important;">
                            <input type="checkbox" id="product-featured" name="featured" style="width: 1rem; height: 1rem; accent-color: #7c3aed;">
                            <span>Producto Destacado</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #374151 !important;">
                            <input type="checkbox" id="product-active" name="active" checked style="width: 1rem; height: 1rem; accent-color: #7c3aed;">
                            <span>Producto Activo</span>
                        </label>
                    </div>

                </section>

                <footer style="padding: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="button" data-modal-close class="btn btn--ghost">Cancelar</button>
                    <button type="submit" id="product-submit" class="btn btn--primary">Guardar Producto</button>
                </footer>
            </form>
        </article>
    </section>

@endsection