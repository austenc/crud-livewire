<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Stuck in the CRUD') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.0-alpha.15/tailwind.min.css" integrity="sha512-ccLnjloT6fB8iXDVzphgM300jy35nVZPcEd+S5KWP9rAGlFeESdDTuf4FhstnVrc5ogSVda4Oyzq8eECmSNvpg==" crossorigin="anonymous" />
        <livewire:styles />
    </head>
    <body class="bg-gray-200 antialiased text-gray-700">
       {{ $slot }} 
       <livewire:scripts />
       <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </body>
</html>
