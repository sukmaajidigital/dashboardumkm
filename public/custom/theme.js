document.addEventListener("DOMContentLoaded", function () {
    const themes = ["light", "dark", "gourmet", "corporate", "luxury", "soft", "my"];
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

document.addEventListener("DOMContentLoaded", function () {
    const directions = ["ltr", "rtl"];
    const directionSelector = document.getElementById("direction-selector");
    const rootElement = document.documentElement;

    // Load direction from localStorage
    const saveddirection = localStorage.getItem("selected-direction");
    if (saveddirection && directions.includes(saveddirection)) {
        rootElement.setAttribute("data-direction", saveddirection);
    }

    // Populate dropdown
    directions.forEach(direction => {
        const option = document.createElement("option");
        option.value = direction;
        option.textContent = direction.charAt(0).toUpperCase() + direction.slice(1);
        if (direction === rootElement.getAttribute("dir")) {
            option.selected = true;
        }
        directionSelector.appendChild(option);
    });

    // Change direction on selection
    directionSelector.addEventListener("change", function () {
        const selecteddirection = this.value;
        rootElement.setAttribute("dir", selecteddirection);
        localStorage.setItem("selected-direction", selectedTheme);
    });
});
