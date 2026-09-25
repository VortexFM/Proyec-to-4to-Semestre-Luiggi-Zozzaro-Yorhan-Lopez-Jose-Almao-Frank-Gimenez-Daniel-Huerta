@extends('layouts.legal')

@section('title', 'Política de Devoluciones - Mi Tienda')
@section('page-title', 'Política de Devoluciones')
@section('page-subtitle', 'Conoce cómo funcionan nuestras devoluciones')

@section('index')
    <li><a href="#plazo">Plazo de devolución</a></li>
    <li><a href="#condiciones">Condiciones del producto</a></li>
    <li><a href="#no-elegibles">Productos no elegibles</a></li>
    <li><a href="#proceso">Proceso de devolución</a></li>
    <li><a href="#costos">Costos de devolución</a></li>
    <li><a href="#reembolsos">Reembolsos</a></li>
    <li><a href="#cambios">Cambios</a></li>
    <li><a href="#contacto">Contacto</a></li>
@endsection

@section('content')

    <details class="legal-section" id="plazo" open>
        <summary class="legal-section__title">
            1. Plazo de devolución
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Aceptamos devoluciones dentro de los <strong>7 días calendario</strong> siguientes
                a la recepción del producto. Pasado este plazo, no se aceptarán devoluciones.
            </p>
        </section>
    </details>

    <details class="legal-section" id="condiciones">
        <summary class="legal-section__title">
            2. Condiciones del producto
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>Para que una devolución sea aceptada, el producto debe estar:</p>
            <ul>
                <li>En buen estado, sin señales de uso.</li>
                <li>Con su empaque original.</li>
                <li>Con todas sus etiquetas y accesorios.</li>
                <li>Acompañado de la factura o comprobante de compra.</li>
            </ul>
        </section>
    </details>

    <details class="legal-section" id="no-elegibles">
        <summary class="legal-section__title">
            3. Productos no elegibles
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>No aceptamos devoluciones de:</p>
            <ul>
                <li>Productos personalizados o hechos a medida.</li>
                <li>Productos de higiene personal.</li>
                <li>Productos alimenticios perecederos.</li>
                <li>Productos en oferta o liquidación.</li>
            </ul>
            <blockquote class="legal-blockquote">
                ⚠️ <strong>Importante:</strong> Verifica que tu producto sea elegible antes de
                solicitar la devolución.
            </blockquote>
        </section>
    </details>

    <details class="legal-section" id="proceso">
        <summary class="legal-section__title">
            4. Proceso de devolución
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <ol>
                <li>Escríbenos a <a href="mailto:info@mitienda.com">info@mitienda.com</a> indicando el número de pedido y el motivo.</li>
                <li>Te responderemos en menos de 24 horas con las instrucciones.</li>
                <li>Envía el producto a la dirección que te indiquemos.</li>
                <li>Una vez recibido y verificado, procesaremos el reembolso o cambio.</li>
            </ol>
        </section>
    </details>

    <details class="legal-section" id="costos">
        <summary class="legal-section__title">
            5. Costos de devolución
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Si la devolución es por un error nuestro (producto dañado, incorrecto, etc.),
                cubrimos los costos de envío. Si es por decisión del cliente, los gastos de
                envío corren por su cuenta.
            </p>
        </section>
    </details>

    <details class="legal-section" id="reembolsos">
        <summary class="legal-section__title">
            6. Reembolsos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Los reembolsos se procesan en un plazo de <strong>5 a 10 días hábiles</strong>
                a través del mismo método de pago utilizado en la compra.
            </p>
        </section>
    </details>

    <details class="legal-section" id="cambios">
        <summary class="legal-section__title">
            7. Cambios
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Si prefieres cambiar el producto en lugar de un reembolso, indícalo en tu
                solicitud. Los cambios están sujetos a disponibilidad de stock.
            </p>
        </section>
    </details>

    <details class="legal-section" id="contacto">
        <summary class="legal-section__title">
            8. Contacto
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Para cualquier consulta sobre devoluciones, contáctanos en
                <a href="mailto:info@mitienda.com">info@mitienda.com</a> o por WhatsApp al
                +58 412-1234567.
            </p>
        </section>
    </details>

@endsection