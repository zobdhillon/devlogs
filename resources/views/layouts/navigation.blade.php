<div class="px-4 pb-2 pt-4" x-data="{ open: false }">
    <nav
        class="relative z-[9999] mx-auto flex h-14 w-full max-w-4xl items-center justify-between rounded-xl border border-white/[0.06] bg-surface px-4 shadow-card sm:px-6">
        <x-logo-sm />

        <div class="hidden items-center gap-6 sm:flex">
            <a href="{{ route('dashboard') }}"
                class="text-sm font-medium transition-colors hover:text-gray-200 {{ request()->routeIs('dashboard') ? 'text-gray-200' : 'text-gray-400' }}">Dashboard</a>
            <a href="{{ route('topics.index') }}"
                class="text-sm font-medium transition-colors hover:text-gray-200 {{ request()->routeIs('topics.*') ? 'text-gray-200' : 'text-gray-400' }}">Topics</a>
            <a href="{{ route('logs.index') }}"
                class="text-sm font-medium transition-colors hover:text-gray-200 {{ request()->routeIs('logs.*') ? 'text-gray-200' : 'text-gray-400' }}">Logs</a>
            <a href="{{ route('goals.index') }}"
                class="text-sm font-medium transition-colors hover:text-gray-200 {{ request()->routeIs('goals.*') ? 'text-gray-200' : 'text-gray-400' }}">Goals</a>
            <a href="{{ route('resources.index') }}"
                class="text-sm font-medium transition-colors hover:text-gray-200 {{ request()->routeIs('resources.*') ? 'text-gray-200' : 'text-gray-400' }}">Resources</a>
        </div>

        <div class="hidden items-center sm:flex">
            <div class="relative" x-data="{ dropOpen: false }" @click.outside="dropOpen = false">
                <button type="button"
                    class="flex items-center gap-2 text-sm text-gray-400 transition-colors hover:text-gray-200"
                    @click.stop="dropOpen = !dropOpen">
                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-full border border-accent/25 bg-accent/10 text-xs font-semibold text-accent">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="font-medium text-gray-200">{{ Auth::user()->name }}</span>
                    <span class="transition-transform" :class="dropOpen ? 'rotate-180' : ''">
                        <x-icon name="chevron-down" class="h-3 w-3 opacity-50" />
                    </span>
                </button>

                <div x-show="dropOpen" x-cloak x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 top-full z-[9999] mt-2 w-44 overflow-hidden rounded-xl border border-white/[0.06] bg-surface shadow-md">
                    <div class="border-b border-white/[0.06] px-4 py-3">
                        <p class="text-xs font-semibold text-gray-100">{{ Auth::user()->name }}</p>
                        <p class="mt-0.5 text-xs text-gray-400">&#64;{{ Auth::user()->username }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200">
                        <x-icon name="user" class="h-3.5 w-3.5" />
                        Profile
                    </a>
                    <a href="/u/{{ Auth::user()->username }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200">
                        <x-icon name="external-link" class="h-3.5 w-3.5" />
                        Public Profile
                    </a>
                    <div class="border-t border-white/[0.06]"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200 w-full hover:text-rose-400">
                            <x-icon name="log-out" class="h-3.5 w-3.5" />
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <button type="button" @click="open = !open" class="p-2 text-gray-400 hover:text-gray-200 sm:hidden"
            aria-label="Toggle menu">
            <x-icon name="menu" class="h-5 w-5" x-show="!open" />
            <x-icon name="x" class="h-5 w-5" x-show="open" x-cloak />
        </button>
    </nav>

    <div :class="{ 'block': open, 'hidden': !open }"
        class="mx-auto mt-2 hidden w-full max-w-4xl overflow-hidden rounded-xl border border-white/[0.06] bg-surface shadow-card sm:hidden">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('dashboard') }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Dashboard</a>
            <a href="{{ route('topics.index') }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Topics</a>
            <a href="{{ route('logs.index') }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Logs</a>
            <a href="{{ route('goals.index') }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Goals</a>
            <a href="{{ route('resources.index') }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Resources</a>
        </div>
        <div class="border-t border-white/[0.06] px-4 py-3">
            <div class="text-sm font-medium text-gray-100">{{ Auth::user()->name }}</div>
            <div class="mt-0.5 text-xs text-gray-400">&#64;{{ Auth::user()->username }}</div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Profile</a>
                <a href="/u/{{ Auth::user()->username }}" class="block py-2 text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Public Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-2 text-left text-sm font-medium text-gray-400 transition-colors hover:text-gray-200">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
