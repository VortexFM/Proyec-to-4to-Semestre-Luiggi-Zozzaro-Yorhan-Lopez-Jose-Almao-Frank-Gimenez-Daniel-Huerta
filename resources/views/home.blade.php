@extends('layouts.app')

@section('Title', 'Inicio - Mi Tienda')

@section('content')

{{-- hero --}}
<section class="hero"> 
    <section class="container">
        <h1 class="hero__title"> Descubre productos unicos</h1>
        <p class="hero__subtitle">Apoya a emprendedores locales y encuentra tesoros especiales</p>
        <section class="hero__actions">
            <a href=" {{ url('/productos')}}" class="btn-btn--primary btn--lg">
                    Ver Catálogo
            </a>
            <a href="#categoria" class="btn btn--primary btn--lg">
                Explorar Categorias
            </a>
        </section>
    </section>
</section>

{{-- Categoria --}}

<section class="section container" id="categorias">
    <section class="section__header">
        <h2 class="section__title">Categoria</h2>
                <a href="#" class="section__link">
                    Ver todas
                    <span> n </span>
                </a>
            </section>
            <section class="grid grid--4">
                @php
                    $categorias = [
                        ['icon' => '', 'name' => 'Ropa'],
                        ['icon' => '', 'name' => 'Artesania'],
                        ['icon' => '', 'name' => 'Alimentos'],
                        ['icon' => '', 'name' => 'Libro'],
                    ];
                @endphp

                @foreach($categorias as $cat)
                    <a href="#" class="category-card__icon">
                        <span class="category-card__icon">{{ $cat['icon'] }}</span>
                        <h3 class="category-card__title">{{ $cat['name']}}</h3>
                    </a>
                @endforeach
            </section>
    </section>

{{-- Productos Destacados --}}
    <section class="section container">
        <section class="section__header">
            <h2 class="section__title">Productos Destacados</h2>
                <a href="{{ url('/productos')}}" class="section__link">
                    Ver todos 
                    <span>n</span>
                </a>
        </section>
        <section class="grid grid--4"> 
            @for ($i = 1; $i <= 8; $i++)
                <x-product-card
                    :nombre="'Producto' .$i"
                    :descripcion="'Descripcion brebe del producto'" 
                    :precio="25.00"
                />
            @endfor
        </section>
    </section>



    {{-- banner pormocional--}}

    <section class="container">
        <section class="promo-banner">
            <h2 class="promo-banner__title">¡Envio gratis en compras mayores a $50!</h2>
            <p class="promo-banner__text">Aprovecha esta oferta por tiempo limitado</p>
            <a href="{{ url("/productos") }}" class="promo-banner__btn">Comprar ahora</a>
        </section>
    </section>

    {{-- Productos recientes --}}

    <section class="section--alt">
        <section class="container">
            <section class="section__header">
                <h2 class="section__title">Recien agrupados</h2>
                <a href=" {{ url('/productos')}}", class="section__link">
                    Ver todos
                    <span>n</span>
                </a>
            </section>
            <section class="grid grid--4"> 
                @for ($i = 5; $i <= 8; $i++)
                    <x-product-card
                        :nombre="'Producto ' . $i"
                        :descripcion="'Descripcion breve del producto'"
                        :precio="15.00 + $i"
                    />
                @endfor
            </section>
        </section>
    </section>
@endsection

