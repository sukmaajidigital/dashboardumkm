import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
// tailwind.config.js
module.exports = {
    flyonui: {
        themes: [
            {
                mytheme: {
                    primary: "#3498db",
                    "primary-content": "#010811",
                    secondary: "#e74c3c",
                    "secondary-content": "#130201",
                    accent: "#9b59b6",
                    "accent-content": "#ebddf1",
                    neutral: "#95a5a6",
                    "neutral-content": "#080a0a",
                    "base-100": "#ecf0f1",
                    "base-200": "#cdd1d2",
                    "base-300": "#afb2b3",
                    "base-content": "#131414",
                    info: "#1abc9c",
                    "info-content": "#000d09",
                    success: "#2ecc71",
                    "success-content": "#010f04",
                    warning: "#f1c40f",
                    "warning-content": "#140e00",
                    error: "#e74c3c",
                    "error-content": "#130201",
                },
            },
        ],
    },
    plugins: [require("flyonui")],
};
