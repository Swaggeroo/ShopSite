<?php
require "../php/#checkPermission.php";
require_once "../tools/config.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/warenkorb.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/checkout.js" defer></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AaMABOoKf6SEVMD5y_dOA3IhTfepuVTp0O39Ilqn6kmBu3FjqhppjCNAGl2HxZRnA_InbjGc6toag5mc&currency=EUR&locale=de_DE&disable-funding=card,credit,bancontact"></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/heuschrecke.jpg","Checkout"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div id="cartItems">
            <h2>Checkout</h2>
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
                        echo $htmlMaker->getCheckoutItem($animal["Title"],$c["Count"],$animal["Price"],$animal["Picture"],$c["ItemID"]);
                    }
                }else{
                    echo "Dein Warenkorb ist leer <a class='emptyButton' href='./shop.php'>Zum Shop</a>";
                }
            }
            ?>
        </div>
        <div id="cartCheckout" class="card">
            <h2>Checkout</h2>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td id="subtotal">0.00???</td>
                </tr>
                <tr>
                    <td>Discount (-10%)</td>
                    <td id="discount">0.00???</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td id="shipping">0.00???</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td id="total">0.00???</td>
                </tr>
            </table>
            <div class='fancy-btn-cont' style="margin-bottom: 1.75em">
                <a class='fancy-btn' href="../php/processBuy.php">
                    Kaufen
                    <span class='line-1'></span>
                    <span class='line-2'></span>
                    <span class='line-3'></span>
                    <span class='line-4'></span>
                </a>
            </div>
            <div id="paypal-button-container" style="margin: auto; width: 80%"></div>
        </div>
    </div>
    <script>
        paypal.Buttons({

            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'horizontal',
                label: 'paypal',
                tagline: false
            },

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({

                    purchase_units: [{
                        amount: {
                            currency_code: "EUR",
                            value: getRealTotal(),
                            breakdown: {
                                item_total: {
                                    currency_code: "EUR",
                                    value: getRealTotal()+getDiscount(getTotal())
                                },
                                discount:{
                                    currency_code: "EUR",
                                    value: getDiscount(getTotal())
                                }
                            }
                        },
                        items: [
                            <?php
                                foreach ($cart as $c){
                                    $animal = $db->getAnimalById(intval($c["ItemID"]));
                                    echo $htmlMaker->getPayPalItem($animal["Title"],"",$c["Count"],intval($animal["Price"])/100);
                                }
                            ?>
                            {
                                name: "Versand",
                                description: "Versandkosten",
                                unit_amount: {
                                    currency_code: "EUR",
                                    value: (getShippingVal(getTotal())/100),
                                },
                                quantity: "1"
                            },
                        ]
                    }]

                });
            },

            // Finalize the transaction after payer approval
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    window.location.replace("../php/processBuy.php");
                });
            }
        }).render('#paypal-button-container');

    </script>
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>