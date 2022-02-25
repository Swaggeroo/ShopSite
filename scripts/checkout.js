let checkout = document.getElementById("cartCheckout");

let stickyCheck = checkout.offsetTop;

window.addEventListener("scroll", scrollfunk);

function scrollfunk() {
    console.log("ran")
    console.log(stickyCheck + " - " + window.pageYOffset)
    if (window.pageYOffset >= stickyCheck-80) {
        checkout.classList.add("stickyCheck");
    } else {
        checkout.classList.remove("stickyCheck");
    }
}

console.log("ran");