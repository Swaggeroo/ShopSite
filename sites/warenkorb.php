<?php
    require_once "../tools/config.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warenkorb</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/warenkorb.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/cart.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/test.jpg","Warenkorb"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div id="cartItems">
            <h2>Dein Warenkorb</h2>
            <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            require_once "../php/dbConnection.php";
            $db = new db();
            if (isset($_SESSION["userLoggedIn"])){
                $cart = $db->getCartFromUser($_SESSION["userID"]);
                if (count($cart)>0){
                    foreach ($cart as $c){
                        $animal = $db->getAnimalById(intval($c["ItemID"]));
                        echo $htmlMaker->getCartItem($animal["Title"],$c["Count"],$animal["Price"],$animal["Picture"],$c["ItemID"]);
                    }
                }else{
                    echo "Dein Warenkorb ist leer <a href='./shop.php'>Zum Shop</a>";
                }
            }else{
                if (isset($_COOKIE['cart']) && count(json_decode($_COOKIE['cart'], true))>0){
                    $cart = json_decode($_COOKIE['cart'], true);
                    foreach (array_keys($cart) as $k){
                        $animal = $db->getAnimalById(intval($k));
                        echo $htmlMaker->getCartItem($animal["Title"],$cart[(string)$k],$animal["Price"],$animal["Picture"],$k);
                    }
                }else{
                    echo "Dein Warenkorb ist leer <a href='./shop.php'>Zum Shop</a>";
                }
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
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>