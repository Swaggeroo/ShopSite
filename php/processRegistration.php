<?php

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "../php/dbConnection.php";
    $db = new db();

    $infoVar = array("vorname",
        "nachname",
        "strasse",
        "stadt",
        "plz",
        "iban",
        "bic",
        "benutzername",
        "email",
        "passwort",
        "passwortWiederholung"
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
    $iban = stripslashes(htmlspecialchars(trim($_POST["iban"])));
    $bic = stripslashes(htmlspecialchars(trim($_POST["bic"])));
    $benutzername = stripslashes(htmlspecialchars(trim($_POST["benutzername"])));
    $email = stripslashes(htmlspecialchars(trim($_POST["email"])));
    $password = stripslashes(htmlspecialchars(trim($_POST["passwort"])));
    $passwortWiederholung = stripslashes(htmlspecialchars(trim($_POST["passwortWiederholung"])));


    $exists = $db->userNameExists($benutzername);

    //Check if User exists in database
    if($exists){
        die("<script>
           alert('Benutzername bereits vergeben');
           history.back();
          </script>"
        );
    }

    if($password != $passwortWiederholung){
        die("<script>
           alert('Passwort nicht gleich');
           history.back();
          </script>"
        );
    }

    //Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //Save to Database
    $db->addUser($benutzername, $passwordHash, $email, $vorname, $nachname, $strasse, $stadt, $plz, $iban, $bic);

    $username = $benutzername;
    $password = $passwordHash;

    require "./processLogin.php";

}
