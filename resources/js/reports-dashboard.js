import ApexCharts from 'apexcharts';

document.addEventListener('DOMContentLoaded', () => {
    
    let charts = {};

    // 1. Lógica de las Pestañas
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabContents.forEach(content => content.style.display = 'none');
            tabBtns.forEach(b => {
                b.style.color = '#6b7280';
                b.style.borderBottomColor = 'transparent';
            });

            const targetId = btn.dataset.target;
            document.getElementById(targetId).style.display = 'grid';
            btn.style.color = '#7c3aed';
            btn.style.borderBottomColor = '#7c3aed';

            setTimeout(() => {
                cargarGraficosPorPestana(targetId);
            }, 100);
        });
    });

    // 2. Función para dibujar un gráfico (CORREGIDA DEFINITIVAMENTE)
    function renderChart(divId, type, labels, seriesData, colors) {
        const el = document.getElementById(divId);
        if (!el) return;

        if (charts[divId]) {
            charts[divId].destroy();
        }
        el.innerHTML = '';

        let formattedSeries = [];
        
        // Si es de torta, aseguramos que los datos sean un arreglo de números puros
        if (type === 'pie' || type === 'donut') {
            formattedSeries = seriesData.map(Number);
        } else {
            // Si es de barras, ApexCharts necesita el formato de objeto
            formattedSeries = [{ name: 'Cantidad', data: seriesData.map(Number) }];
        }

        const options = {
            chart: { type: type, height: 300, toolbar: { show: false } },
            series: formattedSeries,
            labels: labels,
            colors: colors,
            dataLabels: { enabled: type === 'pie' || type === 'donut' },
            legend: { position: 'bottom' },
        };

        charts[divId] = new ApexCharts(el, options);
        charts[divId].render();
    }

    // 3. Cargar los gráficos
    async function cargarGraficosPorPestana(tabId) {
        try {
            if (tabId === 'tab-operativo') {
                // Torta
                const resStatus = await fetch('/api/reportes/avanzados/status-chart', { headers: { 'Accept': 'application/json' } });
                const dataStatus = await resStatus.json();
                if (dataStatus.success) renderChart('chart-orders-status-op', 'pie', dataStatus.data.labels, dataStatus.data.values, ['#f59e0b', '#3b82f6', '#8b5cf6', '#10b981', '#ef4444']);

                // Barras
                const resStock = await fetch('/api/reportes/avanzados/low-stock-chart', { headers: { 'Accept': 'application/json' } });
                const dataStock = await resStock.json();
                if (dataStock.success) renderChart('chart-low-stock', 'bar', dataStock.data.labels, dataStock.data.values, ['#ef4444']);
            }

            if (tabId === 'tab-supervision') {
                const resCoupons = await fetch('/api/reportes/avanzados/coupons-chart', { headers: { 'Accept': 'application/json' } });
                const dataCoupons = await resCoupons.json();
                if (dataCoupons.success) renderChart('chart-coupons', 'bar', dataCoupons.data.labels, dataCoupons.data.values, ['#f59e0b']);

                const resCats = await fetch('/api/reportes/avanzados/categories-chart', { headers: { 'Accept': 'application/json' } });
                const dataCats = await resCats.json();
                if (dataCats.success) renderChart('chart-categories', 'pie', dataCats.data.labels, dataCats.data.values, ['#8b5cf6', '#10b981', '#f59e0b', '#3b82f6', '#ef4444']);
            }

            if (tabId === 'tab-gerencial') {
                const resRev = await fetch('/api/reportes/avanzados/revenue-chart', { headers: { 'Accept': 'application/json' } });
                const dataRev = await resRev.json();
                if (dataRev.success) renderChart('chart-revenue', 'bar', dataRev.data.labels, dataRev.data.values, ['#8b5cf6']);

                const resStatus = await fetch('/api/reportes/avanzados/status-chart', { headers: { 'Accept': 'application/json' } });
                const dataStatus = await resStatus.json();
                if (dataStatus.success) renderChart('chart-orders-status', 'pie', dataStatus.data.labels, dataStatus.data.values, ['#f59e0b', '#3b82f6', '#8b5cf6', '#10b981', '#ef4444']);
            }
        } catch (error) {
            console.error("Error cargando gráficos", error);
        }
    }

    // 4. KPIs
    async function cargarKPIs() {
        try {
            const resEst = await fetch('/api/reportes/avanzados/estrategico', { headers: { 'Accept': 'application/json' } });
            const dataEst = await resEst.json();
            if (dataEst.success) {
                document.getElementById('kpi-revenue-top').textContent = '$' + parseFloat(dataEst.data.total_revenue).toFixed(2);
                document.getElementById('kpi-inventory-top').textContent = '$' + parseFloat(dataEst.data.inventory_value).toFixed(2);
                document.getElementById('kpi-pending-top').textContent = dataEst.data.orders_pending;
            }
            const resTicket = await fetch('/api/reportes/avanzados/ticket-promedio', { headers: { 'Accept': 'application/json' } });
            const dataTicket = await resTicket.json();
            if (dataTicket.success) {
                document.getElementById('kpi-ticket-top').textContent = '$' + parseFloat(dataTicket.data.ticket_promedio).toFixed(2);
            }
        } catch (error) { console.error("Error KPIs", error); }
    }

    cargarGraficosPorPestana('tab-operativo');
    cargarKPIs();
});