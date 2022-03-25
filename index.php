<?php
    require_once "./tools/config.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/buttonWhite.css">
    <link rel="icon" href="./media/icons/favicon.SVG" sizes="any">
    <script src="./scripts/home.js" defer></script>
</head>
<body>
    <?php require "./php/#navBar.php"?>
    <div class="banner">
        <div id="textbox">
            <h1 style="padding-top: .1em">Tiertotal</h1>
            <h2>Von klein bis groß - Der Shop für alle Tier Bedürfnisse</h2>
            <div class='fancy-btn-cont' style="margin-bottom: .5em; margin-top: 2em">
                <a class='fancy-btn' href="./sites/shop.php" style="font-weight: bold">
                    Zum Shop
                    <span class='line-1'></span>
                    <span class='line-2'></span>
                    <span class='line-3'></span>
                    <span class='line-4'></span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>