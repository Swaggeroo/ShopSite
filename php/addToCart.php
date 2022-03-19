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
        $count  = $db->getItemCountCart($itemID,$_SESSION["userID"])+$count;
        if ($count > 999){
            $count = 999;
        }
        $db->updateItemInCart($itemID,$_SESSION["userID"], $count);
    }else{
        $db->insertItemIntoCart($itemID,$_SESSION["userID"],$count);
    }
    echo "success";
}else{
    if (isset($_COOKIE["cart"])){
        $cart = json_decode($_COOKIE['cart'], true);
        $count = $count + $cart[(string)$itemID];
        if ($count > 999){
            $count = 999;
        }
        $cart[(string)$itemID] = $count;
    }else{
        $cart = array($itemID=>$count);
    }
    setcookie('cart', json_encode($cart), time()+60*60*24*30, "/".$GLOBALS['rootDir']."ShopSite/");
    $_COOKIE['cart'] = json_encode($cart);
}