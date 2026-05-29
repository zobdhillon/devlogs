<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevLogs — Track your learning journey</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:700,800|plus-jakarta-sans:400,500,600"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-canvas text-gray-200">

        <nav class="relative z-10 flex h-[70px] items-center justify-between px-5 sm:px-10">
            <x-logo-sm />
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center rounded-lg border border-white/[0.06] bg-white/[0.03] px-5 py-2 text-[13px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center rounded-lg border border-white/[0.06] bg-white/[0.03] px-5 py-2 text-[13px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center rounded-lg bg-accent px-5 py-2 text-[13px] font-semibold text-white transition-colors hover:bg-accent-hover">Get
                        Started</a>
                @endauth
            </div>
        </nav>

        <section
            class="relative z-[2] flex min-h-[calc(100vh-70px)] flex-col items-center justify-center px-5 text-center sm:px-10">
            <h1
                class="mb-4 mt-4 font-display text-[clamp(2.25rem,6vw,3.625rem)] font-extrabold leading-[1.05] tracking-tight text-gray-100">
                Track your<br>
                <span class="text-accent">learning journey</span>
            </h1>
            <p class="mx-auto mb-8 max-w-md text-[clamp(0.875rem,2vw,1rem)] leading-relaxed text-gray-400">
                Log your progress, set goals, save resources and share your developer story with the world.
            </p>
            <div class="flex flex-col items-center gap-3 sm:flex-row">
                <a href="{{ route('register') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-accent px-7 py-3.5 text-[15px] font-semibold text-white transition-colors hover:bg-accent-hover sm:w-auto">
                    Get Started — it's free
                    <x-icon name="arrow-right" class="h-4 w-4" />
                </a>
                <a href="#demo"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-white/[0.06] bg-white/[0.03] px-7 py-3.5 text-[15px] font-semibold text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200 sm:w-auto">
                    See how it works
                </a>
            </div>
        </section>

        <section class="relative z-[2] min-h-screen px-5 pb-10 pt-2 sm:px-10 sm:pb-10" id="demo">
            <h2
                class="mb-2 text-center font-display text-[clamp(1.75rem,4vw,2.375rem)] font-extrabold tracking-tight text-gray-100">
                See how it all <span class="text-accent">works</span>
            </h2>
            <p class="mb-7 text-center text-sm text-gray-400">Track progress, manage goals and stay in flow — all in one
                place.</p>

            <div class="mb-3.5 grid grid-cols-1 gap-3.5 md:grid-cols-2">
                <div class="overflow-hidden rounded-xl border border-white/[0.06] bg-surface shadow-card">
                    <div class="flex items-center gap-1.5 border-b border-white/[0.06] bg-white/[0.02] px-4 py-2.5">
                        <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                        <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                        <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                        <span class="ml-1 text-[10px] font-bold uppercase tracking-wider text-gray-500">My Topics</span>
                    </div>
                    <div class="space-y-3 p-4">
                        @foreach ([['icon' => 'devicon-react-original colored', 'bg' => 'rgba(97,218,251,0.12)', 'name' => 'React', 'pct' => 78, 'color' => '#8b5cf6'], ['icon' => 'devicon-laravel-plain colored', 'bg' => 'rgba(255,45,32,0.12)', 'name' => 'Laravel', 'pct' => 65, 'color' => '#8b5cf6'], ['icon' => 'devicon-vuejs-plain colored', 'bg' => 'rgba(65,184,131,0.12)', 'name' => 'Vue 3', 'pct' => 38, 'color' => '#41b883'], ['icon' => 'devicon-javascript-plain colored', 'bg' => 'rgba(247,223,30,0.12)', 'name' => 'JavaScript', 'pct' => 52, 'color' => '#f7df1e'], ['icon' => 'devicon-typescript-plain colored', 'bg' => 'rgba(49,120,198,0.12)', 'name' => 'TypeScript', 'pct' => 20, 'color' => '#3178c6']] as $topic)
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-[30px] w-[30px] flex-shrink-0 items-center justify-center rounded-lg"
                                    style="background:{{ $topic['bg'] }}">
                                    <i class="{{ $topic['icon'] }}" style="font-size:17px"></i>
                                </div>
                                <span
                                    class="w-20 flex-shrink-0 text-xs font-semibold text-gray-200">{{ $topic['name'] }}</span>
                                <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-white/[0.06]">
                                    <div class="h-full rounded-full"
                                        style="width:{{ $topic['pct'] }}%;background:{{ $topic['color'] }}"></div>
                                </div>
                                <span class="w-[26px] text-right text-[10px] text-gray-400">{{ $topic['pct'] }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-white/[0.06] bg-surface shadow-card">
                    <div class="flex items-center gap-1.5 border-b border-white/[0.06] bg-white/[0.02] px-4 py-2.5">
                        <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                        <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                        <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                        <span class="ml-1 text-[10px] font-bold uppercase tracking-wider text-gray-500">Recent
                            Logs</span>
                    </div>
                    <div class="divide-y divide-white/[0.06] p-4">
                        @foreach ([['title' => 'Finished React hooks deep dive', 'meta' => 'React · 2 hours ago · mood 5/5', 'color' => '#8b5cf6'], ['title' => 'Set up Laravel Breeze auth flow', 'meta' => 'Laravel · yesterday · mood 4/5', 'color' => '#8b5cf6'], ['title' => 'Explored Vue 3 Composition API', 'meta' => 'Vue 3 · 2 days ago · mood 3/5', 'color' => '#41b883'], ['title' => 'JS async/await patterns', 'meta' => 'JavaScript · 3 days ago · mood 4/5', 'color' => '#f7df1e']] as $log)
                            <div class="flex items-start gap-2 py-2.5 first:pt-0 last:pb-0">
                                <span class="mt-1 h-2 w-2 flex-shrink-0 rounded-full"
                                    style="background:{{ $log['color'] }}"></span>
                                <div>
                                    <div class="text-xs font-semibold text-gray-200">{{ $log['title'] }}</div>
                                    <div class="text-[10px] text-gray-400">{{ $log['meta'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-white/[0.06] bg-surface shadow-card">
                <div class="flex items-center gap-1.5 border-b border-white/[0.06] bg-white/[0.02] px-4 py-2.5">
                    <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                    <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                    <span class="h-2 w-2 rounded-full bg-gray-500 opacity-50"></span>
                    <span class="ml-1 text-[10px] font-bold uppercase tracking-wider text-gray-500">Dashboard —
                        @zobia_dev</span>
                </div>
                <div class="p-4">
                    <div class="mb-4 grid grid-cols-1 gap-2.5 sm:grid-cols-3">
                        @foreach ([['icon' => 'file-text', 'num' => '24', 'label' => 'Total logs', 'accent' => false], ['icon' => 'book-open', 'num' => '5', 'label' => 'Active topics', 'accent' => true], ['icon' => 'target', 'num' => '3', 'label' => 'Goals due soon', 'accent' => true]] as $stat)
                            <div
                                class="flex items-center gap-3 rounded-xl border border-white/[0.06] bg-white/[0.02] p-3.5">
                                <div
                                    class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-accent/10">
                                    <x-icon :name="$stat['icon']" @class([
                                        'h-5 w-5',
                                        'text-accent' => $stat['accent'],
                                        'text-gray-400' => !$stat['accent'],
                                    ]) />
                                </div>
                                <div>
                                    <div @class([
                                        'font-display text-[26px] font-bold leading-none',
                                        'text-accent' => $stat['accent'],
                                        'text-gray-100' => !$stat['accent'],
                                    ])>{{ $stat['num'] }}</div>
                                    <div class="mt-0.5 text-[10px] text-gray-400">{{ $stat['label'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <div class="mb-2 text-[10px] font-bold uppercase tracking-wider text-gray-500">Goals</div>
                            @foreach ([['done' => true, 'label' => 'Complete React course', 'date' => 'Done'], ['done' => false, 'label' => 'Build Laravel API', 'date' => 'Jun 15'], ['done' => false, 'label' => 'Ship public profile', 'date' => 'Jun 30'], ['done' => false, 'label' => 'Learn TypeScript basics', 'date' => 'Jul 10']] as $goal)
                                <div class="flex items-center gap-2 border-b border-white/[0.06] py-1.5 last:border-0">
                                    <span @class([
                                        'h-3.5 w-3.5 flex-shrink-0 rounded border',
                                        'border-accent bg-accent' => $goal['done'],
                                        'border-accent/40' => !$goal['done'],
                                    ])></span>
                                    <span @class([
                                        'flex-1 text-[11px]',
                                        'text-gray-400 line-through' => $goal['done'],
                                        'text-gray-200' => !$goal['done'],
                                    ])>{{ $goal['label'] }}</span>
                                    <span @class([
                                        'text-[10px]',
                                        'text-accent' => $goal['done'],
                                        'text-gray-400' => !$goal['done'],
                                    ])>{{ $goal['date'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <div class="mb-2 text-[10px] font-bold uppercase tracking-wider text-gray-500">Saved
                                Resources</div>
                            @foreach ([['title' => 'React docs — useEffect', 'meta' => 'docs · React', 'color' => '#8b5cf6'], ['title' => 'Laracasts — Livewire v3', 'meta' => 'video · Laravel', 'color' => '#8b5cf6'], ['title' => 'Vue 3 migration guide', 'meta' => 'article · Vue 3', 'color' => '#41b883']] as $resource)
                                <div
                                    class="flex items-start gap-2 border-b border-white/[0.06] py-2.5 first:pt-0 last:pb-0">
                                    <span class="mt-1 h-2 w-2 flex-shrink-0 rounded-full"
                                        style="background:{{ $resource['color'] }}"></span>
                                    <div>
                                        <div class="text-xs font-semibold text-gray-200">{{ $resource['title'] }}</div>
                                        <div class="text-[10px] text-gray-400">{{ $resource['meta'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-accent px-12 py-4 text-[17px] font-bold tracking-wide text-white transition-colors hover:bg-accent-hover">
                    Get Started — it's free
                    <x-icon name="arrow-right" class="h-5 w-5" />
                </a>
            </div>
        </section>

    </body>

</html>
