@extends('layouts.admin')

@section('title', 'Reportes - Panel de Administración')

@section('content')

    <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Reportes y Estadísticas</h1>
            <p class="admin-header__subtitle">Resumen general del sistema</p>
        </section>
    </section>

    {{-- KPI CARDS --}}
    <section id="reportes-loading" style="display: none; text-align: center; padding: 2rem;">
        <div class="spinner"></div>
        <p>Cargando reportes...</p>
    </section>

    <section id="reportes-error" style="display: none;"></section>

    <section id="reportes-content" style="display: none;">

        {{-- TARJETAS KPI --}}
        <section style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">📦 Productos</p>
                <p id="kpi-productos" style="font-size: 1.75rem; font-weight: 700; color: #7c3aed; margin-top: 0.25rem;">—</p>
                <p id="kpi-productos-sub" style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem;">—</p>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">📂 Categorías</p>
                <p id="kpi-categorias" style="font-size: 1.75rem; font-weight: 700; color: #7c3aed; margin-top: 0.25rem;">—</p>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">👥 Clientes</p>
                <p id="kpi-clientes" style="font-size: 1.75rem; font-weight: 700; color: #7c3aed; margin-top: 0.25rem;">—</p>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">📍 Direcciones</p>
                <p id="kpi-direcciones" style="font-size: 1.75rem; font-weight: 700; color: #7c3aed; margin-top: 0.25rem;">—</p>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">🎟️ Cupones</p>
                <p id="kpi-cupones" style="font-size: 1.75rem; font-weight: 700; color: #7c3aed; margin-top: 0.25rem;">—</p>
                <p id="kpi-cupones-sub" style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem;">—</p>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.25rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <p style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">🛒 Pedidos</p>
                <p id="kpi-pedidos" style="font-size: 1.75rem; font-weight: 700; color: #7c3aed; margin-top: 0.25rem;">—</p>
                <p id="kpi-ventas" style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem;">—</p>
            </div>
        </section>

        {{-- GRÁFICOS --}}
        <section style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 2rem;">

            {{-- Productos por categoría --}}
            <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">📊 Productos por categoría</h3>
                <div style="height: 300px;">
                    <canvas id="chart-productos-categoria"></canvas>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">

                {{-- Productos estado --}}
                <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">📦 Productos activos vs inactivos</h3>
                    <div style="height: 250px;">
                        <canvas id="chart-productos-estado"></canvas>
                    </div>
                </div>

                {{-- Cupones estado --}}
                <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">🎟️ Cupones por estado</h3>
                    <div style="height: 250px;">
                        <canvas id="chart-cupones-estado"></canvas>
                    </div>
                </div>

            </div>

            {{-- Direcciones por estado --}}
            <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">📍 Direcciones por estado</h3>
                <div style="height: 320px;">
                    <canvas id="chart-direcciones-estado"></canvas>
                </div>
            </div>

        </section>

        {{-- TABLAS DE TOP --}}
        <section style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">

            <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">💰 Top 5 productos más caros</h3>
                <table class="admin-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-top-productos">
                        <tr><td colspan="4" style="text-align: center;">Cargando...</td></tr>
                    </tbody>
                </table>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">⚠️ Productos con bajo stock (&lt; 10)</h3>
                <table class="admin-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-bajo-stock">
                        <tr><td colspan="3" style="text-align: center;">Cargando...</td></tr>
                    </tbody>
                </table>
            </div>

            <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 1rem;">👥 Últimos 5 clientes registrados</h3>
                <table class="admin-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-ultimos-clientes">
                        <tr><td colspan="3" style="text-align: center;">Cargando...</td></tr>
                    </tbody>
                </table>
            </div>

        </section>

            <section class="admin-header">
        <section>
            <h1 class="admin-header__title">Reportes y Estadísticas</h1>
            <p class="admin-header__subtitle">Resumen general del sistema</p>

            <section style="display: flex; gap: 0.75rem; margin-top: 1rem; flex-wrap: wrap;">
                <a href="{{ url('/api/exportar/excel?tipo=productos') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem;">
                    <span>📊</span> Excel
                </a>
                <a href="{{ url('/api/exportar/pdf?tipo=productos') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem;">
                    <span>📄</span> PDF
                </a>
                <a href="{{ url('/api/exportar/word?tipo=productos') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem;">
                    <span>📝</span> Word
                </a>
                <a href="{{ url('/api/exportar/ventas') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; border-color: #10b981; color: #10b981;">
                    <span>💰</span> Ventas
                </a>
                <a href="{{ url('/api/exportar/pedidos') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; border-color: #f59e0b; color: #f59e0b;">
                    <span>📦</span> Pedidos
                </a>
                <a href="{{ url('/api/exportar/direcciones') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; border-color: #3b82f6; color: #3b82f6;">
                    <span>📍</span> Direcciones
                </a>
                <a href="{{ url('/api/exportar/clientes') }}" class="btn btn--outline" style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; font-size: 0.875rem; border-color: #7c3aed; color: #7c3aed;">
                    <span>👥</span> Clientes
                </a>
            </section>
        </section>
        
    </section>

    </section>

@endsection