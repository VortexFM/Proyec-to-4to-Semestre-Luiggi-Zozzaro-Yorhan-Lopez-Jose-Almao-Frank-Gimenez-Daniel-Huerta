<footer class="site-footer">
    <section class="site-footer__content container">

        {{-- COLUMNA 1: MARCA + NEWSLETTER --}}
        <article>
            <h3 class="site-footer__title">Mi Tienda</h3>
            <p class="site-footer__text">
                Apoyando emprendedores locales con productos únicos y de calidad.
            </p>

            <form class="site-footer__newsletter" aria-label="Suscribirse al boletín">
                <label for="newsletter-email" class="site-footer__newsletter-label">
                    Suscríbete a nuestro boletín
                </label>
                <input
                    type="email"
                    id="newsletter-email"
                    class="site-footer__newsletter-input"
                    placeholder="tu@correo.com"
                    required
                >
                <button type="submit" class="site-footer__newsletter-button">
                    Suscribirse
                </button>
                <small class="site-footer__newsletter-hint">
                    Recibe ofertas exclusivas y novedades
                </small>
            </form>
        </article>

        {{-- COLUMNA 2: ENLACES --}}
        <nav aria-label="Enlaces del sitio">
            <h4 class="site-footer__subtitle">Enlaces</h4>
            <ul class="site-footer__links">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('/productos') }}">Productos</a></li>
                <li><a href="{{ url('/categorias') }}">Categorías</a></li>
                <li><a href="{{ url('/nosotros') }}">Sobre nosotros</a></li>
                <li><a href="{{ url('/contacto') }}">Contacto</a></li>
            </ul>
        </nav>

        {{-- COLUMNA 3: AYUDA --}}
        <nav aria-label="Enlaces de ayuda">
            <h4 class="site-footer__subtitle">Ayuda</h4>
            <ul class="site-footer__links">
                <li><a href="{{ url('/faq') }}">Preguntas frecuentes</a></li>
                <li><a href="{{ url('/envios') }}">Envíos</a></li>
                <li><a href="{{ url('/devoluciones') }}">Devoluciones</a></li>
                <li><a href="{{ url('/terminos') }}">Términos y condiciones</a></li>
                <li><a href="{{ url('/privacidad') }}">Política de privacidad</a></li>
            </ul>
        </nav>

        {{-- COLUMNA 4: REDES SOCIALES --}}
        <article>
            <h4 class="site-footer__subtitle">Síguenos</h4>
            <p class="site-footer__text">
                Conéctate con nosotros en redes sociales.
            </p>

            <nav class="site-footer__socials" aria-label="Redes sociales">
                {{-- Instagram --}}
                <a
                    href="https://instagram.com/tu-cuenta"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="site-footer__social"
                    aria-label="Instagram"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>

                {{-- Facebook --}}
                <a
                    href="https://facebook.com/tu-cuenta"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="site-footer__social"
                    aria-label="Facebook"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>

                {{-- WhatsApp --}}
                <a
                    href="https://wa.me/584121234567"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="site-footer__social"
                    aria-label="WhatsApp"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                    </svg>
                </a>

                {{-- TikTok --}}
                <a
                    href="https://tiktok.com/@tu-cuenta"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="site-footer__social"
                    aria-label="TikTok"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                    </svg>
                </a>
            </nav>
        </article>

    </section>

    <p class="site-footer__bottom">© {{ date('Y') }} Mi Tienda. Todos los derechos reservados.</p>
</footer>