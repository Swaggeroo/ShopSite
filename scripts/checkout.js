let checkout = document.getElementById("cartCheckout");

let stickyCheck = checkout.offsetTop;

window.addEventListener("scroll", scrollfunk);

window.addEventListener('resize', scrollfunk);

function scrollfunk() {
    if (!(window.innerWidth < 800)){
        if (window.pageYOffset >= stickyCheck-80) {
            checkout.classList.add("stickyCheck");
        } else {
            checkout.classList.remove("stickyCheck");
        }
    }else {
        checkout.classList.remove("stickyCheck");
    }
}

console.log("ran");