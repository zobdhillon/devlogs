<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <x-ui.label for="email">Email</x-ui.label>
            <x-ui.input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-ui.label for="password">Password</x-ui.label>
            <x-ui.input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6 flex items-center justify-between">
            <label for="remember_me" class="flex cursor-pointer items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="rounded" />
                <span class="text-sm text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-gray-400 transition-colors hover:text-accent">
                    Forgot password?
                </a>
            @endif
        </div>

        <x-ui.button-primary class="w-full py-2.5">
            Log in
        </x-ui.button-primary>
    </form>
</x-guest-layout>
