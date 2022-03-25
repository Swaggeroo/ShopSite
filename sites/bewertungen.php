<!DOCTYPE html>
<html lang="de">
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
    <title>Bewertungen <?php echo $animal["Title"]?></title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/bewertungen.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/elefant.jpg","Bewertungen ".$animal["Title"]); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <div class="starsContainer">
            <div class="stars">
                <?php
                    $starcount = $db->getStarAverage(intval($_GET["id"]));
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
            </div>
            <p>1<img src="../media/icons/star.SVG" class="starSmall"><progress class="progressStarBar" value="<?php echo $db->getStartCounts(intval($_GET["id"]),1)?>" max="<?php echo $db->getMaxStars(intval($_GET["id"]))?>"></progress></p>
            <p>2<img src="../media/icons/star.SVG" class="starSmall"><progress class="progressStarBar" value="<?php echo $db->getStartCounts(intval($_GET["id"]),2)?>" max="<?php echo $db->getMaxStars(intval($_GET["id"]))?>"></progress></p>
            <p>3<img src="../media/icons/star.SVG" class="starSmall"><progress class="progressStarBar" value="<?php echo $db->getStartCounts(intval($_GET["id"]),3)?>" max="<?php echo $db->getMaxStars(intval($_GET["id"]))?>"></progress></p>
            <p>4<img src="../media/icons/star.SVG" class="starSmall"><progress class="progressStarBar" value="<?php echo $db->getStartCounts(intval($_GET["id"]),4)?>" max="<?php echo $db->getMaxStars(intval($_GET["id"]))?>"></progress></p>
            <p>5<img src="../media/icons/star.SVG" class="starSmall"><progress class="progressStarBar" value="<?php echo $db->getStartCounts(intval($_GET["id"]),5)?>" max="<?php echo $db->getMaxStars(intval($_GET["id"]))?>"></progress></p>
            <form class="bewertungsForm" action="">
                <h3>Bewerten</h3>
                <div class="starsContainer">
                    <img src="../media/icons/starGray.SVG" class="star starBewerten s1">
                    <img src="../media/icons/starGray.SVG" class="star starBewerten s2">
                    <img src="../media/icons/starGray.SVG" class="star starBewerten s3">
                    <img src="../media/icons/starGray.SVG" class="star starBewerten s4">
                    <img src="../media/icons/starGray.SVG" class="star starBewerten s5">
                </div>
                <br>
                <label>
                    Kommentar<br>
                    <textarea class="kommentarText" required></textarea>
                </label>
                <br>
                <button class="oldBTN" type="submit">
                    <div class='fancy-btn-cont'>
                        <a class='fancy-btn'>
                            Senden
                            <span class='line-1'></span>
                            <span class='line-2'></span>
                            <span class='line-3'></span>
                            <span class='line-4'></span>
                        </a>
                    </div>
                </button>
            </form>
        </div>
        <div class="bewertungenContainer">
            <h2>Bewertungen</h2>
            <?php
                $comments = $db->getAllComments(intval($_GET["id"]));
                foreach ($comments AS $c){
                    echo $htmlMaker->getComment($c["Comment"],$db->getUserName($c["UserID"]),date("d.m.Y m:h", strtotime($c["CommentDate"])),$c["Stars"],$db->hasUserBoughtThisItem(intval($_GET["id"]),$c["UserID"]));
                }
            ?>
        </div>
    </div>
    <?php echo $htmlMaker->getFooter()?>
    <script src="../scripts/bewertungen.js"></script>
    <?php
    echo "<script >setID(".intval($_GET["id"]).")</script>";
    if (isset($_SESSION["userLoggedIn"]) && $_SESSION["userLoggedIn"]){
        echo "isso";
        if ($db->hasCommented(intval($_GET["id"]),$_SESSION["userID"])){
            echo "hatso";
            $com = $db->getComment(intval($_GET["id"]),$_SESSION["userID"]);
            var_dump($com);
            $curComment = $com[0]["Comment"];
            $curStars = $com[0]["Stars"];
            echo $curComment." ".$curStars;
            echo "<script >setComment(\"".$curComment."\",".$curStars.")</script>";
        }
    }
    ?>
    <script>
        let inputs = document.getElementsByClassName("kommentarText");

        for(let i = 0; i<inputs.length; i++){
            inputs[i].addEventListener("focusout", checkVal);

            inputs[i].addEventListener("change", checkVal);

            function checkVal(event) {
                if (event.target.checkValidity()) {
                    event.target.classList.remove("invalid");
                } else {
                    event.target.classList.add("invalid");
                }
            }
        }
    </script>
</body>
</html>