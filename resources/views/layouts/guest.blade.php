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
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-12 sm:py-20 bg-warm-50 dark:bg-warm-950 relative">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-transparent to-transparent dark:from-blue-500/[0.07] pointer-events-none"></div>

            <div class="relative w-full max-w-sm">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-gradient shadow-sm mb-4">
                        <span class="text-lg font-bold text-white font-serif">PKL</span>
                    </div>
                    <h1 class="text-xl font-semibold text-warm-900 dark:text-warm-50">Monitoring PKL</h1>
                    <p class="text-sm text-warm-500 dark:text-warm-400 mt-1">Sistem Informasi Praktik Kerja Lapangan</p>
                </div>

                <div class="bg-white dark:bg-warm-800 rounded-2xl shadow-sm border border-warm-200 dark:border-warm-700 p-8">
                    {{ $slot }}
                </div>

                <div class="text-center mt-6">
                    <button onclick="toggleDarkModeGuest()" class="text-warm-400 dark:text-warm-500 hover:text-warm-600 dark:hover:text-warm-300 transition-colors text-sm">
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
                        guestLabel.textContent = '\u260C\u00a0Light Mode';
                    } else {
                        guestLabel.textContent = '\u2609\u00a0Dark Mode';
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
