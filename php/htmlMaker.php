<?php
require ("../tools/config.php");
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
            <h1>".$title."</h1>
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
                    <h2 class='totalPrice ".$pricePerItem."'>".number_format(($pricePerItem*$itemCount)/100,2,",",".")."€</h2>
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
                <td><a href=\"./rechnungDrucken.php?id=".$id."\"><img src=\"../media/icons/printer.SVG\" alt=\"drucken\"></a></td>
            </tr>
        ";
    }
}
