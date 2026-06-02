@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-gold-600 dark:text-gold-300 bg-gold-500/10 dark:bg-gold-500/10 rounded-xl transition-all duration-200'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-warm-600 dark:text-warm-300 hover:text-gold-600 dark:hover:text-gold-300 hover:bg-gold-500/5 dark:hover:bg-gold-500/5 rounded-xl transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
