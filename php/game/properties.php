<?php
    session_start();
    include('../commun/getSQL.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
    <title>Monopoly - Propriétés</title>
</head>
<html>
<body style="background-color: #dae9d4;">
    <div class="container">
        <header class="header">
            <?php include("../../html/header2.html")?>
            <div class="row justify-content-end">
                <div class="col-8">
                    <?php
                        echo '<h1 class="text-center">Partie en cours - '.getSql('SELECT `name` FROM `user` WHERE `ID`='.$_SESSION["id"]).'</h1>'
                    ?>
                </div>
                <div class="col-2">
                    <form name="quitSession" method="post" action="#" class="p-1">
                        <input type="hidden" name="quit" value=1>
                        <input type="image" src="../../images/quit.png" alt="Submit" width="32" height="32">
                    </form>
                    <?php
                        if (isset($_POST['quit'])){
                            session_destroy();
                            header('Location: ../menu/connexion.php');
                        } 
                    ?>
                </div>
            </div>
        </header>
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
                    echo'<table class="table table-bordered status-table"><tr style="font-weight: bold;"><td>Rue</td><td>Maison</td><td>Hotel</td></tr>';
                    $properties = [2, 4, 7, 9, 10, 12, 14, 15, 17, 19, 20, 22, 24, 25, 27, 28, 30, 32, 33, 35, 38, 40, 6, 16, 26, 36, 13, 29];
                    foreach ($properties as $property){
                        $owner = getSql('SELECT `'.$property.'` FROM `owner` WHERE `IDgame`='.$_SESSION["idGame"], 1);
                        settype($owner, "int");
                        if($owner==$IDplayer){
                            $colorStreet=getSql('SELECT `color` FROM `box` WHERE `ID`='.$property);
                            $streetName=getSql('SELECT `name` FROM `box` WHERE `ID`='.$property);
                            $nbrHouse=getSql('SELECT  `nbrHouse` FROM `building` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDbox`='.$property);
                            $nbrHotel=getSql('SELECT  `nbrHotel` FROM `building` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDbox`='.$property);
                            echo '<tr><td style="background-color:'.$colorStreet.'">'.$property." : ".utf8_encode ($streetName).'</td>';
                            echo '<td class="text-center" style="background-color:'.$colorStreet.'">'.$nbrHouse.'</td>';
                            echo '<td class="text-center" style="background-color:'.$colorStreet.'">'.$nbrHotel.'</td></tr>';
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