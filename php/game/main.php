<?php
require_once '../commun/getSQL.php';
require_once 'DataInit.php';
require_once 'Game.php';
require_once 'Box.php';
require_once 'Board.php';
require_once 'Player.php';
require_once 'Cards.php';
require_once 'Dice.php';
$ID=$_SESSION["id"];
$gameID=$_SESSION["idGame"];

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

//Identité
echo"Je suis ".$player->getName().".<br/>";

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
}
//Tant que nbr_joueur > 1
if($game->playerOnGame() > 1){
    $IDtoPlay=$game->turnTo();
    echo "C'est au tour de ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDtoPlay).".<br/>";
    if($IDtoPlay==$ID){
        $_SESSION["isTurn"]=true;
        $_SESSION["actionDone"]=false;
        echo"C'est votre tour<br/>";
        $money=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$ID);
        if($money>0){
            $game->playTurn($player, $dice, $board, $board->getBoxByID($player->getPosition()));
        }else{
            header('Location: youLoose.php');
        }
    } 
}else{
    echo "Le gagnant est ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$game->winner());
    if($game->winner()==$ID){
        header('Location: youWin.php');
    }
}
?>