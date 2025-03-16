document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.querySelector('[data-overlay="#default-sidebar"]');
    const sidebar = document.getElementById('default-sidebar');

    function toggleSidebar() {
        sidebar.classList.toggle('open');
    }
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }
});

document.getElementById('toggle-sidebar').addEventListener('click', function () {

    if (window.innerWidth <= 200) {
        const pageContainer = document.getElementById('page-container');
        pageContainer.classList.toggle('sidebar-hidden');
        // Sidebar content fade animation
        const sidebarContent = document.getElementById('sidebar-content');
        if (sidebarContent.classList.contains('hidden')) {
            sidebarContent.classList.remove('hidden');
            sidebarContent.classList.add('fade-in');
            setTimeout(() => sidebarContent.classList.remove('fade-in'), 300);
        } else {
            sidebarContent.classList.add('fade-out');
            setTimeout(() => {
                sidebarContent.classList.remove('fade-out');
                sidebarContent.classList.add('hidden');
            }, 300);
        }

        // Avatar dropdown fade animation
        const dropdownAvatar = document.getElementById('dropdown-avatar');
        if (dropdownAvatar.classList.contains('hidden')) {
            dropdownAvatar.classList.remove('hidden');
            dropdownAvatar.classList.add('fade-in');
            setTimeout(() => dropdownAvatar.classList.remove('fade-in'), 300);
        } else {
            dropdownAvatar.classList.add('fade-out');
            setTimeout(() => {
                dropdownAvatar.classList.remove('fade-out');
                dropdownAvatar.classList.add('hidden');
            }, 300);
        }
    } else {
        const pageContainer = document.getElementById('page-container');
        pageContainer.classList.toggle('sidebar-hidden');
        // Sidebar content fade animation
        const sidebarContent = document.getElementById('sidebar-content');
        if (sidebarContent.classList.contains('hidden')) {
            sidebarContent.classList.remove('hidden');
            sidebarContent.classList.add('fade-in');
            setTimeout(() => sidebarContent.classList.remove('fade-in'), 300);
        } else {
            sidebarContent.classList.add('fade-out');
            setTimeout(() => {
                sidebarContent.classList.remove('fade-out');
                sidebarContent.classList.add('hidden');
            }, 300);
        }

        // Avatar dropdown fade animation
        const dropdownAvatar = document.getElementById('dropdown-avatar');
        if (dropdownAvatar.classList.contains('hidden')) {
            dropdownAvatar.classList.remove('hidden');
            dropdownAvatar.classList.add('fade-in');
            setTimeout(() => dropdownAvatar.classList.remove('fade-in'), 300);
        } else {
            dropdownAvatar.classList.add('fade-out');
            setTimeout(() => {
                dropdownAvatar.classList.remove('fade-out');
                dropdownAvatar.classList.add('hidden');
            }, 300);
        }
    }

});
