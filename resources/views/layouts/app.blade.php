<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('layouts.head')
    </head>

    <body class="min-h-screen bg-canvas" x-data>

        @include('layouts.navigation')

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        {{-- Global confirm delete modal --}}
        <div x-data="confirmModal()" x-on:confirm-delete.window="open($event.detail)" x-show="show" x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-canvas/90"
            style="display:none;">
            <x-ui.card class="w-80 text-center" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                @click.outside="show = false">
                <div
                    class="mx-auto mb-4 flex h-11 w-11 items-center justify-center rounded-full border border-rose-500/30 bg-rose-500/10">
                    <x-icon name="trash" class="h-5 w-5 text-rose-400" />
                </div>
                <p class="mb-1 font-display font-semibold text-gray-100" x-text="title"></p>
                <p class="mb-6 text-xs text-gray-400">This action cannot be undone.</p>
                <div class="flex justify-center gap-3">
                    <x-ui.button-ghost type="button" @click="show = false" class="px-5">
                        Cancel
                    </x-ui.button-ghost>
                    <button type="button" @click="confirm()"
                        class="inline-flex items-center justify-center rounded-lg border border-rose-500/30 bg-rose-500/10 px-5 py-2 text-sm font-medium text-rose-400 transition-colors hover:bg-rose-500/15">
                        Delete
                    </button>
                </div>
            </x-ui.card>
        </div>

        {{-- Global toast notification --}}
        <div x-data="toastNotification()" x-on:show-toast.window="show($event.detail)"
            class="pointer-events-none fixed right-5 top-16 z-50">
            <div x-show="visible" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-8"
                class="pointer-events-auto flex min-w-[220px] max-w-xs items-center gap-3 rounded-xl border px-4 py-3 text-sm shadow-md"
                :class="type === 'success'
                    ? 'border-accent/30 bg-accent/10 text-gray-200'
                    : 'border-rose-500/30 bg-rose-500/10 text-gray-200'">
                <div class="flex-shrink-0">
                    <template x-if="type === 'success'">
                        <svg class="h-4 w-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="h-4 w-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </template>
                </div>
                <span x-text="message" class="flex-1"></span>
                <button type="button" @click="visible = false" class="flex-shrink-0 text-gray-400 hover:text-gray-200">
                    <x-icon name="x" class="h-3.5 w-3.5" />
                </button>
            </div>
        </div>

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
