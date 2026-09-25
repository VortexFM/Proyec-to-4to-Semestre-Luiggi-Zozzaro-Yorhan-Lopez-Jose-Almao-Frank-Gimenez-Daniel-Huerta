<header>
    <nav class="site-header__nav container" aria-label="Navegacion principal">
        {{--- logo ---}}
        <a href="{{url('/')}}" class="site-header__logo">
            Mi tienda
        </a>

        {{--- Menu de navegacion ---}}
        <ul class="site-header__menu">
            <li><a href="{{ url('/')}}">Inicio</a></li>
            <li><a href="{{ url('/productos')}}">Productos</a></li>
            <li><a href="{{ url('/categorias') }}">Categorías</a></li>
            <li><a href="{{ url('/contacto') }}">Contacto</a></li>
        </ul>

        {{-- Acciones --}}
        <section class="site-header__actions">
            {{--- carrito ---}}
            <a href="{{ url('/carrito')}}" class="site-header__cart" aria-label="Carrito">
                <svg xmlns="https://www.w3.org/2000/svg" width="24"  height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h21.l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="size-header__cart-badge">0</span>
            </a>

            {{--- Login / Registro ---}}
            <a href="{{ url('/login')}}" class="btn btn--ghost">Iniciar Session</a>
                <a href="{{ url('/register')}}" class="btn btn--primary">
                    Registrarse

                </a>
        </section>
    </nav>
</header>