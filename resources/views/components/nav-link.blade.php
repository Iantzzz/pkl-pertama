@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-blue-600 dark:text-blue-300 bg-blue-500/10 dark:bg-blue-500/10 transition-all duration-200'
            : 'flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-warm-600 dark:text-warm-300 hover:text-warm-900 dark:hover:text-warm-50 hover:bg-warm-100 dark:hover:bg-warm-700/50 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
