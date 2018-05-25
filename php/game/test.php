<?php
    session_start();
    include('../commun/getSQL.php');
    include('../commun/writeLog.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
</head>
<html>
<body>

    <?php
        $text="3\n";
        $fichier=fopen('../../history/36.txt','a+');
        fputs($fichier, $text);
        fclose($fichier);
        
    ?>
    <iframe src="../../history/36.txt"></iframe>

</body>
</html>