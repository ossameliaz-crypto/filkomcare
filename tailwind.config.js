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
        'primary': '#87B4B8', 
        'danger': '#E05C5C',  
        'dark': '#2D3748',    
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'], 
      }
    },
  },
  plugins: [],
}