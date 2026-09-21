<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8 py-4 flex item-center justify-between">

        {{--- logo ---}}
        <a href="{{url('/')}}" class="text-2x1 font-bold text-purple-600">
            Mi tienda
        </a>

        {{--- Menu de navegacion ---}}
        <ul class="hidden md:flex item-center gap-8 text-gray-700 font-medium">
            <li><a href="{{ url('/')}}" class="hover:text-purple-600 transition">Inicio</a></li>
            <li><a href="#" class="hover:text-purple-600 transition">Productos</a></li>
            <li><a href="#" class="hover:text-purple-600 transition">Categoria</a></li>
            <li><a href="#" class="hover:text-purple-600 transition">Contacto</a></li>
        </ul>

        {{-- Acciones --}}
        <section class="flex items-center gap-4">
            {{--- carrito ---}}
            <a href="#" class="realtive text-gray-700 hover:text_purple-600 tansition">
                <svg xmlns="https://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h21.l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="adsolute -top-2 -right-2 bg-purple-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
            </a>

            {{--- Login / Registro ---}}
            <a href="#" class="text-gray-700 hover:text-purple-600 transition font-medium">Iniciar Session</a>
                <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition font-medium">
                    Registrarse
                </a>
        </section>
    </nav>
</header>