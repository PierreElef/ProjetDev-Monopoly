<?php
include 'DataInit.php';
include 'Game.php';
include 'Box.php';
include 'Player.php';
$ID=$_SESSION["id"];

//initialisation des données sessions
if(is_null($_SESSION['game'])){	
    initGame();
    //Choix de l'ordre de passage
    $game->getPlayingOrder(); 
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

//initilisation administrateur


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