@extends('layouts.app')

@section('title', 'Inicio - Mi Tienda')

@section('content')

    {{-- HERO --}}
    <section class="hero">
        <section class="container">
            <h1 class="hero__title">Descubre productos únicos</h1>
            <p class="hero__subtitle">Apoya a emprendedores locales y encuentra tesoros especiales</p>
            <section class="hero__actions">
                <a href="{{ url('/productos') }}" class="btn btn--primary btn--lg">
                    Ver Catálogo
                </a>
                <a href="#categorias" class="btn hero__btn-secondary btn--lg">
                    Explorar Categorías
                </a>
            </section>
        </section>
    </section>

    {{-- CATEGORÍAS --}}
    <section class="section container" id="categorias">
        <header class="section__header">
            <h2 class="section__title">Categorías</h2>
            <a href="{{ url('/categorias') }}" class="section__link">
                Ver todas
                <span aria-hidden="true">→</span>
            </a>
        </header>

        <section class="grid grid--4">
            @foreach ($categorias as $categoria)
                <a href="{{ url('/categoria/' . $categoria->slug) }}" class="category-card">
                    <span class="category-card__icon" aria-hidden="true">{{ $categoria->icon }}</span>
                    <h3 class="category-card__title">{{ $categoria->name }}</h3>
                    <p class="category-card__count">{{ $categoria->products()->count() }} productos</p>
                </a>
            @endforeach
        </section>
    </section>

    {{-- PRODUCTOS DESTACADOS --}}
    <section class="section container">
        <header class="section__header">
            <h2 class="section__title">Productos Destacados</h2>
            <a href="{{ url('/productos') }}" class="section__link">
                Ver todos
                <span aria-hidden="true">→</span>
            </a>
        </header>

        <section class="grid grid--4">
            @foreach ($destacados as $producto)
                <x-product-card
                    :nombre="$producto->name"
                    :descripcion="$producto->description"
                    :precio="$producto->price"
                    :precio-oferta="$producto->price"
                />
            @endforeach
        </section>
    </section>

    {{-- BANNER PROMOCIONAL --}}
    <section class="container">
        <article class="promo-banner">

            <figure class="promo-banner__icon" aria-hidden="true">
                🚚
            </figure>

            <section class="promo-banner__content">
                <h2 class="promo-banner__title">
                    ¡Envío gratis en compras mayores a $50!
                </h2>
                <p class="promo-banner__text">
                    Aprovecha esta oferta por tiempo limitado
                </p>
            </section>

            <a href="{{ url('/productos') }}" class="promo-banner__btn">
                Comprar ahora
            </a>

        </article>
    </section>

    {{-- PRODUCTOS RECIENTES --}}
    <section class="section--alt">
        <section class="container">
            <header class="section__header">
                <h2 class="section__title">Recién Agregados</h2>
                <a href="{{ url('/productos') }}" class="section__link">
                    Ver todos
                    <span aria-hidden="true">→</span>
                </a>
            </header>

            <section class="grid grid--4">
                @foreach ($recientes as $producto)
                    <x-product-card
                        :nombre="$producto->name"
                        :descripcion="$producto->description"
                        :precio="$producto->price"
                        :precio-oferta="$producto->price"
                    />
                @endforeach
            </section>
        </section>
    </section>

@endsection