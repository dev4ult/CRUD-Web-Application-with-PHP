/** @type {import('tailwindcss').Config} */

module.exports = {
  content: ['./public/**/*.{html,js,php}'],
  theme: {
    extend: {
      fontFamily: {
        poppins: 'Poppins',
      },
    },
  },
  plugins: [require('@tailwindcss/typography'), require('daisyui')],
};
