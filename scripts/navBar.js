const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})

window.onscroll = function() {scrollfunk()};

let navbar = document.getElementsByClassName("navbar")[0];

let sticky = navbar.offsetTop;

function scrollfunk() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
        toggleButton.classList.remove("noScroll");
    } else {
        navbar.classList.remove("sticky");
        toggleButton.classList.add("noScroll");
    }
}