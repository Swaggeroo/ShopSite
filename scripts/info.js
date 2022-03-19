const pic = document.getElementsByClassName("itemPicture")[0];
const bigPic = document.getElementsByClassName("bigPicture")[0];
const qntField = document.getElementById("inputMenge");

pic.addEventListener('click', ()=>{
    bigPic.classList.toggle("disappear")
})

bigPic.addEventListener('click', ()=>{
    bigPic.classList.toggle("disappear")
})

function addToCart(itemID){
    let qnt = parseInt(qntField.value);
    if (qnt > 999){
        qnt = 999;
    }
    itemID = parseInt(itemID);
    console.log(itemID);
    (async()=>{
        let asyncLib = await import("./asyncExec.js");
        let returnVal = await asyncLib.asyncPostWithParms("../php/addToCart.php","id="+itemID+"&count="+qnt);
        console.log(returnVal);
    })();
}