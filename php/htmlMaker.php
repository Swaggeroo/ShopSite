<?php
class htmlMaker {
    public function getProduct($pictureLink,$refLink,$text):string{
        return "
        
            <div class=\"card shopElement fill\" style=\"background-image: url('".$pictureLink."')\">
                <div class='interactionElements'>
                    <button class='infoBTN'><i></i>Info</button>
                    <button class='warenkorbBTN'><i></i>Warenkorb</button>
                </div>
                <span>".$text."</span>
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
}
