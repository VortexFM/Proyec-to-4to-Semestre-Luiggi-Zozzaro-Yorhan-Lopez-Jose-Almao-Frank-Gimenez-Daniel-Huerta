@extends('layouts.legal')

@section('title', 'Política de Privacidad - Mi Tienda')
@section('page-title', 'Política de Privacidad')
@section('page-subtitle', 'Cómo protegemos y usamos tu información')

@section('index')
    <li><a href="#recopilamos">Información que recopilamos</a></li>
    <li><a href="#uso">Uso de la información</a></li>
    <li><a href="#proteccion">Protección de datos</a></li>
    <li><a href="#terceros">Compartir con terceros</a></li>
    <li><a href="#cookies">Cookies</a></li>
    <li><a href="#derechos">Tus derechos</a></li>
    <li><a href="#contacto">Contacto</a></li>
@endsection

@section('content')

    <details class="legal-section" id="recopilamos" open>
        <summary class="legal-section__title">
            1. Información que recopilamos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>En <strong>Mi Tienda</strong> recopilamos la siguiente información personal cuando realizas una compra o te registras:</p>
            <ul>
                <li>Nombre completo.</li>
                <li>Correo electrónico.</li>
                <li>Teléfono de contacto.</li>
                <li>Dirección de envío.</li>
                <li>Cédula o RIF.</li>
            </ul>
        </section>
    </details>

    <details class="legal-section" id="uso">
        <summary class="legal-section__title">
            2. Uso de la información
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>Utilizamos tu información personal para:</p>
            <ul>
                <li>Procesar y enviar tus pedidos.</li>
                <li>Comunicarnos contigo sobre el estado de tu compra.</li>
                <li>Enviar promociones y ofertas (solo si aceptas recibirlas).</li>
                <li>Mejorar nuestros servicios y la experiencia de compra.</li>
            </ul>
        </section>
    </details>

    <details class="legal-section" id="proteccion">
        <summary class="legal-section__title">
            3. Protección de datos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Implementamos medidas de seguridad técnicas y organizativas para proteger tu
                información personal contra accesos no autorizados, pérdida o alteración.
                Tus datos se almacenan en servidores seguros.
            </p>
            <blockquote class="legal-blockquote">
                🔒 <strong>Compromiso:</strong> Nunca compartiremos tu información sin tu consentimiento.
            </blockquote>
        </section>
    </details>

    <details class="legal-section" id="terceros">
        <summary class="legal-section__title">
            4. Compartir información con terceros
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>No vendemos ni alquilamos tu información personal a terceros. Solo compartimos datos con:</p>
            <ul>
                <li>Empresas de encomiendas (para realizar el envío).</li>
                <li>Proveedores de servicios de pago (para procesar transacciones).</li>
                <li>Autoridades legales, si es requerido por ley.</li>
            </ul>
        </section>
    </details>

    <details class="legal-section" id="cookies">
        <summary class="legal-section__title">
            5. Cookies
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Utilizamos cookies para mejorar tu experiencia en el sitio. Las cookies nos permiten
                recordar tus preferencias y analizar el tráfico del sitio. Puedes desactivar las
                cookies en la configuración de tu navegador.
            </p>
        </section>
    </details>

    <details class="legal-section" id="derechos">
        <summary class="legal-section__title">
            6. Tus derechos
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>Tienes derecho a:</p>
            <ul>
                <li>Acceder a la información que tenemos sobre ti.</li>
                <li>Solicitar la corrección de datos inexactos.</li>
                <li>Solicitar la eliminación de tus datos.</li>
                <li>Oponerte al uso de tus datos para fines de marketing.</li>
            </ul>
        </section>
    </details>

    <details class="legal-section" id="contacto">
        <summary class="legal-section__title">
            7. Contacto
            <span class="legal-section__icon" aria-hidden="true">+</span>
        </summary>
        <section class="legal-section__content">
            <p>
                Si tienes preguntas sobre nuestra política de privacidad, contáctanos en
                <a href="mailto:info@mitienda.com">info@mitienda.com</a>.
            </p>
        </section>
    </details>

@endsection