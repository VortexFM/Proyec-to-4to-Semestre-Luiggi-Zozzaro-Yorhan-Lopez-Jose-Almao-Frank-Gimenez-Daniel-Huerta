document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    /* ============================================
       LÓGICA DEL LOCALSTORAGE
       ============================================ */
    function obtenerCarrito() {
        return JSON.parse(localStorage.getItem('cart') || '[]');
    }

    function guardarCarrito(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
        actualizarContadorCarrito();
    }

    function actualizarContadorCarrito() {
        const cart = obtenerCarrito();
        const totalDistintos = cart.length; // Cantidad de productos diferentes

        const badges = document.querySelectorAll('.site-header__cart-badge');
        badges.forEach(badge => badge.textContent = totalDistintos);
        
        const mobileCart = document.querySelector('.site-header__mobile-actions a[href*="carrito"]');
        if (mobileCart) mobileCart.textContent = `🛒 Carrito (${totalDistintos})`;
    }

    /* ============================================
       1. AGREGAR DESDE VISTA DE PRODUCTO Y CATÁLOGO
       ============================================ */
    const btnAdd = document.getElementById('btn-add-to-cart');
    const btnsCatalogo = document.querySelectorAll('.product-card__button');

    // Función central para agregar
    async function agregarAlCarrito(productId, quantity) {
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
                let cart = obtenerCarrito();
                const existing = cart.find(item => item.id == productId);

                if (existing) {
                    existing.quantity += quantity;
                } else {
                    cart.push(data.product);
                }

                guardarCarrito(cart);
                
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
        }
    }

    // Botón de la página de detalle
    if (btnAdd) {
        const inputQty = document.getElementById('product-quantity');
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus  = document.getElementById('btn-plus');

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

        btnAdd.addEventListener('click', async () => {
            const productId = btnAdd.dataset.id;
            const quantity  = parseInt(inputQty.value);
            const originalText = btnAdd.textContent;
            btnAdd.disabled = true;
            btnAdd.textContent = 'Agregando...';
            
            await agregarAlCarrito(productId, quantity);
            
            btnAdd.disabled = false;
            btnAdd.textContent = originalText;
        });
    }

    // Botones del catálogo (tarjetas)
    btnsCatalogo.forEach(btn => {
        btn.addEventListener('click', async (e) => {
            // Si el botón está dentro de un enlace, prevenimos que navegue
            if (btn.closest('a')) e.preventDefault(); 
            
            const productId = btn.getAttribute('data-id');
            if (productId) {
                await agregarAlCarrito(productId, 1);
            } else {
                // 👇 SI NO ENCUENTRA EL ID, REDIRIGE AL PRODUCTO
                window.location.href = btn.closest('a') ? btn.closest('a').href : '/productos';
            }
        });
    });

    /* ============================================
       2. VISTA DEL CARRITO
       ============================================ */
    function renderizarVistaCarrito() {
        const itemsContainer = document.querySelector('.cart-items');
        const summary = document.querySelector('.cart-summary');
        if (!itemsContainer) return;

        const cart = obtenerCarrito();

        if (cart.length === 0) {
            itemsContainer.innerHTML = `
                <div style="text-align: center; padding: 3rem;">
                    <h3>Tu carrito está vacío</h3>
                    <p>Explora nuestro catálogo y encuentra algo especial.</p>
                    <a href="/productos" class="btn btn--primary" style="margin-top: 1rem;">Ver catálogo</a>
                </div>
            `;
            if (summary) summary.style.display = 'none';
            return; 
        }

        if (summary) summary.style.display = 'block';
        itemsContainer.innerHTML = '';

        let subtotal = 0;

        cart.forEach(item => {
            subtotal += item.price * item.quantity;
            const article = document.createElement('article');
            article.className = 'cart-item';
            article.innerHTML = `
                <figure class="cart-item__image"><span>Img</span></figure>
                <section class="cart-item__info">
                    <h3 class="cart-item__title">${item.name}</h3>
                    <p class="cart-item__category">${item.category}</p>
                    <span class="cart-item__price">$${parseFloat(item.price).toFixed(2)}</span>
                </section>
                <section class="quantity-selector">
                    <button type="button" onclick="cambiarCantidadLocal(${item.id}, ${item.quantity - 1})">−</button>
                    <input type="number" value="${item.quantity}" readonly>
                    <button type="button" onclick="cambiarCantidadLocal(${item.id}, ${item.quantity + 1})">+</button>
                </section>
                <p class="cart-item__subtotal"><span>$${(item.price * item.quantity).toFixed(2)}</span></p>
                <button class="cart-item__remove" onclick="eliminarDelCarritoLocal(${item.id})" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            `;
            itemsContainer.appendChild(article);
        });

        const envio = 5.00;
        const iva = subtotal * 0.16;
        const total = subtotal + envio + iva;

        if(document.getElementById('summary-subtotal')) {
            document.getElementById('summary-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('summary-shipping').textContent = `$${envio.toFixed(2)}`;
            document.getElementById('summary-tax').textContent = `$${iva.toFixed(2)}`;
            document.getElementById('summary-total').textContent = `$${total.toFixed(2)}`;
        }
    }

    // Si estamos en la página del carrito, renderizamos
    if (document.querySelector('.cart-items')) {
        renderizarVistaCarrito();
    }

    /* ============================================
       3. FUNCIONES GLOBALES (Carrito)
       ============================================ */
    window.cambiarCantidadLocal = function(id, newQty) {
        if (newQty < 1) return window.eliminarDelCarritoLocal(id);
        let cart = obtenerCarrito();
        const item = cart.find(i => i.id == id);
        if (item) {
            item.quantity = newQty;
            guardarCarrito(cart);
            renderizarVistaCarrito();
        }
    };

    window.eliminarDelCarritoLocal = function(id) {
        let cart = obtenerCarrito();
        cart = cart.filter(i => i.id != id);
        guardarCarrito(cart);
        renderizarVistaCarrito();
    };

    const btnClear = document.querySelector('.cart-actions__clear');
    if (btnClear) {
        btnClear.addEventListener('click', () => {
            if (confirm('¿Vaciar todo el carrito?')) {
                guardarCarrito([]);
                renderizarVistaCarrito();
            }
        });
    }

    /* ============================================
       4. CHECKOUT
       ============================================ */
    const btnConfirmar = document.getElementById('btn-confirmar-pedido');
    
    if (btnConfirmar && window.location.pathname === '/checkout') {
        
        const cart = obtenerCarrito();
        const itemsContainer = document.getElementById('checkout-items');
        if(itemsContainer) {
            itemsContainer.innerHTML = '';
            cart.forEach(item => {
                itemsContainer.innerHTML += `
                    <section class="order-summary__item">
                        <span>${item.name} <small>x${item.quantity}</small></span>
                        <span>$${(item.price * item.quantity).toFixed(2)}</span>
                    </section>
                `;
            });
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const iva = subtotal * 0.16;
            const total = subtotal + 5.00 + iva;
            
            if(document.getElementById('checkout-subtotal')){
                document.getElementById('checkout-subtotal').textContent = `$${subtotal.toFixed(2)}`;
                document.getElementById('checkout-tax').textContent = `$${iva.toFixed(2)}`;
                document.getElementById('checkout-total').textContent = `$${total.toFixed(2)}`;
            }
        }

        btnConfirmar.addEventListener('click', async (e) => {
            e.preventDefault();
            btnConfirmar.disabled = true;
            btnConfirmar.textContent = 'Procesando...';

            const payload = {
                cart: obtenerCarrito(), // Mandamos el carrito del localStorage al backend
                shipping_name: document.getElementById('nombre').value,
                shipping_phone: document.getElementById('telefono').value,
                shipping_estado: document.getElementById('estado').value,
                shipping_ciudad: document.getElementById('ciudad').value,
                shipping_direccion: document.getElementById('direccion').value,
                payment_method: document.querySelector('input[name="payment_method"]:checked').value
            };

            try {
                const res = await fetch('/api/checkout/procesar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (data.success) {
                    if (window.Toast) window.Toast.success('¡Pedido confirmado!', 'Gracias por tu compra.');
                    localStorage.removeItem('cart'); // Limpiamos el carrito local
                    setTimeout(() => {
                        window.location.href = '/pedido/confirmacion';
                    }, 1500);
                } else {
                    alert(data.message || 'Error al procesar el pedido');
                    btnConfirmar.disabled = false;
                    btnConfirmar.textContent = 'Confirmar Pedido';
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión');
                btnConfirmar.disabled = false;
                btnConfirmar.textContent = 'Confirmar Pedido';
            }
        });
    }

    // Inicializar contador al cargar cualquier página
    actualizarContadorCarrito();
});