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
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (document.querySelector('.tinymce')) {
                    tinymce.init({
                        selector: '.tinymce',
                        height: 300,
                        menubar: false,
                        plugins: 'lists link image',
                        toolbar: 'undo redo | bold italic | bullist numlist | alignleft aligncenter alignright | link',
                        content_style: 'body { font-family: Figtree, sans-serif; font-size: 14px; }'
                    });
                }
            });
        </script>
    </head>
    <body class="font-sans bg-warm-50 dark:bg-warm-950 text-warm-900 dark:text-warm-50 min-h-screen transition-colors duration-300">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <div class="border-b border-gold-500/10 dark:border-gold-500/10 bg-white dark:bg-warm-900">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <main class="animate-fade-in">
                {{ $slot }}
            </main>
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
        </script>

        @stack('scripts')
    </body>
</html>
