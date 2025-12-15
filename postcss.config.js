export default {
  plugins: {
    "@tailwindcss/postcss": {
      content: [
        "./templates/**/*.twig",
        "./templates/**/*.html", 
        "./src/**/*.{js,jsx,ts,tsx}",
      ],
    },
  },
};