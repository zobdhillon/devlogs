
<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <x-ui.card class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('logs.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 transition-colors hover:text-accent">
                    <x-icon name="arrow-left" class="h-4 w-4" /> Back
                </a>
                <h2 class="font-display text-lg font-bold text-gray-100">{{ $log->title }}</h2>
            </div>
            <a href="{{ route('logs.edit', $log) }}" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Edit</a>
        </div>

        <div class="mb-6 flex flex-wrap items-center gap-3">
            @if ($log->topic)
                <span class="flex items-center gap-1.5 text-xs" style="color:{{ $log->topic->color }}">
                    <span class="h-2 w-2 rounded-full" style="background:{{ $log->topic->color }}"></span>
                    {{ $log->topic->name }}
                </span>
            @endif
            <span class="text-xs text-gray-400">{{ $log->created_at->format('M d, Y · g:i A') }}</span>
            <span title="Mood {{ $log->mood }}/5">
                <x-mood-icon :level="$log->mood" class="h-4 w-4 text-gray-400" />
            </span>
        </div>

        <div id="log-body-rendered" class="prose prose-sm max-w-none leading-relaxed text-gray-200"></div>

        <script>
            const raw = @json($log->body);
            document.getElementById('log-body-rendered').innerHTML = marked.parse(raw);
        </script>
    </x-ui.card>

</x-app-layout>
