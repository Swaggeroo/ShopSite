const pic = document.getElementsByClassName("itemPicture")[0];
const bigPic = document.getElementsByClassName("bigPicture")[0];
const qntField = document.getElementById("inputMenge");
const spinnerContainer = document.getElementsByClassName("spinnerAddAnim")[0];

pic.addEventListener('click', ()=>{
    bigPic.classList.toggle("disappear")
})

bigPic.addEventListener('click', ()=>{
    bigPic.classList.toggle("disappear")
})

function addToCart(itemID){
    spinnerContainer.style.display = "unset";
    let qnt = parseInt(qntField.value);
    if (qnt > 999){
        qnt = 999;
    }
    if (qnt < 1){
        qnt = 0;
    }
    itemID = parseInt(itemID);
    window.dispatchEvent(new CustomEvent('warenkorbUpdated', {detail:{cartChange: qnt}}));
    (async()=>{
        let asyncLib = await import("./asyncExec.js");
        let returnVal = await asyncLib.asyncPostWithParms("../php/addToCart.php","id="+itemID+"&count="+qnt);
    })();

    window.setTimeout(function () {
        spinnerContainer.style.display = "none";
    },500);
}