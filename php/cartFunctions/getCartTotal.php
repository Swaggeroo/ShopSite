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
}else{
    $cart = json_decode($_COOKIE['cart'], true);
    $total = 0;
    $cart = json_decode($_COOKIE['cart'], true);
    foreach (array_keys($cart) as $k){
        $total += (intval($db->getAnimalById($k)["Price"]) * intval($cart[$k]));
    }
}
echo $total;


