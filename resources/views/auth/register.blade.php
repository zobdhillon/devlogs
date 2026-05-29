<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-ui.label for="name">Name</x-ui.label>
            <x-ui.input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-ui.label for="username">Username</x-ui.label>
            <x-ui.input id="username" type="text" name="username" value="{{ old('username') }}" required />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div>
            <x-ui.label for="email">Email</x-ui.label>
            <x-ui.input id="email" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-ui.label for="password">Password</x-ui.label>
            <x-ui.input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-ui.label for="password_confirmation">Confirm Password</x-ui.label>
            <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('login') }}" class="text-sm text-gray-400 transition-colors hover:text-accent">
                Already registered?
            </a>
            <x-ui.button-primary type="submit">Register</x-ui.button-primary>
        </div>
    </form>
</x-guest-layout>
