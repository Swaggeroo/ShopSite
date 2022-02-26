<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <?php require "../php/htmlMaker.php"; $headerMaker = new htmlMaker(); echo $headerMaker->getHeader("../media/pictures/test.jpg","Profil"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content" align="center">
        <h1>Name</h1>
        <div id="infoContext">
            <h2>Persönliche Daten</h2>
            <table>
                <tr>
                    <td>Vorname</td>
                    <td>Max</td>
                </tr>
                <tr>
                    <td>Nachname</td>
                    <td>Mustermann</td>
                </tr>
                <tr>
                    <td>Straße</td>
                    <td>Musterstraße 29</td>
                </tr>
                <tr>
                    <td>Ort</td>
                    <td>54321 Musterstadt</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>test@test.de</td>
                </tr>
            </table>

            <h2>Zahlungsinformationen</h2>
            <table>
                <tr>
                    <td>IBAN</td>
                    <td>DE12345678900000000000</td>
                </tr>
                <tr>
                    <td>BIC</td>
                    <td>GEOOOOOOOOO</td>
                </tr>
            </table>
        </div>
        <div id="buttonsContext">
            <a id="logoutBTN" href="../php/logout.php">Logout</a>
        </div>
    </div>
</body>
</html>