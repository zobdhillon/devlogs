<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary  py-3 rounded-xl text-sm font-semibold tracking-wide']) }}>
    {{ $slot }}
</button>