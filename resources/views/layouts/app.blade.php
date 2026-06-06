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
    <body class="font-sans antialiased bg-warm-50 dark:bg-warm-950">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <div class="lg:pl-64">
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <div id="lightbox-overlay" class="fixed inset-0 z-50 bg-black/80 hidden items-center justify-center p-4" onclick="closeLightbox(event)">
            <button onclick="closeLightbox(event)" class="absolute top-4 right-4 text-white/80 hover:text-white text-3xl leading-none w-10 h-10 flex items-center justify-center rounded-full hover:bg-white/10 transition-all">&times;</button>
            <img id="lightbox-img" src="" class="max-w-full max-h-full rounded-xl shadow-2xl object-contain" style="max-height: 90vh;">
        </div>

        <script>
            function toggleDarkMode() {
                var html = document.documentElement;
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }

            function openLightbox(src) {
                document.getElementById('lightbox-img').src = src;
                document.getElementById('lightbox-overlay').classList.remove('hidden');
                document.getElementById('lightbox-overlay').classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox(e) {
                if (e) e.stopPropagation();
                document.getElementById('lightbox-overlay').classList.add('hidden');
                document.getElementById('lightbox-overlay').classList.remove('flex');
                document.body.style.overflow = '';
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    var overlay = document.getElementById('lightbox-overlay');
                    if (overlay && !overlay.classList.contains('hidden')) {
                        closeLightbox(e);
                    }
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>
