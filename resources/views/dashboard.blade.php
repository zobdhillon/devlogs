<x-app-layout>

    <x-ui.card class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="mb-1 flex items-center gap-2 font-display text-2xl font-bold text-gray-100">
                {{ $greeting }}, {{ Auth::user()->name }}
            </h1>
            <p class="text-sm text-gray-400">You've logged {{ $logsThisWeek }}
                {{ Str::plural('entry', $logsThisWeek) }} this week. Keep it up!</p>
        </div>
        <div class="rounded-lg border border-white/[0.06] bg-white/[0.02] px-5 py-3 text-center">
            <div class="flex items-center justify-center gap-1.5 font-display text-2xl font-bold text-accent">
                <x-icon name="flame" class="h-5 w-5" />
                {{ $logsThisWeek }}
            </div>
            <div class="mt-1 text-xs text-gray-400">this week</div>
        </div>
    </x-ui.card>

    <div class="mb-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
        @foreach ([
            ['icon' => 'book-open', 'label' => 'Active Topics', 'value' => $stats['topics'], 'accent' => true],
            ['icon' => 'file-text', 'label' => 'Total Logs', 'value' => $stats['logs'], 'accent' => false],
            ['icon' => 'target', 'label' => 'Goals', 'value' => $stats['goals'], 'accent' => true],
            ['icon' => 'link', 'label' => 'Resources', 'value' => $stats['resources'], 'accent' => false],
        ] as $stat)
            <x-ui.card>
                <x-icon :name="$stat['icon']" class="mb-3 h-5 w-5 text-gray-500" />
                <div class="mb-1 text-xs uppercase tracking-wider text-gray-400">{{ $stat['label'] }}</div>
                <div @class([
                    'font-display text-3xl font-bold',
                    'text-accent' => $stat['accent'],
                    'text-gray-100' => ! $stat['accent'],
                ])>{{ $stat['value'] }}</div>
            </x-ui.card>
        @endforeach
    </div>

    <x-ui.card class="mb-6 mt-6" x-data="{ loading: false, insights: '', error: '' }">
        <div class="mb-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <x-icon name="bot" class="h-5 w-5 text-gray-500" />
                <h3 class="text-sm font-semibold uppercase tracking-widest text-gray-400">AI Insights</h3>
            </div>
            <button type="button" class="rounded-md border border-accent/20 bg-accent/10 px-2.5 py-1 text-xs font-medium text-accent transition-colors hover:bg-accent/15" :disabled="loading"
                @click="
                loading = true;
                insights = '';
                error = '';
                fetch('/ai/insights', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(d => { insights = d.insights; loading = false; })
                .catch(() => { error = 'Failed to load insights.'; loading = false; })
            ">
                <span x-show="!loading" class="inline-flex items-center gap-1">
                    <x-icon name="sparkles" class="h-3.5 w-3.5" /> Generate
                </span>
                <span x-show="loading">Thinking...</span>
            </button>
        </div>

        <div x-show="loading" class="text-sm text-gray-400">Analyzing your learning activity...</div>

        <div x-show="insights" class="space-y-3 text-sm leading-relaxed text-gray-200" x-html="insights
        .replace(/\*\*(.*?)\*\*/g, '<span class=\'font-semibold text-accent block mt-3\'>$1</span>')
        .replace(/•/g, '<span class=\'text-accent\'>•</span>')
        .replace(/\n/g, '<br>')
    "></div>

        <div x-show="error" class="text-sm text-rose-400" x-text="error"></div>

        <p x-show="!insights && !loading && !error" class="text-sm text-gray-400">
            Click Generate to get personalized learning insights powered by AI.
        </p>
    </x-ui.card>

    <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

        <x-ui.card class="cursor-pointer" @click="window.location='{{ route('topics.index') }}'">
            <div class="mb-4 flex items-center justify-between">
                <span class="font-display font-bold text-gray-100">Active Topics</span>
                <a href="{{ route('topics.index') }}" class="rounded-md border border-accent/20 bg-accent/10 px-2.5 py-1 text-xs font-medium text-accent transition-colors hover:bg-accent/15" @click.stop>+ Add topic</a>
            </div>
            @forelse($topics as $topic)
                <div class="border-b border-white/[0.06] flex items-center gap-3 py-2 last:border-0">
                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg border"
                        style="background:{{ $topic->color }}18;border-color:{{ $topic->color }}33;">
                        <i class="{{ $topic->icon ?? 'devicon-code-plain' }} text-base"
                            style="color:{{ $topic->color }}"></i>
                    </div>
                    <span class="flex-1 text-sm font-medium text-gray-200">{{ $topic->name }}</span>
                    <div class="flex w-28 items-center gap-2">
                        <div class="h-1.5 flex-1 rounded-full bg-white/[0.06]">
                            <div class="h-full rounded-full" style="width:{{ $topic->progress }}%;background:{{ $topic->color }}"></div>
                        </div>
                        <span class="w-8 text-right text-xs text-gray-400">{{ $topic->progress }}%</span>
                    </div>
                </div>
            @empty
                <p class="py-2 text-sm text-gray-400">No active topics yet.</p>
            @endforelse
        </x-ui.card>

        <x-ui.card class="cursor-pointer" @click="window.location='{{ route('logs.index') }}'">
            <div class="mb-4 flex items-center justify-between">
                <span class="font-display font-bold text-gray-100">Recent Logs</span>
                <a href="{{ route('logs.create') }}" class="rounded-md border border-accent/20 bg-accent/10 px-2.5 py-1 text-xs font-medium text-accent transition-colors hover:bg-accent/15" @click.stop>+ New log</a>
            </div>
            @forelse($logs as $log)
                <div class="border-b border-white/[0.06] py-2 last:border-0">
                    <div class="mb-1 text-sm text-gray-200">{{ $log->title }}</div>
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <span>{{ $log->created_at->diffForHumans() }}</span>
                        <x-mood-icon :level="$log->mood" class="h-3.5 w-3.5 text-gray-500" />
                    </div>
                </div>
            @empty
                <p class="py-2 text-sm text-gray-400">No logs yet. Start journaling!</p>
            @endforelse
        </x-ui.card>

    </div>

    <x-ui.card class="cursor-pointer" @click="window.location='{{ route('goals.index') }}'">
        <div class="mb-4 flex items-center justify-between">
            <span class="font-display font-bold text-gray-100">Goals</span>
            <a href="{{ route('goals.index') }}" class="rounded-md border border-accent/20 bg-accent/10 px-2.5 py-1 text-xs font-medium text-accent transition-colors hover:bg-accent/15" @click.stop>+ Add goal</a>
        </div>
        @forelse($goals as $goal)
            <div id="dash-goal-{{ $goal->id }}" class="border-b border-white/[0.06] flex items-center gap-3 py-2 last:border-0">
                <button type="button" id="dash-goal-toggle-{{ $goal->id }}" onclick="toggleGoal({{ $goal->id }})"
                    @class([
                        'flex h-4 w-4 flex-shrink-0 items-center justify-center rounded border transition-colors',
                        'border-accent bg-accent' => $goal->is_completed,
                        'border-accent/40 bg-transparent' => ! $goal->is_completed,
                    ])>
                    @if ($goal->is_completed)
                        <x-icon name="check" class="h-2.5 w-2.5 text-white" />
                    @endif
                </button>
                <span id="dash-goal-title-{{ $goal->id }}" @class([
                    'flex-1 text-sm',
                    'text-gray-400 line-through' => $goal->is_completed,
                    'text-gray-200' => ! $goal->is_completed,
                ])>{{ $goal->title }}</span>
                <span @class([
                    'text-xs',
                    'text-accent' => $goal->is_completed,
                    'text-gray-400' => ! $goal->is_completed,
                ])>
                    {{ $goal->is_completed ? 'Done' : ($goal->deadline ? \Carbon\Carbon::parse($goal->deadline)->format('M d') : '—') }}
                </span>
            </div>
        @empty
            <p class="py-2 text-sm text-gray-400">No goals yet. Set your first goal!</p>
        @endforelse
    </x-ui.card>

    <x-ui.card class="mt-4 cursor-pointer" @click="window.location='{{ route('resources.index') }}'">
        <div class="mb-4 flex items-center justify-between">
            <span class="font-display font-bold text-gray-100">Recent Resources</span>
            <a href="{{ route('resources.index') }}" class="rounded-md border border-accent/20 bg-accent/10 px-2.5 py-1 text-xs font-medium text-accent transition-colors hover:bg-accent/15" @click.stop>+ Add resource</a>
        </div>
        @forelse($resources as $resource)
            <div class="border-b border-white/[0.06] flex items-center gap-3 py-2 last:border-0">
                <span class="rounded-md px-2 py-0.5 text-[10px] font-medium {{ match($resource->type) { 'video' => 'bg-accent/10 text-accent', 'article' => 'bg-white/[0.06] text-gray-300', 'course' => 'bg-emerald-500/10 text-emerald-400', 'docs' => 'bg-sky-500/10 text-sky-400', default => 'bg-white/[0.06] text-gray-400' } }}">
                    {{ ucfirst($resource->type) }}
                </span>
                <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer"
                    class="flex-1 text-sm text-gray-200 hover:underline" @click.stop>
                    {{ $resource->title }}
                </a>
                @if ($resource->topic)
                    <span class="rounded-md bg-accent/10 px-2 py-0.5 text-[10px] font-medium text-accent" @click.stop>
                        {{ $resource->topic->name }}
                    </span>
                @endif
            </div>
        @empty
            <p class="py-2 text-sm text-gray-400">No resources yet.</p>
        @endforelse
    </x-ui.card>

</x-app-layout>
