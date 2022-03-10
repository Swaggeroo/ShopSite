<?php
//echo $_GET["id"];?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rechnung Drucken</title>
    <link rel="stylesheet" href="../css/bill.css">
    <link rel="icon" href="../media/icons/favicon.SVG" sizes="any">
</head>
<body>
    <img src="../media/icons/faviconDARK.SVG">
    <script>
        self.print();
        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (!mql.matches){
                    window.close();
                }
            });
        }
    </script>
</body>
</html>