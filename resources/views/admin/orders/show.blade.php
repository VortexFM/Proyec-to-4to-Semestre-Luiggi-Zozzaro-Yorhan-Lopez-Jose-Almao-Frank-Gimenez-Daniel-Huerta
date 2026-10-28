@extends('layouts.admin')

@section('title', 'Detalle de Pedido - Panel de Administración')

@section('content')
<div class="admin-header">
    <section>
        <h1 class="admin-header__title">Pedido <span id="order-number-display">...</span></h1>
        <p class="admin-header__subtitle"><a href="/admin/pedidos">← Volver a pedidos</a></p>
    </section>
</div>

<section style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    
    {{-- Columna Izquierda: Productos --}}
    <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
        <h2 style="font-weight: bold; margin-bottom: 1rem;">Productos del Pedido</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody id="order-items-tbody">
                <tr><td colspan="4" style="text-align: center;">Cargando...</td></tr>
            </tbody>
        </table>
    </div>

    {{-- Columna Derecha: Datos y Estado --}}
    <aside style="display: flex; flex-direction: column; gap: 1.5rem;">
        
        {{-- Cambiar Estado --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <h2 style="font-weight: bold; margin-bottom: 1rem;">Cambiar Estado</h2>
            <select id="select-status" class="form-input" style="margin-bottom: 1rem;">
                <option value="pendiente">Pendiente</option>
                <option value="confirmado">Confirmado</option>
                <option value="preparando">Preparando</option>
                <option value="enviado">Enviado</option>
                <option value="entregado">Entregado</option>
                <option value="cancelado">Cancelado</option>
            </select>
            <button id="btn-update-status" class="btn btn--primary btn--block">Actualizar Estado</button>
        </div>

        {{-- Datos de Envío --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <h2 style="font-weight: bold; margin-bottom: 1rem;">Datos de Envío</h2>
            <p><strong>Cliente:</strong> <span id="ship-name"></span></p>
            <p><strong>Teléfono:</strong> <span id="ship-phone"></span></p>
            <p><strong>Dirección:</strong> <span id="ship-address"></span></p>
            <p><strong>Ciudad:</strong> <span id="ship-city"></span>, <span id="ship-state"></span></p>
        </div>

        {{-- Totales --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <h2 style="font-weight: bold; margin-bottom: 1rem;">Resumen</h2>
            <p style="display: flex; justify-content: space-between;"><span>Subtotal:</span> <span id="sum-subtotal"></span></p>
            <p style="display: flex; justify-content: space-between;"><span>Envío:</span> <span id="sum-shipping"></span></p>
            <hr style="margin: 1rem 0;">
            <p style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: bold; color: var(--color-primary);">
                <span>Total:</span> <span id="sum-total"></span>
            </p>
        </div>
    </aside>
</section>

@endsection