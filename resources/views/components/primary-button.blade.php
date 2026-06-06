<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-blue-gradient text-white font-semibold text-sm rounded-xl shadow-blue-sm hover:shadow-blue hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-warm-800 transition-all duration-200']) }}>
    {{ $slot }}
</button>
