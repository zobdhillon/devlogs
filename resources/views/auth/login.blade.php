<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-4">
            <label class="auth-label" for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" class="auth-input w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label class="auth-label" for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="auth-input w-full" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded" />
                <span class="text-sm" style="color:#8b7fa8">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm transition-colors duration-150"
                    style="color:#8b7fa8" onmouseover="this.style.color='#a855f7'"
                    onmouseout="this.style.color='#8b7fa8'">
                    Forgot password?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-primary w-full py-2.5 rounded-xl text-sm font-semibold">
            Log in
        </button>
    </form>
</x-guest-layout>
