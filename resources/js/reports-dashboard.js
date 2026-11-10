document.addEventListener('DOMContentLoaded', () => {
    
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
        });
    });

    // 2. Cargar los KPIs superiores
    async function cargarKPIs() {
        try {
            // Estratégico (Ingresos e Inventario)
            const resEst = await fetch('/api/reportes/avanzados/estrategico', { headers: { 'Accept': 'application/json' } });
            const dataEst = await resEst.json();
            if (dataEst.success) {
                document.getElementById('kpi-revenue-top').textContent = '$' + parseFloat(dataEst.data.total_revenue).toFixed(2);
                document.getElementById('kpi-inventory-top').textContent = '$' + parseFloat(dataEst.data.inventory_value).toFixed(2);
                document.getElementById('kpi-pending-top').textContent = dataEst.data.orders_pending;
            }

            // Ticket Promedio
            const resTicket = await fetch('/api/reportes/avanzados/ticket-promedio', { headers: { 'Accept': 'application/json' } });
            const dataTicket = await resTicket.json();
            if (dataTicket.success) {
                document.getElementById('kpi-ticket-top').textContent = '$' + parseFloat(dataTicket.data.ticket_promedio).toFixed(2);
            }

        } catch (error) {
            console.error("Error cargando KPIs", error);
        }
    }

    cargarKPIs();
});