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

const plzObj = document.getElementById("plz");
plzObj.addEventListener("input", (e)=>{
    let s = e.target.value
    let last = s.slice(-1)
    if (isNaN(last) && !Number.isInteger(parseFloat(last))){
        plzObj.value = s.substring(0,s.length-1)
    }
})