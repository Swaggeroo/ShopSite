<?php
require_once "../tools/config.php";
$itemID = intval(stripslashes(htmlspecialchars(trim($_POST["id"]))));
$comment = stripslashes(htmlspecialchars(trim($_POST["comment"])));
$stars = intval(stripslashes(htmlspecialchars(trim($_POST["stars"]))));
require_once "./dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["userLoggedIn"])) {
    if ($db->getAnimalById($itemID) != null){
        if (strlen($comment) <= 2000){
            if ($stars < 6 && $stars > 0){
                if ($db->hasCommented($itemID,$_SESSION["userID"])){
                    $db->updateComment($_SESSION["userID"],$itemID,$comment,$stars);
                }else{
                    $db->addComment($_SESSION["userID"],$itemID,$comment,$stars);
                }
            }else{
                die("Error: invalid star count");
            }
        }else{
            die("Error: text zu lang");
        }
    }else{
        die("Error Animal ID: ".$itemID);
    }
    die("Success");
}else{
    die("noLogin");
}