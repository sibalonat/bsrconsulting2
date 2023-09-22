import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                'sans': ['Montserrat', ...defaultTheme.fontFamily.sans],
                'display': ['Oswald', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                'first-gray': '#F2F2F2',
                'second-gray': '#BFBFBF',
                'third-gray': '#8C8C8C',
                'forth-gray': '#404040',
                'fifth-gray': '#0D0D0D',
            },
        },
    },

    plugins: [forms],
};
