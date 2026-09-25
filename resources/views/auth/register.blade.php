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
                    <input type="password" id="password" name="password" class="form-input" placeholder="Mínimo 8 caracteres" required>
                </section>

                <section class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Repite tu contraseña" required>
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