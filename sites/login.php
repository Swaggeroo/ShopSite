<?php
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
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/form.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Login"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/processLogin.php" method="post" id="logForm">
            <h3>Profilinformationen</h3>
            <input class="input" type="text" placeholder="Benutzername" name="benutzername" id="benutzername" pattern="[A-Za-z0-9]{5,}" title="Mindestens 5 Zeichen" required>
            <input class="input" type="password" placeholder="Passwort" name="passwort" id="passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>

            <button type="submit" name="registrierenBTN" id="registrierenBTN">Login</button>
        </form>
    </div>
</body>
</html>