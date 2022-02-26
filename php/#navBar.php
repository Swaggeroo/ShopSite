<link rel="stylesheet" href="/ShopSite/css/nav.css">
<script src="/ShopSite/scripts/navBar.js" defer></script>
<nav class="navbar">
    <a href="/ShopSite/" id="navTitleLink"><div class="navTitle">Shop</div></a>
    <a href="#" class="toggle-button noScroll">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links">
        <ul>
            <li><a href="/ShopSite/sites/shop.php">Shop</a></li>
            <li><a href="/ShopSite/sites/warenkorb.php">Warenkorb</a></li>
            <?php
                if(!isset($_SESSION)){
                    session_start();
                }
                if (isset($_SESSION["userLoggedIn"]) && $_SESSION["userLoggedIn"]) {
                    echo "<li><a href=\"/ShopSite/sites/profile.php\">Profil</a></li>";
                } else {
                    if (session_status() === PHP_SESSION_ACTIVE){
                        session_destroy();
                    }
                    echo "<li><a href=\"/ShopSite/sites/registration.php\">Registrieren</a></li>
                        <li><a href=\"/ShopSite/sites/login.php\">Login</a></li>";
                }
            ?>

        </ul>
    </div>
</nav>
