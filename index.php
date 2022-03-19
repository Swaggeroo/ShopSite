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
    <link rel="icon" href="./media/icons/favicon.SVG" sizes="any">
    <script src="./scripts/home.js" defer></script>
</head>
<body>
    <?php require "./php/#navBar.php"?>
    <div class="banner">
        <div id="textbox">
            <h1>Tiertotal</h1>
            <h2>Von klein bis groß - Der Shop für alle Tier Bedürfnisse</h2>
            <h3><a class="toShopLink" href="./sites/shop.php">Zum Shop</a></h3>
        </div>
    </div>
</body>
</html>