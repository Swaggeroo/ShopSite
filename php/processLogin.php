<?php
require "../tools/config.php";
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "../php/dbConnection.php";
    $db = new db();

    $infoVar = array("benutzername","passwort");

    //check if variables are set
    for($i = 0; $i<count($infoVar); $i++){
        if (!isset($_POST[$infoVar[$i]])) {
            die("<script>
           alert('Error: No '.$infoVar[$i]);
           location.replace('../sites/login.php');
          </script>"
            );
        }
    }

    //get variables
    $username = stripslashes(htmlspecialchars(trim($_POST["benutzername"])));
    $password = stripslashes(htmlspecialchars(trim($_POST["passwort"])));
    if (!preg_match("/[A-Za-z0-9]{5,}/", $username)){
        dieError("Benutzername Pattern Mismatch");
    }
    if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)){
        dieError("Password Pattern Mismatch");
    }

    $exists = $db->userNameExists($username);

    //Check if User exists in database
    if(!$exists){
        die("<script>
       alert('Benutzername nicht gefunden');
       location.replace('../');
      </script>"
        );
    }

    $userID = $db->getUserIdForUsername($username);

    $username = $db->getUserName($userID);

    $serverPasswordHash = $db->getPasswordForUserID($userID);

    //Check Password
    if(password_verify($password, $serverPasswordHash)){
        $_SESSION["userLoggedIn"] = true;
        $_SESSION["userID"] = $userID;
        $_SESSION["username"] = $username;

        if (isset($_COOKIE['cart']) && count(json_decode($_COOKIE['cart'], true))>0){
            $cart = json_decode($_COOKIE['cart'], true);
            foreach (array_keys($cart) as $k){
                if ($db->existsInCart(intval($k),$_SESSION["userID"])){
                    $newCount = $cart[(string)$k]+$db->getItemCountCart($k,$userID);
                    $db->updateItemInCart(intval($k),$_SESSION["userID"],$newCount);
                }else{
                    $db->insertItemIntoCart(intval($k),$_SESSION["userID"],$cart[(string)$k]);
                }
            }
            unset($_COOKIE['cart']);
            setcookie('cart', '', time() - 3600,  "/".$GLOBALS['rootDir']."ShopSite/");
        }

        echo "<script>
        location.replace('../sites/shop.php');
        </script>";
    }else{
        echo "<script>
           alert('Falsches Passwort!');
           location.replace('../');
          </script>
          ";
    }

}