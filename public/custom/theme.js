document.addEventListener("DOMContentLoaded", function () {
    const themes = ["light", "dark", "gourmet", "corporate", "luxury", "soft"];
    const themeSelector = document.getElementById("theme-selector");
    const rootElement = document.documentElement;

    // Load theme from localStorage
    const savedTheme = localStorage.getItem("selected-theme");
    if (savedTheme && themes.includes(savedTheme)) {
        rootElement.setAttribute("data-theme", savedTheme);
    }

    // Populate dropdown
    themes.forEach(theme => {
        const option = document.createElement("option");
        option.value = theme;
        option.textContent = theme.charAt(0).toUpperCase() + theme.slice(1);
        if (theme === rootElement.getAttribute("data-theme")) {
            option.selected = true;
        }
        themeSelector.appendChild(option);
    });

    // Change theme on selection
    themeSelector.addEventListener("change", function () {
        const selectedTheme = this.value;
        rootElement.setAttribute("data-theme", selectedTheme);
        localStorage.setItem("selected-theme", selectedTheme);
    });
});
