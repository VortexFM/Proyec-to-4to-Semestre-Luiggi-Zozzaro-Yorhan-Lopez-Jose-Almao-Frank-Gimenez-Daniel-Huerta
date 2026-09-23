@extends('layouts.app')

@section('title', 'Mi Perfil - Mi Tienda')

@section('content')

    <section class="page-header">
        <section class="container">
            <h1 class="page-header__title">Mi Perfil</h1>
            <p class="page-header__subtitle">Gestiona tu información personal y pedidos</p>
        </section>
    </section>

    <section class="section container">
        <section class="profile-layout">

            {{-- SIDEBAR --}}
            <aside class="sidebar">
                <h2 class="sidebar__title">Mi Cuenta</h2>
                <nav class="sidebar__menu">
                    <a href="#" class="active">
                        <span>👤</span> Mi perfil
                    </a>
                    <a href="#">
                        <span>📦</span> Mis pedidos
                    </a>
                    <a href="#">
                        <span>📍</span> Mis direcciones
                    </a>
                    <a href="#">
                        <span>❤️</span> Mis favoritos
                    </a>
                    <a href="#">
                        <span>🚪</span> Cerrar sesión
                    </a>
                </nav>
            </aside>

            {{-- CONTENIDO PRINCIPAL --}}
            <section class="profile-content">

                {{-- CABECERA DEL PERFIL --}}
                <section class="profile-header">
                    <section class="profile-avatar">JP</section>
                    <section>
                        <h2 class="profile-name">Juan Pérez</h2>
                        <p class="profile-email">juan@correo.com</p>
                    </section>
                </section>

                {{-- FORMULARIO DE DATOS --}}
                <h3 class="profile-section-title">Datos personales</h3>
                <form action="#" method="POST">
                    @csrf

                    <section class="form-grid">
                        <section class="form-group">
                            <label class="form-label" for="nombre">Nombre completo</label>
                            <input type="text" id="nombre" class="form-input" value="Juan Pérez">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="correo">Correo electrónico</label>
                            <input type="email" id="correo" class="form-input" value="juan@correo.com">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" class="form-input" value="0412-1234567">
                        </section>

                        <section class="form-group">
                            <label class="form-label" for="cedula">Cédula / RIF</label>
                            <input type="text" id="cedula" class="form-input" value="V-12345678">
                        </section>

                        <section class="form-group form-group--full">
                            <label class="form-label" for="direccion">Dirección</label>
                            <input type="text" id="direccion" class="form-input" value="Calle 1, Urbanización Centro, Barquisimeto">
                        </section>
                    </section>

                    <button type="submit" class="btn btn--primary">
                        Guardar cambios
                    </button>
                </form>

                {{-- HISTORIAL DE PEDIDOS --}}
                <h3 class="profile-section-title" style="margin-top: 3rem;">Historial de pedidos</h3>

                <section class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 3; $i++)
                                <tr>
                                    <td><strong>#00{{ $i }}</strong></td>
                                    <td>22/09/2026</td>
                                    <td>$25.00</td>
                                    <td>
                                        <span class="order-status order-status--delivered">
                                            Entregado
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn--ghost btn--sm">Ver</a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </section>

            </section>

        </section>
    </section>

@endsection