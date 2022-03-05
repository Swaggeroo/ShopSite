<?php
$itemID = $_POST["id"];
require "../dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["userLoggedIn"])) {
    echo $db->getItemCountCart($itemID,$_SESSION["userID"]);
}else{
    //TODO not logged in
}