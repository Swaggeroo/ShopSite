<?php
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
    echo "Not Logged in";
}