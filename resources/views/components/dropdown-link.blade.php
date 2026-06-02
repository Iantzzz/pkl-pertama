<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm text-warm-700 dark:text-warm-200 hover:bg-gold-500/10 dark:hover:bg-gold-500/10 hover:text-gold-600 dark:hover:text-gold-300 focus:outline-none focus:bg-gold-500/10 dark:focus:bg-gold-500/10 focus:text-gold-600 dark:focus:text-gold-300 transition-all duration-200']) }}>
    {{ $slot }}
</a>
