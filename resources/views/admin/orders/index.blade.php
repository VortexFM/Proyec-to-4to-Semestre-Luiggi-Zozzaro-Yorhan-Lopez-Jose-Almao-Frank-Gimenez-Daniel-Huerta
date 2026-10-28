@extends('layouts.admin')

@section('title', 'Gestión de Pedidos - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Pedidos de Clientes</h1>
            <p class="admin-header__subtitle">Gestiona los pedidos y actualiza su estado de envío</p>
        </section>
    </section>

    {{-- FILTROS --}}
    <section style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Buscar Pedido</label>
                <input type="text" id="search-order" class="form-input" placeholder="Nº de orden o nombre del cliente...">
            </div>
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Estado</label>
                <select id="filter-status" class="form-input">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmado">Confirmado</option>
                    <option value="preparando">Preparando</option>
                    <option value="enviado">Enviado</option>
                    <option value="entregado">Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
        </div>
    </section>

    {{-- TABLA --}}
    <section class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nº Orden</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="orders-tbody">
                <tr><td colspan="6" style="text-align: center; padding: 2rem;">Cargando pedidos...</td></tr>
            </tbody>
        </table>
    </section>

@endsection