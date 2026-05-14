<x-app-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-white font-bold text-xl" style="font-family:'Space Grotesk',sans-serif">Your Logs</h2>
        <a href="{{ route('logs.create') }}" class="btn-primary text-sm px-4 py-2 rounded-xl">+ New Log</a>
    </div>

    {{-- Logs List --}}
    <div class="dash-card">
        @php
            $moodEmojis = [1 => '😴', 2 => '😑', 3 => '🤔', 4 => '😄', 5 => '⚡'];
        @endphp

        @forelse($logs as $log)
            {{-- Each row has a unique id so fadeRemove() can find and remove it --}}
            <div id="log-{{ $log->id }}" class="flex items-start gap-3 py-4 border-b"
                style="border-color:rgba(168,85,247,0.08)">

                <div class="w-2 h-2 rounded-full flex-shrink-0"
                    style="background:{{ $log->topic?->color ?? '#8b7fa8' }};
                           box-shadow:0 0 6px {{ $log->topic?->color ?? '#8b7fa8' }};
                           margin-top:6px;">
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold truncate" style="color:#f0ece8">{{ $log->title }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b7fa8">
                        {{ $log->topic?->name ?? 'No topic' }}
                        · {{ $log->created_at->diffForHumans() }}
                        · {{ $moodEmojis[$log->mood] ?? '🤔' }}
                    </p>
                </div>

                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('logs.show', $log) }}" class="topic-action-btn">View</a>
                    <a href="{{ route('logs.edit', $log) }}" class="topic-action-btn">Edit</a>

                    {{--
                        No <form> here anymore.
                        $dispatch sends an event to the global modal in app.blade.php.
                        The modal shows, and if the user clicks Delete it calls deleteLog(id).
                    --}}
                    <button type="button" class="topic-action-btn topic-delete-btn"
                        @click="$dispatch('confirm-delete', {
                            title: 'Delete this log?',
                            callback: () => deleteRecord('logs', {{ $log->id }})
                        })">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-4xl mb-3">📝</div>
                <p class="text-sm mb-1" style="color:#f0ece8">No logs yet</p>
                <p class="text-xs mb-4" style="color:#8b7fa8">Start journaling your dev progress</p>
                <a href="{{ route('logs.create') }}" class="btn-primary text-sm px-4 py-2 rounded-xl">
                    Write your first log
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($logs->hasPages())
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    @endif

</x-app-layout>
