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
                gold: {
                    50: '#FBF7EE',
                    100: '#F5EDD3',
                    200: '#E8D5A3',
                    300: '#DDBF7A',
                    400: '#D4AF37',
                    500: '#C9A84C',
                    600: '#B8952E',
                    700: '#8A7022',
                    800: '#6B551A',
                    900: '#4D3D12',
                },
                warm: {
                    50: '#F8F5F0',
                    100: '#F0EBE3',
                    200: '#E0D8CC',
                    300: '#C5BBAE',
                    400: '#A69A8A',
                    500: '#8C8273',
                    600: '#736A5C',
                    700: '#5C5447',
                    800: '#453E34',
                    900: '#2D2822',
                    950: '#1A1510',
                },
            },
            boxShadow: {
                'warm-sm': '0 1px 3px rgba(45, 40, 34, 0.06), 0 1px 2px rgba(45, 40, 34, 0.04)',
                'warm': '0 4px 6px rgba(45, 40, 34, 0.07), 0 2px 4px rgba(45, 40, 34, 0.04)',
                'warm-lg': '0 10px 25px rgba(45, 40, 34, 0.1), 0 4px 10px rgba(45, 40, 34, 0.05)',
                'warm-xl': '0 20px 50px rgba(45, 40, 34, 0.12)',
                'gold-sm': '0 2px 8px rgba(201, 168, 76, 0.2)',
                'gold': '0 4px 16px rgba(201, 168, 76, 0.25)',
                'gold-lg': '0 8px 32px rgba(201, 168, 76, 0.3)',
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
                'gold-gradient': 'linear-gradient(135deg, #C9A84C 0%, #E8D5A3 40%, #C9A84C 100%)',
                'gold-gradient-subtle': 'linear-gradient(135deg, rgba(201, 168, 76, 0.08) 0%, rgba(232, 213, 163, 0.04) 100%)',
                'warm-dark': 'linear-gradient(180deg, #1A1510 0%, #2D2822 100%)',
                'warm-light': 'linear-gradient(180deg, #F8F5F0 0%, #F0EBE3 100%)',
            },
        },
    },

    plugins: [forms],
};
