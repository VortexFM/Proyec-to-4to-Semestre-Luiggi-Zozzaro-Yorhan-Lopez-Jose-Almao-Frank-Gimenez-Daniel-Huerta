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

        {{-- Aquí pegamos directamente el layout de los productos, sin el @if --}}
        <section class="cart-layout">

            {{-- LISTA DE PRODUCTOS --}}
            <section class="cart-main">
                <section class="cart-items" id="cart-items-container">
                    {{-- Aquí el JS inyectará los productos --}}
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
                    <span id="summary-subtotal">$0.00</span>
                </p>
                <p class="cart-summary__row">
                    <span>Envío</span>
                    <span id="summary-shipping">$5.00</span>
                </p>
                <p class="cart-summary__row">
                    <span>IVA (16%)</span>
                    <span id="summary-tax">$0.00</span>
                </p>

                <p class="cart-summary__total">
                    <span class="cart-summary__total-label">Total</span>
                    <span class="cart-summary__total-value" id="summary-total">$0.00</span>
                </p>

                <a href="{{ url('/checkout') }}" class="btn btn--primary btn--block btn--lg">
                    Proceder al Pago
                </a>
            </aside>

        </section>

    </section>

@endsection