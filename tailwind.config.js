/** @type {import('tailwindcss').Config} */
export default {
    content: ["./src/**/*.{html,js}"],

theme: {
    spinner: (theme) => ({
        default: {
            color: '#dae1e7',
            size: '1em',
            border: '2px',
            speed: '500ms',
        },
    }),
extend: {
    width:{
        '96' : '24rem',
    },
    colors: {
        modalColor: {
            '800': '##1F1F1E',
        },
    },
},
},
    variants: { // all the following default to ['responsive']
        spinner: ['responsive'],
    },
    plugins: [
        // optional configuration for resulting class name and/or tailwind theme key
        require('tailwindcss-spinner')({ className: 'spinner', themeKey: 'spinner' }),
    ],

}
