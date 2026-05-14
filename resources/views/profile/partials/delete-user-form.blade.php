<div x-data="{ confirm: false }">

    <button type="button" @click="confirm = true" class="topic-action-btn topic-delete-btn text-sm px-4 py-2">
        Delete Account
    </button>

    {{-- Confirm modal --}}
    <div x-show="confirm" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background:rgba(0,0,0,0.7);backdrop-filter:blur(4px)">

        <div class="w-full max-w-md rounded-2xl p-6"
            style="background:rgba(12,8,24,0.98);border:1px solid rgba(244,63,94,0.3);box-shadow:0 0 40px rgba(244,63,94,0.1)">

            <h3 class="font-bold text-base mb-2" style="font-family:'Space Grotesk',sans-serif;color:#f0ece8">
                Delete your account?
            </h3>
            <p class="text-xs mb-5" style="color:#8b7fa8">
                All your topics, logs, goals and resources will be permanently deleted. This cannot be undone. Enter
                your password to confirm.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label class="auth-label" for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password"
                        class="auth-input w-full" />
                    @error('password', 'userDeletion')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-1">
                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-150"
                        style="background:rgba(244,63,94,0.15);border:1px solid rgba(244,63,94,0.3);color:#f87171"
                        onmouseover="this.style.background='rgba(244,63,94,0.25)'"
                        onmouseout="this.style.background='rgba(244,63,94,0.15)'">
                        Yes, delete my account
                    </button>
                    <button type="button" @click="confirm = false"
                        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-150"
                        style="color:#8b7fa8;border:1px solid rgba(168,85,247,0.15)"
                        onmouseover="this.style.color='#f0ece8'" onmouseout="this.style.color='#8b7fa8'">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
