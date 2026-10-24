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
                            <input type="text" id="nombre" name="shipping_name" class="form-input" placeholder="Ej: Juan Pérez" required>
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="cedula">Cédula / RIF *</label>
                            <input type="text" id="cedula" name="cedula" class="form-input" placeholder="Ej: V-12345678">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="correo">Correo electrónico *</label>
                            <input type="email" id="correo" name="email" class="form-input" placeholder="Ej: juan@correo.com">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="telefono">Teléfono *</label>
                            <input type="tel" id="telefono" name="shipping_phone" class="form-input" placeholder="Ej: 0412-1234567" required>
                        </section>

                        <section class="form-group form-group--full">
                            <label class="form-label" for="direccion">Dirección completa *</label>
                            <input type="text" id="direccion" name="shipping_direccion" class="form-input" placeholder="Calle, número, urbanización..." required>
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="ciudad">Ciudad *</label>
                            <input type="text" id="ciudad" name="shipping_ciudad" class="form-input" placeholder="Ej: Barquisimeto" required>
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="estado">Estado *</label>
                            <input type="text" id="estado" name="shipping_estado" class="form-input" placeholder="Ej: Lara" required>
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
                            <input type="radio" name="payment_method" value="transferencia" checked class="form-radio">
                            <section>
                                <p class="payment-option__title">Transferencia bancaria</p>
                                <p class="payment-option__description">Te enviaremos los datos por correo</p>
                            </section>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="pago_movil" class="form-radio">
                            <section>
                                <p class="payment-option__title">Pago móvil</p>
                                <p class="payment-option__description">Pago rápido desde tu banco</p>
                            </section>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="efectivo" class="form-radio">
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
                    <textarea rows="3" name="notes" class="form-textarea" placeholder="¿Algo que debamos saber sobre tu pedido?"></textarea>
                </section>

            </section>

            {{-- RESUMEN --}}
            <aside class="order-summary">
                <h2 class="cart-summary__title">Resumen del Pedido</h2>

                {{-- Aquí el JS inyectará los productos reales del carrito --}}
                <section class="order-summary__items" id="checkout-items">
                    <p style="text-align: center; padding: 1rem;">Cargando resumen...</p>
                </section>

                <section class="cart-summary__row">
                    <span>Subtotal</span>
                    <span id="checkout-subtotal">$0.00</span>
                </section>
                <section class="cart-summary__row">
                    <span>Envío</span>
                    <span>$5.00</span>
                </section>
                <section class="cart-summary__row">
                    <span>IVA (16%)</span>
                    <span id="checkout-tax">$0.00</span>
                </section>

                <section class="cart-summary__total">
                    <span class="cart-summary__total-label">Total</span>
                    <span class="cart-summary__total-value" id="checkout-total">$0.00</span>
                </section>

                {{-- Aquí está el botón con el id que espera el JS --}}
                <button type="button" id="btn-confirmar-pedido" class="btn btn--primary btn--block btn--lg">
                    Confirmar Pedido
                </button>

                <p class="order-summary__note">
                    Al confirmar, aceptas nuestros términos y condiciones
                </p>
            </aside>

        </section>
    </section>

@endsection