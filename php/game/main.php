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
    //echo 'Jeu créé<br/>';
}
$game = unserialize($_SESSION['game']);

if(is_null($_SESSION['player'])){	
	initPlayer();
    //echo 'Joueur créé<br/>';
}
$player = unserialize($_SESSION['player']);

if(is_null($_SESSION['board'])){	
    initBoard();
    //echo'Plateau créé<br/>';
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
    initAdmin();
}
$order = unserialize($_SESSION['order']);

//Identité
echo"Je suis ".$player->getName()."<br/>";

if(is_null($_SESSION['choise'])){	
    $_SESSION['choise']=7;
}

echo"le jeu commence<br/>";
//Tant que nbr_joueur > 1
if($game->playerOnGame() > 1){
    $IDtoPlay=$game->turnTo();
    echo "C'est au tour de ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDtoPlay)."<br/>";
    if($IDtoPlay==$ID){
        $_SESSION["isTurn"]=true;
        echo"C'est votre tour<br/>";
        echo"choix ".$_SESSION['choise']."<br/>";
        $player->jailOff();
        $game->choise();
        $game->playTurn($player, $dice, $board, $board->getBoxByID($player->getPos())); 
        etat();
    } 
}else{
    echo "Le gagnant est ".$game->winner();
}

//A enlever
function etat(){
    if($_SESSION["isTurn"]==true){
        echo "isTurn<br/>";
    }else{
        echo"pas ton tour<br/>";
    }
    if($_SESSION["pulledDice"]==true){
        echo "pulledDice<br/>";
    }else{
        echo"dés pas lancées<br/>";
    }
    if($_SESSION["onStreet"]==true){
        echo "onStreet<br/>";
    }else{
        echo"pas sur une rue<br/>";
    }
    if($_SESSION["onStation"]==true){
        echo "onStation<br/>";
    }else{
        echo"pas sur une gare<br/>";
    }
    if($_SESSION["onEnergie"]==true){
        echo "onEnergie<br/>";
    }else{
        echo"pas sur une Energie<br/>";
    }
    if($_SESSION["isOwner"]==true){
        echo "isOwner<br/>";
    }else{
        echo"pas propriétaire<br/>";
    }
    if($_SESSION["onJail"]==true){
        echo "onJail<br/>";
    }else{
        echo"pas en prison<br/>";
    }
    if($_SESSION["CardsJail"]==true){
        echo "CardsJail<br/>";
    }else{
        echo"pas de carte sortie de prison<br/>";
    }
    if($_SESSION["actionDoing"]==true){
        echo "Action En cours<br/>";
    }else{
        echo "Action Pas En Cours<br/>";
    }
    if($_SESSION["actionDone"]==true){
        echo "Action Faite<br/>";
    }else{
        echo "Action pas Faite<br/>";
    }
}
?>