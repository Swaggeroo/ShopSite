<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION["userLoggedIn"])){
    $_SESSION["userLoggedIn"] = false;
}

if(!$_SESSION["userLoggedIn"]){
    die("<script>alert('Du musst dich erst anmelden.');window.location.replace(\"../\");</script>");
}


?>
