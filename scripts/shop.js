/* Store the element in el */
let el = document.getElementsByClassName('shopElement')
console.log(el);
console.log(document.getElementsByClassName('shopElement')[0])

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
    /*
      * Get position of mouse cursor
      * With respect to the element
      * On mouseover
      */
    /* Store the x position */
    const xVal = e.layerX
    /* Store the y position */
    const yVal = e.layerY

    /*
      * Calculate rotation valuee along the Y-axis
      * Here the multiplier 20 is to
      * Control the rotation
      * You can change the value and see the results
      */
    const yRotation = 20 * ((xVal - width / 2) / width)

    /* Calculate the rotation along the X-axis */
    const xRotation = -20 * ((yVal - height / 2) / height)

    /* Generate string for CSS transform property */
    const string = 'perspective(500px) scale(1.1) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'

    element.style.transform = string

    /* Apply the calculated transformation */

}
