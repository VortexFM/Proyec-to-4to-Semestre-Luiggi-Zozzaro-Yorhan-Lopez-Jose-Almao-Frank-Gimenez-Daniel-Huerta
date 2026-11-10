@extends('layouts.admin')

@section('title', 'Centro de Reportes - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Centro de Reportes</h1>
            <p class="admin-header__subtitle">Analiza el rendimiento de tu tienda y exporta los datos</p>
        </section>
    </section>

    {{-- PESTAÑAS (TABS) --}}
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 0.5rem;">
        <button class="tab-btn active" data-target="tab-operativo" style="background: none; border: none; font-size: 1rem; font-weight: 600; color: #7c3aed; cursor: pointer; padding-bottom: 0.5rem; border-bottom: 3px solid #7c3aed;">
            ⚙️ Operativo
        </button>
        <button class="tab-btn" data-target="tab-supervision" style="background: none; border: none; font-size: 1rem; font-weight: 600; color: #6b7280; cursor: pointer; padding-bottom: 0.5rem; border-bottom: 3px solid transparent;">
            🕵️‍♂️ Supervisión
        </button>
        <button class="tab-btn" data-target="tab-gerencial" style="background: none; border: none; font-size: 1rem; font-weight: 600; color: #6b7280; cursor: pointer; padding-bottom: 0.5rem; border-bottom: 3px solid transparent;">
            💼 Gerencial
        </button>
    </div>

    {{-- ========================================== --}}
    {{-- PESTAÑA 1: OPERATIVO (El día a día) --}}
    {{-- ========================================== --}}
    <div id="tab-operativo" class="tab-content" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
        
        {{-- Tarjeta Alertas de Stock --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #ef4444;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">⚠️ Alertas de Stock</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Productos con menos de 10 unidades.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-low-stock" style="font-size: 1.5rem; color: #ef4444;">...</strong> productos por agotarse
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('operativo')">Exportar Stock</button>
        </div>

        {{-- Tarjeta Pedidos Pendientes --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #f59e0b;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">📦 Pedidos Pendientes</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Órdenes listas para preparar.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-pending-orders" style="font-size: 1.5rem; color: #f59e0b;">...</strong> pedidos en espera
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('pedidos')">Exportar Pedidos</button>
        </div>

        {{-- Tarjeta Direcciones --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #3b82f6;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">📍 Envíos del Día</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Direcciones de entrega registradas.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-addresses" style="font-size: 1.5rem; color: #3b82f6;">...</strong> direcciones
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('direcciones')">Exportar Direcciones</button>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- PESTAÑA 2: SUPERVISIÓN (Control) --}}
    {{-- ========================================== --}}
    <div id="tab-supervision" class="tab-content" style="display: none; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
        
        {{-- Tarjeta Cupones --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #8b5cf6;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">🎯 Efectividad de Cupones</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Dinero otorgado en descuentos.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-discounts" style="font-size: 1.5rem; color: #8b5cf6;">...</strong> en descuentos
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('marketing')">Exportar Marketing</button>
        </div>

        {{-- Tarjeta Productos Estancados --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #10b981;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">🐢 Productos Estancados</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Productos con stock alto pero sin ventas.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-stagnant" style="font-size: 1.5rem; color: #10b981;">...</strong> productos estancados
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('estancados')">Exportar Estancados</button>
        </div>

        {{-- Tarjeta Top Categorías --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #06b6d4;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">📊 Categoría más Vendida</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Rendimiento por categoría.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-top-category" style="font-size: 1.1rem; color: #06b6d4;">...</strong>
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('tactico')">Exportar Táctico</button>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- PESTAÑA 3: GERENCIAL (Estrategia) --}}
    {{-- ========================================== --}}
    <div id="tab-gerencial" class="tab-content" style="display: none; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
        
        {{-- Tarjeta Balance --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #ec4899;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">💰 Balance General</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Ingresos vs Inventario.</p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-bottom: 1.5rem;">
                <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem;">
                    <small style="color:#6b7280;">Ingresos</small><br>
                    <strong id="kpi-revenue" style="color: #ec4899;">...</strong>
                </div>
                <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem;">
                    <small style="color:#6b7280;">Inventario</small><br>
                    <strong id="kpi-inventory" style="color: #ec4899;">...</strong>
                </div>
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('estrategico')">Exportar Estratégico</button>
        </div>

        {{-- Tarjeta Crecimiento --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #f97316;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">📈 Crecimiento de Clientes</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Nuevos clientes este mes.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-growth" style="font-size: 1.5rem; color: #f97316;">...</strong> nuevos clientes
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('crecimiento')">Exportar Crecimiento</button>
        </div>

        {{-- Tarjeta Ticket Promedio --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #14b8a6;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">🧾 Ticket Promedio</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Gasto promedio por pedido.</p>
            <div style="background: #f9fafb; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <strong id="kpi-avg-ticket" style="font-size: 1.5rem; color: #14b8a6;">...</strong>
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('ticket')">Exportar Ticket</button>
        </div>
    </div>

@endsection