
<x-app-layout>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

    <x-ui.card class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('logs.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 transition-colors hover:text-accent">
                <x-icon name="arrow-left" class="h-4 w-4" /> Back
            </a>
            <h2 class="font-display text-lg font-bold text-gray-100">New Log</h2>
        </div>

        <form method="POST" action="{{ route('logs.store') }}" class="space-y-5">
            @csrf

            <div>
                <x-ui.label>Title</x-ui.label>
                <x-ui.input type="text" name="title" value="{{ old('title') }}"
                    placeholder="What did you work on today?" required />
                @error('title')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap gap-3">
                <div class="relative min-w-48 flex-1" @click.outside="open = false" x-data="{
                    open: false,
                    selectedId: '{{ old('topic_id', '') }}',
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
                    <x-ui.label>Topic <span class="text-gray-500">(optional)</span></x-ui.label>
                    <input type="hidden" name="topic_id" :value="selectedId">
                    <button type="button" @click="open = !open"
                        class="flex w-full cursor-pointer items-center justify-between gap-2 rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm text-gray-200 transition-colors focus:border-accent/50 focus:outline-none focus:ring-2 focus:ring-accent/20">
                        <span x-text="selectedName"></span>
                        <span class="transition-transform" :class="open ? 'rotate-180' : ''">
                            <x-icon name="chevron-down" class="h-4 w-4 flex-shrink-0 text-gray-400" />
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

                <x-mood-picker :value="old('mood', 3)" />
            </div>

            <div>
                <x-ui.label>Log Entry</x-ui.label>
                <textarea name="body" id="log-body" placeholder="Write your log here...">{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <x-ui.button-primary type="submit">Save Log</x-ui.button-primary>
                <a href="{{ route('logs.index') }}" class="inline-flex items-center gap-1 px-4 py-2 text-sm text-gray-400 transition-colors hover:text-accent">Cancel</a>
            </div>
        </form>
    </x-ui.card>

    <script>
        const easyMDE = new EasyMDE({
            element: document.getElementById('log-body'),
            spellChecker: false,
            autosave: { enabled: false },
            placeholder: 'Write your log here... Markdown supported.',
            toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'code', '|', 'preview', 'side-by-side', 'fullscreen'],
            minHeight: '220px',
        });
    </script>

</x-app-layout>
