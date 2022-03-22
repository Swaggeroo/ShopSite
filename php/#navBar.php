<link rel="stylesheet" href="/<?php echo $GLOBALS['rootDir']?>ShopSite/css/nav.css">
<script src="/<?php echo $GLOBALS['rootDir']?>ShopSite/scripts/navBar.js" defer></script>
<nav class="navbar">
    <a href="/<?php echo $GLOBALS['rootDir']?>ShopSite/" id="navTitleLink"><div class="navTitle">Tiertotal</div></a>
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
            <li><a id="warenkorbNavbarElement" href="/<?php echo $GLOBALS['rootDir']?>ShopSite/sites/warenkorb.php">Warenkorb</a></li>
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
<script>
    const warenkorbElement = document.getElementById("warenkorbNavbarElement");
    let curVal = 0;

    (async()=>{
        curVal = parseInt(await getTotal());
        updateUI();
    })();

    window.addEventListener('warenkorbUpdated', (e) => {
        console.log("Event Triggered: "+e.detail.cartChange)
        curVal += parseInt(e.detail.cartChange);
        updateUI();
    });

    async function getTotal(){
        let module = await import("../scripts/asyncExec.js");
        let res = await module.asyncGet("../php/cartFunctions/getCartTotalItems.php");
        console.log("result: "+res);
        return res;
    }

    function updateUI(){
        console.log(curVal)
        if (curVal > 0){
            if (curVal > 99){
                warenkorbElement.classList.add("warenkorbNavbarElementAfter");
                warenkorbElement.setAttribute("warenKorbCount", "99+");
            }else {
                warenkorbElement.classList.add("warenkorbNavbarElementAfter");
                warenkorbElement.setAttribute("warenKorbCount", curVal);
            }
        }else {
            warenkorbElement.classList.remove("warenkorbNavbarElementAfter");
            warenkorbElement.setAttribute("warenKorbCount", "");
        }
    }
</script>
