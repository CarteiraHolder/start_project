/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#40a9a8',
                "primary-light": '#40a9a8',
                secondary: '#4c91ce',
                "secondary-light": '#4c91ce',
                "gray-light": '#E6E7E8',
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

