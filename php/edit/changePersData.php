<?php

require_once "../../php/dbConnection.php";
$db = new db();

$infoVar = array("vorname",
    "nachname",
    "strasse",
    "stadt",
    "plz"
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
$vorname = stripslashes(htmlspecialchars(trim($_POST["vorname"])));
$nachname = stripslashes(htmlspecialchars(trim($_POST["nachname"])));
$strasse = stripslashes(htmlspecialchars(trim($_POST["strasse"])));
$stadt = stripslashes(htmlspecialchars(trim($_POST["stadt"])));
$plz = intval(stripslashes(htmlspecialchars(trim($_POST["plz"]))));

//checkForRegex
if (!preg_match("/[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}/", $vorname)){
    dieError("Vorname Pattern Mismatch");
}
if (!preg_match("/[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}/", $nachname)){
    dieError("Nachname Pattern Mismatch");
}
if (!preg_match("/[A-Za-zßÄÜÖäüöÉÚÓÁéúóá\- ]{2,}[ ]{1}[0-9]{1,}/", $strasse)){
    dieError("Strasse Pattern Mismatch");
}
if (!preg_match("/[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{2,}/", $stadt)){
    dieError("Stadt Pattern Mismatch");
}
if (!preg_match("/[0-9]{5}/", $plz)){
    dieError("Plz Pattern Mismatch");
}

if (!isset($_SESSION)) {
    session_start();
}

$db->updatePersData($vorname,$nachname,$strasse,$stadt,$plz,$_SESSION["userID"]);

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