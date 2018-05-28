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
    <header class="header">
        <?php include("../../html/header2.html")?>
        <div class="row justify-content-end">
            <div class="col-8">
            <?php
                    echo '<h1 class="text-center">Partie en cours - '.getSql('SELECT `name` FROM `user` WHERE `ID`='.$_SESSION["id"]).'</h1>'
                ?>
            </div>
            <div class="col-2">
                <div class="row m-2">
                    <form name="changeSettings" method="post" action="#" class="p-1">
                        <input type="hidden" name="change" value=1>
                        <input type="image" src="../../images/settings.png" alt="Submit" width="32" height="32">
                    </form>
                    <form name="quitSession" method="post" action="#" class="p-1">
                        <input type="hidden" name="quit" value=1>
                        <input type="image" src="../../images/quit.png" alt="Submit" width="32" height="32">
                    </form>
                </div>
            </div>
        </div>
        <?php
            if (isset($_POST['change'])){
                header('Location: ../menu/changeSettings2.php');
            }
            if (isset($_POST['quit'])){
                session_destroy();
                header('Location: ../menu/connexion.php');
            } 
        ?>
    </header>
    <div class="row justify-content-around text-center">
        <div id="proprities" class="col-xl-8 col-lg-12 p-2">
        <h1>Propriétaires</h1>
            <div class="row justify-content-around">
                <?php
                    $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
                    foreach($IDplayers as $IDplayer){
                        $namePlayer=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer);
                        echo'<div class="col-lg-5 col-md-12 mr-3 ml-3">';
                        echo'<h2>'.$namePlayer.'</h2>';
                        echo'<table class="table table-bordered status-table"><tr style="font-weight: bold;background-color:#fff"><td>Rue</td><td>Maison</td><td>Hotel</td></tr>';
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
                        echo'</div>';
                    }
                ?>
            </div>
        </div>
        <div id="board" class="col-xl-4 col-lg-12 p-2"  style="border-left:1px solid black">
            <h1>Plateau</h1>
            <?php 
                //Plateau en canvas à garder pour la v2
                include("../../html/monopoly_canvas.html");
            ?>
        </div>
    </div>
    
    <footer>
        <?php include("../../html/footer.html")?>
    </footer>
</body>
</html>