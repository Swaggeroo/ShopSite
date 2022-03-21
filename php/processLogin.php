<?php
//TODO warenkorb übertragen
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
                $db->updateItemInCart(intval($k),$_SESSION["userID"],$cart[(string)$k]+$db->getItemCountCart($k,$userID));
            }
            var_dump($cart);
        }

        echo "<script>
        //location.replace('../sites/shop.php');
       </script>";
    }else{
        echo "<script>
           alert('Falsches Passwort!');
           location.replace('../');
          </script>
          ";
    }

}