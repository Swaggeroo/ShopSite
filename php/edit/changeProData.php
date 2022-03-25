<?php

require_once "../../php/dbConnection.php";
$db = new db();

$infoVar = array("email",
    "passwort",
    "passwortWiederholung",
    "oldPasswort",
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
$email = stripslashes(htmlspecialchars(trim($_POST["email"])));
$oldPassword = stripslashes(htmlspecialchars(trim($_POST["oldPasswort"])));
$password = stripslashes(htmlspecialchars(trim($_POST["passwort"])));
$passwortWiederholung = stripslashes(htmlspecialchars(trim($_POST["passwortWiederholung"])));

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

//checkForRegex
if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    dieError("Email Pattern Mismatch ".$email);
}
if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $oldPassword)){
    dieError("Old Password Pattern Mismatch");
}
if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)){
    dieError("Password Pattern Mismatch");
}
if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $passwortWiederholung)){
    dieError("Passwort Wiederholung Pattern Mismatch");
}

if (!isset($_SESSION)) {
    session_start();
}



$userID = $_SESSION["userID"];

$username = $db->getUserName($userID);

$serverPasswordHash = $db->getPasswordForUserID($userID);

//Check Password
if(password_verify($oldPassword, $serverPasswordHash)){
    if ($password == $passwortWiederholung){
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $db->updateProData($email,$passwordHash,$userID);
    }else{
        dieError("Neue Passwörter nicht gleich");
    }
}else{
    dieError("Passwort ist Falsch");
}

function dieError($error){
    die("<script>
        console.log('Error: ".$error."');
        alert('Ein Fehler ist aufgetreten:\\n".$error."');
        location.replace('../../sites/profile.php');
    </script>");
}

echo "<script>
        location.replace('../../sites/profile.php');
        </script>";