let subtotal = document.getElementById("subtotal");
let discount = document.getElementById("discount");
let shipping = document.getElementById("shipping");
let total = document.getElementById("total");

function getTotal(){
    let response = 0.00;
    let prices = document.getElementsByClassName("totalPrice");
    for (let i = 0; i<prices.length;i++){
        response += parseInt(prices[i].textContent.split('.').join("").split(",").join(""));
    }
    return response;
}

function getRealTotal(){
    let response = getTotal();
    return (response/100)+(getShippingVal(response)/100)-(getDiscount(response));
}

function getShippingVal(total){
    let shippingVal = 0;
    if (total < 10000){
        shippingVal = 10000
    }else if(total < 100000){
        shippingVal = 5000;
    }else if(total < 1000000){
        shippingVal = 2500;
    }
    return shippingVal;
}

function getDiscount(total){
    return total/1000;
}

function calculateTotal(){
    (async ()=>{
        let response = getTotal();
        let formatter = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });
        subtotal.textContent = formatter.format(response/100);
        discount.textContent = "- "+formatter.format(getDiscount(response));
        let shippingVal = getShippingVal(response);
        shipping.textContent = formatter.format(shippingVal/100);
        total.textContent = formatter.format((response/100)+(shippingVal/100)-(getDiscount(response)));
    })();

}

calculateTotal();

console.log(getTotal())
console.log(getDiscount(getTotal()))
console.log(getShippingVal(getTotal()))
console.log(getRealTotal())