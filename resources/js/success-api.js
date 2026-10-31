document.addEventListener('DOMContentLoaded', () => {
    const successTbody = document.getElementById('success-items-tbody');
    if (!successTbody) return; // Si no estamos en la página de éxito, no hacer nada

    const lastOrderStr = localStorage.getItem('last_order');
    
    if (lastOrderStr) {
        const order = JSON.parse(lastOrderStr);
        
        // 1. Actualizar número de orden
        const orderNumberEl = document.getElementById('success-order-number');
        if (orderNumberEl) orderNumberEl.textContent = '#' + order.number;

        // 2. Llenar la tabla con los productos reales
        successTbody.innerHTML = '';
        let subtotalCalc = 0;

        if (order.items && order.items.length > 0) {
            order.items.forEach(item => {
                const subtotalItem = item.price * item.quantity;
                subtotalCalc += subtotalItem;

                successTbody.innerHTML += `
                    <tr>
                        <td>
                            <section class="product-cell">
                                <figure class="product-cell__image">IMG</figure>
                                <section class="product-cell__info">
                                    <strong>${item.name}</strong>
                                </section>
                            </section>
                        </td>
                        <td>${item.quantity}</td>
                        <td>$${parseFloat(item.price).toFixed(2)}</td>
                        <td><strong>$${subtotalItem.toFixed(2)}</strong></td>
                    </tr>
                `;
            });

            // 3. Actualizar los totales
            const iva = subtotalCalc * 0.16;
            const totalFinal = subtotalCalc + 5.00 + iva;

            if(document.getElementById('success-subtotal')) document.getElementById('success-subtotal').textContent = `$${subtotalCalc.toFixed(2)}`;
            if(document.getElementById('success-tax')) document.getElementById('success-tax').textContent = `$${iva.toFixed(2)}`;
            if(document.getElementById('success-total')) document.getElementById('success-total').textContent = `$${totalFinal.toFixed(2)}`;

        } else {
            successTbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No hay detalles del pedido.</td></tr>';
        }

        // 👇 4. AQUÍ ESTÁ EL CAMBIO NUEVO: Llenar los datos de envío 👇
        const addressEl = document.querySelector('.order-info');
        if (addressEl && order.client_name) {
            addressEl.innerHTML = `
                <p><strong>${order.client_name}</strong></p>
                <p>${order.address}</p>
                <p>Tel: ${order.phone}</p>
            `;
        }

    } else {
        successTbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No hay información del pedido reciente.</td></tr>';
    }
});