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
                    ['icon' => '👕', 'name' => 'Ropa',        'slug' => 'ropa',        'count' => 24],
                    ['icon' => '🎨', 'name' => 'Artesanía',   'slug' => 'artesania',   'count' => 18],
                    ['icon' => '🍰', 'name' => 'Alimentos',   'slug' => 'alimentos',   'count' => 12],
                    ['icon' => '📚', 'name' => 'Libros',      'slug' => 'libros',      'count' => 8],
                    ['icon' => '💍', 'name' => 'Accesorios',  'slug' => 'accesorios',  'count' => 32],
                    ['icon' => '🧸', 'name' => 'Juguetes',    'slug' => 'juguetes',    'count' => 15],
                    ['icon' => '🏺', 'name' => 'Decoración',  'slug' => 'decoracion',  'count' => 20],
                    ['icon' => '🌸', 'name' => 'Belleza',     'slug' => 'belleza',     'count' => 10],
                ];
            @endphp

            @foreach ($categorias as $categoria)
                <a href="{{ url('/categoria/' . $categoria['slug']) }}" class="category-card">
                    <span class="category-card__icon" aria-hidden="true">{{ $categoria['icon'] }}</span>
                    <h3 class="category-card__title">{{ $categoria['name'] }}</h3>
                    <p class="category-card__count">{{ $categoria['count'] }} productos</p>
                </a>
            @endforeach

        </section>
    </section>

@endsection