<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm text-warm-700 dark:text-warm-200 hover:bg-blue-500/10 dark:hover:bg-blue-500/10 hover:text-blue-600 dark:hover:text-blue-300 focus:outline-none focus:bg-blue-500/10 dark:focus:bg-blue-500/10 focus:text-blue-600 dark:focus:text-blue-300 transition-all duration-200']) }}>
    {{ $slot }}
</a>
