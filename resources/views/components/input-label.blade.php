@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-warm-700 dark:text-gold-300 tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
