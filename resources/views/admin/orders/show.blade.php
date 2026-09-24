@extends('layouts.admin')

@section('title', 'Detalle de Pedido - Panel de Administración')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="admin-header">
        <section>
            <h1 class="admin-header__title">Pedido #001</h1>
            <p class="admin-header__subtitle">Detalles completos del pedido</p>
        </section>
        <a href="{{ url('/admin/pedidos') }}" class="btn btn--ghost">
            ← Volver
        </a>
    </header>

    {{-- LAYOUT DE 2 COLUMNAS --}}
    <section class="order-detail-grid">

        {{-- COLUMNA PRINCIPAL --}}
        <section class="order-detail-main">

            {{-- INFORMACIÓN DEL CLIENTE --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Información del Cliente</h2>

                <address class="order-info">
                    <p><strong>Nombre:</strong> Cliente 1</p>
                    <p><strong>Correo:</strong> cliente1@correo.com</p>
                    <p><strong>Teléfono:</strong> 0412-1234567</p>
                    <p><strong>Cédula / RIF:</strong> V-12345678</p>
                    <p><strong>Dirección:</strong> Calle 1, Urbanización Centro, Barquisimeto, Lara</p>
                </address>
            </article>

            {{-- MÉTODO DE PAGO --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Método de Pago</h2>

                <section class="order-info">
                    <p><strong>Método:</strong> Transferencia bancaria</p>
                    <p><strong>Estado del pago:</strong> <span class="badge badge--success">Confirmado</span></p>
                    <p><strong>Fecha de pago:</strong> 22/09/2026</p>
                </section>
            </article>

            {{-- PRODUCTOS DEL PEDIDO --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Productos del Pedido</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 3; $i++)
                            <tr>
                                <td>
                                    <section class="product-cell">
                                        <figure class="product-cell__image">IMG</figure>
                                        <section class="product-cell__info">
                                            <strong>Producto {{ $i }}</strong>
                                            <small>SKU-00{{ $i }}</small>
                                        </section>
                                    </section>
                                </td>
                                <td>1</td>
                                <td>$25.00</td>
                                <td><strong>$25.00</strong></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

                {{-- TOTALES --}}
                <footer class="order-totals">
                    <p class="order-totals__row">
                        <span>Subtotal</span>
                        <span>$75.00</span>
                    </p>
                    <p class="order-totals__row">
                        <span>Envío</span>
                        <span>$5.00</span>
                    </p>
                    <p class="order-totals__row">
                        <span>IVA (16%)</span>
                        <span>$12.80</span>
                    </p>
                    <p class="order-totals__total">
                        <span>Total</span>
                        <span>$92.80</span>
                    </p>
                </footer>
            </article>

            {{-- NOTAS DEL CLIENTE --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Notas del Cliente</h2>
                <p class="form-help">
                    Por favor entregar en la tarde después de las 3 PM. Si no hay nadie, dejar con el conserje.
                </p>
            </article>

        </section>

        {{-- COLUMNA LATERAL --}}
        <aside class="order-detail-sidebar">

            {{-- ESTADO DEL PEDIDO --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Estado del Pedido</h2>

                <form action="#" method="POST">
                    @csrf
                    @method('PUT')

                    <section class="form-group">
                        <label class="form-label" for="estado">Cambiar estado</label>
                        <select id="estado" name="estado" class="form-select">
                            <option>Pendiente</option>
                            <option>Confirmado</option>
                            <option>En preparación</option>
                            <option>Enviado</option>
                            <option selected>Entregado</option>
                            <option>Cancelado</option>
                        </select>
                    </section>

                    <button type="submit" class="btn btn--primary btn--block">
                        Actualizar estado
                    </button>
                </form>
            </article>

            {{-- INFORMACIÓN DEL PEDIDO --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Información del Pedido</h2>

                <section class="order-info">
                    <p><strong>Pedido:</strong> #001</p>
                    <p><strong>Fecha:</strong> 22/09/2026</p>
                    <p><strong>Hora:</strong> 14:35</p>
                    <p><strong>Estado actual:</strong>
                        <span class="order-status order-status--delivered">Entregado</span>
                    </p>
                </section>
            </article>

            {{-- ACCIONES --}}
            <article class="admin-card">
                <h2 class="admin-card__title">Acciones</h2>

                <button type="button" class="btn btn--outline btn--block">
                    🖨️ Imprimir pedido
                </button>

                <button type="button" class="btn btn--danger btn--block" style="margin-top: 0.75rem;">
                    Cancelar pedido
                </button>
            </article>

        </aside>

    </section>

@endsection