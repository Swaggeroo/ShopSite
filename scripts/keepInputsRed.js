let inputs = document.getElementsByClassName("input");
let form = document.getElementsByClassName("formular")[0];
let snackBar = document.getElementById("snackbar");
let timeout;

for(let i = 0; i<inputs.length; i++){
    inputs[i].addEventListener("focusout", checkVal);

    inputs[i].addEventListener("input", checkVal);
    inputs[i].addEventListener("input", showError);

    function checkVal(event) {
        if (event.target.checkValidity()) {
            event.target.classList.remove("invalid");
        } else {
            event.target.classList.add("invalid");
        }
    }

    function showError(event){
        if (event.target.checkValidity()) {
            window.clearTimeout(timeout)
            snackBar.classList.remove("show");
        } else {
            snackBar.textContent = event.target.title;
            snackBar.classList.add("show");
            window.clearTimeout(timeout);
            timeout = window.setTimeout(function () {
                snackBar.classList.remove("show");
            },5000);
        }
    }
}