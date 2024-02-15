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
                primary: '#081466',
                "primary-light": '#0E49B5',
                secondary: '#05C60E',
                "secondary-light": '#54E346',
                "gray-light": '#E6E7E8',
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

