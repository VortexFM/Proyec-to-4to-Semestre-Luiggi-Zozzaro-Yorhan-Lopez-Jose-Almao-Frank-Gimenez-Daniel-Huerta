@extends('layouts.app')

@section('title', 'Detalle del Producto - Mi Tienda')

@section('content')

    <section class="container section">

        {{-- MIGAS DE PAN --}}
        <nav class="breadcrumb" aria-label="Migas de pan">
            <a href="{{ url('/') }}">Inicio</a>
            <span>/</span>
            <a href="{{ url('/productos') }}">Productos</a>
            <span>/</span>
            <span class="breadcrumb__current">Nombre del Producto</span>
        </nav>

        {{-- DETALLE DEL PRODUCTO --}}
        <section class="product-detail">

            {{-- Galería --}}
            <section class="product-gallery">
                <figure class="product-gallery__main">
                    <span>Imagen principal del producto</span>
                </figure>
                <section class="product-gallery__thumbs">
                    @for ($i = 1; $i <= 4; $i++)
                        <figure class="product-gallery__thumb">
                            <span>Mini {{ $i }}</span>
                        </figure>
                    @endfor
                </section>
            </section>

            {{-- Información --}}
            <section class="product-info">
                <span class="badge badge--primary">Categoría</span>

                <h1 class="product-info__title">Nombre del Producto</h1>

                {{-- Calificación --}}
                <section class="product-info__rating">
                    <span>⭐⭐⭐⭐⭐</span>
                    <span class="product-info__reviews">(24 reseñas)</span>
                </section>

                {{-- Precio --}}
                <section class="product-info__price">
                    $25.00
                    <span class="product-info__price-old">$35.00</span>
                </section>

                {{-- Descripción --}}
                <p class="product-info__description">
                    Esta es la descripción detallada del producto. Aquí se explica qué es, para qué sirve,
                    sus características principales, materiales, dimensiones, etc. Es importante que el cliente
                    tenga toda la información necesaria para tomar una decisión de compra.
                </p>

                {{-- Stock --}}
                <section class="product-info__stock">
                    <span class="stock-indicator stock-indicator--available"></span>
                    Disponible (15 unidades)
                </section>

                {{-- Cantidad y agregar al carrito --}}
                <section class="product-info__actions">
                    <section class="quantity-selector">
                        <button type="button">−</button>
                        <input type="number" value="1" min="1">
                        <button type="button">+</button>
                    </section>

                    <button class="btn btn--primary btn--lg">
                        🛒 Agregar al Carrito
                    </button>
                </section>

                {{-- Información adicional --}}
                <ul class="product-info__extras">
                    <li>🚚 Envío a todo el país</li>
                    <li>🔒 Pago 100% seguro</li>
                    <li>↩️ Devolución en 7 días</li>
                </ul>
            </section>

        </section>

        {{-- PRODUCTOS RELACIONADOS --}}
        <section class="section">
            <h2 class="section__title">Productos Relacionados</h2>
            <section class="grid grid--4">
                @for ($i = 1; $i <= 4; $i++)
                    <x-product-card
                        :nombre="'Producto Relacionado ' . $i"
                        :descripcion="'Descripción breve'"
                        :precio="20.00 + $i"
                    />
                @endfor
            </section>
        </section>

    </section>

@endsection