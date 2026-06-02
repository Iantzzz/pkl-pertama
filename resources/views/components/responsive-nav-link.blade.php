@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-gold-500 text-start text-base font-medium text-gold-600 dark:text-gold-300 bg-gold-500/10 dark:bg-gold-500/10 focus:outline-none focus:text-gold-800 dark:focus:text-gold-200 focus:bg-gold-500/20 dark:focus:bg-gold-500/20 focus:border-gold-700 transition-all duration-200'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-warm-600 dark:text-warm-300 hover:text-gold-600 dark:hover:text-gold-300 hover:bg-gold-500/5 dark:hover:bg-gold-500/5 hover:border-gold-500/40 focus:outline-none focus:text-gold-600 dark:focus:text-gold-300 focus:bg-gold-500/5 dark:focus:bg-gold-500/5 focus:border-gold-500/40 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
