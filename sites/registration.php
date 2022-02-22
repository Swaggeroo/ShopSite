<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/registration.css">
    <script src="../scripts/form.js" defer></script>
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Registrierung"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/processRegistration.php" method="post" id="regForm">
            <h3>Persönliche Daten</h3>
            <input class="input" type="text" placeholder="Vorname" name="vorname" id="vorname" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}" title="Nur Buchstaben" required>
            <input class="input" type="text" placeholder="Nachname" name="nachname" id="nachname" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}" title="Nur Buchstaben" required>
            <input class="input" type="text" placeholder="Straße" name="strasse" id="strasse" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\- ]{2,}[ ]{1}[0-9]{1,}" title="Straße 123" required>
            <input class="input" type="text" placeholder="Stadt" name="stadt" id="stadt" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{2,}" title="Nur aus Buchstaben" required>
            <input class="input" type="text" placeholder="Postleitzahl" name="plz" id="plz" pattern="[0-9]{5}" title="Nur 5 Zahlen" required>

            <h3>Zahlungsinformationen</h3>
            <input class="input" type="text" placeholder="IBAN" name="iban" id="iban" pattern="[A-Z]{2}[0-9]{20}" title="DE12345678901234567890" required>
            <input class="input" type="text" placeholder="BIC" name="bic" id="bic" pattern="[A-Z0-9]{11}" title="11 Zeichen mit nur Großbuchstaben und Zahlen" required>

            <h3>Profilinformationen</h3>
            <input class="input" type="text" placeholder="Benutzername" name="benutzername" id="benutzername" pattern="[A-Za-z0-9]{5,}" title="Mindestens 5 Zeichen" required>
            <input class="input" type="email" placeholder="Email" name="email" id="email" required>
            <input class="input" type="password" placeholder="Passwort" name="passwort" id="passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>
            <input class="input" type="password" placeholder="Passwort wiederholen" name="passwortWiederholung" id="passwortWiederholung" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Mindestens 8 Zeichen, 1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl" required>

            <button type="submit" name="registrierenBTN" id="registrierenBTN">Registrieren</button>
        </form>
    </div>
</body>
</html>