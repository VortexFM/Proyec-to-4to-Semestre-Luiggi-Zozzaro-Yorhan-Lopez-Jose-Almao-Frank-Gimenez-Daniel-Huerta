@extends('layouts.app')

@section('title', 'Recuperar Contraseña - Mi Tienda')

@section('content')
    <section class="section container" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
        <div style="background: white; padding: 2.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%; max-width: 450px;">
            
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">¿Olvidaste tu contraseña?</h1>
                <p style="color: #6b7280; font-size: 0.875rem;">
                    No hay problema. Ingresa tu correo y te enviaremos un enlace para restablecerla.
                </p>
            </div>

            {{-- Mensaje de estado (si el correo se envió) --}}
            @if (session('status'))
                <div class="alert alert--success" style="margin-bottom: 1rem; background-color: #ecfdf5; color: #065f46; padding: 1rem; border-radius: 0.5rem; font-size: 0.875rem;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botón --}}
                <button type="submit" class="btn btn--primary btn--block" style="margin-top: 1.5rem;">
                    Enviar enlace de recuperación
                </button>

                <div style="text-align: center; margin-top: 1rem;">
                    <a href="{{ route('login') }}" style="color: var(--color-primary); font-size: 0.875rem; text-decoration: none;">
                        ← Volver al inicio de sesión
                    </a>
                </div>
            </form>
        </div>
    </section>
@endsection