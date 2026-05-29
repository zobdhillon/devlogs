<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 rounded-lg border border-white/[0.06] bg-white/[0.03] px-4 py-2 text-sm font-medium text-gray-400 transition-colors hover:bg-white/[0.05] hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-accent/30 focus:ring-offset-2 focus:ring-offset-canvas']) }}>
    {{ $slot }}
</button>
