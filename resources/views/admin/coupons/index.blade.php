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
    <section class="modal-overlay" id="modal-coupon" aria-hidden="true">
        <article class="modal">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-coupon-title">Nuevo Cupón</h2>
                <button type="button" class="modal__close" data-modal-close aria-label="Cerrar">✕</button>
            </header>

            <form id="coupon-form">
                <section class="modal__body">
                    <input type="hidden" id="coupon-id">

                    <div class="form-group">
                        <label class="form-label form-label--required" for="coupon-code">Código</label>
                        <input type="text" id="coupon-code" name="code" class="form-input"
                               required maxlength="50" placeholder="EJ: VERANO2026"
                               style="text-transform: uppercase;">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="coupon-discount">Descuento (%)</label>
                        <input type="number" id="coupon-discount" name="discount"
                               class="form-input" step="0.01" min="0" max="100" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="coupon-min-amount">Compra mínima ($)</label>
                        <input type="number" id="coupon-min-amount" name="min_amount"
                               class="form-input" step="0.01" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="coupon-valid-from">Válido desde</label>
                        <input type="date" id="coupon-valid-from" name="valid_from"
                               class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label form-label--required" for="coupon-valid-until">Válido hasta</label>
                        <input type="date" id="coupon-valid-until" name="valid_until"
                               class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="coupon-max-uses">Usos máximos</label>
                        <input type="number" id="coupon-max-uses" name="max_uses"
                               class="form-input" min="1"
                               placeholder="Dejar vacío para ilimitados">
                    </div>

                    <div class="form-group">
                        <label class="filter-checkbox">
                            <input type="checkbox" id="coupon-active" name="active"
                                   class="form-checkbox" checked>
                            <span>Cupón activo</span>
                        </label>
                    </div>
                </section>

                <footer class="modal__footer">
                    <button type="button" class="btn btn--ghost" data-modal-close>Cancelar</button>
                    <button type="submit" class="btn btn--primary" id="coupon-submit">Guardar cupón</button>
                </footer>
            </form>
        </article>
    </section>

@endsection