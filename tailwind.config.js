/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container: {
      center: true,
    },
    extend: {
      colors: {
        "orange": "#E9A178",
        "red": "#A84448",
        "cream": "#F6E1C3",
      },
    },
  },
  plugins: [],
}