import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Pastikan warna yang dibutuhkan tersedia
                amber: {
                    100: '#fef3c7',
                    800: '#92400e',
                },
                emerald: {
                    100: '#d1fae5',
                    800: '#065f46',
                }
            }
        },
    },

    plugins: [forms],

    // Safelist untuk class yang digunakan dinamis
    safelist: [
        'bg-amber-100',
        'text-amber-800',
        'bg-emerald-100',
        'text-emerald-800',
        {
            pattern: /bg-(amber|emerald)-(100|800)/,
            variants: ['hover'],
        },
        {
            pattern: /text-(amber|emerald)-(100|800)/,
        }
    ]
};