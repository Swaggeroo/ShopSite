<?php
require_once ("../../tools/config.php");
require_once ("../dbConnection.php");
if (!isset($db) || $db == null){
    $db = new db();
}
if(!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION["userLoggedIn"]) && $_SESSION["userLoggedIn"]) {
    echo $db->getCartItemCount($_SESSION["userID"]);
}else {
    if (isset($_COOKIE["cart"])){
        $cart = json_decode($_COOKIE['cart'], true);
        $total = 0;
        foreach (array_keys($cart) as $k){
            $total += $cart[$k];
        }
        echo $total;
    }else{
        echo 0;
    }
}
