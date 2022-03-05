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
            if (!isset($_SESSION)) {
                session_start();
            }
            require "../php/dbConnection.php";
            $db = new db();
            if (isset($_SESSION["userLoggedIn"])){
                $cart = $db->getCartFromUser($_SESSION["userID"]);
                foreach ($cart as $c){
                    $animal = $db->getAnimalById(intval($c["ItemID"]));
                    echo $htmlMaker->getCartItem($animal["Title"],$c["Count"],$animal["Price"],$animal["Picture"],$c["ItemID"]);
                }
            }else{
                echo "<p>Not Logged in</p>";
            }
            ?>
        </div>
        <div id="cartCheckout" class="card">
            <h2>Checkout</h2>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td id="subtotal">0.00€</td>
                </tr>
                <tr>
                    <td>Discount (-10%)</td>
                    <td id="discount">0.00€</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td id="shipping">0.00€</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td id="total">0.00€</td>
                </tr>
            </table>
            <a href="./checkout.php" id="checkoutBTN">Checkout</a>
        </div>
    </div>
</body>
</html>