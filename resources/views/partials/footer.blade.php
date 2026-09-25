<footer class="site-footer">
    <section class="site-footer__content container">

        <article>
            <h3 class="site-footer__title">Mi tienda</h3>
            <p class="site-footer__text"> 
                Apoyando emprendedores locales en productos unicos y de calidad
            </p>
        </article>

        <section>
            <nav aria-lable="Enlace del sitio">
                <h4 class="site-footer__subtitle">Enlace</h4>
                <ul class="site-footer__links"> 
                    <li><a href=" {{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/productos')}}">Productos</a></li>
                    <li><a href="{{ url('/contacto') }}">Contacto</a></li>
                    <li><a href="{{ url('/nosotros') }}">Sobre nosotros</a></li>
                </ul>
            </nav>
        </section>

        <section>
            <nav aria-label="Enlaces de ayuda">
                <h4 class="site-footer__subtitle">Ayuda</h4>
                <ul class="site-footer__links">
                    <li><a href="#">Preguntas frecuentes</a></li>
                    <li><a href="#">Envíos</a></li>
                    <li><a href="#">Devoluciones </a></li>
                </ul>
            </nav>
        </section>

        <section>
            <h4 class="site-footer__subtitle">Síguenos</h4>
            <p class="site-footer__text">Instagram · Facebook · WhatsApp</p>
        </section>

    </section>
            <p class="site-footer__button"> @ {{ date('Y')}} Mi tienda. Todos los derechos reservados</p>
</footer>