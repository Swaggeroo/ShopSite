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
    <title>Profil</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/profile.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/schnecke.jpg","Profil"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content" align="center">
        <h1><?php echo $user["UserName"]?></h1>
        <div id="infoContext">
            <h2>Persönliche Daten <img class="editInfo persData" src="../media/icons/edit.SVG"></h2>
            <table>
                <tr>
                    <td>Vorname</td>
                    <td><?php echo $user["Vorname"]?></td>
                </tr>
                <tr>
                    <td>Nachname</td>
                    <td><?php echo $user["Nachname"]?></td>
                </tr>
                <tr>
                    <td>Straße</td>
                    <td><?php echo $user["Strasse"]?></td>
                </tr>
                <tr>
                    <td>Ort</td>
                    <td><?php echo $user["PLZ"]; echo " "; echo $user["Stadt"];?></td>
                </tr>
            </table>

            <h2>Zahlungsinformationen <img class="editInfo payData" src="../media/icons/edit.SVG"></h2>
            <table>
                <tr>
                    <td>IBAN</td>
                    <td><?php echo $user["IBAN"]?></td>
                </tr>
                <tr>
                    <td>BIC</td>
                    <td><?php echo $user["BIC"]?></td>
                </tr>
            </table>
            <h2>Profilinformationen <img class="editInfo proData" src="../media/icons/edit.SVG"></h2>
            <table>
                <tr>
                    <td>Benutzername</td>
                    <td><?php echo $user["UserName"]?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $user["Email"]?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;</td>
                </tr>
            </table>
        </div>
        <div id="buttonsContext">
            <a id="bestellungenBTN" href="./bestellungen.php">Bestellungen</a><br><br>
            <a id="logoutBTN" href="../php/logout.php">Logout</a>
        </div>
    </div>
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>