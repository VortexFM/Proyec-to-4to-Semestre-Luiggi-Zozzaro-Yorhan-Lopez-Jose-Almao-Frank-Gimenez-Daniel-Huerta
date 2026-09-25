@extends('layouts.app')

@section('title', 'Sobre Nosotros - Mi Tienda')

@section('content')

    {{-- ENCABEZADO --}}
    <header class="page-header">
        <section class="container">
            <h1 class="page-header__title">Sobre Nosotros</h1>
            <p class="page-header__subtitle">Conoce la historia detrás de Mi Tienda</p>
        </section>
    </header>

    {{-- NUESTRA HISTORIA --}}
    <section class="section container">
        <section class="about-story">
            <figure class="about-story__image">
                <span>Imagen del emprendimiento</span>
            </figure>

            <article class="about-story__content">
                <h2 class="about-story__title">Nuestra Historia</h2>
                <p class="about-story__text">
                    Mi Tienda nació en Barquisimeto, estado Lara, con la idea de crear un espacio donde
                    los emprendedores locales pudieran mostrar sus productos y conectar con clientes
                    que valoran lo hecho en casa.
                </p>
                <p class="about-story__text">
                    Comenzamos organizando pequeños eventos y ferias, y hoy nos hemos convertido en
                    un referente de la cultura emprendedora en la región. Cada producto que vendemos
                    tiene una historia detrás: la historia de alguien que decidió apostar por su sueño.
                </p>
                <p class="about-story__text">
                    Nuestro compromiso es seguir apoyando a los emprendedores venezolanos, ofreciendo
                    productos de calidad y una experiencia de compra única.
                </p>
            </article>
        </section>
    </section>

    {{-- MISIÓN, VISIÓN Y VALORES --}}
    <section class="section--alt">
        <section class="container">
            <header class="section__header section__header--center">
                <h2 class="section__title">Misión, Visión y Valores</h2>
                <p class="section__subtitle">Los pilares que guían nuestro trabajo</p>
            </header>

            <section class="grid grid--3">

                <article class="about-card">
                    <figure class="about-card__icon" aria-hidden="true">🎯</figure>
                    <h3 class="about-card__title">Misión</h3>
                    <p class="about-card__text">
                        Apoyar a emprendedores locales ofreciendo una plataforma donde puedan
                        mostrar y vender sus productos, conectando con clientes que valoran
                        lo artesanal y lo hecho en Venezuela.
                    </p>
                </article>

                <article class="about-card">
                    <figure class="about-card__icon" aria-hidden="true">🚀</figure>
                    <h3 class="about-card__title">Visión</h3>
                    <p class="about-card__text">
                        Ser la tienda virtual de referencia para emprendedores de la región
                        centro-occidental de Venezuela, expandiendo nuestra operación a nivel
                        nacional para el año 2028.
                    </p>
                </article>

                <article class="about-card">
                    <figure class="about-card__icon" aria-hidden="true">💎</figure>
                    <h3 class="about-card__title">Valores</h3>
                    <p class="about-card__text">
                        Compromiso con la calidad, apoyo incondicional al emprendimiento local,
                        transparencia en cada transacción y pasión por lo que hacemos.
                    </p>
                </article>

            </section>
        </section>
    </section>

    {{-- NUESTRO EQUIPO --}}
    <section class="section container">
        <header class="section__header section__header--center">
            <h2 class="section__title">Nuestro Equipo</h2>
            <p class="section__subtitle">Las personas detrás de Mi Tienda</p>
        </header>

        <section class="grid grid--4">

            @php
                $equipo = [
                    ['nombre' => 'Juan Pérez', 'cargo' => 'Fundador & CEO'],
                    ['nombre' => 'María Gómez', 'cargo' => 'Gerente de Operaciones'],
                    ['nombre' => 'Carlos Ruiz', 'cargo' => 'Diseñador Gráfico'],
                    ['nombre' => 'Ana López', 'cargo' => 'Atención al Cliente'],
                ];
            @endphp

            @foreach ($equipo as $miembro)
                <article class="team-card">
                    <figure class="team-card__avatar" aria-hidden="true">
                        {{ strtoupper(substr($miembro['nombre'], 0, 1)) }}{{ strtoupper(substr(explode(' ', $miembro['nombre'])[1], 0, 1)) }}
                    </figure>
                    <h3 class="team-card__name">{{ $miembro['nombre'] }}</h3>
                    <p class="team-card__role">{{ $miembro['cargo'] }}</p>
                </article>
            @endforeach

        </section>
    </section>

    {{-- LLAMADO A LA ACCIÓN --}}
    <section class="container">
        <article class="cta-banner">
            <h2 class="cta-banner__title">¿Listo para descubrir productos únicos?</h2>
            <p class="cta-banner__text">
                Explora nuestro catálogo y apoya a los emprendedores locales
            </p>
            <a href="{{ url('/productos') }}" class="btn btn--primary btn--lg">
                Ver Catálogo
            </a>
        </article>
    </section>

@endsection