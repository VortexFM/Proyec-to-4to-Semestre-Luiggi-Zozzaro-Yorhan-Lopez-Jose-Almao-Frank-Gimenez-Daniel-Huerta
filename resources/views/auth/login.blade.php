@extends('layouts.app')

@section('title', 'Iniciar Sesión - Mi Tienda')

@section('content')

    <section class="auth-container">
        <section class="auth-card">

            {{-- Logo --}}
            <section class="auth-card__logo">
                <a href="{{ url('/') }}">Mi Tienda</a>
            </section>

            <h1 class="auth-card__title">Iniciar Sesión</h1>
            <p class="auth-card__subtitle">Bienvenido de nuevo a tu tienda favorita</p>

            <form action="#" method="POST">
                @csrf

                <section class="form-group">
                    <label class="form-label" for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" class="form-input" placeholder="tu@correo.com" required>
                </section>

                <section class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                </section>

                <section class="auth-card__options">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="remember" class="form-checkbox">
                        <span>Recordarme</span>
                    </label>
                    <a href="#" class="auth-card__link">¿Olvidaste tu contraseña?</a>
                </section>

                <button type="submit" class="btn btn--primary btn--block btn--lg">
                    Iniciar Sesión
                </button>
            </form>

            <section class="auth-divider">o</section>

            <p class="auth-card__footer">
                ¿No tienes cuenta? <a href="{{ url('/register') }}">Regístrate</a>
            </p>

        </section>
    </section>

@endsection