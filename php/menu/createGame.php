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
    <title>Création d'une partie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container">
        <header class="header">
            <?php include("../../html/header.html")?>
            <div>
                <h1 class="text-center">Création d'une partie</h1>
            <div>
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
                    requetSql('INSERT INTO `game`(`IDplayer1`, `nbrPlayer`, `nbrOnLine`, `nbrNeeded`, `jackpot`) VALUES ('.$idPlayer.','.$nbrTTPlayer.',1,'.$nbrRealPlayer.',0)');
                    $sql='SELECT MAX(`ID`) FROM `game`';
                    $_SESSION["idGame"]=getSql($sql);
                    requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$_SESSION["idGame"].',15000000,1,0,"'.$colorArray[0].'")');
                    requetSql('INSERT INTO `owner`(`IDgame`) VALUES ('.$_SESSION["idGame"].')');
                    $IDplayerIA=1;
                    for ($i=$nbrRealPlayer+1; $i<=$nbrTTPlayer; $i++){
                        requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$IDplayerIA.','.$_SESSION["idGame"].',15000000,1,0,"'.$colorArray[$i].'")');
                        requetSql('UPDATE `game` SET `IDplayer'.$i.'`='.$IDplayerIA.' WHERE `ID`='.$_SESSION["idGame"]);
                        $IDplayerIA=$IDplayerIA+1;
                    }
                    header('Location: waitGamev2.php');
                }
            }
        ?>
        <?php include("../../html/footer.html")?>
    </div>
</body>
</html>