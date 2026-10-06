@extends('layouts.app')

@section('title', $producto->name . ' - Mi Tienda')

@section('content')

    <section class="section container">

        {{-- MIGAS DE PAN --}}
        <nav class="breadcrumb" aria-label="Migas de pan">
            <a href="{{ url('/') }}">Inicio</a>
            <span>/</span>
            <a href="{{ url('/productos') }}">Productos</a>
            <span>/</span>
            <a href="{{ url('/categoria/' . $producto->category->slug) }}">{{ $producto->category->name }}</a>
            <span>/</span>
            <span class="breadcrumb__current">{{ $producto->name }}</span>
        </nav>

        {{-- DETALLE DEL PRODUCTO --}}
        <section class="product-detail">

            {{-- Galería --}}
            <section class="product-gallery">
                <figure class="product-gallery__main">
                    <span>Imagen del producto</span>
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
                <span class="badge badge--primary">{{ $producto->category->name }}</span>

                <h1 class="product-info__title">{{ $producto->name }}</h1>

                {{-- Calificación --}}
                <section class="product-info__rating">
                    <span>⭐⭐⭐⭐⭐</span>
                    <span class="product-info__reviews">({{ $producto->reviews->count() }} reseñas)</span>
                </section>

                {{-- Precio --}}
                <section class="product-info__price">
                        @if ($producto->sale_price)
                        {{-- Hay oferta: mostrar precio de oferta + precio original tachado --}}
                            ${{ number_format($producto->sale_price, 2) }}
                            <span class="product-info__price-old">${{ number_format($producto->price, 2) }}</span>
                        @else
                        {{-- Sin oferta: mostrar solo el precio normal --}}
                            ${{ number_format($producto->price, 2) }}
                        @endif
                </section>

                {{-- Descripción --}}
                <p class="product-info__description">{{ $producto->description }}</p>

                {{-- Stock --}}
                <section class="product-info__stock">
                    <span class="stock-indicator stock-indicator--available"></span>
                    Disponible ({{ $producto->stock }} unidades)
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
                @forelse ($relacionados as $relacionado)
                    <x-product-card
                        :nombre="$relacionado->name"
                        :descripcion="$relacionado->description"
                        :precio="$relacionado->price"
                        :precio-oferta="$producto->price"
                    />
                @empty
                    <p>No hay productos relacionados.</p>
                @endforelse
            </section>
        </section>

    </section>

@endsection