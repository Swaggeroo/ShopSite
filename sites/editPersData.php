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
    <title>Persönliche Daten bearbeiten</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/keepInputsRed.js" defer></script>
    <script src="../scripts/registration.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/chihuahua.jpg","Persönliche Daten bearbeiten"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/edit/changePersData.php" method="post" id="regForm">
            <div id="snackbar">Some text some message..</div>
            <h3>Persönliche Daten</h3>
            <input value="<?php echo $user["Vorname"]?>" class="input" type="text" placeholder="Vorname" name="vorname" id="vorname" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}" title="Nur Buchstaben" required>
            <input value="<?php echo $user["Nachname"]?>" class="input" type="text" placeholder="Nachname" name="nachname" id="nachname" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{3,}" title="Nur Buchstaben" required>
            <input value="<?php echo $user["Strasse"]?>" class="input" type="text" placeholder="Straße und Nr" name="strasse" id="strasse" pattern="[A-Za-zßÄÜÖäüöÉÚÓÁéúóá\- ]{2,}[ ]{1}[0-9]{1,}" title="Pattern: Straße 123" required>
            <input value="<?php echo $user["PLZ"]?>" class="input" type="text" placeholder="Postleitzahl" name="plz" id="plz" pattern="[0-9]{5}" title="Nur 5 Zahlen" required>
            <input value="<?php echo $user["Stadt"]?>" class="input" type="text" placeholder="Stadt" name="stadt" id="stadt" pattern="[A-Za-zÄÜÖäüöÉÚÓÁéúóá\-]{2,}" title="Nur aus Buchstaben" required>

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