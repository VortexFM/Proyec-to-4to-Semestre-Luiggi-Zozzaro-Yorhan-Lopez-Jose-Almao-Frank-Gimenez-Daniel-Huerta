<footer class="bg-gray-900 text-white mt-20">
    <section class="max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">

        <section>
            <h3 class="text-x1 font-bold md-4 text-purple-400">Mi tienda</h3>
            <p class="text-gray-400 text-sm leading-relaxed"> 
                Apoyando emprendedores locales en productos unicos y de calidad
            </p>
        </section>

        <section>
            <h4 class="font-semibold md-4">Enlace</h4>
            <ul class="text-gray-400 text-sm space-Y-2"> 
                <li><a href=" {{ url('/') }}" class="hover:text-purple-400 transition">Inicio</a></li>

                <li><a href="#" class="hover:text-purple-400 transition">Productos</a></li>
                <li><a href="#" class="hover:text-purple-400 transition">Contacto</a></li>
            </ul>
        </section>

        <section>
            <h4 class="font-semibold mb-4">Ayuda</h4>
            <ul class="text-gray-400 text-sm space-y-2">
                <li><a href="#" class="hover:text-purple-400 transition">Preguntas frecuentes</a></li>
                <li><a href="#" class="hover:text-purple-400 transition">Envíos</a></li>
                <li><a href="#" class="hover:text-purple-400 transition">Devoluciones</a></li>
            </ul>
        </section>

        <section class="border-t border-gray-800 py-4 text-center text-gray-500 text-sm">
            @ {{ date('Y')}} Mi tienda. Todos los derechos reservados


    </section>