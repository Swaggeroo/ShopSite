<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require "../php/dbConnection.php";
        $db = new db();
        $animal = $db->getAnimalById(intval($_GET["id"]));
        $verkaeufer = $db->getManufacturerById($animal["ManufacturerID"]);
        $kategorie = $db->getCategoryById($animal["CategoryID"]);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $animal["Title"]?></title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/info.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/info.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg",$animal["Title"]); ?>
    <?php require "../php/#navBar.php" ?>
    <div style="width: 100%; min-height: 100%; height: auto" class="content">
        <div class="flex-container wrap itemContent">
            <div class="itemPicture">
                <img src="../media/pictures/animals/<?php echo $animal["Picture"]?>" class="card" id="itemPictureIMG" alt="Item-Picture">
            </div>
            <div class="bigPicture disappear">
                <img src="../media/pictures/animals/<?php echo $animal["Picture"]?>" class="card" id="itemPictureIMG" alt="Item-Picture">
            </div>
            <div class="itemDescriptionContainer">
                <div class="itemDescription">
                    <h2><?php echo $animal["Title"]?></h2>
                    <h4>Kategorie</h4>
                    <a href="./shop.php?kategorie=<?php echo $kategorie["CategoryID"]?>"><p><?php echo $kategorie["Title"]?></p></a>
                    <h4>Verkäufer</h4>
                    <a href="./infoVerkaeufer.php?id=<?php echo $verkaeufer["ManufacturerID"]?>"><p><?php echo $verkaeufer["FirmName"]?></p></a>
                    <h4>Beschreibung</h4>
                    <p><?php echo $animal["Content"]?></p>
                </div>
                <div class="itemButtons">
                    <h4>Qnt.<input type="number" name="menge" id="inputMenge" value="1"></h4>
                    <button>In den Warenkorb</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>