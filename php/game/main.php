<?php
require_once '../commun/getSQL.php';
require_once '../commun/writeLog.php';
require_once 'DataInit.php';
require_once 'Game.php';
require_once 'Box.php';
require_once 'Board.php';
require_once 'Player.php';
require_once 'Cards.php';
require_once 'Dice.php';
require_once 'PlayerAI.php';

//initialisation des données sessions
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

//création des joueurs AI
if(is_null($_SESSION['playersAI'])){
    $IDadmin = getSql('SELECT `IDadmin` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
    if($IDadmin==$_SESSION["id"]){
        echo'Prout';
        $IDplayers=getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"],1);
        $playerAI1=NULL;
        $playerAI2=NULL;
        $playerAI3=NULL;
        $playerAI4=NULL;
        $playerAI5=NULL;
        foreach($IDplayers AS $IDplayer){
            if($IDplayer==1){
                $playerAI1=new PlayerAI(1);
                echo'PlayerAI1<br/>';
                $_SESSION['playerAI1']=serialize($playerAI1);
            }elseif($IDplayer==2){
                $playerAI2=new PlayerAI(2);
                echo'PlayerAI2';
                $_SESSION['playerAI2']=serialize($playerAI2);
            }elseif($IDplayer==3){
                $playerAI3=new PlayerAI(3);
                echo'PlayerAI3';
                $_SESSION['playerAI3']=serialize($playerAI3);
            }elseif($IDplayer==4){
                $playerAI4=new PlayerAI(4);
                echo'PlayerAI4';
                $_SESSION['playerAI4']=serialize($playerAI4);
            }elseif($IDplayer==5){
                $playerAI5=new PlayerAI(5);
                echo'PlayerAI5';
                $_SESSION['playerAI5']=serialize($playerAI5);
            }
        }
        $playersAI=array($playerAI1,$playerAI2,$playerAI3,$playerAI4,$playerAI5);
        $_SESSION['playersAI']=serialize($playersAI);
        echo'PlayersAI créés';
    }else{
        $_SESSION['playersAI']=NULL;
    }
    $playersAI = unserialize($_SESSION['playersAI']);
}

if(is_null($_SESSION['choise'])){	
    $_SESSION["isTurn"]=false;
    $_SESSION["pulledDice"]=false;
    $_SESSION["onStreet"]=false;
    $_SESSION["onStation"]=false;
    $_SESSION["onEnergie"]=false;
    $_SESSION["isOwner"]=false;
    $_SESSION["onJail"]=false;
    $_SESSION["actionDoing"]=false;
    $_SESSION["actionDone"]=true;
    $_SESSION["cardJail"]=false;
    $_SESSION["turnJail"]=0;
    $_SESSION["double"]=false;
}
//Tant que nbr_joueur > 1
if($game->playerOnGame() > 1){
    $IDtoPlay=$game->turnTo();
    echo "C'est au tour de ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDtoPlay).".<br/>";
    if($IDtoPlay==$_SESSION["id"]){
        $_SESSION["isTurn"]=true;
        $_SESSION["actionDone"]=false;
        echo"C'est votre tour<br/>";
        $money=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$_SESSION["id"]);
        if($money>0){
            $game->playTurn($player, $dice, $board, $board->getBoxByID($player->getPosition()));
        }else{
            header('Location: youLoose.php');
        }
    }elseif($IDtoPlay==1 OR $IDtoPlay==2 OR $IDtoPlay==3 OR $IDtoPlay==4 OR $IDtoPlay==5){
        //Joueur AI
        $IDadmin = getSql('SELECT `IDadmin` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
        if($IDadmin==$_SESSION["id"]){
            
            $money=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDtoPlay);
            if($money>0){
                if($IDtoPlay==1){
                    $playerAI1 = unserialize($_SESSION['playerAI1']);
                    $game->playTurnAI($playerAI1, $dice, $board, $board->getBoxByID($player->getPosition()));
                    $_SESSION['playerAI1']=serialize($playerAI1);
                }elseif($IDtoPlay==2){
                    $playerAI2 = unserialize($_SESSION['playerAI2']);
                    $game->playTurnAI($playerAI2, $dice, $board, $board->getBoxByID($player->getPosition()));
                    $_SESSION['playerAI2']=serialize($playerAI2);
                }elseif($IDtoPlay==3){
                    $playerAI3 = unserialize($_SESSION['playerAI3']);
                    $game->playTurnAI($playerAI3, $dice, $board, $board->getBoxByID($player->getPosition()));
                    $_SESSION['playerAI3']=serialize($playerAI3);
                }elseif($IDtoPlay==4){
                    $playerAI4 = unserialize($_SESSION['playerAI4']);
                    $game->playTurnAI($playerAI4, $dice, $board, $board->getBoxByID($player->getPosition()));
                    $_SESSION['playerAI4']=serialize($playerAI4);
                }elseif($IDtoPlay==5){
                    $playerAI5 = unserialize($_SESSION['playerAI5']);
                    $game->playTurnAI($playerAI5, $dice, $board, $board->getBoxByID($player->getPosition()));
                    $_SESSION['playerAI5']=serialize($playerAI5);
                }
                
            }
        }
    } 
}else{
    echo "Le gagnant est ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$game->winner());
    if($game->winner()==$_SESSION["id"]){
        header('Location: youWin.php');
    }
}
?> 