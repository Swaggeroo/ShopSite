<?php
    require_once "../tools/config.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bestellung Erfolgreich</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/orderComplete.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/test.jpg","Kauf Erfolgreich"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <h1>Kauf Erfolgreich</h1>
        <div class="success-checkmark">
            <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
        </div>
        <p style="margin-top: 90px"><a href="./shop.php">Weiter Shoppen</a></p>
        <p><a href="./rechnungDrucken.php?id=<?php echo $_GET["id"]?>" target="_blank">Rechnung drucken</a></p>
    </div>
</body>
</html>