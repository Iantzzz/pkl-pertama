<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 border border-warm-300 dark:border-warm-700 text-warm-700 dark:text-warm-300 font-semibold text-sm rounded-xl hover:bg-warm-50 dark:hover:bg-warm-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-warm-800 transition-all duration-200']) }}>
    {{ $slot }}
</button>
