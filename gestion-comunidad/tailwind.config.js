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
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#1E4A26',
                accent: '#26FF05',
                'accent-lime': '#A3FF05',
                page: '#F5F7FA',
                card: '#FFFFFF',
                main: '#1A1A1A',
                muted: '#6B7280',
            },
        },
    },

    plugins: [forms],
};
