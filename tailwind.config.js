// tailwind.config.js
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flyonui/dist/js/*.js",
        "./node_modules/flyonui/dist/js/accordion.js",
        "./node_modules/datatables.net/js/dataTables.min.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("flyonui"), require("flyonui/plugin")],
    flyonui: {},
};
