<?php
$itemID = $_POST["id"];
require "../dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["userLoggedIn"])) {
    $db->removeItemInCart($itemID,$_SESSION["userID"]);
    echo "success";
}else{
    $cart = json_decode($_COOKIE['cart'], true);
    unset($cart[(string)$itemID]);
    setcookie('cart', json_encode($cart), time()+60*60*24*30, "/ShopSite/");
    $_COOKIE['cart'] = json_encode($cart);
}