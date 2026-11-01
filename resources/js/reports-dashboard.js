document.addEventListener('DOMContentLoaded', async () => {
    
    // 1. Llenar los KPIs visuales (solo si estamos en la página de reportes)
    if (!document.getElementById('kpi-revenue')) return;

    try {
        // Estratégico
        const resEst = await fetch('/api/reportes/avanzados/estrategico', { headers: { 'Accept': 'application/json' } });
        const dataEst = await resEst.json();
        if(dataEst.success) {
            document.getElementById('kpi-revenue').textContent = '$' + parseFloat(dataEst.data.total_revenue).toFixed(2);
            document.getElementById('kpi-inventory').textContent = '$' + parseFloat(dataEst.data.inventory_value).toFixed(2);
            document.getElementById('kpi-pending-orders').textContent = dataEst.data.orders_pending;
        }

        // Marketing
        const resMkt = await fetch('/api/reportes/avanzados/marketing', { headers: { 'Accept': 'application/json' } });
        const dataMkt = await resMkt.json();
        if(dataMkt.success) {
            document.getElementById('kpi-discounts').textContent = '$' + parseFloat(dataMkt.data.total_discounts_given).toFixed(2);
        }

        // Táctico
        const resTac = await fetch('/api/reportes/avanzados/tactico', { headers: { 'Accept': 'application/json' } });
        const dataTac = await resTac.json();
        if(dataTac.success && dataTac.data.length > 0) {
            const top = dataTac.data[0];
            document.getElementById('kpi-top-category').textContent = top.name + ' (' + top.products_count + ' prod)';
        }
    } catch (error) {
        console.error("Error cargando KPIs", error);
    }
});

// 2. Función para exportar (debe estar fuera para que el HTML la encuentre)
window.exportReport = function(tipo) {
    if(tipo === 'estrategico') window.location.href = '/api/reportes/avanzados/exportar-estrategico'; 
    // Los demás los dejas como estaban por ahora
    if(tipo === 'marketing') window.location.href = '/api/exportar/clientes'; 
    if(tipo === 'operativo') window.location.href = '/api/exportar/direcciones';
    if(tipo === 'tactico') window.location.href = '/api/exportar/pedidos';
};