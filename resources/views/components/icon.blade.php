@props(['name', 'class' => 'w-4 h-4'])

@php
    $attrs = $attributes->merge([
        'class' => $class,
        'xmlns' => 'http://www.w3.org/2000/svg',
        'viewBox' => '0 0 24 24',
        'fill' => 'none',
        'stroke' => 'currentColor',
        'stroke-width' => '2',
        'stroke-linecap' => 'round',
        'stroke-linejoin' => 'round',
        'aria-hidden' => 'true',
    ]);
@endphp

@switch($name)
    @case('book-open')
        <svg {{ $attrs }}><path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/></svg>
        @break
    @case('file-text')
        <svg {{ $attrs }}><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
        @break
    @case('target')
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
        @break
    @case('link')
        <svg {{ $attrs }}><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
        @break
    @case('flame')
        <svg {{ $attrs }}><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
        @break
    @case('hand')
        <svg {{ $attrs }}><path d="M18 11V6a2 2 0 0 0-4 0v5"/><path d="M14 10V4a2 2 0 0 0-4 0v6"/><path d="M10 10.5V6a2 2 0 0 0-4 0v8c0 4.4 3.6 8 8 8h1a4 4 0 0 0 4-4v-4a2 2 0 0 0-4 0"/></svg>
        @break
    @case('sparkles')
        <svg {{ $attrs }}><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/><path d="M20 3v4"/><path d="M22 5h-4"/><path d="M4 17v2"/><path d="M5 18H3"/></svg>
        @break
    @case('bot')
        <svg {{ $attrs }}><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
        @break
    @case('trash')
        <svg {{ $attrs }}><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
        @break
    @case('user')
        <svg {{ $attrs }}><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        @break
    @case('external-link')
        <svg {{ $attrs }}><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
        @break
    @case('log-out')
        <svg {{ $attrs }}><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
        @break
    @case('chevron-down')
        <svg {{ $attrs }}><path d="m6 9 6 6 6-6"/></svg>
        @break
    @case('menu')
        <svg {{ $attrs }}><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        @break
    @case('x')
        <svg {{ $attrs }}><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        @break
    @case('arrow-left')
        <svg {{ $attrs }}><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
        @break
    @case('arrow-right')
        <svg {{ $attrs }}><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        @break
    @case('moon')
        <svg {{ $attrs }}><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
        @break
    @case('meh')
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/><line x1="8" x2="16" y1="15" y2="15"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
        @break
    @case('help-circle')
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
        @break
    @case('smile')
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
        @break
    @case('zap')
        <svg {{ $attrs }}><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
        @break
    @case('check')
        <svg {{ $attrs }}><path d="M20 6 9 17l-5-5"/></svg>
        @break
    @case('plus')
        <svg {{ $attrs }}><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        @break
    @case('pen-line')
        <svg {{ $attrs }}><path d="M12 20h9"/><path d="M16.376 3.622a1 1 0 0 1 1.414 0l4.586 4.586a1 1 0 0 1 0 1.414l-9.586 9.586a2 2 0 0 1-.878.515l-4.05 1.012a.5.5 0 0 1-.61-.61l1.012-4.05a2 2 0 0 1 .515-.878z"/></svg>
        @break
    @case('eye')
        <svg {{ $attrs }}><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
        @break
    @case('heart')
        <svg {{ $attrs }}><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
        @break
    @case('circle-dot')
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="1"/></svg>
        @break
    @default
        <svg {{ $attrs }}><circle cx="12" cy="12" r="10"/></svg>
@endswitch
