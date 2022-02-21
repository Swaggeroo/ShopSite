<?php
class htmlMaker {
    public function getProduct($pictureLink,$refLink,$text):string{
        return "
        <a href=\"".$refLink."\">
            <div class=\"card shopElement fill\" style=\"background-image: url('".$pictureLink."')\">
                <span>".$text."</span>
            </div>
        </a>";
    }

    public function getHeader($pictureLink, $title):string{
        return "
        <link rel='stylesheet' href='/ShopSite/css/head.css'>
        <div class=\"header\" style=\"background-image: url('".$pictureLink."')\">
            <h1>".$title."</h1>
        </div>";
    }
}
