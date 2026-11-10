document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Lógica de las Pestañas (Tabs)
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
        });
    });

    // 2. Cargar todos los KPIs
    async function cargarKPIs() {
        try {
            // Gerencial: Estratégico
            const resEst = await fetch('/api/reportes/avanzados/estrategico', { headers: { 'Accept': 'application/json' } });
            const dataEst = await resEst.json();
            if (dataEst.success) {
                document.getElementById('kpi-revenue').textContent = '$' + parseFloat(dataEst.data.total_revenue).toFixed(2);
                document.getElementById('kpi-inventory').textContent = '$' + parseFloat(dataEst.data.inventory_value).toFixed(2);
                document.getElementById('kpi-pending-orders').textContent = dataEst.data.orders_pending;
            }

            // Gerencial: Crecimiento
            const resGrowth = await fetch('/api/reportes/avanzados/crecimiento', { headers: { 'Accept': 'application/json' } });
            const dataGrowth = await resGrowth.json();
            if (dataGrowth.success) {
                document.getElementById('kpi-growth').textContent = dataGrowth.data.este_mes;
            }

            // Gerencial: Ticket Promedio
            const resTicket = await fetch('/api/reportes/avanzados/ticket-promedio', { headers: { 'Accept': 'application/json' } });
            const dataTicket = await resTicket.json();
            if (dataTicket.success) {
                document.getElementById('kpi-avg-ticket').textContent = '$' + parseFloat(dataTicket.data.ticket_promedio).toFixed(2);
            }

            // Supervisión: Cupones
            const resMkt = await fetch('/api/reportes/avanzados/marketing', { headers: { 'Accept': 'application/json' } });
            const dataMkt = await resMkt.json();
            if (dataMkt.success) {
                document.getElementById('kpi-discounts').textContent = '$' + parseFloat(dataMkt.data.total_discounts_given).toFixed(2);
            }

            // Supervisión: Estancados
            const resStag = await fetch('/api/reportes/avanzados/estancados', { headers: { 'Accept': 'application/json' } });
            const dataStag = await resStag.json();
            if (dataStag.success) {
                document.getElementById('kpi-stagnant').textContent = dataStag.data.length;
            }

            // Supervisión: Categoría Top
            const resTac = await fetch('/api/reportes/avanzados/tactico', { headers: { 'Accept': 'application/json' } });
            const dataTac = await resTac.json();
            if (dataTac.success && dataTac.data.length > 0) {
                document.getElementById('kpi-top-category').textContent = dataTac.data[0].name;
            }

        } catch (error) {
            console.error("Error cargando KPIs", error);
        }
    }

    cargarKPIs();
});

window.exportReport = function(tipo) {
    if(tipo === 'estrategico') window.location.href = '/api/reportes/avanzados/exportar-estrategico'; 
    if(tipo === 'marketing') window.location.href = '/api/reportes/avanzados/exportar-marketing';
    if(tipo === 'operativo') window.location.href = '/api/exportar/direcciones';
    if(tipo === 'tactico') window.location.href = '/api/exportar/pedidos';
    if(tipo === 'pedidos') window.location.href = '/api/exportar/pedidos';
    if(tipo === 'direcciones') window.location.href = '/api/exportar/direcciones';
    
    // 👇 NUEVAS RUTAS PARA LOS REPORTES QUE FALTABAN 👇
    if(tipo === 'estancados') window.location.href = '/api/reportes/avanzados/exportar-estancados';
    if(tipo === 'crecimiento') window.location.href = '/api/reportes/avanzados/exportar-crecimiento';
    if(tipo === 'ticket') window.location.href = '/api/reportes/avanzados/exportar-ticket';
};
