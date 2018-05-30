<?php
    session_start();
    include('../commun/getSQL.php');
    $ID=$_SESSION["id"];
    $IDgame=$_SESSION["idGame"];
    require_once '../game/DataInit.php';
    require_once '../game/Game.php';
    require_once '../game/Box.php';
    require_once '../game/Board.php';
    require_once '../game/Player.php';
    require_once '../game/Cards.php';
    require_once '../game/Dice.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
    <title>Monopoly - attente</title>
    <meta http-equiv="Refresh" content="5">
</head>
<html>
<body style="background-color: #dae9d4;">
    <div class="container">
        <header class="header">
            <?php include("../../html/header2.html")?>
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
        $nbrPlayerNeed = getSql('SELECT `nbrNeeded` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
        $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
        $IDadmin = getSql('SELECT `IDadmin` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
        if($nbrPlayerNeed==$nbrOnLine){
            if($IDadmin==$_SESSION["id"]){
                $_SESSION['game']=NULL;
                $_SESSION['player']=NULL;
                $_SESSION['board']=NULL;
                $_SESSION['dice']=NULL;
                $_SESSION['order']=NULL;
                $_SESSION['choise']=NULL;
                $_SESSION['orderCard']=NULL;
                if(is_null($_SESSION['game'])){	
                    initGame();
                    echo 'Jeu créé<br/>';
                }
                $game = unserialize($_SESSION['game']);
                if(is_null($_SESSION['player'])){	
                    initPlayer();
                    echo 'Joueur créé<br/>';
                }
                $player = unserialize($_SESSION['player']);
                if(is_null($_SESSION['board'])){	
                    initBoard();
                    echo'Plateau créé<br/>';
                }
                $board = unserialize($_SESSION['board']);
                if(is_null($_SESSION['dice'])){	
                    //Création des dés
                    initDice();
                    echo'Dé créé<br/>';
                }
                $dice = unserialize($_SESSION['dice']);
                //initilisation administrateur
                if(is_null($_SESSION['order'])){	
                    //Création du tour des joueurs
                    initOrderPlayer();
                    echo'Ordre OK<br/>';
                }
                $order = $_SESSION['order'];
                if(is_null($_SESSION['orderCard'])){	
                    //Création de l'ordre des cartes
                    initOrderCard();
                    echo'Ordre cartes OK<br/>La Partie commence<br/>';
                }
                $orderCard = $_SESSION['orderCard'];
                requetSql('UPDATE `game` SET `jackpot`= 0 WHERE `ID`='.$_SESSION["idGame"]);
                header('Location: ../game/GameIF.php');
            }else{
                $jackpot=getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
                if($jackpot!==NULL){
                    $_SESSION['game']=NULL;
                    $_SESSION['player']=NULL;
                    $_SESSION['board']=NULL;
                    $_SESSION['dice']=NULL;
                    $_SESSION['order']=NULL;
                    $_SESSION['choise']=NULL;
                    $_SESSION['orderCard']=NULL;
                    $_SESSION['playersAI']=NULL;
                    if(is_null($_SESSION['game'])){	
                        initGame();
                    }
                    $game = unserialize($_SESSION['game']);
                    if(is_null($_SESSION['player'])){	
                        initPlayer();
                    }
                    $player = unserialize($_SESSION['player']);
                    if(is_null($_SESSION['board'])){	
                        initBoard();
                    }
                    $board = unserialize($_SESSION['board']);
                    if(is_null($_SESSION['dice'])){	
                        //Création des dés
                        initDice();
                    }
                    $dice = unserialize($_SESSION['dice']);
                    //initilisation administrateur
                    if(is_null($_SESSION['order'])){	
                        //Création du tour des joueurs
                        initOrderPlayer();
                    }
                    $order = $_SESSION['order'];
                    if(is_null($_SESSION['orderCard'])){	
                        //Création de l'ordre des cartes
                        initOrderCard();
                    }
                    $orderCard = $_SESSION['orderCard'];
                    //création des joueurs AI
                    if(is_null($_SESSION['playersAI'])){
                        initAI();
                    }
                    header('Location: ../game/GameIF.php');
                }     
            }
        }
        ?>
        <?php include("../../html/footer.html")?>
    </div>
</body>
</html>