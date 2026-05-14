<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.head')
    </head>

    <body class="page auth-page">
        <div class="orb orb-tl" aria-hidden="true"></div>
        <div class="orb orb-tr" aria-hidden="true"></div>
        <div class="orb orb-br" aria-hidden="true"></div>

        <div class="auth-wrap">
            <div class="auth-brand">
                <x-logo-sm />
                <p class="auth-brand-sub">Track your learning journey</p>
            </div>
            <div class="auth-card">
                {{ $slot }}
            </div>
            <p class="auth-footer">Built for developers, by developers 💜</p>
        </div>
    </body>

</html>
