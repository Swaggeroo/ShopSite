<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION["userLoggedIn"])){
    $_SESSION["userLoggedIn"] = false;
}

if(!$_SESSION["userLoggedIn"]){
    $file = explode("/",$_SERVER["PHP_SELF"]);
    $file = $file[count($file)-1];
    if ($file == "checkout.php"){
        die("<script>alert('Du musst dich erst anmelden.');window.location.replace(\"../sites/login.php\");</script>");
    }
    die("<script>alert('Du musst dich erst anmelden.');window.location.replace(\"../\");</script>");
}


?>
