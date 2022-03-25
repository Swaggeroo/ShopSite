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
    <title>Registrierung</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/form.js" defer></script>
    <script src="../scripts/keepInputsRed.js" defer></script>
    <script src="../scripts/registration.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/schildkroete.jpg","Registrierung"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/processRegistration.php" class="formular" method="post" id="regForm">
            <div id="snackbar">Some text some message..</div>
            <p>Schon bereits registriert? <a id="crossLink" href="./login.php">Login</a></p>
            <h3>Persönliche Daten</h3>
            <input class="input" type="text" placeholder="Vorname" name="vorname" id="vorname" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}" title="Nur Buchstaben" required>
            <input class="input" type="text" placeholder="Nachname" name="nachname" id="nachname" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}" title="Nur Buchstaben" required>
            <input class="input" type="text" placeholder="Straße und Nr" name="strasse" id="strasse" pattern="[A-Za-zßÄÜÖäüöÉÚÓÁéúóá\- ]{2,}[ ]{1}[0-9]{1,}" title="Pattern: Straße 123" required>
            <input class="input" type="text" placeholder="Postleitzahl" name="plz" id="plz" pattern="[0-9]{5}" title="Nur 5 Zahlen" required>
            <input class="input" type="text" placeholder="Stadt" name="stadt" id="stadt" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{2,}" title="Nur aus Buchstaben" required>

            <h3>Zahlungsinformationen</h3>
            <input class="input" type="text" placeholder="IBAN" name="iban" id="iban" pattern="[A-Z]{2}[0-9]{20}" title="Pattern: DE12345678901234567890" required>
            <input class="input" type="text" placeholder="BIC" name="bic" id="bic" pattern="[A-Z0-9]{11}" title="11 Zeichen mit nur Großbuchstaben und Zahlen" required>

            <h3>Profilinformationen</h3>
            <input class="input" type="text" placeholder="Benutzername" name="benutzername" id="benutzername" pattern="[A-Za-z0-9]{5,}" title="Mindestens 5 Zeichen" required>
            <input class="input" type="email" placeholder="Email" name="email" id="email" title="Es muss eine valide Email sein" required>
            <div class="passwordContainer">
                <input class="input pwInput" type="password" placeholder="Passwort" name="passwort" id="passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
                <i class="togglePassword" ></i>
            </div>
            <div class="passwordContainer">
                <input class="input pwInput" type="password" placeholder="Passwort wiederholen" name="passwortWiederholung" id="passwortWiederholung" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
                <i class="togglePassword" ></i>
            </div>
            <button class="oldBTN" type="submit" name="registrierenBTN" id="registrierenBTN">
                <div class='fancy-btn-cont'>
                    <a class='fancy-btn'>
                        Registrieren
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