<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />
        <style>
            .devlog-bg {
                background-color: #1a1528;
                position: relative;
                background-image:
                    radial-gradient(ellipse 80% 40% at 20% 80%, #2d2448 0%, transparent 70%),
                    radial-gradient(ellipse 60% 35% at 80% 90%, #322852 0%, transparent 65%),
                    radial-gradient(ellipse 70% 30% at 50% 100%, #3d3260 0%, transparent 60%),
                    radial-gradient(ellipse 40% 20% at 10% 95%, #423668 0%, transparent 55%),
                    radial-gradient(ellipse 30% 15% at 90% 85%, #2a2245 0%, transparent 50%),
                    radial-gradient(ellipse 50% 25% at 60% 20%, #251e38 0%, transparent 60%),
                    radial-gradient(ellipse 20% 15% at 30% 10%, #2d2448 0%, transparent 50%);
                min-height: 100vh;
            }

            .devlog-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                height: 50%;
                background-image:
                    radial-gradient(2px 2px at 10% 15%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2.5px 2.5px at 25% 8%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(3px 3px at 40% 20%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2px 2px at 60% 12%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2.5px 2.5px at 75% 25%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(3px 3px at 85% 8%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2px 2px at 92% 18%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2.5px 2.5px at 15% 35%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2px 2px at 50% 5%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(3px 3px at 33% 28%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2px 2px at 68% 32%, #c4b8e8 0%, transparent 100%),
                    radial-gradient(2.5px 2.5px at 55% 18%, #c4b8e8 0%, transparent 100%);
                opacity: 0.7;
                pointer-events: none;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body
        class="font-sans text-devlog-text antialiased devlog-bg min-h-screen flex flex-col sm:justify-center items-center p-6">

        <div class="w-full sm:max-w-md">
            {{-- Logo/Brand --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-devlog-text">DevLog</h1>
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
