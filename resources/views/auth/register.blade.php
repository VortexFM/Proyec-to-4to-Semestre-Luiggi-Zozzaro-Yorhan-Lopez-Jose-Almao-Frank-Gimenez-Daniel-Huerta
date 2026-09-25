@extends('layouts.app')

@section('title', 'Crear Cuenta - Mi Tienda')

@section('content')

    <section class="auth-container">
        <div class="auth-card">

            {{-- Logo --}}
            <section class="auth-card__logo">
                <a href="{{ url('/') }}">Mi Tienda</a>
            </section>

            <h1 class="auth-card__title">Crear Cuenta</h1>
            <p class="auth-card__subtitle">Únete y empieza a comprar productos únicos</p>

            <form action="#" method="POST">
                @csrf

                <section class="form-group">
                    <label class="form-label" for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Ej: Juan Pérez" required>
                </section>

                <div class="form-group">
                    <label class="form-label" for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" class="form-input" placeholder="tu@correo.com" required>
                </div>

                <section class="form-group">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="0412-1234567">
                </section>

                <section class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                        <section class="form-password">
                            <input type="password" id="password" name="password" class="form-input" placeholder="Mínimo 8 caracteres" required>
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

                <section class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                        <section class="form-password">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Repite tu contraseña" required>
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
                    </section>
                </section>

                <section class="form-group">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="terminos" class="form-checkbox" required>
                        <span>Acepto los <a href="{{ url('/terminos') }}" class="auth-card__link">términos y condiciones</a></span>
                    </label>
                </section>

                <button type="submit" class="btn btn--primary btn--block btn--lg">
                    Crear Cuenta
                </button>
            </form>

            <p class="auth-card__footer">
                ¿Ya tienes cuenta? <a href="{{ url('/login') }}">Inicia sesión</a>
            </p>

        </section>
    </section>

@endsection