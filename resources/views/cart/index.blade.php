@extends('layouts.app')

@section('title', 'Carrito de Compras - Mi Tienda')

@section('content')

    <section class="page-header">
        <section class="container">
            <h1 class="page-header__title">Carrito de Compras</h1>
            <p class="page-header__subtitle">Revisa los productos antes de finalizar tu compra</p>
        </section>
    </section>

    <section class="section container">
        <section class="cart-layout">

            {{-- LISTA DE PRODUCTOS --}}
            <section class="cart-main">

                <section class="cart-items">

                    @for ($i = 1; $i <= 3; $i++)
                        <article class="cart-item">
                            {{-- Imagen --}}
                            <figure class="cart-item__image">
                                <span>Imagen</span>
                            </figure>

                            {{-- Info --}}
                            <section class="cart-item__info">
                                <h3 class="cart-item__title">Producto de prueba {{ $i }}</h3>
                                <p class="cart-item__category">Categoría</p>
                                <span class="cart-item__price">$25.00</span>
                            </section>

                            {{-- Cantidad --}}
                            <section class="quantity-selector">
                                <button type="button">−</button>
                                <input type="number" value="1" min="1">
                                <button type="button">+</button>
                            </section>

                            {{-- Subtotal --}}
                            <section class="cart-item__subtotal">
                                <span>$25.00</span>
                            </section>

                            {{-- Eliminar --}}
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

                {{-- Botones de acción --}}
                <section class="cart-actions">
                    <a href="{{ url('/productos') }}" class="cart-actions__back">
                        ← Seguir comprando
                    </a>
                    <button class="cart-actions__clear" type="button">
                        Vaciar carrito
                    </button>
                </section>

            </section>

            {{-- RESUMEN DEL PEDIDO --}}
            <aside class="cart-summary">
                <h2 class="cart-summary__title">Resumen del Pedido</h2>

                <section class="cart-summary__row">
                    <span>Subtotal</span>
                    <span>$75.00</span>
                </section>
                <section class="cart-summary__row">
                    <span>Envío</span>
                    <span>$5.00</span>
                </section>
                <section class="cart-summary__row">
                    <span>IVA (16%)</span>
                    <span>$12.80</span>
                </section>

                <section class="cart-summary__total">
                    <span class="cart-summary__total-label">Total</span>
                    <span class="cart-summary__total-value">$92.80</span>
                </section>

                <a href="{{ url('/checkout') }}" class="btn btn--primary btn--block btn--lg">
                    Proceder al Pago
                </a>
            </aside>

        </section>
    </section>

@endsection