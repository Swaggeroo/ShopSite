<?php
    require_once "../tools/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once "../php/dbConnection.php";
        $db = new db();
        $animal = $db->getAnimalById(intval($_GET["id"]));
        if ($animal == null){
            echo "
                <script>
                    alert('Error Tier not found');
                    window.location.replace('./shop.php');
               </script>
            ";
        }
        $verkaeufer = $db->getManufacturerById($animal["ManufacturerID"]);
        $kategorie = $db->getCategoryById($animal["CategoryID"]);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $animal["Title"]?></title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/info.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/info.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/krokodil.jpg",$animal["Title"]); ?>
    <?php require "../php/#navBar.php" ?>
    <div class='shopAddAnim fill'><div id="spinner"></div></div>
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
                    <h4>Bewertung</h4>
                    <div class="starsContainer">
                        <?php
                        $starcount = $db->getStarAverage(intval($_GET["id"]));
                        if ($starcount<1){
                            $starcount = 5;
                        }
                        $starString = "<img src=\"../media/icons/star.SVG\" class=\"star\">";
                        $grayStars = 5-$starcount;
                        while ($starcount > 1){
                            $starString .= "<img src=\"../media/icons/star.SVG\" class=\"star\">";
                            $starcount--;
                        }
                        while ($grayStars>0){
                            $starString .= "<img src=\"../media/icons/starGray.SVG\" class=\"star\">";
                            $grayStars--;
                        }

                        echo $starString;
                        ?>
                        <p><a href="./bewertungen.php?id=<?php echo $_GET["id"]?>">Alle <?php echo $db->getCommentCount(intval($_GET["id"]))?> Bewertungen sehen</a></p>
                    </div>
                </div>
                <div class="itemButtons">
                    <h3>Preis: <?php echo number_format($animal["Price"]/100, 2, ',', '.')."€"?></h3>
                    <h4>Qnt.<input type="number" name="menge" id="inputMenge" value="1"></h4>
                    <button class="oldBTN" onclick="addToCart(<?php echo $_GET["id"]?>)">
                        <div class='fancy-btn-cont'>
                            <a class='fancy-btn'>
                                In den Warenkorb
                                <span class='line-1'></span>
                                <span class='line-2'></span>
                                <span class='line-3'></span>
                                <span class='line-4'></span>
                            </a>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>