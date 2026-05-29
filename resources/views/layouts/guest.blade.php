<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.head')
    </head>

    <body class="flex min-h-screen items-center justify-center bg-canvas px-6 py-8">
        <div class="w-full max-w-md">
            <div class="mb-8 flex flex-col items-center gap-2 text-center">
                <x-logo-sm />
                <p class="text-sm text-gray-400">Track your learning journey</p>
            </div>
            <x-ui.card>
                {{ $slot }}
            </x-ui.card>
            <p class="mt-5 text-center text-xs text-gray-500">Built for developers, by developers</p>
        </div>
    </body>

</html>
