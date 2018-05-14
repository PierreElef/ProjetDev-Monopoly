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
    <title>Monopoly</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<meta http-equiv="refresh" content="1"/>-->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container">
        <header class="header">
            <?php include("../../html/header2.html")?>
            <div class="row justify-content-end">
                <div class="col-8">
                    <h1 class="text-center">Partie en cours</h1>
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
        <div class="row mt-4">
            <div id="board" class="col-xl-6 col-lg-12 pl-5 pb-5">
                <h2>Déroulement du jeu</h2>
                <?php 
                    include('main.php');
                ?>
            </div>
            <div class="col-xl-6 row">
                <div class="col-xl-12 col-lg-6">
                    <div id="playerStats">
                        <table class="table table-bordered">
                            <tr style="font-weight: bold;">
                                <td>Joueur</td>
                                <td>Argent</td>
                                <td>Position</td>
                            </tr>
                            <?php
                                $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
                                foreach($IDplayers as $IDplayer){
                                    $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
                                    $positionPlayer=getSql('SELECT `position` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
                                    $positionName=getSql('SELECT `name` FROM `box` WHERE `ID`='.$positionPlayer.'');
                                    $namePlayer=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer.'');
                                    $colorPlayer=getSql('SELECT `color` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
                                    echo '<tr>';
                                    echo '<td style="color:'.$colorPlayer.'"><b>'.$namePlayer.'</b></td>';
                                    echo '<td>'.$moneyPlayer.'</td>';
                                    echo '<td>'.$positionPlayer.' : '.utf8_encode($positionName).'</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </div>
                    <div>
                        <p>Voir <a href="properties.php" target="_blank">Plateau et propriétés</a></p>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <!--Bouton Lancer le dé--> 
                            <form action="#" method="post">
                                <input type="hidden" name="diceButton" value="1">
                                <?php 
                                    if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==false){
                                        echo'<input class="buttonGame" type="submit" value="Lancer les dés">';
                                    }else{
                                       echo'<input class="buttonGame" type="submit" value="Lancer le dé" disabled>';
                                    }
                                ?>
                            </form><br/><br/>
                            <!--Bouton Acheter--> 
                            <form action="#"  method="post">
                                <input type="hidden" name="buyButton" value="1">
                                <?php 
                                    if ($_SESSION["isTurn"]==true AND $_SESSION["actionDone"]==false AND $_SESSION["pulledDice"]==true AND ($_SESSION["onStreet"]==true OR $_SESSION["onStation"]==true OR $_SESSION["onEnergie"]==true)){
                                        echo'<input class="buttonGame" type="submit" value="Acheter">';
                                    }else{
                                        echo'<input class="buttonGame" type="submit" value="Acheter" disabled>';
                                    }
                                ?>
                            </form><br/><br/>
                            <!--Bouton Passer--> 
                            <form action="#"  method="post">
                                <input type="hidden" name="passButton" value="1">
                                <?php 
                                    if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==true AND $_SESSION["actionDone"]==false){
                                        echo'<input class="buttonGame" type="submit" value="Passer">';
                                    }else{
                                        echo'<input class="buttonGame" type="submit" value="Passer" disabled>';
                                    }
                                ?>
                            </form>
                        </div>
                        <div class="col-6">
                            <!--Bouton construire-->
                            <form action="#" method="post">
                                <input type="hidden" name="buildButton" value="1">
                                <?php 
                                   if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==true AND $_SESSION["onStreet"]==true AND $_SESSION["actionDone"]==false){
                                        echo'<input class="buttonGame" type="submit" value="Construire">';
                                    }else{
                                        echo'<input class="buttonGame" type="submit" value="Construire" disabled>';
                                    }
                                ?>
                            </form><br/>
                            <!--Bouton vendre-->        
                            <form action="#" method="post">
                                <input type="hidden" name="sellButton" value="1">
                                <?php 
                                    if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==true AND $_SESSION["actionDone"]==false AND ($_SESSION["onStreet"]==true OR $_SESSION["onStation"]==true OR $_SESSION["onEnergie"]==true)){
                                        echo'<input class="buttonGame" type="submit" value="Vendre">';
                                        echo'<input class="buttonGame" type="number" name="boxIDtoSell" min="1" max="40">';
                                    }else{
                                        echo'<input class="buttonGame" type="number" name="boxIDtoSell" min="1" max="40" disabled>';
                                        echo'<input class="buttonGame" type="submit" value="Vendre" disabled>';
                                    }
                                ?>
                            </form>
                            <!--Bouton carte prison--> 
                            <form action="#" method="post"><br/><br/>
                                <input type="hidden" name="cardJailButton" value="1">
                                <?php 
                                    if ($_SESSION["isTurn"]==true AND $_SESSION["onJail"]==true AND $_SESSION["cardJail"]==true){
                                        echo'<input class="buttonGame" type="submit" value="Carte Prison">';
                                    }else{
                                        echo'<input class="buttonGame" type="submit" value="Carte Prison" disabled>';
                                    }
                                ?>
                            </form>
                            <form action="#" method="post"><br/><br/>
                                <input type="hidden" name="other" value="1">
                                <input class="buttonGame" type="submit" value="Reboot">
                            </form>
                        </div>
                        <?php
                        if (isset($_POST['diceButton'])){
                            $_SESSION["choise"]=1;
                        }
                        if (isset($_POST['buyButton'])){
                            //faire acheter
                            $_SESSION["choise"]=2;
                        }
                        if (isset($_POST['passButton'])){
                            //faire passer le tour
                            $_SESSION["choise"]=3;
                        }
                        if (isset($_POST['buildButton'])){
                            //faire rajouter une maison
                            $_SESSION["choise"]=4;
                        }
                        if (isset($_POST['sellButton'])){
                            //faire vendre la case $_POST['boxIDtoSell']
                            $_SESSION["choise"]=5;
                        }
                        if (isset($_POST['cardJailButton'])){
                            //faire utiliser la carte sortie de prison
                            $_SESSION["choise"]=6;
                        }
                        if (isset($_POST['other'])){
                            //faire utiliser la carte sortie de prison
                            $_SESSION["choise"]=7;
                            $_SESSION["isTurn"]=false;
                            $_SESSION["pulledDice"]=false;
                            $_SESSION["onStreet"]=false;
                            $_SESSION["onStation"]=false;
                            $_SESSION["onEnergie"]=false;
                            $_SESSION["isOwner"]=false;
                            $_SESSION["onJail"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--<div class="col-xl-4 col-lg-6">
                <?php
                /*echo "<h1>Propriétaires</h1>";
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
                }*/
                ?> 
            </div>-->
        </div>
    </div>
</body>
</html>