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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand-bg': '#E8EBF2',
                'brand-accent': '#000000',
                'brand-glass': 'rgba(255, 255, 255, 0.7)',
                'brand-muted': '#F3F5F9',
            },
            borderRadius: {
                'pill': '100px',
                'high': '40px',
                '5xl': '3rem',
                '6xl': '4rem',
            },
            backdropBlur: {
                'xs': '2px',
            }
        },
    },

    plugins: [forms],
};
