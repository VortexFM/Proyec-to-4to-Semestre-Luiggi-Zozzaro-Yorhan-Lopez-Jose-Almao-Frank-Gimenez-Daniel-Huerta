@extends('layouts.app')

@section('title', 'Checkout - Mi Tienda')

@section('content')

    <section class="page-header">
        <section class="container">
            <h1 class="page-header__title">Finalizar Compra</h1>
            <p class="page-header__subtitle">Completa tus datos para procesar el pedido</p>
        </section>
    </section>

    <section class="section container">
        <section class="checkout-layout">

            {{-- FORMULARIO --}}
            <section class="checkout-main">

                {{-- DATOS DE ENVÍO --}}
                <section class="checkout-section">
                    <h2 class="checkout-section__title">
                        <span class="checkout-section__step">1</span>
                        Datos de Envío
                    </h2>

                    <section class="form-grid">
                        <section class="form-group">
                            <label class="form-label" for="nombre">Nombre completo *</label>
                            <input type="text" id="nombre" class="form-input" placeholder="Ej: Juan Pérez">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="cedula">Cédula / RIF *</label>
                            <input type="text" id="cedula" class="form-input" placeholder="Ej: V-12345678">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="correo">Correo electrónico *</label>
                            <input type="email" id="correo" class="form-input" placeholder="Ej: juan@correo.com">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="telefono">Teléfono *</label>
                            <input type="tel" id="telefono" class="form-input" placeholder="Ej: 0412-1234567">
                        </section>

                        <section class="form-group form-group--full">
                            <label class="form-label" for="direccion">Dirección completa *</label>
                            <input type="text" id="direccion" class="form-input" placeholder="Calle, número, urbanización...">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="ciudad">Ciudad *</label>
                            <input type="text" id="ciudad" class="form-input" placeholder="Ej: Barquisimeto">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="estado">Estado *</label>
                            <input type="text" id="estado" class="form-input" placeholder="Ej: Lara">
                        </section>
                    </section>
                </section>

                {{-- MÉTODO DE PAGO --}}
                <section class="checkout-section">
                    <h2 class="checkout-section__title">
                        <span class="checkout-section__step">2</span>
                        Método de Pago
                    </h2>

                    <section class="payment-options">
                        <label class="payment-option payment-option--selected">
                            <input type="radio" name="pago" checked class="form-radio">
                            <section>
                                <p class="payment-option__title">Transferencia bancaria</p>
                                <p class="payment-option__description">Te enviaremos los datos por correo</p>
                            </section>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="pago" class="form-radio">
                            <section>
                                <p class="payment-option__title">Pago móvil</p>
                                <p class="payment-option__description">Pago rápido desde tu banco</p>
                            </section>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="pago" class="form-radio">
                            <section>
                                <p class="payment-option__title">Efectivo contra entrega</p>
                                <p class="payment-option__description">Pagas al recibir tu pedido</p>
                            </section>
                        </label>
                    </section>
                </section>

                {{-- NOTAS --}}
                <section class="checkout-section">
                    <h2 class="checkout-section__title">Notas adicionales (opcional)</h2>
                    <textarea rows="3" class="form-textarea" placeholder="¿Algo que debamos saber sobre tu pedido?"></textarea>
                </section>

            </section>

            {{-- RESUMEN --}}
            <aside class="order-summary">
                <h2 class="cart-summary__title">Resumen del Pedido</h2>

                <section class="order-summary__items">
                    <section class="order-summary__item">
                        <span>Producto 1 <small>x1</small></span>
                        <span>$25.00</span>
                    </section>
                    <section class="order-summary__item">
                        <span>Producto 2 <small>x2</small></span>
                        <span>$30.00</span>
                    </section>
                    <section class="order-summary__item">
                        <span>Producto 3 <small>x1</small></span>
                        <span>$20.00</span>
                    </section>
                </section>

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

                <button class="btn btn--primary btn--block btn--lg" type="button">
                    Confirmar Pedido
                </button>

                <p class="order-summary__note">
                    Al confirmar, aceptas nuestros términos y condiciones
                </p>
            </aside>

        </section>
    </section>

@endsection