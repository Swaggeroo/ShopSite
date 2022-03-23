<?php
    require_once "../tools/config.php";
    require_once "../php/dbConnection.php";
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
    <?php require_once "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/animals/salamander.jpg","Shop"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div id="sortContainer" class="hide">
            <p style="margin: 0">Filtern</p>
            <input type="text" id="filterSearch" value="<?php if (isset($_GET["search"])) echo $_GET["search"]?>" placeholder="Suchbegriff" onkeydown="handleEnterSearch()">
            <select id="filterKat">
                <option value="" <?php if (!isset($_GET["kategorie"])) echo "selected"?>>Alle Kategorie</option>
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
                <option value="" <?php if (!isset($_GET["verkaeufer"])) echo "selected"?>>Alle Verkäufer</option>
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
            <p></p>
            <p style="margin: 0">Sortieren</p>
            <select id="sortType">
                <option value="Title" <?php if (!isset($_GET["sortBY"]) || $_GET["sortBY"] == "Title") echo "selected"?>>Name</option>
                <option value="Price" <?php if (isset($_GET["sortBY"]) && $_GET["sortBY"] == "Price") echo "selected"?>>Price</option>
            </select>
            <select id="sortAscDesc">
                <option value="ASC" <?php if (!isset($_GET["ascDsc"]) || $_GET["ascDsc"] == "ASC") echo "selected"?>>Aufsteigend</option>
                <option value="DESC" <?php if (isset($_GET["ascDsc"]) && $_GET["ascDsc"] == "DESC") echo "selected"?>>Absteigend</option>
            </select>
            <p></p>
            <p></p>
            <button onclick="filterShop()">SORTIEREN</button>
            <?php
                if (isset($_GET["verkaeufer"]) || isset($_GET["kategorie"]) || isset($_GET["search"]) || isset($_GET["sortBY"]) || isset($_GET["ascDsc"])){
                    echo "<button onclick=\"resetFilterShop()\">RESET</button>";
                }
            ?>
        </div>
        <div class="shopRoot flex-container row wrap">
            <?php
                $htmlMaker = new htmlMaker();
                $animals = null;
                if (isset($_GET["verkaeufer"]) || isset($_GET["kategorie"]) || isset($_GET["search"]) || isset($_GET["sortBY"]) || isset($_GET["ascDsc"])){
                    $verkaeufer = "%";
                    $kategorie = "%";
                    $search = "%";
                    $sortBY = "Title";
                    $ascDsc = "ASC";
                    if (isset($_GET["verkaeufer"])){
                        $verkaeufer = $_GET["verkaeufer"];
                    }
                    if (isset($_GET["kategorie"])){
                        $kategorie = $_GET["kategorie"];
                    }
                    if (isset($_GET["search"])){
                        $search = $_GET["search"];
                    }
                    if (isset($_GET["sortBY"])){
                        if ($_GET["sortBY"] == "Price"){
                            $sortBY = "Price";
                        }
                    }
                    if (isset($_GET["ascDsc"])){
                        if ($_GET["ascDsc"] == "DESC"){
                            $ascDsc = "DESC";
                        }
                    }

                    $animals = $db->getAnimalBySearch($kategorie,$verkaeufer,$search,$sortBY,$ascDsc);
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
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>