var checkbox = document.querySelector("input[name=theme]");
let theme = localStorage.getItem("data-theme");

const changeThemeToDark = () => {
    document.documentElement.setAttribute("data-theme", "dark");
    let alert = document
        .getElementById("topalert");
    if (alert) alert.setAttribute("class", "alert alert-dark");
    localStorage.setItem("data-theme", "dark"); // save theme to local storage
};

const changeThemeToLight = () => {
    document.documentElement.setAttribute("data-theme", "light");
    let alert = document
        .getElementById("topalert");
    if (alert) alert.setAttribute("class", "alert alert-success");
    localStorage.setItem("data-theme", "light"); // save theme to local storage
};

(function () {
    if (theme == "light") {
        changeThemeToLight();
        checkbox.checked = false;
    } else if (theme == "dark") {
        changeThemeToDark();
        checkbox.checked = true;
    }
})();

checkbox.addEventListener("change", function () {
    if (this.checked) {
        changeThemeToDark();
    } else {
        changeThemeToLight();
    }
});
