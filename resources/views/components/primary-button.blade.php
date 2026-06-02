<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-gold-500/40 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-warm-900 transition-all duration-200']) }}>
    {{ $slot }}
</button>
