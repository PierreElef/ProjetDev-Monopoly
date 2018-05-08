<?php
require_once '../commun/getSQL.php' ;
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
    echo 'Jeu créé';
}
$game = unserialize($_SESSION['game']);

if(is_null($_SESSION['player'])){	
	initPlayer();
    echo 'Joueur créé';
}
$player = unserialize($_SESSION['player']);

if(is_null($_SESSION['board'])){	
    initBoard();
    echo'Plateau créé';
}
$board = unserialize($_SESSION['board']);

//initilisation administrateur
initAdmin();

//Tant que nbr_joueur > 1
if($game->playerOnGame() > 1){
    if($game->turnTo()==$ID){
        echo"C'est votre tour<br/>";
        $game->choise();
        $game->playTurn($player, $dice);
    } 
}else{
    echo "Le gagnant est ".$game->winner();
}



?>