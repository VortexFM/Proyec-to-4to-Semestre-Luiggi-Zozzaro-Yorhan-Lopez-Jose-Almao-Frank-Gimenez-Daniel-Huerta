@extends('layouts.app')

@section('title', 'Preguntas Frecuentes - Mi Tienda')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">Preguntas Frecuentes</h1>
            <p class="page-header__subtitle">Encuentra respuestas a las dudas más comunes</p>
        </section>
    </header>

    {{-- BUSCADOR --}}
    <section class="section container">
        <search class="faq-search" aria-label="Buscar preguntas">
            <input type="search" class="form-input" placeholder="🔍 Busca una pregunta...">
        </search>
    </section>

    {{-- PREGUNTAS POR CATEGORÍA --}}
    <section class="section container">

        {{-- CATEGORÍA: ENVÍOS --}}
        <article class="faq-category">
            <header class="faq-category__header">
                <span class="faq-category__icon" aria-hidden="true">🚚</span>
                <h2 class="faq-category__title">Envíos</h2>
            </header>

            <section class="faq-list">
                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Cuánto tarda el envío?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Los envíos dentro de Barquisimeto tardan de 1 a 2 días hábiles.
                        Para el resto del país, el tiempo estimado es de 3 a 5 días hábiles
                        dependiendo de la empresa de encomiendas.
                    </p>
                </details>

                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Hacen envíos a todo el país?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Sí, realizamos envíos a todo el territorio nacional a través de
                        empresas de encomiendas como Zoom, MRW y Tealca. El costo del envío
                        se calcula según el destino y el peso del paquete.
                    </p>
                </details>

                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿El envío es gratis?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        El envío es gratis para compras superiores a $50. Para compras menores,
                        el costo del envío se calcula según el destino.
                    </p>
                </details>
            </section>
        </article>

        {{-- CATEGORÍA: PAGOS --}}
        <article class="faq-category">
            <header class="faq-category__header">
                <span class="faq-category__icon" aria-hidden="true">💳</span>
                <h2 class="faq-category__title">Pagos</h2>
            </header>

            <section class="faq-list">
                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Qué métodos de pago aceptan?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Aceptamos transferencia bancaria, pago móvil y efectivo contra entrega
                        (solo para entregas en Barquisimeto).
                    </p>
                </details>

                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Es seguro comprar en línea?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Sí, nuestra plataforma cuenta con protocolos de seguridad para proteger
                        tus datos. Además, verificamos cada pago antes de procesar el envío.
                    </p>
                </details>

                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Puedo pagar en cuotas?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Por ahora no manejamos pagos en cuotas. Todos los pedidos deben pagarse
                        al momento de la compra.
                    </p>
                </details>
            </section>
        </article>

        {{-- CATEGORÍA: DEVOLUCIONES --}}
        <article class="faq-category">
            <header class="faq-category__header">
                <span class="faq-category__icon" aria-hidden="true">↩️</span>
                <h2 class="faq-category__title">Devoluciones</h2>
            </header>

            <section class="faq-list">
                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Cuál es la política de devoluciones?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Aceptamos devoluciones dentro de los primeros 7 días después de recibir
                        el producto, siempre y cuando esté en buen estado y con su empaque original.
                    </p>
                </details>

                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Cómo solicito una devolución?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Escríbenos a info@mitienda.com indicando el número de pedido y el motivo
                        de la devolución. Te responderemos en menos de 24 horas.
                    </p>
                </details>
            </section>
        </article>

        {{-- CATEGORÍA: PRODUCTOS --}}
        <article class="faq-category">
            <header class="faq-category__header">
                <span class="faq-category__icon" aria-hidden="true">📦</span>
                <h2 class="faq-category__title">Productos</h2>
            </header>

            <section class="faq-list">
                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Los productos son hechos en Venezuela?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Sí, todos nuestros productos son elaborados por emprendedores venezolanos.
                        Apoyamos el talento local en cada compra.
                    </p>
                </details>

                <details class="faq-item">
                    <summary class="faq-item__question">
                        ¿Puedo solicitar un producto personalizado?
                        <span class="faq-item__icon" aria-hidden="true">+</span>
                    </summary>
                    <p class="faq-item__answer">
                        Claro, contáctanos por WhatsApp o correo con tu idea y te pondremos
                        en contacto con el emprendedor que pueda hacerla realidad.
                    </p>
                </details>
            </section>
        </article>

    </section>

    {{-- LLAMADO A LA ACCIÓN --}}
    <section class="container">
        <article class="cta-banner">
            <h2 class="cta-banner__title">¿No encuentras lo que buscas?</h2>
            <p class="cta-banner__text">
                Nuestro equipo está listo para ayudarte con cualquier duda
            </p>
            <a href="{{ url('/contacto') }}" class="btn btn--primary btn--lg">
                Contáctanos
            </a>
        </article>
    </section>

@endsection