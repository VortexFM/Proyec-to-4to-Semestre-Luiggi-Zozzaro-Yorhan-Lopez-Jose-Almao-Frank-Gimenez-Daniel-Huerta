@extends('layouts.app')

@section('title', 'Mi Cuenta - Mi Tienda')

@section('content')

    <section class="page-header">
        <section class="container">
            <h1 class="page-header__title">Mi Cuenta</h1>
            <p class="page-header__subtitle">Bienvenido(a), <span id="user-name-display"></span></p>
        </section>
    </section>

    <section class="section container">
        
        <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 2rem;">
            
            {{-- Menú Lateral --}}
            <aside style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); height: fit-content;">
                <h2 style="font-weight: bold; margin-bottom: 1rem; font-size: 1.1rem;">Mi Perfil</h2>
                <p style="margin-bottom: 0.5rem;"><strong>Email:</strong> <br><span id="user-email-display"></span></p>
                <p style="margin-bottom: 1.5rem;"><strong>Teléfono:</strong> <br><span id="user-phone-display"></span></p>
                
                <hr style="margin: 1rem 0; border-color: #e5e7eb;">
                
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn--outline btn--block" style="color: red; border-color: red;">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </aside>

            {{-- Historial de Pedidos --}}
            <main>
                <h2 class="section__title" style="margin-bottom: 1rem; text-align: left;">Mis Pedidos</h2>
                
                <div id="orders-loading" style="text-align: center; padding: 2rem;">Cargando historial...</div>
                <div id="orders-empty" style="display: none; text-align: center; padding: 2rem; background: white; border-radius: 1rem;">
                    <p>Aún no has realizado ninguna compra.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn--primary" style="margin-top: 1rem;">Ir a la tienda</a>
                </div>

                <div id="orders-list" style="display: flex; flex-direction: column; gap: 1rem;">
                    {{-- Aquí se inyectan los pedidos con JS --}}
                </div>
            </main>
        </div>

    </section>

@endsection