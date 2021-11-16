let currentTheme = localStorage.getItem("data-theme");
if (currentTheme === 'dark')
    document.documentElement.setAttribute("data-theme", "dark");