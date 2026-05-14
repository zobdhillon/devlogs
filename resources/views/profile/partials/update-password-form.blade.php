<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div>
        <label class="auth-label" for="update_password_current_password">Current Password</label>
        <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
            class="auth-input w-full" />
        @error('current_password', 'updatePassword')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="auth-label" for="update_password_password">New Password</label>
        <input id="update_password_password" name="password" type="password" autocomplete="new-password"
            class="auth-input w-full" />
        @error('password', 'updatePassword')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="auth-label" for="update_password_password_confirmation">Confirm Password</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
            autocomplete="new-password" class="auth-input w-full" />
        @error('password_confirmation', 'updatePassword')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4 pt-1">
        <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-sm font-semibold">
            Update Password
        </button>

        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs"
                style="color:#41b883">
                ✓ Updated
            </p>
        @endif
    </div>
</form>
