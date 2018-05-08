<?php
    session_start();
    require_once('../commun/getSQL.php');
    require_once 'DataInit.php';
    require_once 'Game.php';
    require_once 'Box.php';
    require_once 'Board.php';
    require_once 'Player.php';
    require_once 'Cards.php';
    $ID=$_SESSION["id"];
    settype($ID, "int");
    $gameID=$_SESSION["idGame"];
    settype($gameID, "int");
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