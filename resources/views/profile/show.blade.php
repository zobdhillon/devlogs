<x-public-layout>

    <div class="max-w-2xl mx-auto">

        {{-- Profile Header --}}
        <div class="dash-card mb-4">
            <div class="flex items-start gap-4 mb-4">

                {{-- Avatar --}}
                <div style="position:relative;flex-shrink:0;">
                    <div
                        style="width:56px;height:56px;border-radius:50%;background:rgba(168,85,247,0.15);border:1.5px solid rgba(168,85,247,0.4);display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;color:#a855f7;font-family:'Space Grotesk',sans-serif;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div
                        style="position:absolute;bottom:2px;right:2px;width:12px;height:12px;border-radius:50%;background:#41b883;border:2px solid #08060f;">
                    </div>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-3" x-data="{ copied: false }">
                        <div>
                            <h1 class="text-xl font-bold" style="font-family:'Space Grotesk',sans-serif;color:#f0ece8">
                                {{ $user->name }}
                            </h1>
                            <p class="text-sm mt-0.5" style="color:#8b7fa8">{{ '@' . $user->username }}</p>
                        </div>

                        {{-- Share button --}}
                        @auth
                            @if (auth()->user()->username === $user->username)
                                {{-- Own profile — show share button --}}
                                <button id="share-btn"
                                    onclick="
                    var btn = document.getElementById('share-btn').querySelector('span');
                    var url = window.location.href;
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(url).then(() => {
                            btn.innerText = '✓ Copied!';
                            setTimeout(() => btn.innerText = 'Share Profile', 2000);
                        });
                    } else {
                        var el = document.createElement('textarea');
                        el.value = url;
                        document.body.appendChild(el);
                        el.select();
                        document.execCommand('copy');
                        document.body.removeChild(el);
                        btn.innerText = '✓ Copied!';
                        setTimeout(() => btn.innerText = 'Share Profile', 2000);
                    }
                "
                                    style="background:linear-gradient(135deg,#a855f7,#f97316);border:none;border-radius:20px;padding:8px 18px;color:#fff;font-size:12px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;box-shadow:0 0 20px rgba(168,85,247,0.4);">
                                    <svg width="13" height="13" fill="none" stroke="white" viewBox="0 0 24 24"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span>Share Profile</span>
                                </button>
                            @endif
                        @else
                            {{-- Guest or other user — show CTA --}}
                            <a href="{{ route('register') }}"
                                style="background:linear-gradient(135deg,#a855f7,#f97316);border:none;border-radius:20px;padding:8px 18px;color:#fff;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;box-shadow:0 0 20px rgba(168,85,247,0.4);text-decoration:none;">
                                Create your DevLog →
                            </a>
                        @endauth
                    </div>

                    @if ($user->bio)
                        <p class="text-sm mt-3 leading-relaxed" style="color:#c4b8e8">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>

            {{-- Stats --}}
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
                <div class="text-center py-3 rounded-xl"
                    style="background:rgba(168,85,247,0.08);border:1px solid rgba(168,85,247,0.15)">
                    <p class="text-xl font-bold" style="font-family:'Space Grotesk',sans-serif;color:#a855f7">
                        {{ $stats['logs'] }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b7fa8">Logs</p>
                </div>
                <div class="text-center py-3 rounded-xl"
                    style="background:rgba(168,85,247,0.08);border:1px solid rgba(168,85,247,0.15)">
                    <p class="text-xl font-bold" style="font-family:'Space Grotesk',sans-serif;color:#a855f7">
                        {{ $stats['active_topics'] }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b7fa8">Active Topics</p>
                </div>
                <div class="text-center py-3 rounded-xl"
                    style="background:rgba(249,115,22,0.08);border:1px solid rgba(249,115,22,0.15)">
                    <p class="text-xl font-bold" style="font-family:'Space Grotesk',sans-serif;color:#f97316">
                        {{ $stats['completed_goals'] }}</p>
                    <p class="text-xs mt-0.5" style="color:#8b7fa8">Goals Done</p>
                </div>
            </div>
        </div>

        {{-- Topics --}}
        @if ($topics->count())
            <div class="dash-card mb-4">
                <h2 class="text-sm font-bold uppercase tracking-widest mb-4"
                    style="color:#8b7fa8;font-family:'Space Grotesk',sans-serif">Topics</h2>
                @foreach ($topics as $topic)
                    <div class="flex items-center gap-3 py-2.5 border-b" style="border-color:rgba(168,85,247,0.08)">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                            style="background:{{ $topic->color }}18;border:1px solid {{ $topic->color }}33">
                            <i class="{{ $topic->icon ?? 'devicon-code-plain' }} text-base"
                                style="color:{{ $topic->color }}"></i>
                        </div>
                        <span class="flex-1 text-sm font-medium" style="color:#f0ece8">{{ $topic->name }}</span>
                        <span class="dash-badge dash-badge-{{ $topic->status }}">{{ $topic->status }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Recent Logs --}}
        @if ($logs->count())
            <div class="dash-card mb-4">
                <h2 class="text-sm font-bold uppercase tracking-widest mb-4"
                    style="color:#8b7fa8;font-family:'Space Grotesk',sans-serif">Recent Logs</h2>
                @php $moodEmojis = [1 => '😴', 2 => '😑', 3 => '🤔', 4 => '😄', 5 => '⚡']; @endphp
                @foreach ($logs as $log)
                    <div class="flex items-start gap-3 py-3 border-b" style="border-color:rgba(168,85,247,0.08)">
                        <div class="w-2 h-2 rounded-full flex-shrink-0"
                            style="background:{{ $log->topic?->color ?? '#8b7fa8' }};box-shadow:0 0 6px {{ $log->topic?->color ?? '#8b7fa8' }};margin-top:6px;">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color:#f0ece8">{{ $log->title }}</p>
                            <p class="text-xs mt-0.5" style="color:#8b7fa8">
                                {{ $log->topic?->name ?? 'No topic' }}
                                · {{ $log->created_at->diffForHumans() }}
                                · {{ $moodEmojis[$log->mood] ?? '🤔' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Completed Goals --}}
        @if ($completedGoals->count())
            <div class="dash-card mb-4">
                <h2 class="text-sm font-bold uppercase tracking-widest mb-4"
                    style="color:#8b7fa8;font-family:'Space Grotesk',sans-serif">Completed Goals</h2>
                @foreach ($completedGoals as $goal)
                    <div class="flex items-center gap-3 py-2.5 border-b" style="border-color:rgba(168,85,247,0.08)">
                        <div class="w-5 h-5 rounded flex items-center justify-center flex-shrink-0"
                            style="background:#7c3aed;border:1px solid #7c3aed;box-shadow:0 0 8px rgba(124,58,237,0.4)">
                            <svg class="w-3 h-3" fill="none" stroke="white" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="flex-1 text-sm"
                            style="color:#8b7fa8;text-decoration:line-through">{{ $goal->title }}</span>
                        @if ($goal->topic)
                            <span class="text-xs px-2 py-0.5 rounded-full"
                                style="background:{{ $goal->topic->color }}18;color:{{ $goal->topic->color }};border:1px solid {{ $goal->topic->color }}33">
                                {{ $goal->topic->name }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</x-public-layout>
