<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/registration.css">
    <script src="../scripts/form.js" defer></script>
</head>
<body>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/processRegistration.php" method="post" id="regForm">
            <h3>Persönliche Daten</h3>
            <div class="formRow">
                <label for="vorname">Vorname</label>
                <input class="input" type="text" placeholder="Vorname" name="vorname" id="vorname" required>
            </div>
            <div class="formRow">
                <label for="nachname">Nachname</label>
                <input class="input" type="text" placeholder="Nachname" name="nachname" id="nachname" required>
            </div>
            <div class="formRow">
                <label for="strasse">Straße</label>
                <input class="input" type="text" placeholder="Straße" name="strasse" id="strasse" required>
            </div>
            <div class="formRow">
                <label for="stadt">Stadt</label>
                <input class="input" type="text" placeholder="Stadt" name="stadt" id="stadt" required>
            </div>
            <div class="formRow">
                <label for="plz">Postleitzahl</label>
                <input class="input" type="number" placeholder="Postleitzahl" name="plz" id="plz" required>
            </div>

            <h3>Zahlungsinformationen</h3>

            <h3>Profilinformationen</h3>
            <div class="formRow">
                <label for="benutzername">Benutzername</label>
                <input class="input" type="text" placeholder="Benutzername" name="benutzername" id="benutzername" required>
            </div>
            <div class="formRow">
                <label for="email">Email</label>
                <input class="input" type="email" placeholder="Email" name="email" id="email" required>
            </div>
            <div class="formRow">
                <label for="passwort">Passwort</label>
                <input class="input" type="password" placeholder="Passwort" name="passwort" id="passwort" required>
            </div>
            <div class="formRow">
                <label for="passwortWiederholung">Passwort wiederholen</label>
                <input class="input" type="password" placeholder="Passwort" name="passwortWiederholung" id="passwortWiederholung" required>
            </div>
            <button type="submit" name="registrierenBTN" id="registrierenBTN">Registrieren</button>
        </form>
    </div>
</body>
</html>