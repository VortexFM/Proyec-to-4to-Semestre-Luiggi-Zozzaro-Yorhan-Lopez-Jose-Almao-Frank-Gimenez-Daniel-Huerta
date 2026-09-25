@extends('layouts.app')

@section('title', 'Carrito de Compras - Mi Tienda')

@section('content')

    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">Carrito de Compras</h1>
            <p class="page-header__subtitle">Revisa los productos antes de finalizar tu compra</p>
        </section>
    </header>

    <section class="section container">

        {{-- CAMBIA ESTO A true PARA VER EL ESTADO VACÍO --}}
        @php $carritoVacio = true; @endphp

        @if ($carritoVacio)

            {{-- ============================== --}}
            {{-- ESTADO VACÍO --}}
            {{-- ============================== --}}
            <article class="cart-empty">
                <figure class="cart-empty__icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </figure>

                <header class="cart-empty__header">
                    <h2 class="cart-empty__title">Tu carrito está vacío</h2>
                    <p class="cart-empty__subtitle">
                        Parece que aún no has agregado ningún producto.
                        Explora nuestro catálogo y encuentra algo especial.
                    </p>
                </header>

                <nav class="cart-empty__actions" aria-label="Acciones del carrito vacío">
                    <a href="{{ url('/productos') }}" class="btn btn--primary btn--lg">
                        🛍️ Ver catálogo
                    </a>
                    <a href="{{ url('/categorias') }}" class="btn btn--outline btn--lg">
                        Explorar categorías
                    </a>
                </nav>
            </article>

        @else

            {{-- ============================== --}}
            {{-- ESTADO CON PRODUCTOS --}}
            {{-- ============================== --}}
            <section class="cart-layout">

                {{-- LISTA DE PRODUCTOS --}}
                <section class="cart-main">

                    <section class="cart-items">
                        @for ($i = 1; $i <= 3; $i++)
                            <article class="cart-item">
                                <figure class="cart-item__image">
                                    <span>Imagen</span>
                                </figure>

                                <section class="cart-item__info">
                                    <h3 class="cart-item__title">Producto de prueba {{ $i }}</h3>
                                    <p class="cart-item__category">Categoría</p>
                                    <span class="cart-item__price">$25.00</span>
                                </section>

                                <section class="quantity-selector">
                                    <button type="button" aria-label="Disminuir cantidad">−</button>
                                    <input type="number" value="1" min="1" aria-label="Cantidad">
                                    <button type="button" aria-label="Aumentar cantidad">+</button>
                                </section>

                                <p class="cart-item__subtotal">
                                    <span>$25.00</span>
                                </p>

                                <button class="cart-item__remove" aria-label="Eliminar producto" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                            </article>
                        @endfor
                    </section>

                    <nav class="cart-actions" aria-label="Acciones del carrito">
                        <a href="{{ url('/productos') }}" class="cart-actions__back">
                            ← Seguir comprando
                        </a>
                        <button class="cart-actions__clear" type="button">
                            Vaciar carrito
                        </button>
                    </nav>

                </section>

                {{-- RESUMEN --}}
                <aside class="cart-summary">
                    <h2 class="cart-summary__title">Resumen del Pedido</h2>

                    <p class="cart-summary__row">
                        <span>Subtotal</span>
                        <span>$75.00</span>
                    </p>
                    <p class="cart-summary__row">
                        <span>Envío</span>
                        <span>$5.00</span>
                    </p>
                    <p class="cart-summary__row">
                        <span>IVA (16%)</span>
                        <span>$12.80</span>
                    </p>

                    <p class="cart-summary__total">
                        <span class="cart-summary__total-label">Total</span>
                        <span class="cart-summary__total-value">$92.80</span>
                    </p>

                    <a href="{{ url('/checkout') }}" class="btn btn--primary btn--block btn--lg">
                        Proceder al Pago
                    </a>
                </aside>

            </section>

        @endif

    </section>

@endsection