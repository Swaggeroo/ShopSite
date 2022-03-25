<?php

require_once "../../php/dbConnection.php";
$db = new db();

$infoVar = array("iban",
    "bic"
);

//check if variables are set
for($i = 0; $i<count($infoVar); $i++){
    if (!isset($_POST[$infoVar[$i]])) {
        die("<script>
           alert('Error: No '.$infoVar[$i]);
           history.back();
          </script>"
        );
    }
}

//get variables
$iban = stripslashes(htmlspecialchars(trim($_POST["iban"])));
$bic = stripslashes(htmlspecialchars(trim($_POST["bic"])));

//checkForRegex
if (!preg_match("/[A-Z]{2}[0-9]{20}/", $iban)){
    dieError("Iban Pattern Mismatch");
}
if (!preg_match("/[A-Z0-9]{11}/", $bic)){
    dieError("Bic Pattern Mismatch");
}

if (!isset($_SESSION)) {
    session_start();
}

$db->updatePayData($iban,$bic,$_SESSION["userID"]);

function dieError($error){
    die("<script>
        console.log('Error: ".$error."');
        alert('Ein Fehler ist aufgetreten');
        location.replace('../../sites/profile.php');
    </script>");
}

echo "<script>
        location.replace('../../sites/profile.php');
        </script>";