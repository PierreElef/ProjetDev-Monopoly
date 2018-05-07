<?php
    session_start();
    include('../commun/getSQL.php');
    $ID=$_SESSION["id"];
    $gameID=$_SESSION["idGame"];
    settype($gameID, "int");
    settype($ID, "int");
    //include 'Box.php';
    //include 'Board.php';
    //settype($gameID, "int");
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Monopoly</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container">
        <?php 
            print_r($ID);
            print_r(gettype($ID));
        ?>
        
    </div>
</body>
</html>