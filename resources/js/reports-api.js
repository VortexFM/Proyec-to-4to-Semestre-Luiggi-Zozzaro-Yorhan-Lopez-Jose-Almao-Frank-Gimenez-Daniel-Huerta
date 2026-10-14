/**
 * REPORTS-API.JS - Dashboard de reportes con Chart.js
 */

import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('reportes-content');
    if (!content) return; // No estamos en la página de reportes

    const API_URL = '/api/reportes';

    const loading = document.getElementById('reportes-loading');
    const errorEl = document.getElementById('reportes-error');

    /* ============================================
       HELPERS
       ============================================ */
    async function fetchJSON(url) {
        const res = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        if (!res.ok) throw new Error(`Error ${res.status}`);
        return res.json();
    }

    function showError(msg) {
        errorEl.style.display = 'block';
        errorEl.innerHTML = `
            <div class="alert alert--danger">
                <div class="alert__content">
                    <div class="alert__title">Error al cargar reportes</div>
                    <div class="alert__message">${msg}</div>
                </div>
            </div>`;
        loading.style.display = 'none';
        content.style.display = 'none';
    }

    /* ============================================
       CARGAR KPIs
       ============================================ */
    async function cargarResumen() {
        const json = await fetchJSON(`${API_URL}/resumen`);
        const d = json.data;

        document.getElementById('kpi-productos').textContent = d.total_productos;
        document.getElementById('kpi-productos-sub').textContent = `${d.productos_activos} activos`;

        document.getElementById('kpi-categorias').textContent = d.total_categorias;
        document.getElementById('kpi-clientes').textContent = d.total_clientes;
        document.getElementById('kpi-direcciones').textContent = d.total_direcciones;

        document.getElementById('kpi-cupones').textContent = d.total_cupones;
        document.getElementById('kpi-cupones-sub').textContent = `${d.cupones_activos} activos`;

        document.getElementById('kpi-pedidos').textContent = d.total_pedidos;
        document.getElementById('kpi-ventas').textContent = `$${parseFloat(d.ventas_totales || 0).toFixed(2)} en ventas`;
    }

    /* ============================================
       GRÁFICO: Productos por categoría (barras)
       ============================================ */
    async function cargarProductosPorCategoria() {
        const json = await fetchJSON(`${API_URL}/productos-por-categoria`);
        const labels = json.data.map(d => d.categoria);
        const values = json.data.map(d => d.cantidad);

        new Chart(document.getElementById('chart-productos-categoria'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Productos',
                    data: values,
                    backgroundColor: '#a78bfa',
                    borderColor: '#7c3aed',
                    borderWidth: 2,
                    borderRadius: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } },
                },
            },
        });
    }

    /* ============================================
       GRÁFICO: Productos estado (dona)
       ============================================ */
    async function cargarProductosEstado() {
        const json = await fetchJSON(`${API_URL}/productos-estado`);

        new Chart(document.getElementById('chart-productos-estado'), {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Inactivos'],
                datasets: [{
                    data: [json.data.activos, json.data.inactivos],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                },
            },
        });
    }

    /* ============================================
       GRÁFICO: Cupones estado (dona)
       ============================================ */
    async function cargarCuponesEstado() {
        const json = await fetchJSON(`${API_URL}/cupones-estado`);

        new Chart(document.getElementById('chart-cupones-estado'), {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Vencidos', 'Inactivos'],
                datasets: [{
                    data: [json.data.activos, json.data.vencidos, json.data.inactivos],
                    backgroundColor: ['#10b981', '#f59e0b', '#6b7280'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                },
            },
        });
    }

    /* ============================================
       GRÁFICO: Direcciones por estado (barras horizontales)
       ============================================ */
    async function cargarDireccionesPorEstado() {
        const json = await fetchJSON(`${API_URL}/direcciones-por-estado`);
        const labels = json.data.map(d => d.estado);
        const values = json.data.map(d => d.total);

        new Chart(document.getElementById('chart-direcciones-estado'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Direcciones',
                    data: values,
                    backgroundColor: '#7c3aed',
                    borderRadius: 6,
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { beginAtZero: true, ticks: { precision: 0 } },
                },
            },
        });
    }

    /* ============================================
       TABLA: Top productos más caros
       ============================================ */
    async function cargarTopProductos() {
        const json = await fetchJSON(`${API_URL}/top-productos`);
        const tbody = document.getElementById('tabla-top-productos');

        if (!json.data.length) {
            tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;">Sin datos</td></tr>';
            return;
        }

        tbody.innerHTML = json.data.map(p => `
            <tr>
                <td><strong>${p.name}</strong></td>
                <td>${p.categoria}</td>
                <td><strong style="color:#7c3aed;">$${parseFloat(p.price).toFixed(2)}</strong></td>
                <td>${p.stock}</td>
            </tr>
        `).join('');
    }

    /* ============================================
       TABLA: Bajo stock
       ============================================ */
    async function cargarBajoStock() {
        const json = await fetchJSON(`${API_URL}/bajo-stock`);
        const tbody = document.getElementById('tabla-bajo-stock');

        if (!json.data.length) {
            tbody.innerHTML = '<tr><td colspan="3" style="text-align:center;">Ningún producto con bajo stock 🎉</td></tr>';
            return;
        }

        tbody.innerHTML = json.data.map(p => `
            <tr>
                <td><strong>${p.name}</strong></td>
                <td>${p.categoria}</td>
                <td>
                    <span class="badge ${p.stock < 5 ? 'badge--danger' : 'badge--warning'}">
                        ${p.stock}
                    </span>
                </td>
            </tr>
        `).join('');
    }

    /* ============================================
       TABLA: Últimos clientes
       ============================================ */
    async function cargarUltimosClientes() {
        const json = await fetchJSON(`${API_URL}/ultimos-clientes`);
        const tbody = document.getElementById('tabla-ultimos-clientes');

        if (!json.data.length) {
            tbody.innerHTML = '<tr><td colspan="3" style="text-align:center;">Sin clientes registrados</td></tr>';
            return;
        }

        tbody.innerHTML = json.data.map(u => `
            <tr>
                <td><strong>${u.name}</strong></td>
                <td>${u.email}</td>
                <td>${u.created_at}</td>
            </tr>
        `).join('');
    }

    /* ============================================
       INICIALIZAR TODO
       ============================================ */
    async function cargarTodo() {
        loading.style.display = 'block';
        content.style.display = 'none';

        try {
            await Promise.all([
                cargarResumen(),
                cargarProductosPorCategoria(),
                cargarProductosEstado(),
                cargarCuponesEstado(),
                cargarDireccionesPorEstado(),
                cargarTopProductos(),
                cargarBajoStock(),
                cargarUltimosClientes(),
            ]);

            loading.style.display = 'none';
            content.style.display = 'block';

        } catch (e) {
            console.error(e);
            showError(e.message);
        }
    }

    cargarTodo();
});