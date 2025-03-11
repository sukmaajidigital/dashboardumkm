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
        themes: [
            {
                my: {
                    primary: "#4CAF50", // Hijau utama yang lembut
                    secondary: "#81C784", // Hijau muda sebagai warna sekunder
                    accent: "#388E3C", // Hijau tua untuk aksen
                    neutral: "#2E7D32", // Hijau netral yang lebih gelap
                    "base-100": "#F1F8E9", // Warna dasar hijau pucat untuk kenyamanan
                    info: "#2196F3", // Biru untuk informasi
                    success: "#4CAF50", // Hijau untuk sukses
                    warning: "#FB8C00", // Oranye untuk peringatan
                    error: "#F44336", // Merah untuk kesalahan

                    "--rounded-box": "1.5rem", // Border-radius lebih bulat untuk box besar
                    "--rounded-btn": "1rem", // Border-radius lebih bulat untuk tombol
                    "--rounded-tooltip": "2rem", // Tooltip lebih membulat
                    "--animation-btn": "0.3s", // Animasi tombol sedikit lebih lambat agar smooth
                    "--animation-input": "0.25s", // Animasi input lebih natural
                    "--btn-focus-scale": "0.98", // Sedikit lebih besar saat tombol difokuskan
                    "--border-btn": "1px", // Ketebalan border tombol tetap
                    "--tab-border": "1px", // Ketebalan border tab tetap
                    "--tab-radius": "1rem" // Border-radius lebih bulat untuk tab
                }

            }, "light", "dark", "gourmet", "corporate", "luxury", "soft"]
    }
};
