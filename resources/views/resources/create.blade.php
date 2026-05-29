
<x-app-layout>

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('resources.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 transition-colors hover:text-accent">
            <x-icon name="arrow-left" class="h-4 w-4" /> Back
        </a>
        <h1 class="font-display text-lg font-bold text-gray-100">Add Resource</h1>
    </div>

    <x-ui.card x-data="{
        type: '{{ old('type', '') }}',
        typeOpen: false,
        topicId: '{{ old('topic_id', '') }}',
        topicOpen: false,
    }">
        <form method="POST" action="{{ route('resources.store') }}" class="space-y-5">
            @csrf

            <div>
                <x-ui.label for="title">Title</x-ui.label>
                <x-ui.input id="title" name="title" type="text" value="{{ old('title') }}"
                    placeholder="e.g. Laravel Docs, JS Course on YouTube" required autofocus />
                @error('title')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-ui.label for="url">URL</x-ui.label>
                <x-ui.input id="url" name="url" type="url" value="{{ old('url') }}" placeholder="https://..." required />
                @error('url')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-ui.label>Type</x-ui.label>
                <div class="relative" @click.outside="typeOpen = false">
                    <button type="button" @click="typeOpen = !typeOpen"
                        class="flex w-full cursor-pointer items-center justify-between rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm text-gray-200">
                        <span x-text="type ? type.charAt(0).toUpperCase() + type.slice(1) : 'Select type'"></span>
                        <x-icon name="chevron-down" class="h-4 w-4 text-gray-400" />
                    </button>
                    <div x-show="typeOpen" x-transition x-cloak class="absolute left-0 top-[calc(100%+6px)] z-[999] w-full overflow-hidden rounded-lg border border-white/[0.06] bg-surface shadow-md">
                        @foreach (['video', 'article', 'course', 'docs'] as $opt)
                            <div class="cursor-pointer px-3.5 py-2.5 text-sm capitalize text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200" :class="{ 'bg-accent/10 text-gray-200': type === '{{ $opt }}' }"
                                @click="type = '{{ $opt }}'; typeOpen = false">{{ ucfirst($opt) }}</div>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="type" :value="type">
                @error('type')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-ui.label>Topic <span class="text-gray-500">(optional)</span></x-ui.label>
                @php $topicMap = $topics->pluck('name', 'id'); @endphp
                <div class="relative" @click.outside="topicOpen = false">
                    <button type="button" @click="topicOpen = !topicOpen"
                        class="flex w-full cursor-pointer items-center justify-between rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm text-gray-200">
                        <span x-text="topicId && {{ $topicMap->toJson() }}[topicId] ? {{ $topicMap->toJson() }}[topicId] : 'No topic'"></span>
                        <x-icon name="chevron-down" class="h-4 w-4 text-gray-400" />
                    </button>
                    <div x-show="topicOpen" x-transition x-cloak class="absolute left-0 top-[calc(100%+6px)] z-[999] w-full overflow-hidden rounded-lg border border-white/[0.06] bg-surface shadow-md">
                        <div class="cursor-pointer px-3.5 py-2.5 text-sm capitalize text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200" :class="{ 'bg-accent/10 text-gray-200': topicId === '' }"
                            @click="topicId = ''; topicOpen = false">No topic</div>
                        @foreach ($topics as $topic)
                            <div class="cursor-pointer px-3.5 py-2.5 text-sm capitalize text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200" :class="{ 'bg-accent/10 text-gray-200': topicId === '{{ $topic->id }}' }"
                                @click="topicId = '{{ $topic->id }}'; topicOpen = false">{{ $topic->name }}</div>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="topic_id" :value="topicId || ''">
                @error('topic_id')
                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <x-ui.button-primary type="submit">Save Resource</x-ui.button-primary>
        </form>
    </x-ui.card>

</x-app-layout>
