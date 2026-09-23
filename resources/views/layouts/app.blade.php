<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-whidth,  initial-scale=1.0">
        <title>@vield('title', ' Mi tienda ')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body> 

        @include('partials.header')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')

    </body>
</html>

