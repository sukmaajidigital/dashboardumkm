// tailwind.config.js
const { addDynamicIconSelectors } = require("@iconify/tailwind")
module.exports = {
    content: [
        "./src/*.html",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flyonui/dist/js/*.js",
        "./node_modules/flyonui/dist/js/accordion.js",
        "./node_modules/jquery/dist/jquery.min.js",
        "./node_modules/datatables.net/js/dataTables.min.js",
        "./node_modules/datatables.net-dt/js/dataTables.dataTables.min.js",
        "./node_modules/datatables.net-buttons-dt/js/buttons.dataTables.min.js",
        "./node_modules/datatables.net-responsive-dt/js/responsive.dataTables.min.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("flyonui"),
        require("flyonui/plugin"),
        // Iconify plugin
        addDynamicIconSelectors(),
    ],
    flyonui: {
        themes: ["light", "dark", "gourmet", "corporate", "luxury", "soft"]
    }
};
