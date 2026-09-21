@extends('layouts.app')

@section('Title', 'Inicio - Mi Tienda')

@section('content')

{{-- hero --}}
<section class="bg-gradient-to-r from-purple-600 to-pink-500 text-white"> 
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4"> Descubre productos unicos</h1>
        <p class="text-lg md:text-xl mb-8 opacity-90">Apoya a emprendedores locales y encuentra tesoros especiales</p>
        <a href="#" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                Ver Catálogo
        </a>
    </section>
</section>

{{-- Categoria --}}

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-2xl font-bold mb-8">Categoria</h2>
    <section>
        @for ($i = 1; $i <= 4; $i++)
        <a href="#" class="bg-white p-6 rounded-x1 shadow-sm hover:shadow-md transition text-center">
            <section class="text-4x1 mb-3">🎁</section>
            <p class="font-semibold text-gray-700">Categoria {{ $i }}</p>
        </a>

        @endfor
    </section>
</section>

{{-- Productos Destacados --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold mb-8">Productos Destacados</h2>
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 1; $i <= 8; $i++)
                <section class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <section class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                        Imagen del producto
                    </section>
                    <section class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-1">Producto {{ $i }}</h3>
                        <p class="text-sm text-gray-500 mb-3">Descripción breve del producto</p>
                        <section class="flex items-center justify-between">
                            <span class="text-lg font-bold text-purple-600">$25.00</span>
                            <button class="bg-purple-600 text-white p-2 rounded-lg hover:bg-purple-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </section>
                    </section>
                </section>
            @endfor
        </section>
    </section>

     {{-- Productos Recientes --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold mb-8">Recién Agregados</h2>
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 1; $i <= 4; $i++)
                <section class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <section class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                        Imagen
                    </section>
                    <section class="p-4">
                        <h3 class="font-semibold text-gray-800">Nuevo Producto {{ $i }}</h3>
                        <span class="text-lg font-bold text-purple-600">$15.00</span>
                    </section>
                </section>
            @endfor
        </section>
    </section>

@endsection




