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
        <div class="flex-container row wrap">
            <?php
                $htmlMaker = new htmlMaker();
                require "../php/dbConnection.php";
                $db = new db();
                $animals = $db->getAllAnimals();
                foreach ($animals as $animal){
                    echo $htmlMaker->getProduct("../media/pictures/animals/".$animal["Picture"],"info.php?id=".$animal["ItemID"],$animal["Title"]);
                }
            ?>
        </div>
    </div>
</body>
</html>