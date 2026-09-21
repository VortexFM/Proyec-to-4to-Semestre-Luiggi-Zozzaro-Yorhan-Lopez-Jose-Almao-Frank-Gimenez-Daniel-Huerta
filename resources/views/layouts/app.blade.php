<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-whidth,  initial-scale=1.0">
        <title>@vield('title', 'Mi tienda')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-800 font-sans antialiased"> 

        @include('partials.header')

        <main class="min-h-screen">
            @yield('content')
        </main>

        @include('partials.footer')

    </body>
</html>

