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
}
