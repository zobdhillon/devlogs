<x-app-layout>

    {{-- Greeting --}}
    <div class="dash-card flex justify-between items-center mb-4">
        <div>
            <h1 class="font-bold text-2xl text-white mb-1">{{ $greeting }}, {{ Auth::user()->name }} 👋</h1>
            <p class="text-sm" style="color:#8b7fa8">You've logged {{ $logsThisWeek }}
                {{ Str::plural('entry', $logsThisWeek) }} this week. Keep it up!</p>
        </div>
        <div class="dash-streak text-center">
            <div class="dash-streak-num">🔥 {{ $logsThisWeek }}</div>
            <div class="text-xs mt-1" style="color:#8b7fa8">this week</div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
        <div class="dash-card">
            <div class="text-lg mb-2">📚</div>
            <div class="text-xs uppercase tracking-wider mb-1" style="color:#8b7fa8">Active Topics</div>
            <div class="text-3xl font-bold"
                style="font-family:'Space Grotesk',sans-serif;color:#a855f7;text-shadow:0 0 16px rgba(168,85,247,0.4)">
                {{ $stats['topics'] }}</div>
        </div>
        <div class="dash-card">
            <div class="text-lg mb-2">📝</div>
            <div class="text-xs uppercase tracking-wider mb-1" style="color:#8b7fa8">Total Logs</div>
            <div class="text-3xl font-bold text-white" style="font-family:'Space Grotesk',sans-serif">
                {{ $stats['logs'] }}</div>
        </div>
        <div class="dash-card">
            <div class="text-lg mb-2">🎯</div>
            <div class="text-xs uppercase tracking-wider mb-1" style="color:#8b7fa8">Goals</div>
            <div class="text-3xl font-bold"
                style="font-family:'Space Grotesk',sans-serif;color:#f97316;text-shadow:0 0 16px rgba(249,115,22,0.4)">
                {{ $stats['goals'] }}</div>
        </div>
        <div class="dash-card">
            <div class="text-lg mb-2">🔗</div>
            <div class="text-xs uppercase tracking-wider mb-1" style="color:#8b7fa8">Resources</div>
            <div class="text-3xl font-bold text-white" style="font-family:'Space Grotesk',sans-serif">
                {{ $stats['resources'] }}</div>
        </div>
    </div>

    {{-- Topics + Logs --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

        {{-- Topics --}}

        <div class="dash-card" @click="window.location='{{ route('topics.index') }}'">
            <div class="flex justify-between items-center mb-4">
                <span class="font-bold text-white" style="font-family:'Space Grotesk',sans-serif">Active Topics</span>
                <a href="{{ route('topics.index') }}" class="dash-add-btn">+ Add topic</a>
            </div>
            @forelse($topics as $topic)
                <div class="flex items-center gap-3 py-2 border-b" style="border-color:rgba(168,85,247,0.08)">
                    {{-- Icon --}}
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                        style="background:{{ $topic->color }}18;border:1px solid {{ $topic->color }}33;">
                        <i class="{{ $topic->icon ?? 'devicon-code-plain' }} text-base"
                            style="color:{{ $topic->color }}"></i>
                    </div>

                    {{-- Name --}}
                    <span class="text-sm font-medium flex-1" style="color:#f0ece8">{{ $topic->name }}</span>

                    {{-- Progress bar --}}
                    <div class="flex items-center gap-2 w-28">
                        <div class="flex-1 h-1.5 rounded-full" style="background:rgba(168,85,247,0.1)">
                            <div class="h-full rounded-full"
                                style="width:{{ $topic->progress }}%;background:{{ $topic->color }};box-shadow:0 0 6px {{ $topic->color }}">
                            </div>
                        </div>
                        <span class="text-xs w-8 text-right" style="color:#8b7fa8">{{ $topic->progress }}%</span>
                    </div>
                </div>
            @empty
                <p class="text-sm py-2" style="color:#8b7fa8">No active topics yet. </p>
            @endforelse
        </div>

        {{-- Logs --}}
        <div class="dash-card" @click="window.location='{{ route('logs.index') }}'">
            <div class="flex justify-between items-center mb-4">
                <span class="font-bold text-white" style="font-family:'Space Grotesk',sans-serif">Recent Logs</span>
                <a href="{{ route('logs.create') }}" class="dash-add-btn">+ New log</a>
            </div>
            @forelse($logs as $log)
                <div class="py-2 border-b" style="border-color:rgba(168,85,247,0.08)">
                    <div class="text-sm mb-1" style="color:#f0ece8">{{ $log->title }}</div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs" style="color:#8b7fa8">{{ $log->created_at->diffForHumans() }}</span>
                        <span>{{ ['😞', '😐', '🙂', '😊', '🔥'][$log->mood - 1] }}</span>
                    </div>
                </div>
            @empty
                <p class="text-sm py-2" style="color:#8b7fa8">No logs yet. Start journaling!</p>
            @endforelse
        </div>

    </div>

    {{-- Goals --}}
    <div class="dash-card" @click="window.location='{{ route('goals.index') }}'">
        <div class="flex justify-between items-center mb-4">
            <span class="font-bold text-white" style="font-family:'Space Grotesk',sans-serif">Goals</span>
            <a href="{{ route('goals.index') }}" class="dash-add-btn">+ Add goal</a>
        </div>
        @forelse($goals as $goal)
            <div id="dash-goal-{{ $goal->id }}" class="flex items-center gap-3 py-2 border-b"
                style="border-color:rgba(168,85,247,0.08)">

                {{-- Toggle button --}}
                <button type="button" id="dash-goal-toggle-{{ $goal->id }}"
                    onclick="toggleGoal({{ $goal->id }})"
                    class="w-4 h-4 rounded flex items-center justify-center flex-shrink-0 transition-all duration-150"
                    style="{{ $goal->is_completed
                        ? 'background:#7c3aed;border:1.5px solid #7c3aed;box-shadow:0 0 8px rgba(124,58,237,0.4)'
                        : 'background:transparent;border:1.5px solid rgba(168,85,247,0.4)' }}">
                    @if ($goal->is_completed)
                        <svg class="w-2.5 h-2.5" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                </button>

                <span id="dash-goal-title-{{ $goal->id }}" class="text-sm flex-1"
                    style="color:{{ $goal->is_completed ? '#8b7fa8' : '#f0ece8' }};
                       text-decoration:{{ $goal->is_completed ? 'line-through' : 'none' }}">
                    {{ $goal->title }}
                </span>

                <span class="text-xs" style="color:{{ $goal->is_completed ? '#a855f7' : '#8b7fa8' }}">
                    {{ $goal->is_completed ? 'Done ✓' : ($goal->deadline ? \Carbon\Carbon::parse($goal->deadline)->format('M d') : '—') }}
                </span>
            </div>
        @empty
            <p class="text-sm py-2" style="color:#8b7fa8">No goals yet. Set your first goal!</p>
        @endforelse
    </div>

    {{-- Resources --}}
    <div class="dash-card" style="margin-top:1rem;" x-data @click="window.location='{{ route('resources.index') }}'"
        style="cursor:pointer">
        <div class="flex justify-between items-center mb-4">
            <span class="font-bold text-white" style="font-family:'Space Grotesk',sans-serif">Recent Resources</span>
            <a href="{{ route('resources.index') }}" class="dash-add-btn" @click.stop>+ Add resource</a>
        </div>
        @forelse($resources as $resource)
            @php
                $badgeStyles = [
                    'video' => 'background:rgba(249,115,22,0.15);color:rgba(249,115,22,1);',
                    'article' => 'background:rgba(168,85,247,0.15);color:rgba(168,85,247,1);',
                    'course' => 'background:rgba(34,197,94,0.15);color:rgba(34,197,94,1);',
                    'docs' => 'background:rgba(59,130,246,0.15);color:rgba(59,130,246,1);',
                ];
            @endphp
            <div class="flex items-center gap-3 py-2 border-b" style="border-color:rgba(168,85,247,0.08)">
                <span class="dash-badge" style="{{ $badgeStyles[$resource->type] ?? '' }}">
                    {{ ucfirst($resource->type) }}
                </span>
                <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer" class="text-sm flex-1"
                    style="color:#f0ece8;text-decoration:none;" @click.stop
                    onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    {{ $resource->title }}
                </a>
                @if ($resource->topic)
                    <span class="dash-badge dash-badge-active" @click.stop>{{ $resource->topic->name }}</span>
                @endif
            </div>
        @empty
            <p class="text-sm py-2" style="color:#8b7fa8">No resources yet.</p>
        @endforelse
    </div>

</x-app-layout>
