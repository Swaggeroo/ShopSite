let checkout = document.getElementById("cartCheckout");
let itemCountControlls = document.getElementsByClassName("itemCountBTN");
let subtotal = document.getElementById("subtotal");
let discount = document.getElementById("discount");
let shipping = document.getElementById("shipping");
let total = document.getElementById("total");
let itemContainer = document.getElementById("cartItems");
let checkoutBTN = document.getElementById("checkoutFancyBTN");

let stickyCheck = checkout.offsetTop;

window.addEventListener("scroll", scrollfunk);

window.addEventListener('resize', scrollfunk);

checkoutBTN.addEventListener('click', ()=>{
   if (!isEmpty()){
       window.location.href = "./checkout.php";
   }else {
       alert("Dein Warenkorb ist leer");
   }
});

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

function changeCount(el){
    console.log("clicked")
    let input = el.parentNode.getElementsByClassName("itemCountInput")[0];
    let itemNode = el.parentNode.parentNode;
    let h2Tag = itemNode.getElementsByClassName("itemPreis")[0].getElementsByClassName("totalPrice")[0];
    let pricePerItem = h2Tag.classList.item(1);
    let factor = el.textContent === "+" ? 1 : -1;
    window.dispatchEvent(new CustomEvent('warenkorbUpdated', {detail:{cartChange: factor}}));
    input.value = parseInt(input.value) + factor;
    if (input.value > 999){
        input.value = 999;
    }
    h2Tag.textContent = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(input.value*pricePerItem/100);
    (async ()=>{
        if (input.value<=0){
            itemNode.parentNode.removeChild(itemNode);
            if (isEmpty()){
                showEmpty();
            }
            let module = await import("../scripts/asyncExec.js");
            let response = await module.asyncPostWithParms("../php/cartFunctions/removeFromCart.php","id="+parseInt(input.name));
            console.log(response);
        }else{
            let module = await import("../scripts/asyncExec.js");
            let response = await module.asyncPostWithParms("../php/cartFunctions/getCartItemCount.php","id="+parseInt(input.name));
            console.log(response);
            response = (factor + parseInt(response));
            response = await module.asyncPostWithParms("../php/cartFunctions/updateCartCount.php","id="+parseInt(input.name)+"&count="+response);
            console.log(response);
        }
    })();
    calculateTotal();
}

function calculateTotal(){
    (async ()=>{
        let response = 0.000;
        let prices = document.getElementsByClassName("totalPrice");
        for (let i = 0; i<prices.length;i++){
            console.log(prices[i].textContent);
            response += parseInt(prices[i].textContent.split('.').join("").split(",").join(""));
            console.log(response);
        }

        let formatter = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });
        subtotal.textContent = formatter.format(response/100);
        discount.textContent = "- "+formatter.format(response/1000);
        let shippingVal = 0;
        if (response < 10000){
            shippingVal = 10000
        }else if(response < 100000){
            shippingVal = 5000;
        }else if(response < 1000000){
            shippingVal = 2500;
        }
        shipping.textContent = formatter.format(shippingVal/100);
        total.textContent = formatter.format((response/100)+(shippingVal/100)-(response/1000));
    })();

}



function isEmpty(){
    let items = document.getElementsByClassName("item");
    if (items.length <= 0){
        return true;
    }
}

function showEmpty(){
    let text = document.createElement("span");
    text.innerText = "Dein Warenkorb ist leer "
    let link = document.createElement('a');
    link.innerText = "Zum Shop";
    link.classList.add("emptyButton");
    link.href = "./shop.php";
    itemContainer.appendChild(text);
    itemContainer.appendChild(link);
    checkoutBTN.style.color = "gray";
}

calculateTotal();
if (isEmpty()){
    showEmpty();
}