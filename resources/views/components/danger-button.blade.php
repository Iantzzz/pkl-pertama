<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold text-sm rounded-xl shadow-lg shadow-red-500/20 hover:shadow-red-500/40 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-warm-800 transition-all duration-200']) }}>
    {{ $slot }}
</button>
