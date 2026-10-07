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
            @forelse ($categorias as $categoria)
                <a href="{{ url('/categoria/' . $categoria->slug) }}" class="category-card">
                    <span class="category-card__icon" aria-hidden="true">{{ $categoria->icon }}</span>
                    <h3 class="category-card__title">{{ $categoria->name }}</h3>
                    <p class="category-card__count">{{ $categoria->products_count }} productos</p>
                </a>
            @empty
                <p>No hay categorías disponibles.</p>
            @endforelse
        </section>
    </section>

@endsection