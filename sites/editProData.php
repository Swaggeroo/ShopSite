<?php
    require_once "../php/#checkPermission.php";
    require_once "../php/dbConnection.php";
    require_once "../tools/config.php";
    $db = new db();
    $user = $db->getUserById($_SESSION["userID"]);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profilinformationen bearbeiten</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/keepInputsRed.js" defer></script>
    <script src="../scripts/form.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/huhn.jpg","Profilinformationen bearbeiten"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/edit/changeProData.php" method="post" id="regForm">
            <div id="snackbar">Some text some message..</div>
            <h3>Profilinformationen</h3>
            <input value="<?php echo $user["UserName"]?>" disabled class="input" type="text" id="benutzername">
            <input value="<?php echo $user["Email"]?>" class="input" type="email" placeholder="Email" name="email" id="email" title="Es muss eine valide Email sein" required>
            <div class="passwordContainer">
                <input class="input pwInput" type="password" placeholder="Altes Passwort" name="oldPasswort" id="oldPasswort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
                <i class="togglePassword" ></i>
            </div>
            <div class="passwordContainer">
                <input class="input pwInput" type="password" placeholder="Passwort" name="passwort" id="passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
                <i class="togglePassword" ></i>
            </div>
            <div class="passwordContainer">
                <input class="input pwInput" type="password" placeholder="Passwort wiederholen" name="passwortWiederholung" id="passwortWiederholung" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
                <i class="togglePassword" ></i>
            </div>
            <button class="oldBTN" type="submit">
                <div class='fancy-btn-cont'>
                    <a class='fancy-btn'>
                        Ändern
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