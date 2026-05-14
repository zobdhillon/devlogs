<x-app-layout>

    <div class="dash-card max-w-2xl mx-auto" x-data="{
        open: false,
        selectedId: '{{ old('topic_id', $goal->topic_id ?? '') }}',
        selectedName: 'No topic',
        topics: [],
        init() {
            this.topics = JSON.parse(this.$el.dataset.topics);
            if (this.selectedId) {
                const t = this.topics.find(t => t.id == this.selectedId);
                if (t) this.selectedName = t.name;
            }
        }
    }"
        data-topics="{{ $topics->map(fn($t) => ['id' => $t->id, 'name' => $t->name, 'color' => $t->color])->toJson() }}">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('goals.index') }}" class="text-sm transition-colors duration-150" style="color:#8b7fa8"
                onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='#8b7fa8'">← Back</a>
            <h2 class="text-white font-bold text-lg" style="font-family:'Space Grotesk',sans-serif">
                Edit Goal
            </h2>
        </div>

        <form method="POST" action="{{ route('goals.update', $goal) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="auth-label">Goal</label>
                <input type="text" name="title" value="{{ old('title', $goal->title) }}"
                    placeholder="e.g. Finish Laravel API" required class="auth-input w-full" />
                @error('title')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Topic + Deadline row --}}
            <div class="flex gap-3 flex-wrap">

                {{-- Topic --}}
                <div class="relative flex-1 min-w-48" @click.outside="open = false">
                    <label class="auth-label">Topic <span style="color:#8b7fa8">(optional)</span></label>
                    <input type="hidden" name="topic_id" :value="selectedId">
                    <button type="button" @click="open = !open"
                        class="auth-input w-full flex items-center justify-between gap-2 cursor-pointer">
                        <span x-text="selectedName" style="color:#f0ece8"></span>
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
                <div>
                    <label class="auth-label">Deadline <span style="color:#8b7fa8">(optional)</span></label>
                    <input type="date" name="deadline"
                        value="{{ old('deadline', $goal->deadline?->format('Y-m-d')) }}" class="auth-input w-40" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-sm font-semibold">
                    Save Changes
                </button>
                <a href="{{ route('goals.index') }}"
                    class="px-6 py-2 rounded-xl text-sm font-semibold transition-colors duration-150"
                    style="color:#8b7fa8;border:1px solid rgba(168,85,247,0.15)"
                    onmouseover="this.style.color='#f0ece8'" onmouseout="this.style.color='#8b7fa8'">
                    Cancel
                </a>
            </div>
        </form>

    </div>

</x-app-layout>
