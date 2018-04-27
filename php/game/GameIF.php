<?php
    session_start();
    include('../commun/getSQL.php');
    $ID=$_SESSION["id"];
    $IDgame=$_SESSION["idGame"];
    settype($IDgame, "int");
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
            <div id="board" class="col-lg-7 col-md-12">
                <?php include("../../html/monopoly_canvas.html")?>
            </div>
            <div class="col-lg-5 row">
                <div class="col-lg-12 col-md-6">
                    <div id="playerStats">
                        <table class="table table-bordered">
                            <tr style="font-weight: bold;">
                                <td>Joueur</td>
                                <td>Argent</td>
                                <td>Position</td>
                            </tr>
                            <?php
                                $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$IDgame, 1);
                                foreach($IDplayers as $IDplayer){
                                    $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$IDgame.' AND `IDuser`='.$IDplayer.'');
                                    $positionPlayer=getSql('SELECT `position` FROM `player` WHERE `IDgame`='.$IDgame.' AND `IDuser`='.$IDplayer.'');
                                    $namePlayer=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer.'');
                                    $colorPlayer=getSql('SELECT `color` FROM `player` WHERE `IDgame`='.$IDgame.' AND `IDuser`='.$IDplayer.'');
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
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <form>
                                <input class="btn-md m-1 buttonGame" type="submit" value="Lancer le dé">
                            </form>
                            <form>
                                <input class="btn-md m-1 buttonGame" type="submit" value="Acheter">
                            </form>
                            <form>
                                <input class="btn-md m-1 buttonGame" type="submit" value="Payer">
                            </form>
                        </div>
                        <div class="col-6">
                            <form>
                                <input class="btn-md m-1 buttonGame" type="submit" value="Négocier">
                            </form>
                            <form>
                                <input class="btn-md m-1 buttonGame" type="submit" value="Construire">
                            </form>
                            <form>
                                <input class="btn-md m-1 buttonGame" type="submit" value="Carte Prison">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>