
<x-app-layout>

    <x-ui.card class="mx-auto max-w-2xl" x-data="{
        icon: '{{ $topic->icon ?? 'devicon-javascript-plain' }}',
        iconOpen: false,
        icons: [
            'devicon-javascript-plain', 'devicon-typescript-plain', 'devicon-python-plain',
            'devicon-react-original', 'devicon-vuejs-plain', 'devicon-laravel-plain',
            'devicon-nodejs-plain', 'devicon-php-plain', 'devicon-html5-plain',
            'devicon-css3-plain', 'devicon-sass-plain', 'devicon-tailwindcss-plain',
            'devicon-docker-plain', 'devicon-git-plain', 'devicon-github-original',
            'devicon-mysql-plain', 'devicon-postgresql-plain', 'devicon-mongodb-plain',
            'devicon-redis-plain', 'devicon-linux-plain', 'devicon-rust-plain',
            'devicon-go-plain', 'devicon-swift-plain', 'devicon-kotlin-plain',
            'devicon-java-plain', 'devicon-cplusplus-plain', 'devicon-ruby-plain',
            'devicon-figma-plain', 'devicon-vscode-plain', 'devicon-firebase-plain'
        ]
    }">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('topics.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 transition-colors hover:text-accent">
                <x-icon name="arrow-left" class="h-4 w-4" /> Back
            </a>
            <h2 class="font-display text-lg font-bold text-gray-100">Edit Topic</h2>
        </div>

        <form method="POST" action="{{ route('topics.update', $topic) }}">
            @csrf
            @method('PUT')
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.input type="text" name="name" placeholder="Topic name e.g. React"
                    value="{{ old('name', $topic->name) }}" required class="min-w-48 flex-1" />

                <div class="flex items-center gap-2">
                    @foreach (['#41b883', '#3178c6', '#f7df1e', '#8b5cf6'] as $c)
                        <label class="block h-6 w-6 cursor-pointer rounded-full border-2 border-transparent transition-all has-[:checked]:scale-110 has-[:checked]:border-white"
                            style="background:{{ $c }}">
                            <input type="radio" name="color" value="{{ $c }}" class="hidden"
                                {{ old('color', $topic->color) === $c ? 'checked' : '' }}>
                        </label>
                    @endforeach
                </div>

                <div class="relative" @click.outside="iconOpen = false">
                    <button type="button" @click="iconOpen = !iconOpen"
                        class="flex w-36 cursor-pointer items-center justify-between gap-2 rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm">
                        <span class="flex items-center gap-2">
                            <i :class="icon" class="text-base text-accent"></i>
                            <span x-text="icon.replace('devicon-','').replace('-plain','').replace('-original','')"
                                class="max-w-[64px] truncate text-xs capitalize text-gray-200"></span>
                        </span>
                        <span class="transition-transform" :class="iconOpen ? 'rotate-180' : ''">
                            <x-icon name="chevron-down" class="h-3 w-3 text-gray-400" />
                        </span>
                    </button>
                    <div x-show="iconOpen" x-transition
                        class="absolute z-50 mt-1 grid max-h-[200px] w-[220px] grid-cols-6 gap-1 overflow-y-auto rounded-xl border border-white/[0.06] bg-surface p-2 shadow-md [&::-webkit-scrollbar]:hidden"
                        style="scrollbar-width:none">
                        <template x-for="ic in icons" :key="ic">
                            <button type="button" @click="icon = ic; iconOpen = false"
                                class="flex items-center justify-center rounded-lg p-2 transition-colors"
                                :class="icon === ic ? 'bg-accent/10' : 'hover:bg-white/[0.04]'">
                                <i :class="ic" class="text-lg" :class="icon === ic ? 'text-accent' : 'text-gray-400'"></i>
                            </button>
                        </template>
                    </div>
                    <input type="hidden" name="icon" :value="icon" />
                </div>

                <div x-data="{ open: false, selected: '{{ old('status', $topic->status) }}', options: ['active', 'paused', 'completed'] }"
                    class="relative">
                    <input type="hidden" name="status" :value="selected">
                    <button type="button" @click="open = !open"
                        class="flex w-36 cursor-pointer items-center justify-between gap-2 rounded-lg border border-white/[0.06] bg-white/[0.03] px-3.5 py-2.5 text-sm capitalize text-gray-200">
                        <span x-text="selected"></span>
                        <x-icon name="chevron-down" class="h-4 w-4 text-gray-400" />
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition class="absolute left-0 top-[calc(100%+6px)] z-[999] w-full overflow-hidden rounded-lg border border-white/[0.06] bg-surface shadow-md">
                        <template x-for="option in options" :key="option">
                            <div @click="selected = option; open = false" class="cursor-pointer px-3.5 py-2.5 text-sm capitalize text-gray-400 transition-colors hover:bg-white/[0.04] hover:text-gray-200 capitalize"
                                :class="{ 'bg-accent/10 text-gray-200': selected === option }" x-text="option"></div>
                        </template>
                    </div>
                </div>

                <div class="flex items-center gap-3" x-data="{ progress: {{ $topic->progress }} }">
                    <input type="range" name="progress" min="0" max="100" x-model="progress" class="topic-slider" />
                    <span class="w-10 text-sm text-gray-400" x-text="progress + '%'"></span>
                </div>

                <x-ui.button-primary type="submit">Save Changes</x-ui.button-primary>
                <a href="{{ route('topics.index') }}" class="inline-flex items-center gap-1 px-4 py-2 text-sm text-gray-400 transition-colors hover:text-accent">Cancel</a>
            </div>
            @error('name')
                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
            @enderror
        </form>
    </x-ui.card>

</x-app-layout>
