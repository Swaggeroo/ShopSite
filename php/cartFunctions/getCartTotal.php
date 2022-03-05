<?php
require "../dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["userLoggedIn"])){
    $cart = $db->getCartFromUser($_SESSION["userID"]);
    $total = 0;
    foreach ($cart as $c){
        $total += ($db->getAnimalById($c["ItemID"])["Price"] * $c["Count"]);
    }
    echo $total;
}else{
    //TODO not logged in
}


