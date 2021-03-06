/* Store the element in el */
const filterSearch = document.getElementById("filterSearch")
const filterKat = document.getElementById("filterKat")
const filterVerk = document.getElementById("filterVerk")
const sortType = document.getElementById("sortType")
const sortAscDesc = document.getElementById("sortAscDesc")
const filterBTN = document.getElementById("filterBTN")
const filterContainer = document.getElementById("sortContainer")
const spinnerContainer = document.getElementsByClassName("spinnerAddAnim")[0];
let el = document.getElementsByClassName('shopContainer')

/* Get the height and width of the element */
let height;
let width;
if (el[0] != null){
    height = el[0].clientHeight
    width = el[0].clientWidth
}else{
    filterContainer.classList.remove("hide")
}

/*
  * Add a listener for mousemove event
  * Which will trigger function 'handleMove'
  * On mousemove
  */
for (let i = 0; i < el.length; i++){
    let element = el[i]

    element.addEventListener('mousemove', function(e){handleMove(e,element)})


    /* Add listener for mouseout event, remove the rotation */
    element.addEventListener('mouseout', function() {
        element.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
    })
}

let xVal;
let yVal;
let yRotation;
let xRotation;
let prop;

/* Define function a */
function handleMove(e,element) {
    if (window.innerWidth < 800){
        prop = 'perspective(500px) scale(1.1)'
    }else{
        /* Store relative position to element */
        xVal = e.pageX - element.offsetLeft
        yVal = e.pageY - element.offsetTop

        /* Calculate rotation multiplikator 20*/
        yRotation = 20 * ((xVal - width / 2) / width)
        xRotation = -20 * ((yVal - height / 2) / height)

        /* CSS  property*/
        prop = 'perspective(500px) scale(1.1) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'
    }
    element.style.transform = prop

}

function filterShop(){
    let redicrect = "./shop.php?"
    if (filterSearch.value !== ""){
        redicrect+="search="+filterSearch.value+"&"
    }
    if (filterKat.value !== ""){
        redicrect+="kategorie="+filterKat.value+"&"
    }
    if (filterVerk.value !== ""){
        redicrect+="verkaeufer="+filterVerk.value+"&"
    }
    if (sortType.value !== ""){
        redicrect+="sortBY="+sortType.value+"&"
    }
    if (sortAscDesc.value !== ""){
        redicrect+="ascDsc="+sortAscDesc.value
    }
    window.location.href = redicrect
}

function resetFilterShop(){
    window.location.href = "./shop.php"
}

filterBTN.addEventListener("click", ()=>{
    filterContainer.classList.toggle("hide")
})

function addToCart(el){
    const itemID = parseInt(el.value);
    spinnerContainer.style.display = "unset";
    (async()=>{
        let asyncLib = await import("./asyncExec.js");
        let returnVal = await asyncLib.asyncPostWithParms("../php/addToCart.php","id="+itemID+"&count=1");
    })();

    window.dispatchEvent(new CustomEvent('warenkorbUpdated', {detail:{cartChange: 1}}));

    window.setTimeout(function () {
        spinnerContainer.style.display = "none";
    },500);
}

function handleEnterSearch(e){
    if(event.key === 'Enter') {
        filterShop();
    }
}
