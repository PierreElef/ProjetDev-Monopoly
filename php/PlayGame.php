<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Jouer une partie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container text-center">
        <?php include("../html/header.html")?>
        <h1>Jouer au Monopoly</h1>
        <div class="row justify-content-around m-2">
            <div class="col-3 p-2">
                <form name="createGame" method="post" action="#">
                        <input type="hidden" name="create" value=1></br>
                        <input class="btn-lg m-1" type="submit" value="Créer une partie" style="font-size:18px;">
                </form>
            </div>
            <div class="col-3 p-2">
                <form name="joinGame" method="post" action="#">
                        <input type="hidden" name="join" value=1></br>
                        <input class="btn-lg m-1" type="submit" value="Rejoindre une partie" style="font-size:18px;">
                        <label class="m-2">Numéro de la partie</label>
                        <input type="number" class="text-center" name="gameNumber"></br>
                </form>
            </div>
            <div class="col-3 p-2">
                <form name="changeSettings" method="post" action="#">
                        <input type="hidden" name="change" value=1></br>
                        <input class="fakeButton" type="image" src="../images/settings.png" alt="Submit" width="64" height="64">
                        <label class="m-2">Changer les paramètres du compte</label>
                </form>
            </div>
        </div>
        <?php
            include('getSQL.php');
            $username_ok=0;
            if (isset($_POST['create'])){
                
            }
            if (isset($_POST['join'])){
               $gameNumber=$_POST['gameNumber'];
            }
            if (isset($_POST['change'])){
                header('Location: changeSettings.php');
             } 
        ?>
        <div class="m-2">
            <h3>Partie en cours</h3>
            <?php
                $games=array();
                $games= getSqlArray('SELECT `ID` FROM `game` ORDER BY `ID`', 1);
                if (sizeof($games) > 0){
                    echo '<table class="table table-striped">';
                    echo '<tr style="font-weight: bold;">';
                    echo "<td>Numéro de</br>la partie</td>";
                    echo "<td>Nombre de</br>joueurs manquants</td>";
                    echo "<td>Joueur 1</td>";
                    echo "<td>Joueur 2</td>";
                    echo "<td>Joueur 3</td>";
                    echo "<td>Joueur 4</td>";
                    echo "<td>Joueur 5</td>";
                    echo "<td>Joueur 6</td>";
                    echo "</tr>";
                    //pour chaque valeur du tableau game
                    foreach ($games as $IDgame){
                        //récupération des caractéristiques du livre
                        $IDplayer1 = getSql('SELECT `IDplayer1` FROM `game` WHERE `ID`='.$IDgame.'');
                        if (!($IDplayer1==NULL)){
                            $namePlayer1 = getSql('SELECT `username` FROM `player` WHERE `ID`='.$IDplayer1.'');
                        }else{
                            $namePlayer1 = "";
                        }
                        $IDplayer2 = getSql('SELECT `IDplayer2` FROM `game` WHERE `ID`='.$IDgame.'');
                        if (!($IDplayer2==NULL)){
                            $namePlayer2 = getSql('SELECT `username` FROM `player` WHERE `ID`='.$IDplayer2.'');
                        }else{
                            $namePlayer2 = "";
                        }
                        $IDplayer3 = getSql('SELECT `IDplayer3` FROM `game` WHERE `ID`='.$IDgame.'');
                        if (!($IDplayer3==NULL)){
                            $namePlayer3 = getSql('SELECT `username` FROM `player` WHERE `ID`='.$IDplayer3.'');
                        }else{
                            $namePlayer3 = "";
                        }
                        $IDplayer4 = getSql('SELECT `IDplayer4` FROM `game` WHERE `ID`='.$IDgame.'');
                        if (!($IDplayer4==NULL)){
                            $namePlayer4 = getSql('SELECT `username` FROM `player` WHERE `ID`='.$IDplayer4.'');
                        }else{
                            $namePlayer4 = "";
                        } 
                        $IDplayer5 = getSql('SELECT `IDplayer5` FROM `game` WHERE `ID`='.$IDgame.'');
                        if (!($IDplayer5==NULL)){
                            $namePlayer5 = getSql('SELECT `username` FROM `player` WHERE `ID`='.$IDplayer5.'');
                        }else{
                            $namePlayer5 = "";
                        }  
                        $IDplayer6 = getSql('SELECT `IDplayer6` FROM `game` WHERE `ID`='.$IDgame.'');
                        if (!($IDplayer6==NULL)){
                            $namePlayer6 = getSql('SELECT `username` FROM `player` WHERE `ID`='.$IDplayer6.'');
                        }else{
                            $namePlayer6 = "";
                        } 
                        $nbrPlayer = getSql('SELECT `nbrPlayer` FROM `game` WHERE `ID`='.$IDgame.'');
                        $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$IDgame.'');
                        if ($nbrPlayer==$nbrOnLine){
                            echo '<tr style="background:green;">';
                        }else{
                            echo "<tr>";
                        }
                        echo "<td>".$IDgame."</td>";
                        echo "<td>".($nbrPlayer-$nbrOnLine)."</td>";
                        echo "<td>".$namePlayer1."</td>";
                        echo "<td>".$namePlayer2."</td>";
                        echo "<td>".$namePlayer3."</td>";
                        echo "<td>".$namePlayer4."</td>";
                        echo "<td>".$namePlayer5."</td>";
                        echo "<td>".$namePlayer6."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else{
                    //s'il n'y a pas de partie en cours
                    echo '<p style="color:red">Il n\'y a de partie en cours.<p>';
                }
            ?>
        </div>
        <?php include("../html/footer.html")?>
    </div>
</body>
</html>