<?php
require_once "../../tools/config.php";
$itemID = $_POST["id"];
$newCount = $_POST["count"];
require_once "../dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["userLoggedIn"])) {
    $db->updateItemInCart($itemID,$_SESSION["userID"],$newCount);
    echo "success";
}else{
    $cart = json_decode($_COOKIE['cart'], true);
    $cart[(string)$itemID] = $newCount;
    setcookie('cart', json_encode($cart), time()+60*60*24*30, "/".$GLOBALS['rootDir']."ShopSite/");
    $_COOKIE['cart'] = json_encode($cart);
}
