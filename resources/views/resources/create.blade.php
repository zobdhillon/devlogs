<x-app-layout>
    <x-slot name="header">Add Resource</x-slot>

    <div class="page-container">

        {{-- Header --}}
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:1.5rem;">
            <a href="{{ route('resources.index') }}" class="btn-ghost"
                style="font-size:13px; padding:0; background:none; border:none; box-shadow:none;">← Back</a>
            <h1 style="font-family:'Space Grotesk',sans-serif; font-size:1.2rem; font-weight:700; color:#f0ece8;">Add
                Resource</h1>
        </div>

        <div class="dash-card" x-data="{
            type: '{{ old('type', '') }}',
            typeOpen: false,
            topicId: '{{ old('topic_id', '') }}',
            topicOpen: false,
        }">

            <form method="POST" action="{{ route('resources.store') }}">
                @csrf

                {{-- Title --}}
                <div class="form-group">
                    <label for="title" class="auth-label">Title</label>
                    <input id="title" name="title" type="text"
                        class="auth-input @error('title') input-error @enderror" value="{{ old('title') }}"
                        placeholder="e.g. Laravel Docs, JS Course on YouTube" required autofocus>
                    @error('title')
                        <p style="font-size:12px; color:#f87171; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- URL --}}
                <div class="form-group">
                    <label for="url" class="auth-label">URL</label>
                    <input id="url" name="url" type="url"
                        class="auth-input @error('url') input-error @enderror" value="{{ old('url') }}"
                        placeholder="https://..." required>
                    @error('url')
                        <p style="font-size:12px; color:#f87171; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Type --}}
                <div class="form-group">
                    <label class="auth-label">Type</label>

                    <div style="position:relative;" @click.outside="typeOpen = false">
                        <button type="button" class="auth-input"
                            style="display:flex; justify-content:space-between; align-items:center; width:100%; text-align:left; cursor:pointer;"
                            @click="typeOpen = !typeOpen">
                            <span x-text="type ? type.charAt(0).toUpperCase() + type.slice(1) : 'Select type'"></span>
                            <svg style="width:1.1rem; height:1.1rem; flex-shrink:0; color:#8b7fa8;"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div class="custom-select-dropdown" x-show="typeOpen" x-transition x-cloak>
                            @foreach (['video', 'article', 'course', 'docs'] as $opt)
                                <div class="custom-select-option"
                                    :class="{ 'custom-select-option-active': type === '{{ $opt }}' }"
                                    @click="type = '{{ $opt }}'; typeOpen = false">
                                    {{ ucfirst($opt) }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <input type="hidden" name="type" :value="type">
                    @error('type')
                        <p style="font-size:12px; color:#f87171; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Topic --}}
                <div class="form-group">
                    <label class="auth-label">Topic <span style="color:#8b7fa8;">(optional)</span></label>

                    @php $topicMap = $topics->pluck('name', 'id'); @endphp

                    <div style="position:relative;" @click.outside="topicOpen = false">
                        <button type="button" class="auth-input"
                            style="display:flex; justify-content:space-between; align-items:center; width:100%; text-align:left; cursor:pointer;"
                            @click="topicOpen = !topicOpen">
                            <span
                                x-text="topicId && {{ $topicMap->toJson() }}[topicId] ? {{ $topicMap->toJson() }}[topicId] : 'No topic'"></span>
                            <svg style="width:1.1rem; height:1.1rem; flex-shrink:0; color:#8b7fa8;"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div class="custom-select-dropdown" x-show="topicOpen" x-transition x-cloak>
                            <div class="custom-select-option"
                                :class="{ 'custom-select-option-active': topicId === '' }"
                                @click="topicId = ''; topicOpen = false">
                                No topic
                            </div>
                            @foreach ($topics as $topic)
                                <div class="custom-select-option"
                                    :class="{ 'custom-select-option-active': topicId === '{{ $topic->id }}' }"
                                    @click="topicId = '{{ $topic->id }}'; topicOpen = false">
                                    {{ $topic->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <input type="hidden" name="topic_id" :value="topicId || ''">
                    @error('topic_id')
                        <p style="font-size:12px; color:#f87171; margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-top:1.5rem;">
                    <button type="submit" class="btn-primary">Save Resource</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
