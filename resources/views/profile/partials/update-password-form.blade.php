<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div>
        <x-ui.label for="update_password_current_password">Current Password</x-ui.label>
        <x-ui.input id="update_password_current_password" name="current_password" type="password"
            autocomplete="current-password" />
        @error('current_password', 'updatePassword')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-ui.label for="update_password_password">New Password</x-ui.label>
        <x-ui.input id="update_password_password" name="password" type="password" autocomplete="new-password" />
        @error('password', 'updatePassword')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-ui.label for="update_password_password_confirmation">Confirm Password</x-ui.label>
        <x-ui.input id="update_password_password_confirmation" name="password_confirmation" type="password"
            autocomplete="new-password" />
        @error('password_confirmation', 'updatePassword')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4 pt-1">
        <x-ui.button-primary type="submit">Update Password</x-ui.button-primary>
        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="flex items-center gap-1 text-xs text-emerald-400">
                <x-icon name="check" class="h-3.5 w-3.5" /> Updated
            </p>
        @endif
    </div>
</form>
