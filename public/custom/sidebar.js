document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.querySelector('[data-overlay="#default-sidebar"]');
    const sidebar = document.getElementById('default-sidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });
    }
});
