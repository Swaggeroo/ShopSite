let inputs = document.getElementsByClassName("input");
let pwInputs = document.getElementsByClassName("pwInput");
let shown = false;

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

for(let i = 0; i<pwInputs.length; i++){
    let parent = pwInputs[i].parentNode;
    parent.getElementsByClassName("togglePassword")[0].addEventListener("mousedown", showPW);
}

document.addEventListener("mouseup", hidePW);

function showPW(event) {
    shown = true;
    event.target.classList.add("showPW");
    let parent = event.target.parentNode;
    parent.getElementsByClassName("pwInput")[0].setAttribute('type','text');
}

function hidePW(event) {
    if (shown){
        for(let i = 0; i<pwInputs.length; i++){
            pwInputs[i].setAttribute('type','password');
            let parent = pwInputs[i].parentNode;
            parent.getElementsByClassName("togglePassword")[0].classList.remove("showPW");
        }
        shown = false;
    }
}