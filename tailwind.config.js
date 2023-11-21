/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    "*/*.{html,js,php}",
    "./index.html",
  ],
   theme: {
    extend: {
      colors: {
        'primary': {
          100: '#327FAE',
          200: '#2e739e',
          300: '#29688E',
          400: '#255C7E',
          500: '#1e4b67',
        },
        'secondary': {
          100: '#FEC29A',
          200: '#FEB685',
          300: '#FEA971',
          400: '#FE9D5D',
          500: '#fe9148',
        },
        'tertiary': {
          100: '#FEE9AE',
          200: '#FEE39A',
          300: '#FEDE85',
          400: '#FED872',
          500: '#fdd35d',
        },
      },
    },
},
plugins: [
  require('@tailwindcss/forms'),
],
}