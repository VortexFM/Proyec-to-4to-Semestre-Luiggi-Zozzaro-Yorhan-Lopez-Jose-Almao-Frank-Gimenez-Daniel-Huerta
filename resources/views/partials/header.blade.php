<header class="site-header">
    <nav class="site-header__nav container" aria-label="Navegación principal">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="site-header__logo">Mi Tienda</a>

        {{-- Botón hamburguesa (solo móvil) --}}
        <button type="button" class="site-header__toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
            <span class="site-header__toggle-bar"></span>
            <span class="site-header__toggle-bar"></span>
            <span class="site-header__toggle-bar"></span>
        </button>

        {{-- Menú de navegación (desktop) --}}
        <ul class="site-header__menu">
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/productos') }}">Productos</a></li>
            <li><a href="{{ url('/categorias') }}">Categorías</a></li>
            <li><a href="{{ url('/contacto') }}">Contacto</a></li>
        </ul>

        {{-- Acciones (desktop) --}}
        <section class="site-header__actions">
            {{-- Carrito --}}
            <a href="{{ url('/carrito') }}" class="site-header__cart" aria-label="Ver carrito de compras">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="site-header__cart-badge">0</span>
            </a>

            <a href="{{ url('/login') }}" class="btn btn--ghost">Iniciar Sesión</a>
            <a href="{{ url('/register') }}" class="btn btn--primary">Registrarse</a>
        </section>

    </nav>

    {{-- Menú móvil desplegable --}}
    <aside id="mobile-menu" class="site-header__mobile-menu" aria-hidden="true">
        <nav aria-label="Navegación móvil">
            <ul class="site-header__mobile-list">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('/productos') }}">Productos</a></li>
                <li><a href="{{ url('/categorias') }}">Categorías</a></li>
                <li><a href="{{ url('/contacto') }}">Contacto</a></li>
                <li><a href="{{ url('/nosotros') }}">Sobre nosotros</a></li>
                <li><a href="{{ url('/faq') }}">Preguntas frecuentes</a></li>
            </ul>

            <footer class="site-header__mobile-actions">
                <a href="{{ url('/carrito') }}" class="btn btn--outline btn--block">
                    🛒 Carrito (0)
                </a>
                <a href="{{ url('/login') }}" class="btn btn--ghost btn--block">
                    Iniciar Sesión
                </a>
                <a href="{{ url('/register') }}" class="btn btn--primary btn--block">
                    Registrarse
                </a>
            </footer>
        </nav>
    </aside>
</header>