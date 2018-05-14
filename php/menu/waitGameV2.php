<?php
    session_start();
    include('../commun/getSQL.php');
    $ID=$_SESSION["id"];
    $IDgame=$_SESSION["idGame"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>En attente de joueur</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="5"/>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container">
        <header class="header">
            <?php include("../../html/header.html")?>
            <div class="text-center">
                <h1 class="text-center">En attente de joueurs</h1>
            </div>
        </header>
        <div class="row text-center p-2">
            <div class="col-lg-8 col-md-12">
                <img src="../../images/wait.jpg" style="width:640px"></br>
                <i>Possibilité de fin de partie</i>
            </div>
            <div class="col-lg-4 align-middle p-1">
                <p></br>La partie va bientôt commencer. Il manque encore des joueurs.</p>
                <p>Préparez à jouer une partie conviviale et amicale.</p>
                <p>Vous pouvez en profiter pour relire les <a href="http://monopolyste.online.fr/regles.shtml" target="_blank">règles</a>.</br></p>
                <img src="../../images/wait2.gif" width=50%>
            </div>
        </div>
        <?php 
        $nbrPlayerNeed = getSql('SELECT `nbrNeeded` FROM `game` WHERE `ID`='.$IDgame.'');
        $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$IDgame.'');
        if($nbrPlayerNeed==$nbrOnLine){
            $_SESSION['game']=NULL;
            $_SESSION['player']=NULL;
            $_SESSION['board']=NULL;
            $_SESSION['dice']=NULL;
            $_SESSION['order']=NULL;
            $_SESSION['choise']=NULL;
            $_SESSION['orderCard']=NULL;
            header('Location: ../game/GameIF.php');
        }
        ?>
        <?php include("../../html/footer.html")?>
    </div>

                        

</body>
</html>