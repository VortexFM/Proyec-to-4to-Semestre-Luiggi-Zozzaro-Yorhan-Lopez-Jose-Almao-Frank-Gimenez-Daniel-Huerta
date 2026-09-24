@extends('layouts.app')

@section('title', 'Pedido Confirmado - Mi Tienda')

@section('content')

    <section class="section container">
        <section class="confirmation">

            {{-- ÍCONO DE ÉXITO --}}
            <figure class="confirmation__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </figure>

            {{-- MENSAJE --}}
            <header class="confirmation__header">
                <h1 class="confirmation__title">¡Pedido confirmado!</h1>
                <p class="confirmation__subtitle">
                    Gracias por tu compra. Hemos recibido tu pedido y te contactaremos pronto.
                </p>
                <p class="confirmation__order-number">
                    Número de pedido: <strong>#001</strong>
                </p>
            </header>

            {{-- RESUMEN DEL PEDIDO --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Resumen del Pedido</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                <td>
                                    <section class="product-cell">
                                        <figure class="product-cell__image">IMG</figure>
                                        <section class="product-cell__info">
                                            <strong>Producto {{ $i }}</strong>
                                            <small>SKU-00{{ $i }}</small>
                                        </section>
                                    </section>
                                </td>
                                <td>1</td>
                                <td>$25.00</td>
                                <td><strong>$25.00</strong></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

                <footer class="order-totals">
                    <p class="order-totals__row">
                        <span>Subtotal</span>
                        <span>$75.00</span>
                    </p>
                    <p class="order-totals__row">
                        <span>Envío</span>
                        <span>$5.00</span>
                    </p>
                    <p class="order-totals__row">
                        <span>IVA (16%)</span>
                        <span>$12.80</span>
                    </p>
                    <p class="order-totals__total">
                        <span>Total</span>
                        <span>$92.80</span>
                    </p>
                </footer>
            </article>

            {{-- INFORMACIÓN DE ENVÍO --}}
            <section class="confirmation-grid">
                <article class="admin-card">
                    <h2 class="admin-card__title">Dirección de Envío</h2>
                    <address class="order-info">
                        <p><strong>Cliente 1</strong></p>
                        <p>Calle 1, Urbanización Centro</p>
                        <p>Barquisimeto, Lara</p>
                        <p>0412-1234567</p>
                    </address>
                </article>

                <article class="admin-card">
                    <h2 class="admin-card__title">Método de Pago</h2>
                    <section class="order-info">
                        <p><strong>Transferencia bancaria</strong></p>
                        <p>Estado: <span class="badge badge--warning">Pendiente de confirmación</span></p>
                        <p class="form-help">Te enviaremos los datos por correo</p>
                    </section>
                </article>
            </section>

            {{-- BOTONES DE ACCIÓN --}}
            <nav class="confirmation__actions" aria-label="Acciones del pedido">
                <a href="{{ url('/perfil') }}" class="btn btn--primary btn--lg">
                    Ver mi pedido
                </a>
                <a href="{{ url('/productos') }}" class="btn btn--outline btn--lg">
                    Seguir comprando
                </a>
            </nav>

        </section>
    </section>

@endsection