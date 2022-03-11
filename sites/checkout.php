<?php
require "../php/#checkPermission.php";
require "../tools/config.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/warenkorb.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/checkout.js" defer></script>
    <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AaMABOoKf6SEVMD5y_dOA3IhTfepuVTp0O39Ilqn6kmBu3FjqhppjCNAGl2HxZRnA_InbjGc6toag5mc&currency=EUR&locale=de_DE&disable-funding=card,credit,bancontact"></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/test.jpg","Checkout"); ?>
    <?php require "../php/#navBar.php" ?>
    <div align="center" class="content">
        <div id="cartItems">
            <h2>Checkout</h2>
            <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            require "../php/dbConnection.php";
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
            <a href="../php/processBuy.php" id="checkoutBTN">Kaufen</a>
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
                tagline: false //TODO
            },

            // Sets up the transaction when a payment button is clicked
            createOrder: function(data, actions) {
                return actions.order.create({

                    purchase_units: [{
                        amount: {
                            currency_code: "EUR",
                            value: getRealTotal(),
                            breakdown: {
                                item_total: {  /* Required when including the `items` array */
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
                    // Successful capture! For dev/demo purposes:
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    window.location.replace("../php/processBuy.php");
                });
            },

            onCancel: function (data) {
                // TODO Cancel
            }
        }).render('#paypal-button-container');

    </script>
</body>
</html>