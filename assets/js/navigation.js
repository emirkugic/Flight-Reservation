const hamburgerMenu = document.querySelector(".hamburger-menu");
const mobileMenu = document.querySelector(".mobile-menu");
hamburgerMenu.addEventListener("click", function () {
    mobileMenu.classList.toggle("show");
});