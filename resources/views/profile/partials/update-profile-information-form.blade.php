<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    {{-- Name --}}
    <div>
        <label class="auth-label" for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
            autocomplete="name" class="auth-input w-full" />
        @error('name')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Username --}}
    <div>
        <label class="auth-label" for="username">Username</label>
        <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm pointer-events-none"
                style="color:#f0eef5">@</span>
            <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required
                autocomplete="username" class="auth-input auth-input-username w-full" />
        </div>
        @error('username')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Bio --}}
    <div>
        <label class="auth-label" for="bio">Bio <span style="color:#8b7fa8">(optional)</span></label>
        <textarea id="bio" name="bio" rows="3" placeholder="Tell the world what you're learning..."
            class="auth-input w-full resize-none" style="height:auto">{{ old('bio', $user->bio) }}</textarea>
        @error('bio')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="auth-label" for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
            autocomplete="email" class="auth-input w-full" />
        @error('email')
            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Save --}}
    <div class="flex items-center gap-4 pt-1">
        <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-sm font-semibold">
            Save Changes
        </button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs"
                style="color:#41b883">
                ✓ Saved
            </p>
        @endif
    </div>
</form>
