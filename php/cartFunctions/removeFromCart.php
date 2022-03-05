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
    //TODO not logged in
    echo "Not Logged in";
}
