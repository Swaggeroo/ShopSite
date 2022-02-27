<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/info.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/info.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Item"); ?>
    <?php require "../php/#navBar.php" ?>
    <div style="width: 100%; min-height: 100%; height: auto" class="content">
        <div class="flex-container wrap itemContent">
            <div class="itemPicture">
                <img src="../media/pictures/test.jpg" class="card" id="itemPictureIMG" alt="Item-Picture">
            </div>
            <div class="bigPicture disappear">
                <img src="../media/pictures/test.jpg" class="card" id="itemPictureIMG" alt="Item-Picture">
            </div>
            <div class="itemDescriptionContainer">
                <div class="itemDescription">
                    <h2>Item</h2>
                    <h4>Kategorie</h4>
                    <p>Kleintier</p>
                    <h4>Hersteller</h4>
                    <p>Super Hersteller</p>
                    <h4>Beschreibung</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                        molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                        numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                        optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                        obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                        nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                        tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
                        quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos
                        sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
                        recusandae alias error harum maxime adipisci amet laborum. Perspiciatis
                        minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit
                        quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur
                        fugiat, temporibus enim commodi iusto libero magni deleniti quod quam
                        consequuntur! Commodi minima excepturi repudiandae velit hic maxime
                        doloremque. Quaerat provident commodi consectetur veniam similique ad
                        earum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo
                        fugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore
                        suscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium
                        modi minima sunt esse temporibus sint culpa, recusandae aliquam numquam
                        totam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam
                        quasi aliquam eligendi, placeat qui corporis!</p>
                </div>
                <div class="itemButtons">
                    <h4>Qnt.<input type="number" name="menge" id="inputMenge" value="1"></h4>
                    <button>In den Warenkorb</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>