let inputs = document.getElementsByClassName("input");

for(let i = 0; i<inputs.length; i++){
    inputs[i].addEventListener("focusout", checkVal);

    inputs[i].addEventListener("change", checkVal);

    function checkVal(event) {
        if (event.target.checkValidity()) {
            event.target.classList.remove("invalid");
        } else {
            event.target.classList.add("invalid");
        }
    }
}