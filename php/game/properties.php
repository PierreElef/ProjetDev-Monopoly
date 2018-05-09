<?php
    session_start();
    include('../commun/getSQL.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Monopoly - Propriété</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container">
        <div class="row">
            <div id="board" class="col-xl-7 col-lg-12">
                <?php 
                    //Plateau en canvas à garder pour la v2
                    include("../../html/monopoly_canvas.html");
                ?>
            </div>
            <div class="col-xl-4">
                <?php
                echo "<h1>Propriétaires</h1>";
                $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
                foreach($IDplayers as $IDplayer){
                    $namePlayer=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer);
                    echo'<h2>'.$namePlayer.'</h2>';
                    echo'<table class="table table-bordered"><tr style="font-weight: bold;"><td>Rue</td></tr>';
                    $properties = [2, 4, 7, 9, 10, 12, 14, 15, 17, 19, 20, 22, 24, 25, 27, 28, 30, 32, 33, 35, 38, 40, 6, 16, 26, 36, 13, 29];
                    foreach ($properties as $property){
                        $owner = getSql('SELECT `'.$property.'` FROM `owner` WHERE `IDgame`='.$_SESSION["idGame"], 1);
                        settype($owner, "int");
                        if($owner==$IDplayer){
                            $colorStreet=getSql('SELECT `color` FROM `box` WHERE `ID`='.$property);
                            $streetName=getSql('SELECT `name` FROM `box` WHERE `ID`='.$property);
                            echo '<tr><td style="background-color:'.$colorStreet.'">'.utf8_encode ($streetName).'</td></tr>';
                        }
                    }
                    echo'</table>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>