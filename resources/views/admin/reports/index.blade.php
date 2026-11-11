@extends('layouts.admin')

@section('title', 'Centro de Reportes - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Centro de Reportes</h1>
            <p class="admin-header__subtitle">Analiza el rendimiento de tu tienda y exporta los datos</p>
        </section>
    </section>

    {{-- FILTROS --}}
    <section style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
        <div>
            <label style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Desde</label>
            <input type="date" id="filter-from" class="form-input" style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px;">
        </div>
        <div>
            <label style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Hasta</label>
            <input type="date" id="filter-to" class="form-input" style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px;">
        </div>
        <button id="btn-apply-date-filter" class="btn btn--primary">Aplicar Filtro</button>
        <button id="btn-clear-date-filter" class="btn btn--outline">Limpiar</button>
    </section>

    {{-- KPIs --}}
    <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2.5rem;">
        <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #ec4899;">
            <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Ingresos Totales</p>
            <p id="kpi-revenue-top" style="font-size: 1.5rem; font-weight: 700; color: #ec4899; margin-top: 0.25rem;">...</p>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #8b5cf6;">
            <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Valor Inventario</p>
            <p id="kpi-inventory-top" style="font-size: 1.5rem; font-weight: 700; color: #8b5cf6; margin-top: 0.25rem;">...</p>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #f59e0b;">
            <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Pedidos Pendientes</p>
            <p id="kpi-pending-top" style="font-size: 1.5rem; font-weight: 700; color: #f59e0b; margin-top: 0.25rem;">...</p>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-left: 4px solid #14b8a6;">
            <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Ticket Promedio</p>
            <p id="kpi-ticket-top" style="font-size: 1.5rem; font-weight: 700; color: #14b8a6; margin-top: 0.25rem;">...</p>
        </div>
    </section>

    {{-- PESTAÑAS --}}
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 0.5rem;">
        <button class="tab-btn active" data-target="tab-operativo" style="background: none; border: none; font-size: 1rem; font-weight: 600; color: #7c3aed; cursor: pointer; padding-bottom: 0.5rem; border-bottom: 3px solid #7c3aed;">⚙️ Operativo</button>
        <button class="tab-btn" data-target="tab-supervision" style="background: none; border: none; font-size: 1rem; font-weight: 600; color: #6b7280; cursor: pointer; padding-bottom: 0.5rem; border-bottom: 3px solid transparent;">🕵️‍♂️ Supervisión</button>
        <button class="tab-btn" data-target="tab-gerencial" style="background: none; border: none; font-size: 1rem; font-weight: 600; color: #6b7280; cursor: pointer; padding-bottom: 0.5rem; border-bottom: 3px solid transparent;">💼 Gerencial</button>
    </div>

    {{-- Pestaña Operativa --}}
    <div id="tab-operativo" class="tab-content" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700;">📦 Pedidos</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Lista de órdenes y estados.</p>
            <a href="{{ url('/api/exportar/pedidos') }}" class="btn btn--outline btn--block">Exportar Pedidos</a>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700;">📍 Direcciones</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Envíos registrados.</p>
            <a href="{{ url('/api/exportar/direcciones') }}" class="btn btn--outline btn--block">Exportar Direcciones</a>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); grid-column: span 2;">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">📊 Pedidos por Estado (Torta)</h3>
            <div id="chart-orders-status-op" style="height: 300px;"></div>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">📈 Productos con Bajo Stock (Barras)</h3>
            <div id="chart-low-stock" style="height: 300px;"></div>
        </div>
    </div>

    {{-- Pestaña Supervisión --}}
    <div id="tab-supervision" class="tab-content" style="display: none; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700;">🎯 Marketing</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Uso de cupones.</p>
            <a href="{{ url('/api/reportes/avanzados/exportar-marketing') }}" class="btn btn--outline btn--block">Exportar Marketing</a>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700;">🐢 Estancados</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Productos sin ventas.</p>
            <a href="{{ url('/api/reportes/avanzados/exportar-estancados') }}" class="btn btn--outline btn--block">Exportar Estancados</a>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); grid-column: span 2;">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">🎯 Uso de Cupones (Barras)</h3>
            <div id="chart-coupons" style="height: 300px;"></div>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">📂 Productos por Categoría (Torta)</h3>
            <div id="chart-categories" style="height: 300px;"></div>
        </div>
    </div>

    {{-- Pestaña Gerencial --}}
    <div id="tab-gerencial" class="tab-content" style="display: none; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700;">💰 Balance</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Ingresos e inventario.</p>
            <a href="{{ url('/api/reportes/avanzados/exportar-estrategico') }}" class="btn btn--outline btn--block">Exportar Estratégico</a>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700;">📈 Crecimiento</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Nuevos clientes.</p>
            <a href="{{ url('/api/reportes/avanzados/exportar-crecimiento') }}" class="btn btn--outline btn--block">Exportar Crecimiento</a>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); grid-column: span 2;">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">📊 Ingresos por Mes</h3>
            <div id="chart-revenue" style="height: 300px;"></div>
        </div>
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">🥧 Pedidos por Estado</h3>
            <div id="chart-orders-status" style="height: 300px;"></div>
        </div>
    </div>

@endsection