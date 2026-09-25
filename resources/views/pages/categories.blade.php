@extends('layouts.app')

@section('title', 'Categorías - Mi Tienda')

@section('content')

    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">Categorías</h1>
            <p class="page-header__subtitle">Explora nuestros productos por categoría</p>
        </section>
    </header>

    <section class="section container">
        <section class="grid grid--4">

            @php
                $categorias = [
                    ['icon' => '👕', 'name' => 'Ropa', 'count' => 24],
                    ['icon' => '🎨', 'name' => 'Artesanía', 'count' => 18],
                    ['icon' => '🍰', 'name' => 'Alimentos', 'count' => 12],
                    ['icon' => '📚', 'name' => 'Libros', 'count' => 8],
                    ['icon' => '💍', 'name' => 'Accesorios', 'count' => 32],
                    ['icon' => '🧸', 'name' => 'Juguetes', 'count' => 15],
                    ['icon' => '🏺', 'name' => 'Decoración', 'count' => 20],
                    ['icon' => '🌸', 'name' => 'Belleza', 'count' => 10],
                ];
            @endphp

            @foreach ($categorias as $categoria)
                <a href="{{ url('/productos') }}" class="category-card">
                    <span class="category-card__icon" aria-hidden="true">{{ $categoria['icon'] }}</span>
                    <h3 class="category-card__title">{{ $categoria['name'] }}</h3>
                    <p class="category-card__count">{{ $categoria['count'] }} productos</p>
                </a>
            @endforeach

        </section>
    </section>

@endsection