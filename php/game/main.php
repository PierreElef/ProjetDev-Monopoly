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
initAdmin();

//Identité
echo"Je suis ".$player->getName()."<br/>";

if(is_null($_SESSION['choise'])){	
    $_SESSION['choise']=7;
    echo"et hop";
}
//Tant que nbr_joueur > 1
if($game->playerOnGame() > 1){
    echo"le jeu commence<br/>";
    $IDtoPlay=$game->turnTo();
    echo "C'est au tour de ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDtoPlay)."<br/>";
    if($IDtoPlay==$ID){
        echo"C'est votre tour<br/>";
        $game->choise();
        $game->playTurn($player, $dice);
    } 
}else{
    echo "Le gagnant est ".$game->winner();
}



?>