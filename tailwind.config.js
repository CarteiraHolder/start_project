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
                primary: '#1d548d',
                "primary-light": '#508cd2',
                secondary: '#44b285',
                "secondary-light": '#49a49f',
                "gray-light": '#E6E7E8',
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

