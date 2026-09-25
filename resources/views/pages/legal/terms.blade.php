@extends('layouts.legal')

@section('title', 'Términos y Condiciones - Mi Tienda')
@section('page-title', 'Términos y Condiciones')
@section('page-subtitle', 'Condiciones de uso de nuestra tienda')

@section('index')
    <li><a href="#aceptacion">Aceptación de los términos</a></li>
    <li><a href="#uso">Uso del sitio</a></li>
    <li><a href="#productos">Productos y precios</a></li>
    <li><a href="#pedidos">Pedidos y pagos</a></li>
    <li><a href="#envios">Envíos</a></li>
    <li><a href="#devoluciones">Devoluciones</a></li>
    <li><a href="#propiedad">Propiedad intelectual</a></li>
    <li><a href="#modificaciones">Modificaciones</a></li>
    <li><a href="#contacto">Contacto</a></li>
@endsection

@section('content')

    <details class="legal-section" id="aceptacion" open>
        <summary class="legal-section__title">
            1. Aceptación de los términos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Al acceder y utilizar el sitio web de <strong>Mi Tienda</strong>, aceptas cumplir con
                los siguientes términos y condiciones. Si no estás de acuerdo con alguna parte de estos
                términos, te pedimos que no utilices nuestros servicios.
            </p>
            <blockquote class="legal-blockquote">
                💡 <strong>Importante:</strong> El uso continuado del sitio implica la aceptación
                automática de estos términos.
            </blockquote>
        </section>
    </details>

    <details class="legal-section" id="uso">
        <summary class="legal-section__title">
            2. Uso del sitio
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>El uso de este sitio está permitido únicamente para fines legales. No puedes utilizar la plataforma para:</p>
            <ul>
                <li>Realizar actividades fraudulentas o ilegales.</li>
                <li>Publicar contenido ofensivo, difamatorio o inapropiado.</li>
                <li>Interferir con el funcionamiento del sitio.</li>
            </ul>
        </section>
    </details>

    <details class="legal-section" id="productos">
        <summary class="legal-section__title">
            3. Productos y precios
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Los precios de los productos están expresados en dólares (USD) y pueden variar sin
                previo aviso. Nos reservamos el derecho de modificar o discontinuar productos en
                cualquier momento.
            </p>
        </section>
    </details>

    <details class="legal-section" id="pedidos">
        <summary class="legal-section__title">
            4. Pedidos y pagos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Al realizar un pedido, el cliente se compromete a pagar el monto total indicado.
                Aceptamos transferencia bancaria, pago móvil y efectivo contra entrega (solo en
                Barquisimeto).
            </p>
        </section>
    </details>

    <details class="legal-section" id="envios">
        <summary class="legal-section__title">
            5. Envíos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Los envíos se realizan a través de empresas de encomiendas. Los tiempos de entrega
                pueden variar según el destino. No nos hacemos responsables por retrasos ocasionados
                por las empresas de encomiendas.
            </p>
        </section>
    </details>

    <details class="legal-section" id="devoluciones">
        <summary class="legal-section__title">
            6. Devoluciones
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Aceptamos devoluciones dentro de los primeros 7 días después de recibir el producto,
                siempre y cuando esté en buen estado y con su empaque original. Los gastos de envío
                de la devolución corren por cuenta del cliente.
            </p>
            <blockquote class="legal-blockquote">
                ⚠️ <strong>Recuerda:</strong> Las devoluciones deben solicitarse por correo
                electrónico con el número de pedido.
            </blockquote>
        </section>
    </details>

    <details class="legal-section" id="propiedad">
        <summary class="legal-section__title">
            7. Propiedad intelectual
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Todo el contenido de este sitio (textos, imágenes, logos) es propiedad de
                <strong>Mi Tienda</strong> y está protegido por las leyes de propiedad intelectual.
                No está permitido su uso sin autorización previa.
            </p>
        </section>
    </details>

    <details class="legal-section" id="modificaciones">
        <summary class="legal-section__title">
            8. Modificaciones
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Nos reservamos el derecho de modificar estos términos en cualquier momento. Las
                modificaciones entrarán en vigor una vez publicadas en el sitio.
            </p>
        </section>
    </details>

    <details class="legal-section" id="contacto">
        <summary class="legal-section__title">
            9. Contacto
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Si tienes preguntas sobre estos términos, puedes contactarnos en
                <a href="mailto:info@mitienda.com">info@mitienda.com</a>.
            </p>
        </section>
    </details>

@endsection