let pic = document.getElementsByClassName("itemPicture")[0];
let bigPic = document.getElementsByClassName("bigPicture")[0];

pic.addEventListener('click', ()=>{
    bigPic.classList.toggle("disappear")
})

bigPic.addEventListener('click', ()=>{
    bigPic.classList.toggle("disappear")
})