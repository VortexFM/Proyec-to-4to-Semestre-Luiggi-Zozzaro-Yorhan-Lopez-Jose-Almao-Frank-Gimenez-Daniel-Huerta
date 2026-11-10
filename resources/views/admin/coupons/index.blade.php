@extends('layouts.admin')

@section('title', 'Gestión de Cupones - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Cupones de descuento</h1>
            <p class="admin-header__subtitle">Gestiona los cupones disponibles para tus clientes</p>
        </section>
        <button type="button" class="btn btn--primary" id="btn-new-coupon">
            + Nuevo cupón
        </button>
    </section>

    {{-- ESTADO DE CARGA --}}
    <section id="coupons-loading" style="display: none; text-align: center; padding: 2rem;">
        <div class="spinner"></div>
        <p>Cargando cupones...</p>
    </section>

    {{-- ESTADO DE ERROR --}}
    <section id="coupons-error" style="display: none;"></section>

    {{-- TABLA DE CUPONES --}}
    <section class="admin-table-container" id="coupons-table">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descuento</th>
                    <th>Mínimo</th>
                    <th>Vigencia</th>
                    <th>Usos</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="coupons-tbody">
                {{-- Los cupones se cargan dinámicamente desde la API --}}
            </tbody>
        </table>
    </section>

        {{-- MODAL DE CREAR/EDITAR CUPÓN --}}
    <section class="modal-overlay" id="modal-coupon" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.6); backdrop-filter: blur(3px);">
        <article class="modal-coupon" style="background-color: #ffffff !important; border-radius: 12px; max-width: 500px; width: 100%; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
            
            <header style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <h2 id="modal-coupon-title" style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #1f2937 !important;">Nuevo Cupón</h2>
                <button type="button" data-modal-close style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #6b7280 !important;">✕</button>
            </header>

            <form id="coupon-form">
                <section style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <input type="hidden" id="coupon-id">

                    <div>
                        <label for="coupon-code" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Código del Cupón *</label>
                        <input type="text" id="coupon-code" required maxlength="50" placeholder="Ej: VERANO2026" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important; text-transform: uppercase;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="coupon-discount" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Descuento (%) *</label>
                            <input type="number" step="0.01" id="coupon-discount" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="coupon-min-amount" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Compra Mínima ($)</label>
                            <input type="number" step="0.01" id="coupon-min-amount" value="0" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label for="coupon-valid-from" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Válido desde *</label>
                            <input type="date" id="coupon-valid-from" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                        <div>
                            <label for="coupon-valid-until" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Válido hasta *</label>
                            <input type="date" id="coupon-valid-until" required style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                        </div>
                    </div>

                    <div>
                        <label for="coupon-max-uses" style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151 !important; margin-bottom: 0.5rem;">Usos Máximos</label>
                        <input type="number" id="coupon-max-uses" placeholder="Dejar vacío para ilimitados" style="width: 100%; padding: 0.625rem; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937 !important; background-color: #ffffff !important;">
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                        <input type="checkbox" id="coupon-active" checked style="width: 1rem; height: 1rem; accent-color: #7c3aed;">
                        <label for="coupon-active" style="color: #374151 !important; font-size: 0.875rem; cursor: pointer;">Cupón Activo</label>
                    </div>
                </section>

                <footer style="padding: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
                    <button type="button" data-modal-close class="btn btn--ghost">Cancelar</button>
                    <button type="submit" id="coupon-submit" class="btn btn--primary">Guardar Cupón</button>
                </footer>
            </form>
        </article>
    </section>
@endsection