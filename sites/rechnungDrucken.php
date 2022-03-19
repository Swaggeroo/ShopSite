<?php
require "../php/#checkPermission.php";
require_once "../php/htmlMaker.php";
require_once "../php/dbConnection.php";
$htmlMaker = new htmlMaker();
$db = new db();
$orderID = intval($_GET["id"]);
$orderInfo = $db->getOrderInfos($orderID)[0];
if ($orderInfo["UserID"] != $_SESSION["userID"]){
    die("<script>
           alert('Error Authentication');
           location.replace('../');
          </script>
          ");
}
$kunde = $db->getUserById($orderInfo["UserID"]);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rechnung <?php echo date("d.m.Y", strtotime($orderInfo['OrderDate']))?></title>
    <link rel="stylesheet" href="../css/bill.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <div id="header">
        <img src="../media/icons/faviconDARK.SVG">
        <h1 id="firmname">Tiertotal</h1>
    </div>

    <br>

    <div id="adressen">
        <div id="adresseKunde">
            <p><?php echo $kunde["Nachname"]." ".$kunde["Vorname"]?></p>
            <p><?php echo $kunde["Strasse"]?></p>
            <p><?php echo $kunde["PLZ"]." ".$kunde["Stadt"]?></p>
        </div>

        <div id="adresseFirma">
            <p>Tiertotal GmBH</p>
            <p>Traumstraße 65</p>
            <p>12093 Imaginecity</p>
            <br>
            <p>+49 45 6396821</p>
            <p><a href="mailto:info@tiertotal.com">info@tiertotal.com</a></p>
            <p><a href="www.tiertotal.com">www.tiertotal.com</a></p>
        </div>
    </div>


    <h2>RECHNUNG</h2>
    <div id="rechnungsDaten">
        <table id="rechnungsDatenTable">
            <tr>
                <td>Bestell-NR:</td>
                <td><?php echo $orderInfo['OrderID']?></td>
            </tr>
            <tr>
                <td>Kunden-NR:</td>
                <td><?php echo $orderInfo['UserID']?></td>
            </tr>
            <tr>
                <td>Rechnungsdatum:</td>
                <td><?php  echo date("d. m. Y", strtotime($orderInfo['OrderDate']));?></td>
            </tr>
        </table>
    </div>

    <hr>

    <table id="itemsTable">
        <thead>
            <tr class="contentTable">
                <th>Pos</th>
                <th>Art-Nr.</th>
                <th>Bezeichnung</th>
                <th>Menge</th>
                <th>Preis/Stck (€)</th>
                <th>Gesamt (€)</th>
            </tr>
            <tr>
                <th colspan="6">
                    <hr>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $orderItems = $db->getItemsFromOrder($orderID);
                $i = 1;
                $itemsTotal = 0;
                foreach ($orderItems AS $item){
                    $animal = $db->getAnimalById($item['ItemID']);
                    echo $htmlMaker->getRechnungsItem($i,$animal['ItemID'],$animal['Title'],$item['Count'],number_format($animal['Price']/100,2,',','.'),number_format(($item['Count']*$animal['Price'])/100.00,2,',','.'));
                    $i++;
                    $itemsTotal += $animal['Price']*$item['Count'];
                }
                echo $htmlMaker->getRechnungsItem("⠀","","","","","");
                echo $htmlMaker->getRechnungsItem($i,"D1","Discount(10%)",1,number_format($itemsTotal/-1000,2,',','.'),number_format($itemsTotal/-1000,2,',','.'));
                $i++;
                $shippingVal = 0;
                if ($orderInfo['Total'] < 10000){
                    $shippingVal = 10000;
                }else if($orderInfo['Total'] < 100000){
                    $shippingVal = 5000;
                }else if($orderInfo['Total'] < 1000000){
                    $shippingVal = 2500;
                }
                echo $htmlMaker->getRechnungsItem($i,"S1","Versand",1,number_format($shippingVal/100,2,',','.'),number_format($shippingVal/100,2,',','.'));
            ?>

            <tr>
                <td colspan="3"></td>
                <td colspan="3"><hr></td>
            </tr>
            <tr id="totalTable">
                <td colspan="3"></td>
                <td colspan="2">Endsumme:</td>
                <td><?php echo number_format($orderInfo['Total']/100,2,',','.')."€"?></td>
            </tr>
        </tbody>
    </table>

    <script>
        self.print();
        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (!mql.matches){
                    window.close();
                }
            });
        }
    </script>
</body>
</html>