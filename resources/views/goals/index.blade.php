
<x-app-layout>

    <x-ui.card class="mb-4" x-data="{
        open: false,
        selectedId: '',
        selectedName: 'No topic',
        topics: [],
        init() {
            this.topics = JSON.parse(this.$el.dataset.topics);
        }
    }"
        data-topics="{{ auth()->user()->topics()->orderBy('name')->get()->map(fn($t) => ['id' => $t->id, 'name' => $t->name, 'color' => $t->color])->toJson() }}">
        <h2 class="mb-4 font-display text-lg font-bold text-gray-100">Add New Goal</h2>

        <form method="POST" action="{{ route('goals.store') }}">
            @csrf
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.input type="text" name="title" placeholder="e.g. Finish Laravel API" value="{{ old('title') }}"
                    required class="min-w-48 flex-1" />

                <div class="relative" @click.outside="open = false">
                    <input type="hidden" name="topic_id" :value="selectedId">
                    <button type="button" @click="open = !open"
                        class="flex w-40 cursor-pointer items-center justify-between gap-2 rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm">
                        <span x-text="selectedName" class="truncate text-gray-200"></span>
                        <span class="transition-transform" :class="open ? 'rotate-180' : ''">
                            <x-icon name="chevron-down" class="h-4 w-4 text-gray-400" />
                        </span>
                    </button>
                    <div x-show="open" x-transition class="absolute left-0 top-[calc(100%+6px)] z-[999] w-full overflow-hidden rounded-lg border border-white/[0.06] bg-surface shadow-md">
                        <div @click="selectedId = ''; selectedName = 'No topic'; open = false"
                            class="cursor-pointer px-3.5 py-2.5 text-sm capitalize text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200" :class="{ 'bg-accent/10 text-gray-200': selectedId === '' }">No topic</div>
                        <template x-for="topic in topics" :key="topic.id">
                            <div @click="selectedId = topic.id; selectedName = topic.name; open = false"
                                class="cursor-pointer px-3.5 py-2.5 text-sm capitalize text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200 flex items-center gap-2"
                                :class="{ 'bg-accent/10 text-gray-200': selectedId == topic.id }">
                                <span class="h-2 w-2 flex-shrink-0 rounded-full" :style="`background:${topic.color}`"></span>
                                <span x-text="topic.name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <x-ui.input type="date" name="deadline" value="{{ old('deadline') }}" class="w-40" />

                <x-ui.button-primary type="submit">Add Goal</x-ui.button-primary>
            </div>
            @error('title')
                <p class="mt-2 text-xs text-rose-400">{{ $message }}</p>
            @enderror
        </form>
    </x-ui.card>

    <x-ui.card>
        <h2 class="mb-4 font-display text-lg font-bold text-gray-100">Your Goals</h2>

        @forelse($goals as $goal)
            <div id="goal-{{ $goal->id }}"
                class="flex items-center gap-3 border-b border-white/[0.06] py-3 last:border-0">
                <button type="button" id="goal-toggle-{{ $goal->id }}" onclick="toggleGoal({{ $goal->id }})"
                    @class([
                        'flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border transition-colors',
                        'border-accent bg-accent' => $goal->is_completed,
                        'border-accent/40 bg-transparent' => ! $goal->is_completed,
                    ])>
                    @if ($goal->is_completed)
                        <x-icon name="check" class="h-3 w-3 text-white" />
                    @endif
                </button>

                <span id="goal-title-{{ $goal->id }}" @class([
                    'flex-1 text-sm font-medium',
                    'text-gray-400 line-through' => $goal->is_completed,
                    'text-gray-200' => ! $goal->is_completed,
                ])>{{ $goal->title }}</span>

                @if ($goal->topic)
                    <span class="flex-shrink-0 rounded-full px-2 py-0.5 text-xs"
                        style="background:{{ $goal->topic->color }}18;color:{{ $goal->topic->color }};border:1px solid {{ $goal->topic->color }}33">
                        {{ $goal->topic->name }}
                    </span>
                @endif

                @if ($goal->deadline)
                    <span class="flex-shrink-0 text-xs {{ $goal->is_completed ? 'text-gray-400' : ($goal->deadline->isPast() ? 'text-rose-400' : 'text-gray-400') }}">
                        {{ $goal->deadline->format('M d') }}
                    </span>
                @endif

                <a href="{{ route('goals.edit', $goal) }}" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Edit</a>
                <button type="button" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:border-rose-500/30 hover:bg-rose-500/10 hover:text-rose-400"
                    @click="$dispatch('confirm-delete', {
                        title: 'Delete this goal?',
                        callback: () => deleteRecord('goals', {{ $goal->id }})
                    })">
                    Delete
                </button>
            </div>
        @empty
            <div class="py-12 text-center">
                <x-icon name="target" class="mx-auto mb-3 h-10 w-10 text-gray-500" />
                <p class="mb-1 text-sm text-gray-200">No goals yet</p>
                <p class="text-xs text-gray-400">Set your first learning goal above</p>
            </div>
        @endforelse
    </x-ui.card>

</x-app-layout>
