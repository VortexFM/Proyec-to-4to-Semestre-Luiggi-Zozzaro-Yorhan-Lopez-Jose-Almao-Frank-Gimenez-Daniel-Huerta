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
            <h1 class="admin-header__title">Centro de Reportes</h1>
            <p class="admin-header__subtitle">Analiza el rendimiento de tu tienda y exporta los datos</p>
        </section>
    </section>

    <!-- TARJETAS DE REPORTES -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-top: 2rem;">

        {{-- 1. REPORTE ESTRATÉGICO --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #8b5cf6;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">💼 Estratégico</h3>
                    <p style="font-size: 0.875rem; color: #6b7280;">Balance general, ingresos e inventario.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.5rem;">Ingresos: <br><strong id="kpi-revenue">...</strong></div>
                <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.5rem;">Inventario: <br><strong id="kpi-inventory">...</strong></div>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('estrategico')">Exportar</button>
            </div>
        </div>

        {{-- 2. REPORTE DE MARKETING --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #f59e0b;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">🎯 Marketing</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Impacto de cupones y descuentos.</p>
            <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                Descuentos otorgados: <br><strong id="kpi-discounts">...</strong>
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('marketing')">Exportar</button>
        </div>

        {{-- 3. REPORTE OPERATIVO --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #ef4444;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">⚠️ Operativo</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Alertas de stock y pedidos pendientes.</p>
            <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                Pedidos pendientes: <br><strong id="kpi-pending-orders">...</strong>
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('operativo')">Exportar</button>
        </div>

        {{-- 4. REPORTE TÁCTICO --}}
        <div style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 4px solid #06b6d4;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">📊 Táctico</h3>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">Rendimiento por categoría.</p>
            <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                Categoría top: <br><strong id="kpi-top-category">...</strong>
            </div>
            <button class="btn btn--outline btn--sm btn--block" onclick="exportReport('tactico')">Exportar</button>
        </div>

    </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        // 1. Llenar los KPIs visuales
            try {
                // Estratégico
                const resEst = await fetch('/api/reportes/avanzados/estrategico');
                const dataEst = await resEst.json();
                if(dataEst.success) {
                    document.getElementById('kpi-revenue').textContent = '$' + parseFloat(dataEst.data.total_revenue).toFixed(2);
                    document.getElementById('kpi-inventory').textContent = '$' + parseFloat(dataEst.data.inventory_value).toFixed(2);
                    document.getElementById('kpi-pending-orders').textContent = dataEst.data.orders_pending;
                }

                // Marketing
                const resMkt = await fetch('/api/reportes/avanzados/marketing');
                const dataMkt = await resMkt.json();
                if(dataMkt.success) {
                document.getElementById('kpi-discounts').textContent = '$' + parseFloat(dataMkt.data.total_discounts_given).toFixed(2);
                }

                // Táctico
                const resTac = await fetch('/api/reportes/avanzados/tactico');
                const dataTac = await resTac.json();
                if(dataTac.success && dataTac.data.length > 0) {
                    const top = dataTac.data[0];
                    document.getElementById('kpi-top-category').textContent = top.name + ' (' + top.products_count + ' prod)';
                }
            } catch (error) {
                console.error("Error cargando KPIs", error);
            }
        });

        // 2. Función para exportar (por ahora genera el PDF/Excel que ya tenemos)
        function exportReport(tipo) {
            // Por ahora, redirigimos al Excel básico que ya teníamos
            // En la Fase 3 haremos que el backend devuelva el PDF/Excel específico
            if(tipo === 'estrategico') window.location.href = '/api/exportar/ventas'; // Usamos ventas como demo
            if(tipo === 'marketing') window.location.href = '/api/exportar/clientes'; 
            if(tipo === 'operativo') window.location.href = '/api/exportar/direcciones';
            if(tipo === 'tactico') window.location.href = '/api/exportar/pedidos';
        }
    </script>
    @endpush

@endsection