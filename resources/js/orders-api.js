document.addEventListener('DOMContentLoaded', () => {
    
    /* ============================================
       LÓGICA PARA LA VISTA DE LISTA (TABLA)
       ============================================ */
    const ordersTbody = document.getElementById('orders-tbody');
    
    if (ordersTbody) {
        const API_URL = '/api/pedidos';
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
        const searchInput = document.getElementById('search-order');
        const statusFilter = document.getElementById('filter-status');

        const statusColors = {
            'pendiente': 'badge--warning',
            'confirmado': 'badge--info',
            'preparando': 'badge--primary',
            'enviado': 'badge--info',
            'entregado': 'badge--success',
            'cancelado': 'badge--danger'
        };

        async function cargarPedidos() {
            try {
                const params = new URLSearchParams();
                if (searchInput && searchInput.value) params.set('search', searchInput.value);
                if (statusFilter && statusFilter.value) params.set('status', statusFilter.value);

                const res = await fetch(`${API_URL}?${params}`, { headers: { 'Accept': 'application/json' } });
                const data = await res.json();

                if (!data.success) throw new Error('Error al cargar');
                renderizarTabla(data.data.data);
            } catch (error) {
                console.error(error);
                ordersTbody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:red;">Error al cargar pedidos</td></tr>`;
            }
        }

        function renderizarTabla(orders) {
            if (orders.length === 0) {
                ordersTbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">No hay pedidos registrados</td></tr>`;
                return;
            }

            ordersTbody.innerHTML = orders.map(order => {
                const fecha = new Date(order.created_at).toLocaleDateString('es-ES');
                const badgeColor = statusColors[order.status] || 'badge--gray';

                return `
                    <tr>
                        <td><strong>${order.order_number}</strong></td>
                        <td>${order.shipping_name}</td>
                        <td>${fecha}</td>
                        <td><strong style="color: var(--color-primary);">$${parseFloat(order.total).toFixed(2)}</strong></td>
                        <td><span class="badge ${badgeColor}">${order.status.toUpperCase()}</span></td>
                        <td><a href="/admin/pedidos/${order.id}" class="btn btn--sm btn--ghost">👁️ Ver</a></td>
                    </tr>
                `;
            }).join('');
        }

        let debounce;
        if (searchInput) searchInput.addEventListener('input', () => { clearTimeout(debounce); debounce = setTimeout(cargarPedidos, 400); });
        if (statusFilter) statusFilter.addEventListener('change', cargarPedidos);

        cargarPedidos();
    }

    /* ============================================
       LÓGICA PARA LA VISTA DE DETALLE
       ============================================ */
    const orderItemsTbody = document.getElementById('order-items-tbody');
    
    if (orderItemsTbody) {
        const API_URL = '/api/pedidos';
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
        
        // Obtenemos el ID asegurándonos de que sea un número
        const pathParts = window.location.pathname.split('/');
        const orderId = pathParts[pathParts.length - 1]; 

        async function cargarDetallePedido() {
            try {
                const res = await fetch(`${API_URL}/${orderId}`, { headers: { 'Accept': 'application/json' } });
                const json = await res.json();

                if (!json.success) throw new Error('Error al cargar');
                const order = json.data;

                // Llenar datos asegurando que el elemento exista
                if(document.getElementById('order-number-display')) document.getElementById('order-number-display').textContent = order.order_number;
                if(document.getElementById('ship-name')) document.getElementById('ship-name').textContent = order.shipping_name;
                if(document.getElementById('ship-phone')) document.getElementById('ship-phone').textContent = order.shipping_phone;
                if(document.getElementById('ship-address')) document.getElementById('ship-address').textContent = order.shipping_calle || 'No especificada';
                if(document.getElementById('ship-city')) document.getElementById('ship-city').textContent = order.shipping_ciudad;
                if(document.getElementById('ship-state')) document.getElementById('ship-state').textContent = order.shipping_estado;
                if(document.getElementById('sum-subtotal')) document.getElementById('sum-subtotal').textContent = `$${parseFloat(order.subtotal).toFixed(2)}`;
                if(document.getElementById('sum-shipping')) document.getElementById('sum-shipping').textContent = `$${parseFloat(order.shipping).toFixed(2)}`;
                if(document.getElementById('sum-total')) document.getElementById('sum-total').textContent = `$${parseFloat(order.total).toFixed(2)}`;
                if(document.getElementById('select-status')) document.getElementById('select-status').value = order.status;

                // Llenar tabla de productos
                orderItemsTbody.innerHTML = '';
                order.items.forEach(item => {
                    const subtotal = item.price * item.quantity;
                    orderItemsTbody.innerHTML += `
                        <tr>
                            <td>${item.product ? item.product.name : 'Producto Eliminado'}</td>
                            <td>${item.quantity}</td>
                            <td>$${parseFloat(item.price).toFixed(2)}</td>
                            <td><strong>$${subtotal.toFixed(2)}</strong></td>
                        </tr>
                    `;
                });

            } catch (error) {
                console.error(error);
                orderItemsTbody.innerHTML = `<tr><td colspan="4" style="text-align:center; color:red;">Error al cargar el pedido. Revisa la consola.</td></tr>`;
            }
        }

        cargarDetallePedido();
        // Cambiar Estado
        const btnUpdate = document.getElementById('btn-update-status');
        if (btnUpdate) {
            btnUpdate.addEventListener('click', async () => {
                const newStatus = document.getElementById('select-status').value;
                btnUpdate.disabled = true;
                btnUpdate.textContent = 'Actualizando...';

                try {
                    const res = await fetch(`${API_URL}/${orderId}/estado`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        },
                        body: JSON.stringify({ status: newStatus })
                    });

                    const json = await res.json();

                    if (json.success) {
                        if (window.Toast) window.Toast.success('Actualizado', 'El estado del pedido ha cambiado.');
                        else alert('Estado actualizado');
                        
                        // 👇 ESTO ES LO NUEVO: Recargamos la página después de 1 segundo
                        // para que el usuario vea el estado actualizado en pantalla
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        alert(json.message || 'Error al actualizar');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Error de conexión');
                } finally {
                    btnUpdate.disabled = false;
                    btnUpdate.textContent = 'Actualizar Estado';
                }
            });
        }
    }
});