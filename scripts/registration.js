const plzObj = document.getElementById("plz");
plzObj.addEventListener("input", (e)=>{
    let s = e.target.value
    let last = s.slice(-1)
    if (Number.isNaN(last) && !Number.isInteger(parseFloat(last))){
        plzObj.value = s.substring(0,s.length-1)
    }
})