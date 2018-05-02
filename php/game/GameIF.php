<?php
    session_start();
    include('../commun/getSQL.php');
    $ID=$_SESSION["id"];
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
        <div class="row mt-4">
            <div id="board" class="col-xl-7 col-lg-12">
                <?php include("../../html/monopoly_canvas.html")?>
            </div>
            <div class="col-xl-5 row">
                <div class="col-xl-12 col-lg-6">
                    <div id="playerStats">
                        <table class="table table-bordered">
                            <tr style="font-weight: bold;">
                                <td>Joueur</td>
                                <td>Argent</td>
                                <td>Position</td>
                            </tr>
                            <?php
                                $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$gameID, 1);
                                foreach($IDplayers as $IDplayer){
                                    $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$gameID.' AND `IDuser`='.$IDplayer.'');
                                    $positionPlayer=getSql('SELECT `position` FROM `player` WHERE `IDgame`='.$gameID.' AND `IDuser`='.$IDplayer.'');
                                    $namePlayer=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer.'');
                                    $colorPlayer=getSql('SELECT `color` FROM `player` WHERE `IDgame`='.$gameID.' AND `IDuser`='.$IDplayer.'');
                                    echo '<tr>';
                                    echo '<td style="color:'.$colorPlayer.'"><b>'.$namePlayer.'</b></td>';
                                    echo '<td>'.$moneyPlayer.'</td>';
                                    echo '<td>'.$positionPlayer.'</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <form>
                                <input type="hidden" name="diceButton" value="1">
                                <input class="buttonGame" type="submit" value="Lancer le dé">
                            </form><br/><br/>
                            <form>
                                <input type="hidden" name="buyButton" value="1">
                                <input class="buttonGame" type="submit" value="Acheter">
                            </form><br/><br/>
                            <form>
                                <input type="hidden" name="passButton" value="1">
                                <input class="buttonGame" type="submit" value="Passer">
                            </form>
                        </div>
                        <div class="col-6">
                            <form>
                                <input type="hidden" name="buildButton" value="1">
                                <input class="buttonGame" type="submit" value="Construire">
                            </form><br/>
                                <form>
                                    <input type="hidden" name="sellButton" value="1">
                                    <input class="buttonGame" type="number" name="boxIDtoSell" min="1" max="40">
                                    <input class="buttonGame" type="submit" value="Vendre">  
                                </form>
                            <form><br/><br/>
                                <input type="hidden" name="cardJailButton" value="1">
                                <input class="buttonGame" type="submit" value="Carte Prison">
                            </form>
                        </div>
                        <?php
                        if (isset($_POST['diceButton'])){
                            //faire rouler le dé
                        }
                        if (isset($_POST['buyButton'])){
                            //faire acheter
                        }
                        if (isset($_POST['passButton'])){
                            //faire passer le tour
                        }
                        if (isset($_POST['buildButton'])){
                            //faire rajouter une maison
                        }
                        if (isset($_POST['sellButton'])){
                            //faire vendre la case $_POST['boxIDtoSell']
                        }
                        if (isset($_POST['cardJailButton'])){
                            //faire utiliser la carte sortie de prison
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>