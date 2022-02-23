<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/info.css">
    <script src="../scripts/info.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Item"); ?>
    <?php require "../php/#navBar.php" ?>
    <div style="width: 100%; height: 100%">
        <div class="flex-container wrap itemContent">
            <div class="itemPicture">
                <img src="../media/pictures/test.jpg" id="itemPictureIMG" alt="Item-Picture">
            </div>
            <div class="itemDescriptionContainer">
                <div class="itemDescription">
                    <h2>Item</h2>
                    <p>Description</p>
                </div>
                <div class="itemButtons">
                    <button>Buy</button>
                    <button>sell</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>