<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    <div>
        <x-ui.label for="name">Name</x-ui.label>
        <x-ui.input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
            autocomplete="name" />
        @error('name')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-ui.label for="username">Username</x-ui.label>
        <div class="relative">
            <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-400">@</span>
            <x-ui.input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required
                autocomplete="username" class="pl-7" />
        </div>
        @error('username')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-ui.label for="bio">Bio <span class="text-gray-500">(optional)</span></x-ui.label>
        <textarea id="bio" name="bio" rows="3" placeholder="Tell the world what you're learning..."
            class="w-full resize-none rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm text-gray-200 placeholder:text-gray-500 focus:border-accent/50 focus:outline-none focus:ring-2 focus:ring-accent/20">{{ old('bio', $user->bio) }}</textarea>
        @error('bio')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <x-ui.label for="email">Email</x-ui.label>
        <x-ui.input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
            autocomplete="email" />
        @error('email')
            <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4 pt-1">
        <x-ui.button-primary type="submit">Save Changes</x-ui.button-primary>
        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="flex items-center gap-1 text-xs text-emerald-400">
                <x-icon name="check" class="h-3.5 w-3.5" /> Saved
            </p>
        @endif
    </div>
</form>
