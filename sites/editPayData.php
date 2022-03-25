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
    <title>Zahlungsinformationen bearbeiten</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/registration.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
    <script src="../scripts/keepInputsRed.js" defer></script>
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/flamingo.jpg","Zahlungsinformationen bearbeiten"); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content">
        <form action="../php/edit/changePayData.php" method="post" id="regForm">
            <div id="snackbar">Some text some message..</div>
            <h3>Zahlungsinformationen</h3>
            <input value="<?php echo $user["IBAN"]?>" class="input" type="text" placeholder="IBAN" name="iban" id="iban" pattern="[A-Z]{2}[0-9]{20}" title="Pattern: DE12345678901234567890" required>
            <input value="<?php echo $user["BIC"]?>" class="input" type="text" placeholder="BIC" name="bic" id="bic" pattern="[A-Z0-9]{11}" title="11 Zeichen mit nur Großbuchstaben und Zahlen" required>

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