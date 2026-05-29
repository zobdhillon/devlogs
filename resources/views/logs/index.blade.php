
<x-app-layout>

    <div class="mb-4 flex items-center justify-between">
        <h2 class="font-display text-xl font-bold text-gray-100">Your Logs</h2>
        <a href="{{ route('logs.create') }}" class="inline-flex items-center justify-center rounded-lg bg-accent px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-accent-hover">
            <x-icon name="plus" class="mr-1 h-4 w-4" /> New Log
        </a>
    </div>

    <x-ui.card>
        @forelse($logs as $log)
            <div id="log-{{ $log->id }}" class="flex items-start gap-3 border-b border-white/[0.06] py-4 last:border-0">
                <div class="mt-1.5 h-2 w-2 flex-shrink-0 rounded-full"
                    style="background:{{ $log->topic?->color ?? '#71717a' }}"></div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-gray-200">{{ $log->title }}</p>
                    <p class="mt-0.5 flex items-center gap-1.5 text-xs text-gray-400">
                        {{ $log->topic?->name ?? 'No topic' }}
                        · {{ $log->created_at->diffForHumans() }}
                        · <x-mood-icon :level="$log->mood" class="h-3.5 w-3.5" />
                    </p>
                </div>

                <div class="flex flex-shrink-0 items-center gap-2">
                    <a href="{{ route('logs.show', $log) }}" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">View</a>
                    <a href="{{ route('logs.edit', $log) }}" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Edit</a>
                    <button type="button" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:border-rose-500/30 hover:bg-rose-500/10 hover:text-rose-400"
                        @click="$dispatch('confirm-delete', {
                            title: 'Delete this log?',
                            callback: () => deleteRecord('logs', {{ $log->id }})
                        })">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="py-12 text-center">
                <x-icon name="file-text" class="mx-auto mb-3 h-10 w-10 text-gray-500" />
                <p class="mb-1 text-sm text-gray-200">No logs yet</p>
                <p class="mb-4 text-xs text-gray-400">Start journaling your dev progress</p>
                <a href="{{ route('logs.create') }}" class="inline-flex items-center justify-center rounded-lg bg-accent px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-accent-hover">Write your first log</a>
            </div>
        @endforelse
    </x-ui.card>

    @if ($logs->hasPages())
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    @endif

</x-app-layout>
