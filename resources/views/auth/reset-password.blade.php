@extends('layouts.app')

@section('title', 'Restablecer Contraseña - Mi Tienda')

@section('content')
    <section class="section container" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
        <div style="background: white; padding: 2.5rem; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.05); width: 100%; max-width: 450px;">
            
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Restablecer Contraseña</h1>
                <p style="color: #6b7280; font-size: 0.875rem;">Ingresa tu nueva contraseña a continuación.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                {{-- Token oculto --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus class="form-input">
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Nueva Contraseña</label>
                    <input id="password" type="password" name="password" required class="form-input">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="form-input">
                </div>

                {{-- Botón --}}
                <button type="submit" class="btn btn--primary btn--block" style="margin-top: 1.5rem;">
                    Restablecer Contraseña
                </button>
            </form>
        </div>
    </section>
@endsection