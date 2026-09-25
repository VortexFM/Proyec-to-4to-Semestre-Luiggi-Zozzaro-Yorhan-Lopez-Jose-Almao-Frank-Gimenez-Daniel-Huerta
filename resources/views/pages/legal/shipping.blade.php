@extends('layouts.legal')

@section('title', 'Política de Envíos - Mi Tienda')
@section('page-title', 'Política de Envíos')
@section('page-subtitle', 'Información sobre nuestros métodos y tiempos de envío')

@section('index')
    <li><a href="#zonas">Zonas de envío</a></li>
    <li><a href="#tiempos">Tiempos de entrega</a></li>
    <li><a href="#costos">Costos de envío</a></li>
    <li><a href="#seguimiento">Seguimiento de envío</a></li>
    <li><a href="#empaque">Empaque</a></li>
    <li><a href="#problemas">Problemas con el envío</a></li>
@endsection

@section('content')

    <details class="legal-section" id="zonas" open>
        <summary class="legal-section__title">
            1. Zonas de envío
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Realizamos envíos a todo el territorio nacional a través de empresas de encomiendas
                como Zoom, MRW y Tealca. También ofrecemos entrega personal en Barquisimeto.
            </p>
        </section>
    </details>

    <details class="legal-section" id="tiempos">
        <summary class="legal-section__title">
            2. Tiempos de entrega
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <ul>
                <li><strong>Barquisimeto:</strong> 1 a 2 días hábiles.</li>
                <li><strong>Principales ciudades (Caracas, Maracaibo, Valencia):</strong> 2 a 3 días hábiles.</li>
                <li><strong>Resto del país:</strong> 3 a 5 días hábiles.</li>
            </ul>
            <p>Los tiempos pueden variar en temporadas altas o por causas externas ajenas a nuestra operación.</p>
        </section>
    </details>

    <details class="legal-section" id="costos">
        <summary class="legal-section__title">
            3. Costos de envío
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                El costo del envío se calcula según el destino y el peso del paquete. El monto
                se muestra al finalizar la compra antes de confirmar el pedido.
            </p>
            <blockquote class="legal-blockquote">
                🎉 <strong>¡Envío gratis en compras superiores a $50!</strong>
            </blockquote>
        </section>
    </details>

    <details class="legal-section" id="seguimiento">
        <summary class="legal-section__title">
            4. Seguimiento de envío
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Una vez que tu pedido sea despachado, recibirás un correo con el número de guía
                para que puedas hacer seguimiento a través de la empresa de encomiendas.
            </p>
        </section>
    </details>

    <details class="legal-section" id="empaque">
        <summary class="legal-section__title">
            5. Empaque
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Todos nuestros productos se empacan cuidadosamente para garantizar que lleguen
                en perfecto estado. Usamos materiales reciclables siempre que sea posible.
            </p>
        </section>
    </details>

    <details class="legal-section" id="problemas">
        <summary class="legal-section__title">
            6. Problemas con el envío
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Si tu pedido no llega en el tiempo estimado o llega dañado, contáctanos de inmediato
                a <a href="mailto:info@mitienda.com">info@mitienda.com</a> y te ayudaremos a resolverlo.
            </p>
        </section>
    </details>

@endsection