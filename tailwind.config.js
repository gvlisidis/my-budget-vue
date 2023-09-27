const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                'poppins': ['Poppins', 'sans-serif']
            },
            colors: {
                'custom': {
                    '50': '#f5f7fa',
                    '100': '#e9edf5',
                    '200': '#cfd9e8',
                    '300': '#a4b8d5',
                    '400': '#7392bd',
                    '500': '#5175a6',
                    '600': '#446497',
                    '700': '#334a71',
                    '800': '#2e405e',
                    '900': '#2a3850',
                    '950': '#1c2435',
                },
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-debug-screens'),
    ],
};
