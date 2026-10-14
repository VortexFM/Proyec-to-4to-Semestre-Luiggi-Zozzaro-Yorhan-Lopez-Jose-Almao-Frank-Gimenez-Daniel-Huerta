@extends('layouts.admin')

@section('title', 'Gestión de Direcciones - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Direcciones de clientes</h1>
            <p class="admin-header__subtitle">Gestiona las direcciones de envío registradas</p>
        </section>
    </section>

    {{-- FILTROS --}}
    <section style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label" for="filter-search">Buscar</label>
                <input type="text" id="filter-search" class="form-input"
                       placeholder="Nombre, teléfono, urbanización o ciudad...">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label" for="filter-estado">Estado</label>
                <select id="filter-estado" class="form-input">
                    <option value="">Todos los estados</option>
                </select>
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label" for="filter-default">Tipo</label>
                <select id="filter-default" class="form-input">
                    <option value="">Todas</option>
                    <option value="1">Solo por defecto</option>
                    <option value="0">Solo no por defecto</option>
                </select>
            </div>
        </div>
    </section>

    {{-- ESTADO DE CARGA --}}
    <section id="addresses-loading" style="display: none; text-align: center; padding: 2rem;">
        <div class="spinner"></div>
        <p>Cargando direcciones...</p>
    </section>

    {{-- ESTADO DE ERROR --}}
    <section id="addresses-error" style="display: none;"></section>

    {{-- TABLA --}}
    <section class="admin-table-container" id="addresses-table">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Ubicación</th>
                    <th>Cliente</th>
                    <th>Default</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="addresses-tbody">
                {{-- Se carga dinámicamente --}}
            </tbody>
        </table>
    </section>

    {{-- MODAL DE EDICIÓN --}}
    <section class="modal-overlay" id="modal-address" aria-hidden="true">
        <article class="modal">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-address-title">Editar Dirección</h2>
                <button type="button" class="modal__close" data-modal-close aria-label="Cerrar">✕</button>
            </header>

            <form id="address-form">
                <section class="modal__body">
                    <input type="hidden" id="address-id">

                    <div class="form-group">
                        <label class="form-label form-label--required" for="address-name">Nombre completo</label>
                        <input type="text" id="address-name" class="form-input" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="address-phone">Teléfono</label>
                        <input type="text" id="address-phone" class="form-input" required maxlength="20">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="address-estado">Estado</label>
                        <input type="text" id="address-estado" class="form-input" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="address-municipio">Municipio</label>
                        <input type="text" id="address-municipio" class="form-input" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="address-parroquia">Parroquia</label>
                        <input type="text" id="address-parroquia" class="form-input" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="address-ciudad">Ciudad</label>
                        <input type="text" id="address-ciudad" class="form-input" required maxlength="100">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address-urbanizacion">Urbanización</label>
                        <input type="text" id="address-urbanizacion" class="form-input" maxlength="150">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address-calle">Calle</label>
                        <input type="text" id="address-calle" class="form-input" maxlength="150">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address-casa">Casa / Número</label>
                        <input type="text" id="address-casa" class="form-input" maxlength="50">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address-codigo-postal">Código postal</label>
                        <input type="text" id="address-codigo-postal" class="form-input" maxlength="10">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address-punto-referencia">Punto de referencia</label>
                        <textarea id="address-punto-referencia" class="form-textarea" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="filter-checkbox">
                            <input type="checkbox" id="address-default" class="form-checkbox">
                            <span>Marcar como dirección por defecto</span>
                        </label>
                    </div>
                </section>

                <footer class="modal__footer">
                    <button type="button" class="btn btn--ghost" data-modal-close>Cancelar</button>
                    <button type="submit" class="btn btn--primary">Guardar cambios</button>
                </footer>
            </form>
        </article>
    </section>

@endsection