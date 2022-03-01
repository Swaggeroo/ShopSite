<!DOCTYPE html>
<html lang="de">
<head>
    <?php
    require "../php/dbConnection.php";
    $db = new db();
    $verkaeufer = $db->getManufacturerById($_GET["id"]);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $verkaeufer["FirmName"]?></title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/infoVerkaeufer.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg",$verkaeufer["FirmName"]); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content" align="center">
        <h1><?php echo $verkaeufer["FirmName"]?></h1>
        <div id="infoContext">
            <p><?php echo $verkaeufer["Content"]?></p>
            <h2>Kontakt Daten</h2>
            <table>
                <tr>
                    <td>Straße</td>
                    <td><?php echo $verkaeufer["Strasse"]?></td>
                </tr>
                <tr>
                    <td>Ort</td>
                    <td><?php echo $verkaeufer["PLZ"]; echo " "; echo $verkaeufer["Stadt"];?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><a href="mailto:<?php echo $verkaeufer["Email"]?>"><?php echo $verkaeufer["Email"]?></a></td>
                </tr>
            </table>
        </div>
        <div id="buttonsContext">
            <a id="productsLink" href="./shop.php?verkaeufer=<?php echo $verkaeufer["ManufacturerID"]?>">Produkte ansehen</a>
        </div>
    </div>
</body>
</html>