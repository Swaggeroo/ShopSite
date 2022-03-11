<?php
    require "../tools/config.php";
    require "../php/dbConnection.php";
    $db = new db();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/shop.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Shop"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div id="sortContainer" class="hide">
            <p>Sortieren</p>
            <select id="filterKat">
                <option value="" <?php if (!isset($_GET["kategorie"])) echo "selected"?>>Kategorie auswählen</option>
                <?php
                    $cats = $db->getAllKategorien();
                    foreach ($cats as $cat){
                        if (!isset($_GET["kategorie"]) || ($cat["CategoryID"] != $_GET["kategorie"])) {
                            echo "<option value=\"" . $cat["CategoryID"] . "\">" . $cat["Title"] . "</option>";
                        }else{
                            echo "<option value=\"" . $cat["CategoryID"] . "\" selected>" . $cat["Title"] . "</option>";
                        }
                    }
                ?>
            </select>
            <select id="filterVerk">
                <option value="" <?php if (!isset($_GET["verkaeufer"])) echo "selected"?>>Verkäufer auswählen</option>
                <?php
                $verk = $db->getAllVerkaeufer();
                foreach ($verk as $ver){
                    if (!isset($_GET["verkaeufer"]) || ($ver["ManufacturerID"] != $_GET["verkaeufer"])){
                        echo "<option value=\"".$ver["ManufacturerID"]."\">".$ver["FirmName"]."</option>";
                    }else{
                        echo "<option value=\"".$ver["ManufacturerID"]."\" selected>".$ver["FirmName"]."</option>";
                    }
                }
                ?>
            </select>
            <button onclick="filterShop()">SORTIEREN</button>
            <?php
                if (isset($_GET["verkaeufer"]) || isset($_GET["kategorie"])){
                    echo "<button onclick=\"resetFilterShop()\">RESET</button>";
                }
            ?>
        </div>
        <div class="flex-container row wrap">
            <?php
                $htmlMaker = new htmlMaker();
                $animals = null;
                if(isset($_GET["verkaeufer"]) && isset($_GET["kategorie"])){
                    $animals = $db->getAnimalsSortedByVerkaeuferKategorie(intval($_GET["kategorie"]),intval($_GET["verkaeufer"]));
                }else if(isset($_GET["verkaeufer"])){
                    $animals = $db->getAnimalsSortedByVerkaeufer(intval($_GET["verkaeufer"]));
                }else if (isset($_GET["kategorie"])){
                    $animals = $db->getAnimalsSortedByKategorie(intval($_GET["kategorie"]));
                } else{
                    $animals = $db->getAllAnimals();
                }
                if ($animals!=null){
                    foreach ($animals as $animal){
                        echo $htmlMaker->getProduct("../media/pictures/animals/".$animal["Picture"],$animal["ItemID"],$animal["Title"]);
                    }
                }else{
                    echo "
                      <p>Keine Tiere unter diesem Filter. <a href='./shop.php' id='badFilter'>Filter zurücksetzen</a></p>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>