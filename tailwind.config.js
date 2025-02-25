// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("flyonui")],
    flyonui: {
        themes: [
            {
                mytheme: {
                    primary: "#a991f7",
                    secondary: "#f6d860",
                    accent: "#37cdbe",
                    neutral: "#3d4451",
                    "base-100": "#ffffff",
                },
            },
            "light", // Def
            // ault font family
            "dark", // Default font family
            "gourmet", // fontFamily: 'Rubik'
            "corporate", // fontFamily: 'Public Sans'
            "luxury", // fontFamily: 'Archivo'
            "soft", // fontFamily: 'Montserrat'
        ],
    },
};
