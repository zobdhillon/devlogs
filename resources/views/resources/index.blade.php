<x-app-layout>
    <x-slot name="header">Resources</x-slot>

    <div class="page-container" x-data>

        {{-- Header --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <h1 style="font-family:'Space Grotesk',sans-serif; font-size:1.4rem; font-weight:700; color:#f0ece8;">
                Your Resources
            </h1>
            <a href="{{ route('resources.create') }}" class="btn-primary">+ Add Resource</a>
        </div>

        {{-- List --}}
        <div class="dash-card">
            @forelse ($resources as $resource)
                <div id="resource-{{ $resource->id }}" class="topic-row" style="justify-content:space-between; margin-bottom:0; padding:12px 0; border-bottom:1px solid rgba(168,85,247,0.1);">

                    {{-- Left: badge + info --}}
                    <div style="display:flex; align-items:center; gap:10px; flex:1; min-width:0;">

                        {{-- Type badge --}}
                        @php
                            $badgeStyles = [
                                'video'   => 'background:rgba(249,115,22,0.15); color:rgba(249,115,22,1);',
                                'article' => 'background:rgba(168,85,247,0.15); color:rgba(168,85,247,1);',
                                'course'  => 'background:rgba(34,197,94,0.15); color:rgba(34,197,94,1);',
                                'docs'    => 'background:rgba(59,130,246,0.15); color:rgba(59,130,246,1);',
                            ];
                            $style = $badgeStyles[$resource->type] ?? '';
                        @endphp
                        <span class="dash-badge" style="{{ $style }}; flex-shrink:0;">
                            {{ ucfirst($resource->type) }}
                        </span>

                        {{-- Title + meta --}}
                        <div style="display:flex; flex-direction:column; gap:3px; min-width:0;">
                            <a href="{{ $resource->url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               style="font-size:14px; font-weight:600; color:#f0ece8; text-decoration:none; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"
                               onmouseover="this.style.textDecoration='underline'"
                               onmouseout="this.style.textDecoration='none'">
                                {{ $resource->title }}
                            </a>
                            <div style="font-size:11px; color:#8b7fa8; display:flex; align-items:center; gap:4px;">
                                @if ($resource->topic)
                                    <span class="dash-badge dash-badge-active">{{ $resource->topic->name }}</span>
                                    <span>&middot;</span>
                                @endif
                                {{ $resource->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div style="display:flex; align-items:center; gap:6px; flex-shrink:0; margin-left:12px;">
                        <a href="{{ route('resources.edit', $resource) }}" class="topic-action-btn">Edit</a>
                        <button
                            type="button"
                            class="topic-action-btn topic-delete-btn"
                            @click="$dispatch('confirm-delete', {
                                title: 'Delete this resource?',
                                callback: () => deleteRecord('resources', {{ $resource->id }})
                            })">
                            Delete
                        </button>
                    </div>

                </div>
            @empty
                <div style="text-align:center; padding:2rem 0; color:#8b7fa8;">
                    <p style="margin-bottom:0.75rem;">No resources yet.</p>
                    <a href="{{ route('resources.create') }}" class="btn-primary">Add your first resource</a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($resources->hasPages())
            <div style="margin-top:1.5rem;">
                {{ $resources->links() }}
            </div>
        @endif

    </div>
</x-app-layout>