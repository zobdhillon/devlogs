<x-app-layout>

    {{-- Add Goal Form --}}
    <div class="dash-card mb-4" x-data="{
        open: false,
        selectedId: '',
        selectedName: 'No topic',
        topics: [],
        init() {
            this.topics = JSON.parse(this.$el.dataset.topics);
        }
    }"
        data-topics="{{ auth()->user()->topics()->orderBy('name')->get()->map(fn($t) => ['id' => $t->id, 'name' => $t->name, 'color' => $t->color])->toJson() }}">

        <h2 class="text-white font-bold text-lg mb-4" style="font-family:'Space Grotesk',sans-serif">Add New Goal</h2>

        <form method="POST" action="{{ route('goals.store') }}">
            @csrf
            <div class="flex flex-wrap gap-3 items-center">

                {{-- Title --}}
                <input type="text" name="title" placeholder="e.g. Finish Laravel API" value="{{ old('title') }}"
                    required class="auth-input flex-1 min-w-48" />

                {{-- Topic dropdown --}}
                <div class="relative" @click.outside="open = false">
                    <input type="hidden" name="topic_id" :value="selectedId">
                    <button type="button" @click="open = !open"
                        class="auth-input w-40 flex items-center justify-between gap-2 cursor-pointer">
                        <span x-text="selectedName" class="truncate text-sm" style="color:#f0ece8"></span>
                        <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-150"
                            :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color:#8b7fa8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="custom-select-dropdown">
                        <div @click="selectedId = ''; selectedName = 'No topic'; open = false"
                            class="custom-select-option"
                            :class="{ 'custom-select-option-active': selectedId === '' }">
                            No topic
                        </div>
                        <template x-for="topic in topics" :key="topic.id">
                            <div @click="selectedId = topic.id; selectedName = topic.name; open = false"
                                class="custom-select-option flex items-center gap-2"
                                :class="{ 'custom-select-option-active': selectedId == topic.id }">
                                <span class="w-2 h-2 rounded-full flex-shrink-0"
                                    :style="`background:${topic.color}`"></span>
                                <span x-text="topic.name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Deadline --}}
                <input type="date" name="deadline" value="{{ old('deadline') }}" class="auth-input w-40" />

                {{-- Submit --}}
                <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-sm font-semibold">
                    Add Goal
                </button>
            </div>
            @error('title')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
        </form>
    </div>

    {{-- Goals List --}}
    <div class="dash-card">
        <h2 class="text-white font-bold text-lg mb-4" style="font-family:'Space Grotesk',sans-serif">Your Goals</h2>

        @forelse($goals as $goal)
            <div id="goal-{{ $goal->id }}" class="flex items-center gap-3 py-3 border-b"
                style="border-color:rgba(168,85,247,0.08)">

                <button type="button" id="goal-toggle-{{ $goal->id }}" onclick="toggleGoal({{ $goal->id }})"
                    class="w-5 h-5 rounded flex items-center justify-center transition-all duration-150 border flex-shrink-0"
                    style="{{ $goal->is_completed
                        ? 'background:#7c3aed;border-color:#7c3aed;box-shadow:0 0 8px rgba(124,58,237,0.4)'
                        : 'background:transparent;border-color:rgba(168,85,247,0.4)' }}">
                    @if ($goal->is_completed)
                        <svg class="w-3 h-3" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                </button>

                <span id="goal-title-{{ $goal->id }}" class="flex-1 text-sm font-medium"
                    style="{{ $goal->is_completed ? 'color:#8b7fa8;text-decoration:line-through' : 'color:#f0ece8' }}">
                    {{ $goal->title }}
                </span>

                {{-- Topic badge --}}
                @if ($goal->topic)
                    <span class="text-xs px-2 py-0.5 rounded-full flex-shrink-0"
                        style="background:{{ $goal->topic->color }}18;color:{{ $goal->topic->color }};border:1px solid {{ $goal->topic->color }}33">
                        {{ $goal->topic->name }}
                    </span>
                @endif

                {{-- Deadline --}}
                @if ($goal->deadline)
                    <span class="text-xs flex-shrink-0"
                        style="color:{{ $goal->is_completed ? '#8b7fa8' : ($goal->deadline->isPast() ? '#f43f5e' : '#8b7fa8') }}">
                        {{ $goal->deadline->format('M d') }}
                    </span>
                @endif

                <a href="{{ route('goals.edit', $goal) }}" class="topic-action-btn">Edit</a>

                <button type="button" class="topic-action-btn topic-delete-btn"
                    @click="$dispatch('confirm-delete', {
                        title: 'Delete this goal?',
                        callback: () => deleteRecord('goals', {{ $goal->id }})
                    })">
                    Delete
                </button>

            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-4xl mb-3">🎯</div>
                <p class="text-sm mb-1" style="color:#f0ece8">No goals yet</p>
                <p class="text-xs" style="color:#8b7fa8">Set your first learning goal above</p>
            </div>
        @endforelse
    </div>

</x-app-layout>
