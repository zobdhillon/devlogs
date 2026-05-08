@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-devlog-border bg-devlog-sidebar text-devlog-text placeholder-devlog-muted focus:border-devlog-primary focus:ring-devlog-primary rounded-md shadow-sm']) }}>