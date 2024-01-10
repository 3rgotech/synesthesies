/* eslint-disable global-require */
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            animation: {
                'pulse-fast': 'pulse 0.5s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            boxShadow: {
                custom: 'rgba(0, 0, 0, 0.24) 0px 3px 8px',
            },
            fontFamily: {
                sans: ['Nunito Sans', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: '0.625rem',
            },
            height: (theme) => ({
                ...theme('spacing'),
            }),
            maxHeight: (theme) => ({
                ...theme('spacing'),
            }),
            maxWidth: (theme) => ({
                ...theme('spacing'),
            }),
            minHeight: (theme) => ({
                ...theme('spacing'),
            }),
            minWidth: (theme) => ({
                ...theme('spacing'),
            }),
            transitionProperty: {
                width:   'width',
                spacing: 'margin, padding',
            },
            zIndex: {
                50:  '50',
                60:  '60',
                70:  '70',
                80:  '80',
                90:  '90',
                100: '100',
                max: '9999',
            },
        },
    },
    plugins: [
        // require('@tailwindcss/aspect-ratio'),
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
    ],
};
