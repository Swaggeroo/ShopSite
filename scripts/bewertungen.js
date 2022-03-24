const starsBewerten = document.getElementsByClassName("starBewerten");
const bewertenForm = document.getElementsByClassName("bewertungsForm")[0];
const commentField = document.getElementsByClassName("kommentarText")[0];
let selectedStars = 0;
let id = -1;

for (let i = 0; i<starsBewerten.length; i++){
    starsBewerten[i].addEventListener("mouseover", (e)=>{
        let m = -1;
        if (e.target.classList.contains("s1")){
            m = 0;
        }else if (e.target.classList.contains("s2")){
            m = 1;
        }else if (e.target.classList.contains("s3")){
            m = 2;
        }else if (e.target.classList.contains("s4")){
            m = 3;
        }else if (e.target.classList.contains("s5")){
            m = 4;
        }
        let u = 4-m;
        while (m>-1){
            starsBewerten[m].src = "../media/icons/star.SVG";
            m--;
        }

        while (u>0){
            starsBewerten[5-u].src = "../media/icons/starGray.SVG";
            u--;
        }
    });

    starsBewerten[i].addEventListener("mouseout", (e)=>{
        let i = 5-selectedStars;
        while (i>0){
            starsBewerten[5-i].src = "../media/icons/starGray.SVG";
            i--;
        }
    });

    starsBewerten[i].addEventListener("click", (e)=>{
        if (e.target.classList.contains("s1")){
            selectedStars = 1;
        }else if (e.target.classList.contains("s2")){
            selectedStars = 2;
        }else if (e.target.classList.contains("s3")){
            selectedStars = 3;
        }else if (e.target.classList.contains("s4")){
            selectedStars = 4;
        }else if (e.target.classList.contains("s5")){
            selectedStars = 5;
        }
    });
}

function setID(newId){
    id = newId;
}

function setComment(newComment, newStars){
    selectedStars = newStars;
    commentField.value = newComment;
    updateStars();
}

function updateStars(){
    let m = selectedStars;
    while (m>0){
        console.log(m);
        starsBewerten[m-1].src = "../media/icons/star.SVG";
        m--;
    }
}

bewertenForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    if (selectedStars > 0 && selectedStars <= 5) {
        if(commentField.value.length < 2000){
            (async()=>{
                let asyncLib = await import("./asyncExec.js");
                let returnVal = await asyncLib.asyncPostWithParms("../php/sendBewertung.php","id="+id+"&comment="+commentField.value+"&stars="+selectedStars);
                if(returnVal !== "noLogin") {
                    if (returnVal === "Success"){
                        window.location.reload();
                    }else {
                        console.log(returnVal);
                        alert("Error beim senden der Bewertung");
                    }
                }else {
                    alert("Du musst eingeloggt sein um etwas zu Bewerten");
                    window.location.replace("../sites/login.php");
                }
            })();
        }else{
            alert("Text zu lang");
        }
    } else {
        alert("Du musst eine Sternebewertung auswählen");
    }
});