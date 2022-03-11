<?php
require "../tools/config.php";
if (!isset($_SESSION)) {
    session_start();
}
$itemID = $_POST["id"];
$count  = $_POST["count"];

if (isset($_SESSION["userLoggedIn"])){
    require "../php/dbConnection.php";
    $db = new db();
    if ($db->existsInCart($itemID,$_SESSION["userID"])){
        $db->updateItemInCart($itemID,$_SESSION["userID"],$db->getItemCountCart($itemID,$_SESSION["userID"])+$count);
    }else{
        $db->insertItemIntoCart($itemID,$_SESSION["userID"],$count);
    }
    echo "success";
}else{
    if (isset($_COOKIE["cart"])){
        $cart = json_decode($_COOKIE['cart'], true);
        $cart[(string)$itemID] = $count + $cart[(string)$itemID];
    }else{
        $cart = array($itemID=>$count);
    }
    setcookie('cart', json_encode($cart), time()+60*60*24*30, "/".$GLOBALS['rootDir']."ShopSite/");
    $_COOKIE['cart'] = json_encode($cart);
}