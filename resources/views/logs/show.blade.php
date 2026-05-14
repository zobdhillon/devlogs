<x-app-layout>

    {{-- Markdown rendering --}}
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <div class="dash-card max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('logs.index') }}" class="text-sm transition-colors duration-150" style="color:#8b7fa8"
                    onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='#8b7fa8'">← Back</a>
                <h2 class="text-white font-bold text-lg" style="font-family:'Space Grotesk',sans-serif">
                    {{ $log->title }}
                </h2>
            </div>
            <a href="{{ route('logs.edit', $log) }}" class="topic-action-btn">Edit</a>
        </div>

        {{-- Meta --}}
        @php
            $moodEmojis = [1 => '😴', 2 => '😑', 3 => '🤔', 4 => '😄', 5 => '⚡'];
        @endphp
        <div class="flex items-center gap-3 mb-6 flex-wrap">
            @if ($log->topic)
                <span class="flex items-center gap-1.5 text-xs" style="color:{{ $log->topic->color }}">
                    <span class="w-2 h-2 rounded-full"
                        style="background:{{ $log->topic->color }};box-shadow:0 0 6px {{ $log->topic->color }}"></span>
                    {{ $log->topic->name }}
                </span>
            @endif
            <span class="text-xs" style="color:#8b7fa8">
                {{ $log->created_at->format('M d, Y · g:i A') }}
            </span>
            <span class="text-base" title="Mood {{ $log->mood }}/5">
                {{ $moodEmojis[$log->mood] ?? '🤔' }}
            </span>
        </div>

        {{-- Body --}}
        <div id="log-body-rendered" class="prose prose-sm max-w-none" style="color:#f0ece8; line-height:1.8;">
        </div>

        <script>
            const raw = @json($log->body);
            document.getElementById('log-body-rendered').innerHTML = marked.parse(raw);
        </script>

    </div>

</x-app-layout>
