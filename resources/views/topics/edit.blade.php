<x-app-layout>

    <div class="dash-card max-w-2xl mx-auto" x-data="{
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

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('topics.index') }}" class="text-sm transition-colors duration-150" style="color:#8b7fa8"
                onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='#8b7fa8'">
                ← Back
            </a>
            <h2 class="text-white font-bold text-lg" style="font-family:'Space Grotesk',sans-serif">
                Edit Topic
            </h2>
        </div>

        {{-- Edit Form --}}
        <form method="POST" action="{{ route('topics.update', $topic) }}">
            @csrf
            @method('PUT')

            <div class="flex flex-wrap gap-3 items-center">

                {{-- Name --}}
                <input type="text" name="name" placeholder="Topic name e.g. React"
                    value="{{ old('name', $topic->name) }}" required class="auth-input flex-1 min-w-48" />

                {{-- Color swatches --}}
                <div class="flex items-center gap-2">
                    @foreach (['#41b883', '#3178c6', '#f7df1e', '#ef4444'] as $c)
                        <label class="topic-color-swatch"
                            style="background:{{ $c }};box-shadow:0 0 8px {{ $c }}">
                            <input type="radio" name="color" value="{{ $c }}" class="hidden"
                                {{ old('color', $topic->color) === $c ? 'checked' : '' }}>
                        </label>
                    @endforeach
                </div>

                {{-- Icon picker --}}
                <div class="relative" @click.outside="iconOpen = false">
                    <button type="button" @click="iconOpen = !iconOpen"
                        class="auth-input flex items-center gap-2 cursor-pointer w-36 justify-between">
                        <span class="flex items-center gap-2">
                            <i :class="icon" class="text-base" style="color:#a855f7"></i>
                            <span x-text="icon.replace('devicon-','').replace('-plain','').replace('-original','')"
                                class="capitalize text-xs truncate" style="color:#f0ece8; max-width:64px"></span>
                        </span>
                        <svg class="w-3 h-3 flex-shrink-0 transition-transform duration-150"
                            :class="iconOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" style="color:#8b7fa8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="iconOpen" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="icon-picker-grid absolute z-50 mt-1 rounded-xl p-2 grid grid-cols-6 gap-1"
                        style="background:#0e0a1f; border:1px solid rgba(168,85,247,0.25); width:220px; max-height:200px; overflow-y:auto; box-shadow:0 8px 24px rgba(0,0,0,0.5);">
                        <template x-for="ic in icons" :key="ic">
                            <button type="button" @click="icon = ic; iconOpen = false"
                                class="flex items-center justify-center p-2 rounded-lg transition-all duration-100"
                                :class="icon === ic ? 'bg-purple-500/20' : 'hover:bg-white/5'"
                                :title="ic.replace('devicon-', '').replace('-plain', '').replace('-original', '')">
                                <i :class="ic" class="text-lg"
                                    :style="icon === ic ? 'color:#a855f7' : 'color:#c4b8e8'"></i>
                            </button>
                        </template>
                    </div>

                    <input type="hidden" name="icon" :value="icon" />
                </div>

                {{-- Status dropdown --}}
                <div x-data="{
                    open: false,
                    selected: '{{ old('status', $topic->status) }}',
                    options: ['active', 'paused', 'completed']
                }" class="relative">
                    <input type="hidden" name="status" :value="selected">
                    <button type="button" @click="open = !open"
                        class="auth-input w-36 flex items-center justify-between gap-2 cursor-pointer">
                        <span x-text="selected" class="capitalize"></span>
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition class="custom-select-dropdown">
                        <template x-for="option in options" :key="option">
                            <div @click="selected = option; open = false" class="custom-select-option"
                                :class="{ 'custom-select-option-active': selected === option }" x-text="option">
                            </div>
                        </template>
                    </div>
                </div>

                <div class="flex items-center gap-3" x-data="{ progress: {{ $topic->progress }} }">
                    <input type="range" name="progress" min="0" max="100" x-model="progress"
                        class="topic-slider" />
                    <span class="text-sm w-10" style="color:#8b7fa8" x-text="progress + '%'"></span>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-primary px-6 py-2 rounded-xl text-sm font-semibold">
                    Save Changes
                </button>

                {{-- Cancel --}}
                <a href="{{ route('topics.index') }}"
                    class="px-6 py-2 rounded-xl text-sm font-semibold transition-colors duration-150"
                    style="color:#8b7fa8;border:1px solid rgba(168,85,247,0.15)"
                    onmouseover="this.style.color='#f0ece8'" onmouseout="this.style.color='#8b7fa8'">
                    Cancel
                </a>
            </div>

            @error('name')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
        </form>

    </div>

</x-app-layout>
