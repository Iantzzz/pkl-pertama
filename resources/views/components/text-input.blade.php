@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border border-warm-300 dark:border-warm-700 bg-white dark:bg-warm-800 px-4 py-2.5 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-warm-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:focus:border-blue-500 dark:focus:ring-blue-500/20 transition-all duration-200']) }}>
