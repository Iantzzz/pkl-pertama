<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script>
            (function() {
                var theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-10 sm:py-16 bg-warm-50 dark:bg-warm-950 relative">
            <div class="absolute inset-0 bg-gradient-to-br from-gold-500/5 to-transparent dark:from-gold-500/5 dark:to-transparent pointer-events-none"></div>

            <div class="relative w-full max-w-md">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gold-gradient shadow-gold-sm mb-5">
                        <span class="text-2xl font-bold text-warm-900 font-serif">PKL</span>
                    </div>
                    <h1 class="font-serif text-3xl font-bold text-warm-900 dark:text-warm-50">Monitoring PKL</h1>
                    <p class="text-warm-500 dark:text-gold-300/70 text-sm mt-1.5 tracking-wide">Sistem Informasi Praktik Kerja Lapangan</p>
                </div>

                <div class="bg-white dark:bg-warm-900 rounded-2xl shadow-warm-lg dark:shadow-warm-xl border border-warm-200 dark:border-gold-500/15 p-8">
                    {{ $slot }}
                </div>

                <div class="text-center mt-6">
                    <button onclick="toggleDarkModeGuest()" class="text-warm-400 dark:text-gold-300/60 hover:text-warm-600 dark:hover:text-gold-300 transition-colors text-sm tracking-wide">
                        <span id="guestThemeLabel"></span>
                    </button>
                </div>
            </div>
        </div>

        <script>
            var guestHtml = document.documentElement;
            var guestLabel = document.getElementById('guestThemeLabel');
            function updateGuestLabel() {
                if (guestLabel) {
                    if (guestHtml.classList.contains('dark')) {
                        guestLabel.textContent = '\u260C\xa0Switch to Light Mode';
                    } else {
                        guestLabel.textContent = '\u2609\xa0Switch to Dark Mode';
                    }
                }
            }
            updateGuestLabel();

            function toggleDarkModeGuest() {
                if (guestHtml.classList.contains('dark')) {
                    guestHtml.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    guestHtml.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateGuestLabel();
            }
        </script>
    </body>
</html>
