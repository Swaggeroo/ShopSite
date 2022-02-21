const navbar = document.getElementsByClassName("navbar")[0];
const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]
navbar.classList.add("sticky");
toggleButton.classList.remove("noScroll");

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})