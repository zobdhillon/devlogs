<div class="px-4 pt-4 pb-2 flex justify-center" x-data="{ open: false, dropOpen: false }">
    <nav class="app-nav">
        <x-logo-sm />

        <div class="hidden sm:flex items-center gap-6">
            <a href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">Dashboard</a>
            <a href="{{ route('topics.index') }}"
                class="nav-link {{ request()->routeIs('topics.*') ? 'nav-link-active' : '' }}">Topics</a>
            <a href="{{ route('logs.index') }}"
                class="nav-link {{ request()->routeIs('logs.*') ? 'nav-link-active' : '' }}">Logs</a>
            <a href="{{ route('goals.index') }}"
                class="nav-link {{ request()->routeIs('goals.*') ? 'nav-link-active' : '' }}">Goals</a>
            <a href="{{ route('resources.index') }}"
                class="nav-link {{ request()->routeIs('resources.*') ? 'nav-link-active' : '' }}">Resources</a>
        </div>

        {{-- Avatar dropdown --}}
        <div class="hidden sm:flex items-center relative" @click.outside="dropOpen = false">
            <button class="nav-user-btn" @click="dropOpen = !dropOpen">
                <div style="position:relative;flex-shrink:0;">
                    <div
                        style="width:32px;height:32px;border-radius:50%;background:rgba(168,85,247,0.15);border:1px solid rgba(168,85,247,0.3);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#a855f7;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div
                        style="position:absolute;bottom:0;right:0;width:9px;height:9px;border-radius:50%;background:#41b883;border:1.5px solid #08060f;">
                    </div>
                </div>
                <span style="font-size:13px;color:#f0ece8;font-weight:500;">{{ Auth::user()->name }}</span>
                <svg class="w-3 h-3 transition-transform duration-150 opacity-50" :class="dropOpen ? 'rotate-180' : ''"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="dropOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute right-0 top-full mt-2 w-44 rounded-xl overflow-hidden"
                style="background:rgba(8,6,15,0.98);border:1px solid rgba(168,85,247,0.2);box-shadow:0 8px 32px rgba(0,0,0,0.8);backdrop-filter:blur(20px);z-index:9999;">

                {{-- User info --}}
                <div class="px-4 py-3 border-b" style="border-color:rgba(168,85,247,0.1)">
                    <p class="text-xs font-semibold" style="color:#f0ece8">{{ Auth::user()->name }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b7fa8">&#64;{{ Auth::user()->username }}</p>
                </div>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-colors duration-150"
                    style="color:#8b7fa8"
                    onmouseover="this.style.background='rgba(168,85,247,0.08)';this.style.color='#f0ece8'"
                    onmouseout="this.style.background='transparent';this.style.color='#8b7fa8'">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>

                <a href="/u/{{ Auth::user()->username }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm transition-colors duration-150"
                    style="color:#8b7fa8"
                    onmouseover="this.style.background='rgba(168,85,247,0.08)';this.style.color='#f0ece8'"
                    onmouseout="this.style.background='transparent';this.style.color='#8b7fa8'">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Public Profile
                </a>

                <div class="border-t" style="border-color:rgba(168,85,247,0.1)"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-4 py-2.5 text-sm transition-colors duration-150"
                        style="color:#8b7fa8"
                        onmouseover="this.style.background='rgba(244,63,94,0.08)';this.style.color='#f87171'"
                        onmouseout="this.style.background='transparent';this.style.color='#8b7fa8'">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>

        {{-- Mobile hamburger --}}
        <div class="flex items-center sm:hidden">
            <button @click="open = !open" class="nav-hamburger">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden nav-mobile">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('dashboard') }}" class="nav-mobile-link">Dashboard</a>
            <a href="{{ route('topics.index') }}" class="nav-mobile-link">Topics</a>
            <a href="{{ route('logs.index') }}" class="nav-mobile-link">Logs</a>
            <a href="{{ route('goals.index') }}" class="nav-mobile-link">Goals</a>
            <a href="{{ route('resources.index') }}" class="nav-mobile-link">Resources</a>
        </div>
        <div class="px-4 py-3 border-t" style="border-color:rgba(255,255,255,0.1)">
            <div class="text-sm font-medium" style="color:#f0ece8">{{ Auth::user()->name }}</div>
            <div class="text-xs mt-0.5" style="color:#8b7fa8">&#64;{{ Auth::user()->username }}</div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="nav-mobile-link">Profile</a>
                <a href="/u/{{ Auth::user()->username }}" class="nav-mobile-link">Public Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-mobile-link w-full text-left">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
