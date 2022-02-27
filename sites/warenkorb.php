<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warenkorb</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/warenkorb.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/checkout.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/test.jpg","Warenkorb"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div id="cartItems">
            <h2>Dein Warenkorb</h2>
            <?php
            for ($i=0;$i<100;$i++){
                echo $htmlMaker->getCartItem("Test",3000,3.5);
            }
            ?>
        </div>
        <div id="cartCheckout" class="card">
            <h2>Checkout</h2>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>0.00€</td>
                </tr>
                <tr>
                    <td>Discount (-10%)</td>
                    <td>0.00€</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>0.00€</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>0.00€</td>
                </tr>
            </table>
            <a href="./checkout.php" id="checkoutBTN">Checkout</a>
        </div>
    </div>
</body>
</html>