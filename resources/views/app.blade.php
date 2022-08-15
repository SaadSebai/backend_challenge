<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product Management</title>

        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">

        <div id="app" class="container mx-auto p-12">
            <router-view></router-view>
        </div>

        @vite('resources/js/app.js')
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    </body>
</html>
