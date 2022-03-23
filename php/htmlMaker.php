<?php
require_once ("../tools/config.php");
class htmlMaker {
    public function getProduct($pictureLink,$itemID,$text):string{
        return "
            <div class='shopContainer'>
                <div class='shopPicture fill' style=\"background-image: url('".$pictureLink."')\"></div>
                <div class=\"card shopElement\">
                    <div class='interactionElements'>
                        <div><button class='infoBTN' onclick=\"window.location.href='info.php?id=".$itemID."'\"><i></i>Info</button></div>
                        <div><button class='warenkorbBTN' onclick='addToCart(this)' value='".$itemID."'><i></i>Warenkorb</button></div>
                    </div>
                    <span>".$text."</span>
                </div>
            </div>
        ";
    }

    public function getHeader($pictureLink, $title):string{
        return "
        <link rel='stylesheet' href='/".$GLOBALS['rootDir']."ShopSite/css/head.css'>
        <div class=\"header\" style=\"background-image: url('".$pictureLink."')\">
            <h1 style='z-index: 101'>".$title."</h1>
        </div>";
    }

    public function getCartItem($itemName, $itemCount, $pricePerItem, $picLink, $itemID):string{
        return "
            <div class='item' id='".$itemID."'>
                <div class='itemIMG' style=\"background-image: url('../media/pictures/animals/".$picLink."')\"></div>
                <div class='itemContent'>
                    <h2>".$itemName."</h2>
                    <a class='itemCountBTN' id='min".$itemID."' onclick='changeCount(this)'>-</a><input class='itemCountInput' name=\"".$itemID."\" value='".$itemCount."' disabled><a class='itemCountBTN' id='plus".$itemID."' onclick='changeCount(this)'>+</a>
                </div>
                <div class='itemPreis'>
                    <h2 class='totalPrice ".$pricePerItem."'>".number_format(($pricePerItem*$itemCount)/100,2,",",".")." €</h2>
                </div>
            </div>
        ";
    }

    public function getCheckoutItem($itemName, $itemCount, $pricePerItem, $picLink, $itemID):string{
        return "
            <div class='item' id='".$itemID."'>
                <div class='itemIMG' style=\"background-image: url('../media/pictures/animals/".$picLink."')\"></div>
                <div class='itemContent'>
                    <h2>".$itemName."</h2>
                    <input class='itemCountInput' name=\"".$itemID."\" value='".$itemCount."' disabled>
                </div>
                <div class='itemPreis'>
                    <h2 class='totalPrice ".$pricePerItem."'>".number_format(($pricePerItem*$itemCount)/100,2,",",".")." €</h2>
                </div>
            </div>
        ";
    }

    public function getPayPalItem($prodName,$prodDescription,$quantity,$cost): string{
        return " 
            {
                name: \"".$prodName."\",
                description: \"".$prodDescription."\",
                unit_amount: {
                    currency_code: \"EUR\",
                    value: ".$cost."
                },
                quantity: \"".$quantity."\"
            },
        ";
    }

    public function getOrderItem($date,$id,$total,$status):string{
        if (!$status){
            $status = "shipping.SVG";
        }else{
            $status = "check.SVG";
        }
        return "
            <tr>
                <td>".$date."</td>
                <td>".$id."</td>
                <td><img src=\"../media/icons/".$status."\" alt=\"status\"></td>
                <td>".number_format($total, 2, ',', '.')."€</td>
                <td><a href=\"./rechnungDrucken.php?id=".$id."\" target='_blank'><img src=\"../media/icons/printer.SVG\" alt=\"drucken\"></a></td>
            </tr>
        ";
    }

    public function getRechnungsItem($pos,$artNR,$bezeichnung,$menge,$preisPerItem, $total){
        return "
            <tr class=\"contentTable\">
                <td>".$pos."</td>
                <td>".$artNR."</td>
                <td>".$bezeichnung."</td>
                <td>".$menge."</td>
                <td>".$preisPerItem."</td>
                <td>".$total."</td>
            </tr>
        ";
    }

    public function getFooter(){
        return "
            <div class=\"footerSpacer\"></div>
            <footer>
                <link rel=\"stylesheet\" href=\"../css/footer.css\">
                <div class=\"footLeft\">
                    <div class=\"flex-container row\"><span class=\"icon\"></span><h3>Tiertotal</h3></div>
                    <span>©2022 Tiertotal</span>
                </div>
                <div class=\"footMid\">
                    <p><a href=\"../legal/Datenschutz.html\">Datenschutz</a></p>
                    <p><a href=\"../legal/Nutzungsbedingungen.html\">Nutzungsbedingungen</a></p>
                    <p><a href=\"../legal/Credits.html\">Credits</a></p>
                </div>
                <div class=\"footRight\">
                    <img src=\"../media/icons/paypal.png\">
                    <img class=\"cardIconFoot\" src=\"../media/icons/card-white.svg\">
                </div>
            </footer>
        ";
    }
}
