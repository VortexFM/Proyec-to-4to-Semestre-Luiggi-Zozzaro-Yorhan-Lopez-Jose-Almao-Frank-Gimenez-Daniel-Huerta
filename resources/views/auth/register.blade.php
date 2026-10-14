@extends('layouts.app')

@section('title', 'Crear Cuenta - Mi Tienda')

@section('content')

    <section class="auth-container">
        <article class="auth-card">

            <header class="auth-card__logo">
                <a href="{{ url('/') }}">Mi Tienda</a>
            </header>

            <h1 class="auth-card__title">Crear Cuenta</h1>
            <p class="auth-card__subtitle">Únete y empieza a comprar productos únicos</p>

            @if ($errors->any())
                <div class="alert alert--danger">
                    <span class="alert__icon">⚠</span>
                    <div class="alert__content">
                        @foreach ($errors->all() as $error)
                            <p class="alert__message">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" class="form-input"
                           value="{{ old('name') }}" placeholder="Ej: Juan Pérez" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-input"
                           value="{{ old('email') }}" placeholder="tu@correo.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Teléfono</label>
                    <input type="tel" id="phone" name="phone" class="form-input"
                           value="{{ old('phone') }}" placeholder="0412-1234567">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <div class="form-password">
                        <input type="password" id="password" name="password" class="form-input"
                               placeholder="Mínimo 8 caracteres" required>
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
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                    <div class="form-password">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                               placeholder="Repite tu contraseña" required>
                        <button type="button" class="form-password__toggle" aria-label="Mostrar contraseña" data-target="password_confirmation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="form-password__eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="form-password__eye-off">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="terms" class="form-checkbox" required>
                        <span>Acepto los <a href="{{ url('/terminos') }}" class="auth-card__link">términos y condiciones</a></span>
                    </label>
                </div>

                <button type="submit" class="btn btn--primary btn--block btn--lg">
                    Crear Cuenta
                </button>
            </form>

            <footer class="auth-card__footer">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
            </footer>

        </article>
    </section>

@endsection