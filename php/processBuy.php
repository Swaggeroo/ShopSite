<?php
require "../php/dbConnection.php";
$db = new db();
if (!isset($_SESSION)) {
    session_start();
}
$userID = $_SESSION["userID"];

$cart = $db->getCartFromUser($userID);
$total = 0;
foreach ($cart as $c) {
    $total += ($db->getAnimalById($c["ItemID"])["Price"] * $c["Count"]);
}

$orderID = $db->createOrder($userID,$total);

foreach ($cart as $c) {
    $db->createItemOrderRefference($orderID,$c["ItemID"],$c["Count"]);
}

$db->clearCart($userID);

echo "<script>
        location.replace('../sites/orderComplete.php?id=".$orderID."');
       </script>";