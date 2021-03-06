<?php
    require_once "../tools/config.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php
    require_once "../php/dbConnection.php";
    $db = new db();
    $verkaeufer = $db->getManufacturerById($_GET["id"]);
    if ($verkaeufer == null){
        echo "
            <script>
                alert('Error Verkäufer not found');
                window.location.replace('./shop.php');
           </script>
        ";
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($verkaeufer["FirmName"])?></title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/infoVerkaeufer.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <?php require_once "../php/htmlMaker.php"; $htmlMaker = new htmlMaker(); echo $htmlMaker->getHeader("../media/pictures/animals/biene.jpg",htmlspecialchars($verkaeufer["FirmName"])); ?>
    <?php require "../php/#navBar.php" ?>
    <div class="content" align="center">
        <h1><?php echo htmlspecialchars($verkaeufer["FirmName"])?></h1>
        <div id="infoContext">
            <p><?php echo htmlspecialchars($verkaeufer["Content"])?></p>
            <h2>Kontakt Daten</h2>
            <table>
                <tr>
                    <td>Straße</td>
                    <td><?php echo htmlspecialchars($verkaeufer["Strasse"])?></td>
                </tr>
                <tr>
                    <td>Ort</td>
                    <td><?php echo htmlspecialchars($verkaeufer["PLZ"]); echo " "; echo htmlspecialchars($verkaeufer["Stadt"]);?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><a href="mailto:<?php echo htmlspecialchars($verkaeufer["Email"])?>"><?php echo htmlspecialchars($verkaeufer["Email"])?></a></td>
                </tr>
            </table>
        </div>
        <div id="buttonsContext">
            <a id="productsLink" href="./shop.php?verkaeufer=<?php echo htmlspecialchars($verkaeufer["ManufacturerID"])?>">Produkte ansehen</a>
        </div>
    </div>
    <?php echo $htmlMaker->getFooter()?>
</body>
</html>