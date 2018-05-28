<?php
    session_start();
    include('../commun/getSQL.php');
    $idPlayer=$_SESSION["id"];
    if (isset($_POST['change'])){
        header('Location: changeSettings.php');
    }
    if (isset($_POST['quit'])){
        session_destroy();
        header('Location: connexion.php');
    } 
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
    <title>Monopoly - nouvelle partie</title>
</head>
<html>
<body style="background-color: #dae9d4;">
        <header class="header">
            <?php include("../../html/header2.html")?>
            <div class="row justify-content-end">
                <div class="col-8">
                    <h1 class="text-center">Créer une partie</h1>
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
        </header>
        <div>
            <form name="changeName" method="post" action="#" class="m-2 text-center">
                <input type="hidden" name="create" value=1></br>
                <label class="m-2">Nombre de joueur réel : </label>
                <input name="nbrRealPlayer" type="number" value="1" step="1" min="1" max="6" class="text-center"></br>
                <label class="m-2">Nombre de joueur IA : </label>
                <input name="nbrIAPlayer" type="number" value="0" step="1" min="0" max="5" class="text-center"></br>
                <input class="btn-md m-1" type="submit" value="Créer une partie"></br>
            </form>
        </div>
        <?php
            if (isset($_POST['create'])){
                $nbrRealPlayer=$_POST['nbrRealPlayer'];
                $nbrIAPlayer=$_POST['nbrIAPlayer'];
                $nbrTTPlayer=$nbrRealPlayer+$nbrIAPlayer;
                $idPlayer=$_SESSION["id"];
                $colorArray=array("#FF0000","#003AFF","#4FAB5B","#ffac00","#d8789f","#00c8d8");
                if($nbrTTPlayer>6){
                    echo '<p class="text-center" style="color:red">Trop de joueurs. Limite de 6 au total.</p>';
                }elseif ($nbrTTPlayer==1){
                    echo '<p class="text-center" style="color:red">Il faut au minimum 2 joueurs pour jouer.</p>';
                }else{
                    requetSql('INSERT INTO `game`(`IDplayer1`, `nbrPlayer`, `nbrOnLine`, `nbrNeeded`, `jackpot`, `IDadmin`) VALUES ('.$idPlayer.','.$nbrTTPlayer.',1,'.$nbrRealPlayer.',NULL,'.$idPlayer.')');
                    $gameID=getSql('SELECT MAX(`ID`) FROM `game`');
                    settype($gameID, "int");
                    $_SESSION["idGame"]=$gameID;
                    requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$_SESSION["idGame"].',15000000,1,0,"'.$colorArray[0].'")');
                    requetSql('INSERT INTO `owner`(`IDgame`) VALUES ('.$_SESSION["idGame"].')');
                    $IDplayerIA=1;
                    for ($i=$nbrRealPlayer+1; $i<=$nbrTTPlayer; $i++){
                        requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$IDplayerIA.','.$_SESSION["idGame"].',15000000,1,0,"'.$colorArray[$i].'")');
                        requetSql('UPDATE `game` SET `IDplayer'.$i.'`='.$IDplayerIA.' WHERE `ID`='.$_SESSION["idGame"]);
                        $IDplayerIA=$IDplayerIA+1;
                    }
                    fopen('../../history/'.$_SESSION["idGame"].'.txt', 'w+');
                    header('Location: waitGamev2.php');
                }
            }
        ?>
    <footer>
        <?php include("../../html/footer.html")?>
    </footer>
</body>
</html>