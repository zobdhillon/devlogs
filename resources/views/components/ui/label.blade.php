<label {{ $attributes->merge(['class' => 'mb-1.5 block text-sm font-medium text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>
