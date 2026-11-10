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

     {{-- MODAL DE EDICIÓN DE DIRECCIÓN --}}
    <section class="modal-overlay" id="modal-address" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(3px);">
        <article class="modal-address" style="background-color: #ffffff !important; border-radius: 12px; max-width: 700px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            
            <header style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <h2 id="modal-address-title" style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #1f2937 !important;">Editar Dirección</h2>
                <button type="button" data-modal-close style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280 !important;">✕</button>
            </header>

            <form id="address-form">
                <section style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <input type="hidden" id="address-id">

                    <div>
                        <label for="address-name" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Nombre completo *</label>
                        <input type="text" id="address-name" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div>
                        <label for="address-phone" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Teléfono *</label>
                        <input type="text" id="address-phone" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="address-state" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Estado *</label>
                            <input type="text" id="address-state" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="address-municipality" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Municipio *</label>
                            <input type="text" id="address-municipality" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="address-parish" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Parroquia *</label>
                            <input type="text" id="address-parish" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="address-city" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Ciudad *</label>
                            <input type="text" id="address-city" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div>
                        <label for="address-neighborhood" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Urbanización</label>
                        <input type="text" id="address-neighborhood" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="address-street" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Calle</label>
                            <input type="text" id="address-street" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="address-house-number" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Casa / Número</label>
                            <input type="text" id="address-house-number" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="address-postal-code" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Código Postal</label>
                            <input type="text" id="address-postal-code" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="address-reference-point" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Punto de Referencia</label>
                            <input type="text" id="address-reference-point" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                        <input type="checkbox" id="address-default" style="width: 1rem; height: 1rem; accent-color: #7c3aed;">
                        <label for="address-default" style="color: #374151 !important; font-size: 0.875rem; cursor: pointer;">Marcar como dirección por defecto</label>
                    </div>

                </section>

                <footer style="padding: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="button" data-modal-close class="btn btn--ghost">Cancelar</button>
                    <button type="submit" class="btn btn--primary">Guardar Cambios</button>
                </footer>
            </form>
        </article>
    </section>

@endsection