<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/start.css">
</head>
<body>
    <h1>Shop</h1>
    <div align="center">
        <div class="flex-container row wrap">
            <?php
                require "php/htmlMaker.php";
                $htmlMaker = new htmlMaker();
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Hallo");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Test");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Maik");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Hallo");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Test");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Maik");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Hallo");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Test");
                echo $htmlMaker->getProduct("./media/pictures/test.jpg","test","Maik");
            ?>
        </div>
    </div>
</body>
</html>