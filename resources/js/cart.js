document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    /* ============================================
       1. LÓGICA PARA AGREGAR DESDE LA VISTA DEL PRODUCTO
       ============================================ */
    const btnAdd = document.getElementById('btn-add-to-cart');
    
    if (btnAdd) {
        const inputQty = document.getElementById('product-quantity');
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus  = document.getElementById('btn-plus');

        // Botones + y -
        if (btnMinus && btnPlus && inputQty) {
            btnMinus.addEventListener('click', () => {
                let val = parseInt(inputQty.value);
                if (val > 1) inputQty.value = val - 1;
            });

            btnPlus.addEventListener('click', () => {
                let val = parseInt(inputQty.value);
                let max = parseInt(inputQty.getAttribute('max'));
                if (val < max) inputQty.value = val + 1;
            });
        }

        // Agregar al carrito
        btnAdd.addEventListener('click', async () => {
            const productId = btnAdd.dataset.id;
            const quantity  = parseInt(inputQty.value);
            const originalText = btnAdd.textContent;

            btnAdd.disabled = true;
            btnAdd.textContent = 'Agregando...';

            try {
                const res = await fetch('/api/carrito/agregar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ product_id: productId, quantity: quantity })
                });

                const data = await res.json();

                if (data.success) {
                    actualizarContadorCarrito(data.count);
                    
                    if (window.Toast) {
                        window.Toast.success('¡Agregado!', 'El producto está en tu carrito.');
                    } else {
                        alert('Producto agregado al carrito');
                    }
                } else {
                    alert(data.message || 'Error al agregar');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión');
            } finally {
                btnAdd.disabled = false;
                btnAdd.textContent = originalText;
            }
        });
    }

    /* ============================================
       2. LÓGICA PARA LA VISTA DEL CARRITO (index)
       ============================================ */
    const cartContainer = document.querySelector('.cart-layout');
    const cartEmpty = document.querySelector('.cart-empty');

    if (cartContainer || cartEmpty) {
        cargarCarrito();
    }

    async function cargarCarrito() {
        try {
            const res = await fetch('/api/carrito', { headers: { 'Accept': 'application/json' } });
            const data = await res.json();

            if (data.success) {
                renderizarCarrito(data.data);
            }
        } catch (error) {
            console.error('Error al cargar carrito:', error);
        }
    }

    function renderizarCarrito(cartData) {
        // Si está vacío, mostrar estado vacío
        if (cartData.items.length === 0) {
            if (!document.querySelector('.cart-empty')) {
                window.location.reload(); 
            }
            return;
        }

        // Si hay productos, pero Blade mostraba el estado vacío, recargar
        if (!document.querySelector('.cart-layout')) {
            window.location.reload();
            return;
        }

        // Renderizar los productos
        const itemsContainer = document.querySelector('.cart-items');
        itemsContainer.innerHTML = '';

        cartData.items.forEach(item => {
            const article = document.createElement('article');
            article.className = 'cart-item';
            article.innerHTML = `
                <figure class="cart-item__image">
                    <span>Img</span>
                </figure>
                <section class="cart-item__info">
                    <h3 class="cart-item__title">${item.name}</h3>
                    <p class="cart-item__category">${item.category}</p>
                    <span class="cart-item__price">$${parseFloat(item.price).toFixed(2)}</span>
                </section>
                <section class="quantity-selector">
                    <button type="button" onclick="cambiarCantidad(${item.id}, ${item.quantity - 1})">−</button>
                    <input type="number" value="${item.quantity}" readonly>
                    <button type="button" onclick="cambiarCantidad(${item.id}, ${item.quantity + 1})">+</button>
                </section>
                <p class="cart-item__subtotal">
                    <span>$${(item.price * item.quantity).toFixed(2)}</span>
                </p>
                <button class="cart-item__remove" onclick="eliminarDelCarrito(${item.id})" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            `;
            itemsContainer.appendChild(article);
        });

        // Actualizar resumen (Subtotal, Envío, IVA, Total)
        const subtotal = cartData.total;
        const envio = 5.00; // Costo fijo de envío
        const iva = subtotal * 0.16; // 16% IVA
        const total = subtotal + envio + iva;

        document.querySelectorAll('.cart-summary__row span:last-child')[0].textContent = `$${subtotal.toFixed(2)}`;
        document.querySelectorAll('.cart-summary__row span:last-child')[1].textContent = `$${envio.toFixed(2)}`;
        document.querySelectorAll('.cart-summary__row span:last-child')[2].textContent = `$${iva.toFixed(2)}`;
        document.querySelector('.cart-summary__total-value').textContent = `$${total.toFixed(2)}`;
        
        actualizarContadorCarrito(cartData.count);
    }

    // Funciones globales
    window.cambiarCantidad = async function(id, newQty) {
        if (newQty < 1) return eliminarDelCarrito(id);

        try {
            await fetch('/api/carrito/actualizar', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ product_id: id, quantity: newQty })
            });
            cargarCarrito();
        } catch (e) { console.error(e); }
    };

    window.eliminarDelCarrito = async function(id) {
        try {
            await fetch(`/api/carrito/eliminar/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });
            cargarCarrito();
        } catch (e) { console.error(e); }
    };

    const btnClear = document.querySelector('.cart-actions__clear');
    if (btnClear) {
        btnClear.addEventListener('click', async () => {
            if (!confirm('¿Vaciar todo el carrito?')) return;
            try {
                await fetch('/api/carrito/vaciar', {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                });
                window.location.reload();
            } catch (e) { console.error(e); }
        });
    }

    // Actualizar los numeritos del header
    function actualizarContadorCarrito(count) {
        const badges = document.querySelectorAll('.site-header__cart-badge');
        badges.forEach(badge => badge.textContent = count);
        
        const mobileCart = document.querySelector('.site-header__mobile-actions a[href*="carrito"]');
        if (mobileCart) mobileCart.textContent = `🛒 Carrito (${count})`;
    }
});