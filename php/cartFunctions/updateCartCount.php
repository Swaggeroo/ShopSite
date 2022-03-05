<?php
$itemID = $_POST["id"];
$newCount = $_POST["count"];
require "../dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["userLoggedIn"])) {
    $db->updateItemInCart($itemID,$_SESSION["userID"],$newCount);
    echo "success";
}else{
    //TODO not logged in
    echo "Not Logged in";
}
