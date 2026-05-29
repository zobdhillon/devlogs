@props(['value' => 3])

@php
    $levels = [1 => 'moon', 2 => 'meh', 3 => 'help-circle', 4 => 'smile', 5 => 'zap'];
@endphp

<div x-data="{ mood: {{ $value }} }" {{ $attributes }}>
    <x-ui.label>Mood</x-ui.label>
    <input type="hidden" name="mood" :value="mood">
    <div class="flex h-10 items-center gap-2">
        @foreach ($levels as $level => $icon)
            <button type="button" @click="mood = {{ $level }}" :title="`Mood {{ $level }}/5`"
                class="rounded-lg p-1 transition-all duration-150"
                :class="mood === {{ $level }} ? 'text-accent scale-110' : 'text-gray-500 opacity-50 hover:text-gray-300 hover:opacity-80'">
                <x-icon name="{{ $icon }}" class="h-5 w-5" />
            </button>
        @endforeach
    </div>
    @error('mood')
        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
    @enderror
</div>
