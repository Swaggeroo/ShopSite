const editButtons = document.getElementsByClassName("editInfo");

for (let i = 0; i<editButtons.length; i++){
    editButtons[i].addEventListener("click", clickEdit);
}

function clickEdit(e){
    let classlist = e.target.classList;
    if (classlist.contains("persData")){
        window.location.href = "../sites/editPersData.php";
    }else if(classlist.contains("payData")){
        window.location.href = "../sites/editPayData.php";
    }else if(classlist.contains("proData")){
        window.location.href = "../sites/editProData.php";
    }
}
