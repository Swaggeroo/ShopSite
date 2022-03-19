<?php
require "../php/#checkPermission.php";
require_once "../php/dbConnection.php";
require_once "../php/htmlMaker.php";
require_once "../tools/config.php";
$db = new db();
$htmlMaker = new htmlMaker();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bestellungen</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/bestellungen.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <?php echo $htmlMaker->getHeader("../media/pictures/test.jpg","Bestellungen"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Bstg.NR</th>
                    <th>Status</th>
                    <th>Preis</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $orders = $db->getAllOrdersFromUser($_SESSION["userID"]);
                    foreach ($orders AS $o){
                        echo $htmlMaker->getOrderItem($o["OrderDate"],$o["OrderID"],$o["Total"],$o["Arrived"]);
                    }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>