@props(['level' => 3, 'class' => 'w-4 h-4'])

@php
    $icons = [1 => 'moon', 2 => 'meh', 3 => 'help-circle', 4 => 'smile', 5 => 'zap'];
@endphp

<x-icon :name="$icons[$level] ?? 'help-circle'" :class="$class" {{ $attributes }} />
