<x-app-layout>

    <x-ui.card class="mb-4" x-data="{
        icon: 'devicon-javascript-plain',
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
        <h2 class="mb-4 font-display text-lg font-bold text-gray-100">Add New Topic</h2>
        <form method="POST" action="{{ route('topics.store') }}">
            @csrf
            <div class="flex flex-wrap items-center gap-3">
                <x-ui.input type="text" name="name" placeholder="Topic name e.g. React" value="{{ old('name') }}"
                    required class="min-w-48 flex-1" />

                <div class="flex items-center gap-2">
                    @foreach (['#41b883', '#3178c6', '#f7df1e', '#8b5cf6'] as $c)
                        <label class="block h-6 w-6 cursor-pointer rounded-full border-2 border-transparent transition-all has-[:checked]:scale-110 has-[:checked]:border-white"
                            style="background:{{ $c }}">
                            <input type="radio" name="color" value="{{ $c }}" class="hidden"
                                {{ old('color', '#8b5cf6') === $c ? 'checked' : '' }}>
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
                                :class="icon === ic ? 'bg-accent/10' : 'hover:bg-white/[0.04]'"
                                :title="ic.replace('devicon-', '').replace('-plain', '').replace('-original', '')">
                                <i :class="ic" class="text-lg" :class="icon === ic ? 'text-accent' : 'text-gray-400'"></i>
                            </button>
                        </template>
                    </div>
                    <input type="hidden" name="icon" :value="icon" />
                </div>

                <div x-data="{ open: false, selected: '{{ old('status', 'active') }}', options: ['active', 'paused', 'completed'] }"
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

                <div class="flex items-center gap-3" x-data="{ progress: {{ old('progress', 0) }} }">
                    <input type="range" name="progress" min="0" max="100" x-model="progress" class="topic-slider" />
                    <span class="w-10 text-sm text-gray-400" x-text="progress + '%'"></span>
                </div>

                <x-ui.button-primary type="submit">Add Topic</x-ui.button-primary>
            </div>
            @error('name')
                <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
            @enderror
        </form>
    </x-ui.card>

    <x-ui.card>
        <h2 class="mb-4 font-display text-lg font-bold text-gray-100">Your Topics</h2>

        @forelse($topics as $topic)
            <div id="topic-{{ $topic->id }}"
                class="flex items-center gap-3 border-b border-white/[0.06] py-3 last:border-0">
                <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg border"
                    style="background:{{ $topic->color }}18;border-color:{{ $topic->color }}33;">
                    <i class="{{ $topic->icon ?? 'devicon-code-plain' }} text-base" style="color:{{ $topic->color }}"></i>
                </div>

                <span class="flex-1 text-sm font-medium text-gray-200">{{ $topic->name }}</span>

                <span class="rounded-md px-2 py-0.5 text-[10px] font-medium capitalize {{ match($topic->status) { 'active' => 'bg-accent/10 text-accent', 'paused' => 'bg-white/[0.06] text-gray-400', 'completed' => 'bg-emerald-500/10 text-emerald-400', default => 'bg-white/[0.06] text-gray-400' } }}">
                    {{ $topic->status }}
                </span>

                <div class="flex w-28 items-center gap-2">
                    <div class="h-1.5 flex-1 rounded-full bg-white/[0.06]">
                        <div class="h-full rounded-full transition-all"
                            style="width:{{ $topic->progress }}%;background:{{ $topic->color }}"></div>
                    </div>
                    <span class="w-8 text-right text-xs text-gray-400">{{ $topic->progress }}%</span>
                </div>

                <div class="ml-2 flex items-center gap-2">
                    <a href="{{ route('topics.edit', $topic) }}" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Edit</a>
                    <button type="button" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:border-rose-500/30 hover:bg-rose-500/10 hover:text-rose-400"
                        @click="$dispatch('confirm-delete', {
                            title: 'Delete {{ addslashes($topic->name) }}?',
                            callback: () => deleteRecord('topics', {{ $topic->id }})
                        })">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="py-12 text-center">
                <x-icon name="book-open" class="mx-auto mb-3 h-10 w-10 text-gray-500" />
                <p class="mb-1 text-sm text-gray-200">No topics yet</p>
                <p class="text-xs text-gray-400">Add your first learning topic above</p>
            </div>
        @endforelse
    </x-ui.card>

</x-app-layout>
