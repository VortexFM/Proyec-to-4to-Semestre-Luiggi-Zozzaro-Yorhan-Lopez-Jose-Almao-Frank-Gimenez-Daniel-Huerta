@extends('layouts.app')

@section('title', 'Página no encontrada - Mi Tienda')

@section('content')

    <section class="section container">
        <article class="error-page" aria-labelledby="error-title">

            {{-- ÍCONO DECORATIVO --}}
            <figure class="error-page__icon" aria-hidden="true">
                <span>404</span>
            </figure>

            {{-- MENSAJE --}}
            <header class="error-page__header">
                <h1 id="error-title" class="error-page__title">Página no encontrada</h1>
                <p class="error-page__subtitle">
                    Lo sentimos, la página que estás buscando no existe o fue movida.
                    Verifica la dirección o regresa al inicio.
                </p>
            </header>

            {{-- ACCIONES --}}
            <nav class="error-page__actions" aria-label="Acciones de navegación">
                <a href="{{ url('/') }}" class="btn btn--primary btn--lg">
                    ← Volver al inicio
                </a>
                <a href="{{ url('/productos') }}" class="btn btn--outline btn--lg">
                    Ver productos
                </a>
            </nav>

        </article>
    </section>

@endsection