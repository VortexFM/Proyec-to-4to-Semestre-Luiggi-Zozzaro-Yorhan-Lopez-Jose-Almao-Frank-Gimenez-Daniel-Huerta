<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración - Mi Tienda')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.header')

    <section class="admin-layout">
        <section class="container admin-layout__container">

            {{-- SIDEBAR DE ADMIN (solo desktop) --}}
            <aside class="admin-sidebar admin-sidebar--desktop">
                <h2 class="admin-sidebar__title">Administración</h2>
                <nav class="admin-sidebar__menu">
                    <a href="{{ url('/admin') }}" class="{{ request()->is('admin') ? 'active' : '' }}">
                        <span>📊</span> Dashboard
                    </a>
                    <a href="{{ url('/admin/productos') }}" class="{{ request()->is('admin/productos*') ? 'active' : '' }}">
                        <span>📦</span> Productos
                    </a>
                    <a href="{{ url('/admin/pedidos') }}" class="{{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                        <span>🛒</span> Pedidos
                    </a>
                    <a href="{{ url('/admin/clientes') }}" class="{{ request()->is('admin/clientes*') ? 'active' : '' }}">
                        <span>👥</span> Clientes
                    </a>
                    <a href="{{ url('/admin/reportes') }}" class="{{ request()->is('admin/reportes*') ? 'active' : '' }}">
                        <span>📈</span> Reportes
                    </a>
                </nav>
            </aside>

            {{-- CONTENIDO PRINCIPAL --}}
            <main class="admin-content">

                {{-- Menú de admin colapsable (solo móvil) --}}
                <details class="admin-sidebar admin-sidebar--mobile">
                    <summary class="admin-sidebar__toggle">
                        <span>⚙️ Panel de Administración</span>
                        <span class="admin-sidebar__arrow" aria-hidden="true">▼</span>
                    </summary>
                    <nav class="admin-sidebar__menu">
                        <a href="{{ url('/admin') }}" class="{{ request()->is('admin') ? 'active' : '' }}">
                            <span>📊</span> Dashboard
                        </a>
                        <a href="{{ url('/admin/productos') }}" class="{{ request()->is('admin/productos*') ? 'active' : '' }}">
                            <span>📦</span> Productos
                        </a>
                        <a href="{{ url('/admin/pedidos') }}" class="{{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                            <span>🛒</span> Pedidos
                        </a>
                        <a href="{{ url('/admin/clientes') }}" class="{{ request()->is('admin/clientes*') ? 'active' : '' }}">
                            <span>👥</span> Clientes
                        </a>
                        <a href="{{ url('/admin/reportes') }}" class="{{ request()->is('admin/reportes*') ? 'active' : '' }}">
                            <span>📈</span> Reportes
                        </a>
                    </nav>
                </details>

                @yield('content')
            </main>

        </section>
    </section>

    @include('partials.footer')

</body>
</html>