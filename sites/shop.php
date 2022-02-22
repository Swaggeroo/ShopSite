<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <script src="../scripts/shop.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Shop"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div class="flex-container row wrap">
            <?php
                $htmlMaker = new htmlMaker();
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Hallo");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Test");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Maik");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Hallo");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Test");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Maik");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Hallo");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Test");
                echo $htmlMaker->getProduct("../media/pictures/test.jpg","test","Maik");
            ?>
        </div>
    </div>
</body>
</html>