<link rel="stylesheet" href="/<?php echo $GLOBALS['rootDir']?>ShopSite/css/nav.css">
<script src="/<?php echo $GLOBALS['rootDir']?>ShopSite/scripts/navBar.js" defer></script>
<nav class="navbar">
    <a href="/<?php echo $GLOBALS['rootDir']?>ShopSite/" id="navTitleLink"><div class="navTitle">Shop</div></a>
    <a href="#" class="toggle-button noScroll">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links">
        <ul>
            <?php
                $file = explode("/",$_SERVER["PHP_SELF"]);
                $file = $file[count($file)-1];
                if ($file == "shop.php"){
                    echo "<li><a href=\"#\" id=\"filterBTN\">Filter</a></li>";
                }
            ?>
            <li><a href="/<?php echo $GLOBALS['rootDir']?>ShopSite/sites/shop.php">Shop</a></li>
            <li><a href="/<?php echo $GLOBALS['rootDir']?>ShopSite/sites/warenkorb.php">Warenkorb</a></li>
            <?php
                if(!isset($_SESSION)){
                    session_start();
                }
                if (isset($_SESSION["userLoggedIn"]) && $_SESSION["userLoggedIn"]) {
                    echo "<li><a href=\"/".$GLOBALS['rootDir']."ShopSite/sites/profile.php\">Profil</a></li>";
                } else {
                    if (session_status() === PHP_SESSION_ACTIVE){
                        session_destroy();
                    }
                    echo "<li><a href=\"/".$GLOBALS['rootDir']."ShopSite/sites/registration.php\">Registrieren</a></li>
                        <li><a href=\"/".$GLOBALS['rootDir']."ShopSite/sites/login.php\">Login</a></li>";
                }
            ?>

        </ul>
    </div>
</nav>
