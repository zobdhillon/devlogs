<x-app-layout>

    <div class="mb-6 flex items-center justify-between">
        <h1 class="font-display text-xl font-bold text-gray-100">Your Resources</h1>
        <a href="{{ route('resources.create') }}" class="inline-flex items-center justify-center rounded-lg bg-accent px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-accent-hover">
            <x-icon name="plus" class="mr-1 h-4 w-4" /> Add Resource
        </a>
    </div>

    <x-ui.card>
        @forelse ($resources as $resource)
            <div id="resource-{{ $resource->id }}"
                class="flex items-center justify-between gap-3 border-b border-white/[0.06] py-3 last:border-0">
                <div class="flex min-w-0 flex-1 items-center gap-2.5">
                    <span class="flex-shrink-0 rounded-md px-2 py-0.5 text-[10px] font-medium {{ match($resource->type) { 'video' => 'bg-accent/10 text-accent', 'article' => 'bg-white/[0.06] text-gray-300', 'course' => 'bg-emerald-500/10 text-emerald-400', 'docs' => 'bg-sky-500/10 text-sky-400', default => 'bg-white/[0.06] text-gray-400' } }}">
                        {{ ucfirst($resource->type) }}
                    </span>
                    <div class="min-w-0">
                        <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer"
                            class="block truncate text-sm font-semibold text-gray-200 hover:underline">
                            {{ $resource->title }}
                        </a>
                        <div class="flex items-center gap-1 text-[11px] text-gray-400">
                            @if ($resource->topic)
                                <span class="rounded-md bg-accent/10 px-1.5 py-0.5 text-[10px] text-accent">{{ $resource->topic->name }}</span>
                                <span>&middot;</span>
                            @endif
                            {{ $resource->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                <div class="ml-3 flex flex-shrink-0 items-center gap-1.5">
                    <a href="{{ route('resources.edit', $resource) }}" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200">Edit</a>
                    <button type="button" class="rounded-md border border-white/[0.06] bg-white/[0.03] px-2.5 py-1 text-[11px] text-gray-400 transition-colors hover:border-rose-500/30 hover:bg-rose-500/10 hover:text-rose-400"
                        @click="$dispatch('confirm-delete', {
                            title: 'Delete this resource?',
                            callback: () => deleteRecord('resources', {{ $resource->id }})
                        })">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="py-8 text-center text-gray-400">
                <p class="mb-3">No resources yet.</p>
                <a href="{{ route('resources.create') }}" class="inline-flex items-center justify-center rounded-lg bg-accent px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-accent-hover">Add your first resource</a>
            </div>
        @endforelse
    </x-ui.card>

    @if ($resources->hasPages())
        <div class="mt-6">
            {{ $resources->links() }}
        </div>
    @endif

</x-app-layout>
