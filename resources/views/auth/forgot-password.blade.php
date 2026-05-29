<x-guest-layout>
    <p class="mb-4 text-sm text-gray-400">
        Forgot your password? Enter your email and we'll send you a reset link.
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <x-ui.label for="email">Email</x-ui.label>
            <x-ui.input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-ui.button-primary class="w-full">Email Password Reset Link</x-ui.button-primary>
    </form>
</x-guest-layout>
