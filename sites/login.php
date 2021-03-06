<?php
    require_once "../tools/config.php";
    if(!isset($_SESSION)){
        session_start();
    }
    if (isset($_SESSION["userLoggedIn"]) && $_SESSION["userLoggedIn"]){
        die("
                <script>
                    window.location.replace('./shop.php');
                </script>
            ");
    }

    if(isset($_SESSION)){
        session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/form.js" defer></script>
    <script src="../scripts/keepInputsRed.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/zebra.jpg","Login"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/processLogin.php" method="post" id="logForm">
            <div id="snackbar">Some text some message..</div>
            <p>Noch kein Account? <a id="crossLink" href="./registration.php">Registration</a></p>
            <h3>Profilinformationen</h3>
            <input class="input" type="text" placeholder="Benutzername" name="benutzername" id="benutzername" pattern="[A-Za-z0-9]{5,}" title="Mindestens 5 Zeichen" required>
            <div class="passwordContainer">
                <input class="input pwInput" type="password" placeholder="Passwort" name="passwort" id="passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
                <i class="togglePassword" ></i>
            </div>
            <button class="oldBTN" type="submit" name="registrierenBTN" id="registrierenBTN">
                <div class='fancy-btn-cont'>
                    <a class='fancy-btn'>
                        Login
                        <span class='line-1'></span>
                        <span class='line-2'></span>
                        <span class='line-3'></span>
                        <span class='line-4'></span>
                    </a>
                </div>
            </button>
        </form>
    </div>
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>