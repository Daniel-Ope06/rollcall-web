const nav_toggle = document.getElementsByClassName("navbar-toggler")[0];
const nav_items = document.getElementsByClassName("navbar-collapse")[0];

const hamburger = document.getElementById("hamburger-icon");
const close = document.getElementById("close-icon");

nav_toggle.addEventListener('click', function() {
    nav_items.classList.toggle("open");
    hamburger.classList.toggle("hide-hamburger")
    close.classList.toggle("show-close");
});