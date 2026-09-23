@extends('layouts.admin')

@section('title', 'Nuevo Producto - Panel de Administración')

@section('content')

    {{-- ENCABEZADO --}}
    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Nuevo Producto</h1>
            <p class="admin-header__subtitle">Completa los datos para agregar un producto al catálogo</p>
        </section>
        <a href="{{ url('/admin/productos') }}" class="btn btn--ghost">
            ← Volver
        </a>
    </section>

    {{-- FORMULARIO --}}
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        <section class="product-form">

            {{-- COLUMNA PRINCIPAL --}}
            <section class="product-form__main">

                {{-- Información básica --}}
                <section class="admin-card">
                    <h2 class="admin-card__title">Información básica</h2>

                    <section class="form-group">
                        <label class="form-label" for="nombre">Nombre del producto *</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Ej: Camisa estampada" required>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="descripcion">Descripción *</label>
                        <textarea id="descripcion" name="descripcion" rows="5" class="form-textarea" placeholder="Describe el producto, sus características, materiales, etc." required></textarea>
                    </section>

                    <section class="form-grid">
                        <section class="form-group">
                            <label class="form-label" for="categoria">Categoría *</label>
                            <select id="categoria" name="categoria" class="form-select" required>
                                <option value="">Seleccionar categoría</option>
                                <option>Ropa</option>
                                <option>Artesanía</option>
                                <option>Alimentos</option>
                                <option>Libros</option>
                                <option>Accesorios</option>
                            </select>
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="sku">SKU (código interno)</label>
                            <input type="text" id="sku" name="sku" class="form-input" placeholder="Ej: SKU-001">
                        </section>
                    </section>
                </section>

                {{-- Precios --}}
                <section class="admin-card">
                    <h2 class="admin-card__title">Precios</h2>

                    <section class="form-grid">
                        <section class="form-group">
                            <label class="form-label" for="precio">Precio *</label>
                            <input type="number" id="precio" name="precio" step="0.01" min="0" class="form-input" placeholder="0.00" required>
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="precio_oferta">Precio de oferta (opcional)</label>
                            <input type="number" id="precio_oferta" name="precio_oferta" step="0.01" min="0" class="form-input" placeholder="0.00">
                            <p class="form-help">Si lo dejas vacío, se usará el precio normal</p>
                        </section>
                    </section>
                </section>

                {{-- Inventario --}}
                <section class="admin-card">
                    <h2 class="admin-card__title">Inventario</h2>

                    <section class="form-grid">
                        <section class="form-group">
                            <label class="form-label" for="stock">Cantidad en stock *</label>
                            <input type="number" id="stock" name="stock" min="0" class="form-input" placeholder="0" required>
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="stock_minimo">Stock mínimo (alerta)</label>
                            <input type="number" id="stock_minimo" name="stock_minimo" min="0" class="form-input" placeholder="5">
                            <p class="form-help">Te avisaremos cuando el stock baje de este número</p>
                        </section>
                    </section>
                </section>

            </section>

            {{-- COLUMNA LATERAL --}}
            <aside class="product-form__sidebar">

                {{-- Imágenes --}}
                <section class="admin-card">
                    <h2 class="admin-card__title">Imágenes</h2>

                    <section class="image-upload">
                        <section class="image-upload__dropzone">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            <p>Subir imágenes</p>
                            <small>PNG, JPG o WEBP (máx. 2MB)</small>
                            <input type="file" name="imagenes[]" multiple accept="image/*" hidden>
                        </section>

                        <section class="image-upload__preview">
                            @for ($i = 1; $i <= 3; $i++)
                                <section class="image-upload__thumb">
                                    <span>IMG {{ $i }}</span>
                                </section>
                            @endfor
                        </section>
                    </section>
                </section>

                {{-- Estado --}}
                <section class="admin-card">
                    <h2 class="admin-card__title">Estado del producto</h2>

                    <section class="form-group">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="activo" class="form-checkbox" checked>
                            <span>Producto activo</span>
                        </label>
                        <p class="form-help">Si está inactivo, no se mostrará en la tienda</p>
                    </section>

                    <section class="form-group">
                        <label class="filter-checkbox">
                            <input type="checkbox" name="destacado" class="form-checkbox">
                            <span>Producto destacado</span>
                        </label>
                        <p class="form-help">Aparecerá en la sección de productos destacados del Home</p>
                    </section>
                </section>

                {{-- Acciones --}}
                <section class="admin-card">
                    <button type="submit" class="btn btn--primary btn--block btn--lg">
                        Guardar producto
                    </button>
                    <a href="{{ url('/admin/productos') }}" class="btn btn--ghost btn--block" style="margin-top: 0.75rem;">
                        Cancelar
                    </a>
                </section>

            </aside>

        </section>

    </form>

@endsection