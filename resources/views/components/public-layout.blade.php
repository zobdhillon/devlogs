<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'DevLogs' }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:700,800|plus-jakarta-sans:400,500,600"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="dashboard-bg min-h-screen">
        <div class="orb orb-tl" aria-hidden="true"></div>
        <div class="orb orb-tr" aria-hidden="true"></div>
        <div class="orb orb-br" aria-hidden="true"></div>
        <div class="orb orb-bl" aria-hidden="true"></div>
        <main class="relative z-10 max-w-2xl mx-auto px-4 py-12">
            {{ $slot }}
        </main>
    </body>

</html>
