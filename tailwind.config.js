import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                warm: {
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    200: '#E2E8F0',
                    300: '#CBD5E1',
                    400: '#94A3B8',
                    500: '#64748B',
                    600: '#475569',
                    700: '#334155',
                    800: '#1E293B',
                    900: '#0F172A',
                    950: '#020617',
                },
            },
            boxShadow: {
                'warm-sm': '0 1px 3px rgba(15, 23, 42, 0.06), 0 1px 2px rgba(15, 23, 42, 0.04)',
                'warm': '0 4px 6px rgba(15, 23, 42, 0.07), 0 2px 4px rgba(15, 23, 42, 0.04)',
                'warm-lg': '0 10px 25px rgba(15, 23, 42, 0.1), 0 4px 10px rgba(15, 23, 42, 0.05)',
                'warm-xl': '0 20px 50px rgba(15, 23, 42, 0.12)',
                'blue-sm': '0 2px 8px rgba(59, 130, 246, 0.2)',
                'blue': '0 4px 16px rgba(59, 130, 246, 0.25)',
                'blue-lg': '0 8px 32px rgba(59, 130, 246, 0.3)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-up': 'slideUp 0.5s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
            backgroundImage: {
                'blue-gradient': 'linear-gradient(135deg, #1D4ED8 0%, #3B82F6 50%, #1D4ED8 100%)',
                'blue-gradient-subtle': 'linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(59, 130, 246, 0.04) 100%)',
                'warm-dark': 'linear-gradient(180deg, #020617 0%, #0F172A 100%)',
                'warm-light': 'linear-gradient(180deg, #F8FAFC 0%, #F1F5F9 100%)',
            },
        },
    },

    plugins: [forms],
};
