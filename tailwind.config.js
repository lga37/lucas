import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // ✅ Enable class-based dark mode
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    safelist: [
    'bg-green-100',
    'bg-green-200',
    'bg-green-300',
    'bg-green-400',
    'bg-green-500',
    'bg-green-600',
    'bg-green-700',
    'bg-green-800',
    'bg-green-900',
    'border-green-100',
    'border-green-200',
    'border-green-300',
    'border-green-400',
    'border-green-500',
    'border-green-600',
    'border-green-700',
    'border-green-800',
    'border-green-900',
    'border-cyan-100',
    'border-cyan-200',
    'border-cyan-300',
    'border-cyan-400',
    'border-cyan-500',
    'border-cyan-600',
    'border-cyan-700',
    'border-cyan-800',
    'border-cyan-900',
    'border-yellow-100',
    'border-yellow-200',
    'border-yellow-300',
    'border-yellow-400',
    'border-yellow-500',
    'border-yellow-600',
    'border-yellow-700',
    'border-yellow-800',
    'border-yellow-900',
    'text-yellow-100',
    'text-yellow-200',
    'text-yellow-300',
    'text-yellow-400',
    'text-yellow-500',
    'text-yellow-600',
    'text-yellow-700',
    'text-yellow-800',
    'text-yellow-900',
  ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            display: ['print'], // 👈 enable print variant
        },
    },

    plugins: [forms, typography],
};
