/* Store the element in el */
let el = document.getElementsByClassName('shopContainer')
console.log(el);
console.log(document.getElementsByClassName('shopContainer')[0])

/* Get the height and width of the element */
const height = el[0].clientHeight
const width = el[0].clientWidth

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

/* Define function a */
function handleMove(e,element) {
    /* Store relative position to element */
    const xVal = e.pageX - element.offsetLeft;
    const yVal = e.pageY - element.offsetTop;

    /* Calculate rotation multiplikator 20*/
    const yRotation = 20 * ((xVal - width / 2) / width)
    const xRotation = -20 * ((yVal - height / 2) / height)

    /* CSS  property*/
    let prop;
    if (window.innerWidth < 800){
        prop = 'perspective(500px) scale(1.1)'
    }else{
        prop = 'perspective(500px) scale(1.1) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'
    }
    element.style.transform = prop

}
