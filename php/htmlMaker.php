<?php
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
        <link rel='stylesheet' href='/ShopSite/css/head.css'>
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
}
