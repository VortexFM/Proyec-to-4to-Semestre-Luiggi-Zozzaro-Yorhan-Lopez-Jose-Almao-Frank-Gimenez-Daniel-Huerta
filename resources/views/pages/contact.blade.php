@extends('layouts.app')

@section('title', 'Contacto - Mi Tienda')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">Contáctanos</h1>
            <p class="page-header__subtitle">¿Tienes alguna pregunta? Estamos aquí para ayudarte</p>
        </section>
    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    <section class="section container">
        <section class="contact-layout">

            {{-- FORMULARIO DE CONTACTO --}}
            <article class="contact-form-wrapper">
                <header>
                    <h2 class="contact-form__title">Envíanos un mensaje</h2>
                    <p class="contact-form__subtitle">Responderemos en menos de 24 horas</p>
                </header>

                <form action="#" method="POST" class="contact-form">
                    @csrf

                    <section class="form-group">
                        <label class="form-label" for="nombre">Nombre completo *</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Ej: Juan Pérez" required>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="correo">Correo electrónico *</label>
                        <input type="email" id="correo" name="correo" class="form-input" placeholder="tu@correo.com" required>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="asunto">Asunto *</label>
                        <input type="text" id="asunto" name="asunto" class="form-input" placeholder="¿En qué podemos ayudarte?" required>
                    </section>

                    <section class="form-group">
                        <label class="form-label" for="mensaje">Mensaje *</label>
                        <textarea id="mensaje" name="mensaje" rows="6" class="form-textarea" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </section>

                    <button type="submit" class="btn btn--primary btn--lg btn--block">
                        Enviar mensaje
                    </button>
                </form>
            </article>

            {{-- INFORMACIÓN DE CONTACTO --}}
            <aside class="contact-info">

                {{-- DATOS DE CONTACTO --}}
                <article class="contact-card">
                    <h2 class="contact-card__title">Información de contacto</h2>

                    <ul class="contact-list">
                        <li class="contact-list__item">
                            <span class="contact-list__icon" aria-hidden="true">📧</span>
                            <section>
                                <strong>Correo</strong>
                                <a href="mailto:info@mitienda.com">info@mitienda.com</a>
                            </section>
                        </li>

                        <li class="contact-list__item">
                            <span class="contact-list__icon" aria-hidden="true">📱</span>
                            <section>
                                <strong>Teléfono</strong>
                                <a href="tel:+584121234567">+58 412-1234567</a>
                            </section>
                        </li>

                        <li class="contact-list__item">
                            <span class="contact-list__icon" aria-hidden="true">💬</span>
                            <section>
                                <strong>WhatsApp</strong>
                                <a href="https://wa.me/584121234567" target="_blank" rel="noopener">+58 412-1234567</a>
                            </section>
                        </li>

                        <li class="contact-list__item">
                            <span class="contact-list__icon" aria-hidden="true">📍</span>
                            <section>
                                <strong>Ubicación</strong>
                                <address>Barquisimeto, Estado Lara, Venezuela</address>
                            </section>
                        </li>
                    </ul>
                </article>

                {{-- HORARIO --}}
                <article class="contact-card">
                    <h2 class="contact-card__title">Horario de atención</h2>

                    <ul class="schedule-list">
                        <li class="schedule-list__item">
                            <span>Lunes a Viernes</span>
                            <strong>8:00 AM - 6:00 PM</strong>
                        </li>
                        <li class="schedule-list__item">
                            <span>Sábados</span>
                            <strong>9:00 AM - 2:00 PM</strong>
                        </li>
                        <li class="schedule-list__item">
                            <span>Domingos y feriados</span>
                            <strong>Cerrado</strong>
                        </li>
                    </ul>
                </article>

                {{-- REDES SOCIALES --}}
                <article class="contact-card">
                    <h2 class="contact-card__title">Síguenos</h2>

                    <nav class="social-links" aria-label="Redes sociales">
                        <a href="#" class="social-link" aria-label="Instagram">
                            <span aria-hidden="true">📷</span>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="social-link" aria-label="Facebook">
                            <span aria-hidden="true">👍</span>
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="social-link" aria-label="TikTok">
                            <span aria-hidden="true">🎵</span>
                            <span>TikTok</span>
                        </a>
                    </nav>
                </article>

            </aside>

        </section>
    </section>

@endsection