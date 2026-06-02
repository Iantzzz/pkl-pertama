<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 border border-warm-300 dark:border-gold-500/30 text-warm-700 dark:text-gold-300 font-semibold text-sm rounded-xl hover:bg-gold-500/10 dark:hover:bg-gold-500/10 hover:border-gold-500/40 focus:outline-none focus:ring-2 focus:ring-gold-500/20 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-warm-900 transition-all duration-200']) }}>
    {{ $slot }}
</button>
