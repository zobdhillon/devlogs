<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|plus-jakarta-sans:400,500"
            rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body
        class="font-sans text-devlog-text antialiased devlog-bg min-h-screen flex flex-col sm:justify-center items-center p-6">

        <div class="w-full sm:max-w-md">
            {{-- Logo/Brand --}}
            <div class="text-center mb-8">
                <x-logo></x-logo>
                <p class="text-devlog-muted mt-1 text-sm">Track your learning journey</p>
            </div>

            {{-- Card --}}
            <div class="bg-devlog-card rounded-2xl border border-devlog-border p-8 shadow-lg">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <p class="text-center text-devlog-muted text-xs mt-6">Built for developers, by developers 💜</p>
        </div>

    </body>

</html>
