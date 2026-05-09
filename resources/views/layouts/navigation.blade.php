<div class="px-4 pt-4 pb-2 flex justify-center" x-data="{ open: false }">
    <nav class="w-full max-w-3xl rounded-2xl border border-devlog-border px-6 flex items-center justify-between h-14"
        style="background-color: rgba(45, 36, 72, 0.6); backdrop-filter: blur(16px);">

        <!-- Brand -->
        <x-logo-sm />

        <!-- Nav Links -->
        <div class="hidden sm:flex items-center gap-6">
            <a href="{{ route('dashboard') }}"
                class="text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'text-devlog-text' : 'text-devlog-muted hover:text-devlog-text' }}">
                Dashboard
            </a>
            <a href="{{ route('topics.index') }}"
                class="text-sm font-medium transition {{ request()->routeIs('topics.*') ? 'text-devlog-text' : 'text-devlog-muted hover:text-devlog-text' }}">
                Topics
            </a>
        </div>

        <!-- User -->
        <div class="hidden sm:flex items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center gap-2 text-sm text-devlog-muted hover:text-devlog-text transition">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold"
                            style="background-color: #2d2448; color: #c4b8e8">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        {{ Auth::user()->name }}
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger -->
        <div class="flex items-center sm:hidden">
            <button @click="open = ! open" class="p-2 text-devlog-muted hover:text-devlog-text transition">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </nav>
</div>

<!-- Mobile Menu -->
<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-devlog-border">
    <div class="pt-2 pb-3 space-y-1 px-4">
        <a href="{{ route('dashboard') }}"
            class="block text-sm py-2 text-devlog-muted hover:text-devlog-text">Dashboard</a>
        <a href="{{ route('topics.index') }}"
            class="block text-sm py-2 text-devlog-muted hover:text-devlog-text">Topics</a>
    </div>
    <div class="pt-4 pb-3 border-t border-devlog-border px-4">
        <div class="text-sm font-medium text-devlog-text">{{ Auth::user()->name }}</div>
        <div class="text-xs text-devlog-muted">{{ Auth::user()->email }}</div>
        <div class="mt-3 space-y-1">
            <a href="{{ route('profile.edit') }}"
                class="block text-sm py-2 text-devlog-muted hover:text-devlog-text">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm py-2 text-devlog-muted hover:text-devlog-text">Log
                    Out</button>
            </form>
        </div>
    </div>
</div>
</nav>
