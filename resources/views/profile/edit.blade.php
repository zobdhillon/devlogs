<x-app-layout>

    <div class="mx-auto max-w-2xl space-y-4">
        <x-ui.card>
            <h2 class="mb-1 font-display text-lg font-bold text-gray-100">Profile Information</h2>
            <p class="mb-6 text-xs text-gray-400">Update your name, username, bio and email address.</p>
            @include('profile.partials.update-profile-information-form')
        </x-ui.card>

        <x-ui.card>
            <h2 class="mb-1 font-display text-lg font-bold text-gray-100">Update Password</h2>
            <p class="mb-6 text-xs text-gray-400">Use a long, random password to keep your account secure.</p>
            @include('profile.partials.update-password-form')
        </x-ui.card>

        <x-ui.card class="border-rose-500/20">
            <h2 class="mb-1 font-display text-sm font-bold text-rose-400">Danger Zone</h2>
            <p class="mb-4 text-xs text-gray-400">
                Once your account is deleted, all data will be permanently removed. This cannot be undone.
            </p>
            @include('profile.partials.delete-user-form')
        </x-ui.card>
    </div>

</x-app-layout>
