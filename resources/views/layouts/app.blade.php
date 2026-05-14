<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.head')
    </head>

    <body class="dashboard-bg min-h-screen" x-data>

        @include('layouts.navigation')

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>

        {{-- Global confirm delete modal --}}
        <div x-data="confirmModal()" x-on:confirm-delete.window="open($event.detail)" x-show="show" x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center"
            style="background:rgba(8,6,15,0.85);display:none;">
            <div class="dash-card w-80 text-center" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                @click.outside="show = false">
                <div class="w-11 h-11 rounded-full flex items-center justify-center mx-auto mb-4"
                    style="background:rgba(244,63,94,0.12);border:1px solid rgba(244,63,94,0.3)">
                    <svg class="w-5 h-5" fill="none" stroke="#f43f5e" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <p class="font-semibold mb-1" style="color:#f0ece8;font-family:'Space Grotesk',sans-serif"
                    x-text="title"></p>
                <p class="text-xs mb-6" style="color:#8b7fa8">This action cannot be undone.</p>
                <div class="flex gap-3 justify-center">
                    <button @click="show = false" class="px-5 py-2 rounded-xl text-sm transition-all duration-150"
                        style="border:1px solid rgba(168,85,247,0.3);color:#8b7fa8;background:transparent">
                        Cancel
                    </button>
                    <button @click="confirm()" class="px-5 py-2 rounded-xl text-sm transition-all duration-150"
                        style="border:1px solid rgba(244,63,94,0.4);background:rgba(244,63,94,0.12);color:#f43f5e">
                        Delete
                    </button>
                </div>
            </div>
        </div>

        {{-- Global toast notification --}}
        <div x-data="toastNotification()" x-on:show-toast.window="show($event.detail)" class="fixed top-16 right-5 z-50"
            style="pointer-events:none">
            <div x-show="visible" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-8"
                :class="type === 'success' ? 'toast-success' : 'toast-error'"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm"
                style="pointer-events:auto;min-width:220px;max-width:320px;">
                <div class="flex-shrink-0">
                    <template x-if="type === 'success'">
                        <svg class="w-4 h-4" fill="none" stroke="#a855f7" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="w-4 h-4" fill="none" stroke="#f43f5e" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </template>
                </div>

                {{-- Message --}}
                <span x-text="message" style="color:#f0ece8;flex:1"></span>

                {{-- Close button --}}
                <button @click="visible = false" class="flex-shrink-0" style="color:#8b7fa8">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Fire toast from Laravel flash messages --}}
        @if (session('success'))
            <script>
                document.addEventListener('alpine:init', () => {
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('show-toast', {
                            detail: {
                                message: '{{ session('success') }}',
                                type: 'success'
                            }
                        }))
                    }, 100)
                })
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener('alpine:init', () => {
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('show-toast', {
                            detail: {
                                message: '{{ session('error') }}',
                                type: 'error'
                            }
                        }))
                    }, 100)
                })
            </script>
        @endif
    </body>

</html>
