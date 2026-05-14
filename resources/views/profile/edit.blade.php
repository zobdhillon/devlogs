<x-app-layout>

    <div class="max-w-2xl mx-auto space-y-4">

        {{-- Profile Information --}}
        <div class="dash-card">
            <h2 class="text-white font-bold text-lg mb-1" style="font-family:'Space Grotesk',sans-serif">
                Profile Information
            </h2>
            <p class="text-xs mb-6" style="color:#8b7fa8">Update your name, username, bio and email address.</p>

            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="dash-card">
            <h2 class="text-white font-bold text-lg mb-1" style="font-family:'Space Grotesk',sans-serif">
                Update Password
            </h2>
            <p class="text-xs mb-6" style="color:#8b7fa8">Use a long, random password to keep your account secure.</p>

            @include('profile.partials.update-password-form')
        </div>

        {{-- Danger Zone --}}
        <div class="dash-card" style="border-color:rgba(244,63,94,0.2)">
            <h2 class="text-sm font-bold mb-1" style="font-family:'Space Grotesk',sans-serif;color:#f43f5e">
                Danger Zone
            </h2>
            <p class="text-xs mb-4" style="color:#8b7fa8">
                Once your account is deleted, all data will be permanently removed. This cannot be undone.
            </p>

            @include('profile.partials.delete-user-form')
        </div>

    </div>

</x-app-layout>
