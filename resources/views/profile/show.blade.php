<x-public-layout>

    <div class="mx-auto max-w-2xl">
        <x-ui.card class="mb-4">
            <div class="mb-4 flex items-start gap-4">
                <div
                    class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full border border-accent/30 bg-accent/10 font-display text-xl font-bold text-accent">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h1 class="font-display text-xl font-bold text-gray-100">{{ $user->name }}</h1>
                            <p class="mt-0.5 text-sm text-gray-400">{{ '@' . $user->username }}</p>
                        </div>

                        @auth
                            @if (auth()->user()->username === $user->username)
                                <button id="share-btn" type="button"
                                    class="inline-flex flex-shrink-0 items-center justify-center rounded-lg bg-accent px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-accent-hover !px-4 !py-2 text-xs"
                                    onclick="
                    var btn = document.getElementById('share-btn').querySelector('span');
                    var url = window.location.href;
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(url).then(() => {
                            btn.innerText = 'Copied!';
                            setTimeout(() => btn.innerText = 'Share Profile', 2000);
                        });
                    } else {
                        var el = document.createElement('textarea');
                        el.value = url;
                        document.body.appendChild(el);
                        el.select();
                        document.execCommand('copy');
                        document.body.removeChild(el);
                        btn.innerText = 'Copied!';
                        setTimeout(() => btn.innerText = 'Share Profile', 2000);
                    }
                ">
                                    <x-icon name="link" class="h-3.5 w-3.5" />
                                    <span>Share Profile</span>
                                </button>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="inline-flex flex-shrink-0 items-center justify-center rounded-lg bg-accent px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-accent-hover !px-4 !py-2 text-xs">
                                Create your DevLog
                                <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                            </a>
                        @endauth
                    </div>

                    @if ($user->bio)
                        <p class="mt-3 text-sm leading-relaxed text-gray-300">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                @foreach ([
                    ['value' => $stats['logs'], 'label' => 'Logs'],
                    ['value' => $stats['active_topics'], 'label' => 'Active Topics'],
                    ['value' => $stats['completed_goals'], 'label' => 'Goals Done'],
                ] as $stat)
                    <div class="rounded-xl border border-white/[0.06] bg-white/[0.02] py-3 text-center">
                        <p class="font-display text-xl font-bold text-accent">{{ $stat['value'] }}</p>
                        <p class="mt-0.5 text-xs text-gray-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        @if ($topics->count())
            <x-ui.card class="mb-4">
                <h2 class="mb-4 font-display text-sm font-bold uppercase tracking-widest text-gray-400">Topics</h2>
                @foreach ($topics as $topic)
                    <div class="flex items-center gap-3 border-b border-white/[0.06] py-2.5 last:border-0">
                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg border"
                            style="background:{{ $topic->color }}18;border-color:{{ $topic->color }}33">
                            <i class="{{ $topic->icon ?? 'devicon-code-plain' }} text-base" style="color:{{ $topic->color }}"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium text-gray-200">{{ $topic->name }}</span>
                        <span class="rounded-md px-2 py-0.5 text-[10px] font-medium capitalize {{ match($topic->status) { 'active' => 'bg-accent/10 text-accent', 'paused' => 'bg-white/[0.06] text-gray-400', 'completed' => 'bg-emerald-500/10 text-emerald-400', default => '' } }}">
                            {{ $topic->status }}
                        </span>
                    </div>
                @endforeach
            </x-ui.card>
        @endif

        @if ($logs->count())
            <x-ui.card class="mb-4">
                <h2 class="mb-4 font-display text-sm font-bold uppercase tracking-widest text-gray-400">Recent Logs</h2>
                @foreach ($logs as $log)
                    <div class="flex items-start gap-3 border-b border-white/[0.06] py-3 last:border-0">
                        <div class="mt-1.5 h-2 w-2 flex-shrink-0 rounded-full"
                            style="background:{{ $log->topic?->color ?? '#71717a' }}"></div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-gray-200">{{ $log->title }}</p>
                            <p class="mt-0.5 flex items-center gap-1.5 text-xs text-gray-400">
                                {{ $log->topic?->name ?? 'No topic' }}
                                · {{ $log->created_at->diffForHumans() }}
                                · <x-mood-icon :level="$log->mood" class="h-3.5 w-3.5" />
                            </p>
                        </div>
                    </div>
                @endforeach
            </x-ui.card>
        @endif

        @if ($completedGoals->count())
            <x-ui.card class="mb-4">
                <h2 class="mb-4 font-display text-sm font-bold uppercase tracking-widest text-gray-400">Completed Goals</h2>
                @foreach ($completedGoals as $goal)
                    <div class="flex items-center gap-3 border-b border-white/[0.06] py-2.5 last:border-0">
                        <div class="flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-accent bg-accent">
                            <x-icon name="check" class="h-3 w-3 text-white" />
                        </div>
                        <span class="flex-1 text-sm text-gray-400 line-through">{{ $goal->title }}</span>
                        @if ($goal->topic)
                            <span class="rounded-full px-2 py-0.5 text-xs"
                                style="background:{{ $goal->topic->color }}18;color:{{ $goal->topic->color }};border:1px solid {{ $goal->topic->color }}33">
                                {{ $goal->topic->name }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </x-ui.card>
        @endif
    </div>

</x-public-layout>
