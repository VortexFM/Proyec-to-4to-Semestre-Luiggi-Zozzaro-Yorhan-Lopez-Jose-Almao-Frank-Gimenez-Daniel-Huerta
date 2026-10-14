@extends('layouts.app')

@section('title', 'Iniciar Sesión - Mi Tienda')

@section('content')

    <section class="auth-container">
        <article class="auth-card">

            <header class="auth-card__logo">
                <a href="{{ url('/') }}">Mi Tienda</a>
            </header>

            <h1 class="auth-card__title">Iniciar Sesión</h1>
            <p class="auth-card__subtitle">Bienvenido de nuevo a tu tienda favorita</p>

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <section class="alert alert--danger">
                    <span class="alert__icon">⚠</span>
                    <section class="alert__content">
                        @foreach ($errors->all() as $error)
                            <p class="alert__message">{{ $error }}</p>
                        @endforeach
                    </section>
                </section>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <section class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-input"
                           value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus>
                </section>

                <section class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <section class="form-password">
                        <input type="password" id="password" name="password" class="form-input"
                               placeholder="••••••••" required>
                        <button type="button" class="form-password__toggle" aria-label="Mostrar contraseña" data-target="password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="form-password__eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="form-password__eye-off">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </section>
                </section>

                <section class="auth-card__options">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="remember" class="form-checkbox">
                        <span>Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-card__link">¿Olvidaste tu contraseña?</a>
                    @endif
                </section>

                <button type="submit" class="btn btn--primary btn--block btn--lg">
                    Iniciar Sesión
                </button>
            </form>

            <p class="auth-divider">o</p>

            <footer class="auth-card__footer">
                ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
            </footer>

        </article>
    </section>

@endsection