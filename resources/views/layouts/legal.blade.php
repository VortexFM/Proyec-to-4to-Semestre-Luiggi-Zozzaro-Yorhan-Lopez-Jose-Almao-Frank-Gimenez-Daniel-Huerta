<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Información Legal - Mi Tienda')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.header')

    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">@yield('page-title')</h1>
            <p class="page-header__subtitle">@yield('page-subtitle')</p>
        </section>
    </header>

    <section class="section container">
        <section class="legal-layout">

            {{-- SIDEBAR DE NAVEGACIÓN LEGAL --}}
            <aside class="legal-sidebar">
                <h2 class="legal-sidebar__title">Información Legal</h2>
                <nav class="legal-sidebar__menu" aria-label="Páginas legales">
                    <a href="{{ url('/terminos') }}" class="{{ request()->is('terminos') ? 'active' : '' }}">
                        📄 Términos y condiciones
                    </a>
                    <a href="{{ url('/privacidad') }}" class="{{ request()->is('privacidad') ? 'active' : '' }}">
                        🔒 Política de privacidad
                    </a>
                    <a href="{{ url('/envios') }}" class="{{ request()->is('envios') ? 'active' : '' }}">
                        🚚 Política de envíos
                    </a>
                    <a href="{{ url('/devoluciones') }}" class="{{ request()->is('devoluciones') ? 'active' : '' }}">
                        ↩️ Política de devoluciones
                    </a>
                </nav>
            </aside>

            {{-- CONTENIDO PRINCIPAL --}}
            <article class="legal-content">
                <p class="legal-content__updated">
                    Última actualización: {{ date('d/m/Y') }}
                </p>
                @yield('content')
            </article>

        </section>
    </section>

    @include('partials.footer')

</body>
</html>