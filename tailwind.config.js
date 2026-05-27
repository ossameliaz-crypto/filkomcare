/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Sky (Primary Blue-Teal)
        'sky-light': '#c4eff5',
        'sky-dark': '#8dd9e3',
        'sky-deeper': '#3ab3c3',
        // Warm (Background tones)
        'warm': '#f1e9e2',
        'warm-dark': '#d4c5b6',
        // Slate (Dark tones)
        'slate-base': '#5f6b64',
        'slate-dark': '#3d4a5e',
        // Semantic
        'danger': '#e05c5c',
        'success': '#4caf7d',
        // Blue palette
        'blue-light': '#c4eff5',
        'blue-normal': '#b0d7df',
        'blue-dark': '#93b3b8',
        // Grey palette
        'grey-light': '#fefdf2',
        'grey-normal': '#f1e9e2',
        'grey-dark': '#d5afaa',
        // Dark Blue
        'dark-light': '#eff0f3',
        'dark-normal': '#5f6b84',
        'dark-darker': '#212536',
        // Primary (used in buttons, accents)
        'primary': '#87B4B8',
        'primary-hover': '#76a2a6',
        'primary-dark': '#5A8A8E',
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}