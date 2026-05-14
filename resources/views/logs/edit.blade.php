<x-app-layout>

    {{-- EasyMDE --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

    <div class="dash-card max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('logs.index') }}" class="text-sm transition-colors duration-150" style="color:#8b7fa8"
                onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='#8b7fa8'">← Back</a>
            <h2 class="text-white font-bold text-lg" style="font-family:'Space Grotesk',sans-serif">
                Edit Log
            </h2>
        </div>

        <form method="POST" action="{{ route('logs.update', $log) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="auth-label">Title</label>
                <input type="text" name="title" value="{{ old('title', $log->title) }}"
                    placeholder="What did you work on today?" required class="auth-input w-full" />
                @error('title')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Topic + Mood row --}}
            <div class="flex gap-3 flex-wrap">

                {{-- Topic --}}
                <div class="relative flex-1 min-w-48" @click.outside="open = false" x-data="{
                    open: false,
                    selectedId: '{{ old('topic_id', $log->topic_id ?? '') }}',
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
                    <label class="auth-label">Topic <span style="color:#8b7fa8">(optional)</span></label>
                    <input type="hidden" name="topic_id" :value="selectedId || ''">
                    <button type="button" @click="open = !open"
                        class="auth-input w-full flex items-center justify-between gap-2 cursor-pointer">
                        <span x-text="selectedName" style="color:#f0ece8"></span>
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color:#8b7fa8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=" M19 9l-7
                    7-7-7" />
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

                {{-- Mood --}}
                <div x-data="{
                    mood: {{ old('mood', $log->mood) }},
                    emojis: { 1: '😴', 2: '😑', 3: '🤔', 4: '😄', 5: '⚡' }
                }">
                    <label class="auth-label">Mood</label>
                    <input type="hidden" name="mood" :value="mood">
                    <div class="flex items-center gap-2 h-10">
                        <template x-for="i in [1,2,3,4,5]" :key="i">
                            <button type="button" @click="mood = i"
                                class="text-2xl transition-all duration-150 leading-none select-none"
                                :class="mood === i ? 'scale-125 opacity-100' : 'opacity-35 hover:opacity-60'"
                                :title="`Mood ${i}/5`" x-text="emojis[i]">
                            </button>
                        </template>
                    </div>
                    @error('mood')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Body --}}
            <div>
                <label class="auth-label">Log Entry</label>
                <textarea name="body" id="log-body">{{ old('body', $log->body) }}</textarea>
                @error('body')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-sm font-semibold">
                    Save Changes
                </button>
                <a href="{{ route('logs.index') }}"
                    class="px-6 py-2 rounded-xl text-sm font-semibold transition-colors duration-150"
                    style="color:#8b7fa8;border:1px solid rgba(168,85,247,0.15)"
                    onmouseover="this.style.color='#f0ece8'" onmouseout="this.style.color='#8b7fa8'">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        const easyMDE = new EasyMDE({
            element: document.getElementById('log-body'),
            spellChecker: false,
            autosave: {
                enabled: false
            },
            toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link',
                'code', '|', 'preview', 'side-by-side', 'fullscreen'
            ],
            minHeight: '220px',
        });
    </script>

</x-app-layout>
