<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @vite(['resources/js/app.js', 'resources/sass/app.scss'])

        <!-- Fonts -->
        @livewireStyles

    </head>
    <body class="antialiased">


    @livewireScripts

    </body>
</html>
