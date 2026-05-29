<div x-data="{ confirm: false }">
    <button type="button" @click="confirm = true"
        class="rounded-md border border-rose-500/30 bg-rose-500/10 px-4 py-2 text-sm font-medium text-rose-400 transition-colors hover:bg-rose-500/15">
        Delete Account
    </button>

    <div x-show="confirm" x-cloak x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-50 flex items-center justify-center bg-canvas/90 p-4">
        <x-ui.card class="w-full max-w-md border-rose-500/20">
            <h3 class="mb-2 font-display text-base font-bold text-gray-100">Delete your account?</h3>
            <p class="mb-5 text-xs text-gray-400">
                All your topics, logs, goals and resources will be permanently deleted. This cannot be undone. Enter
                your password to confirm.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <x-ui.label for="password">Password</x-ui.label>
                    <x-ui.input id="password" name="password" type="password" placeholder="Enter your password" />
                    @error('password', 'userDeletion')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-1">
                    <button type="submit"
                        class="rounded-lg border border-rose-500/30 bg-rose-500/10 px-4 py-2 text-sm font-medium text-rose-400 transition-colors hover:bg-rose-500/15">
                        Yes, delete my account
                    </button>
                    <x-ui.button-ghost type="button" @click="confirm = false">Cancel</x-ui.button-ghost>
                </div>
            </form>
        </x-ui.card>
    </div>
</div>
