document.addEventListener('DOMContentLoaded', async () => {
    const ordersList = document.getElementById('orders-list');
    if (!ordersList) return; // Si no estamos en el dashboard del cliente, salir

    const loading = document.getElementById('orders-loading');
    const empty = document.getElementById('orders-empty');

    // Colores de los estados
    const statusColors = {
        'pendiente': '#f59e0b', // Amarillo
        'confirmado': '#3b82f6', // Azul
        'preparando': '#8b5cf6', // Morado
        'enviado': '#06b6d4', // Cyan
        'entregado': '#10b981', // Verde
        'cancelado': '#ef4444' // Rojo
    };

    try {
        const res = await fetch('/api/mi-cuenta', { headers: { 'Accept': 'application/json' } });
        const json = await res.json();

        if (json.success) {
            const user = json.data.user;
            const orders = json.data.orders;

            // Llenar datos del usuario
            document.getElementById('user-name-display').textContent = user.name;
            document.getElementById('user-email-display').textContent = user.email;
            document.getElementById('user-phone-display').textContent = user.phone || 'No registrado';

            loading.style.display = 'none';

            if (orders.length === 0) {
                empty.style.display = 'block';
            } else {
                ordersList.innerHTML = orders.map(order => {
                    const fecha = new Date(order.created_at).toLocaleDateString('es-ES');
                    const color = statusColors[order.status] || '#6b7280';

                    // Generar el HTML de los productos del pedido
                    const itemsHtml = order.items.map(item => `
                        <li style="display: flex; justify-content: space-between; border-bottom: 1px solid #f3f4f6; padding: 0.5rem 0; font-size: 0.9rem;">
                            <span>${item.quantity}x ${item.product ? item.product.name : 'Producto'}</span>
                            <span>$${parseFloat(item.subtotal).toFixed(2)}</span>
                        </li>
                    `).join('');

                    return `
                        <div style="background: white; border-radius: 1rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); overflow: hidden; border-left: 4px solid ${color};">
                            <div style="padding: 1rem; background: #f9fafb; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb;">
                                <div>
                                    <strong style="color: var(--color-primary);">${order.order_number}</strong>
                                    <span style="font-size: 0.875rem; color: #6b7280; margin-left: 1rem;">${fecha}</span>
                                </div>
                                <span class="badge" style="background-color: ${color}20; color: ${color}; font-weight: bold;">
                                    ${order.status.toUpperCase()}
                                </span>
                            </div>
                            <div style="padding: 1rem;">
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    ${itemsHtml}
                                </ul>
                                <div style="display: flex; justify-content: space-between; margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e5e7eb;">
                                    <strong>Total:</strong>
                                    <strong style="color: var(--color-primary);">$${parseFloat(order.total).toFixed(2)}</strong>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            }
        }
    } catch (error) {
        console.error(error);
        loading.textContent = 'Error al cargar el historial.';
    }
});