<?php
session_start();
$ID=$_SESSION["id"];
$gameID=$_SESSION["idGame"];
include 'Player.php';
include 'Dice.php';
include '../commun/getSQL.php' ;

class Game{
    function __construct(){

    }
    
    function makeTurn(){
    switch ($_SESSION["choise"]){
        case 1 :
            //jet de dés
            break;
        case 2 :
            //achat       
            break;
        case 3 :
            //passe le tour
            break;
        case 4 :
            //construire
            break;
        case 5 :
            //vendre
            break;
        case 6 :
            //carte prison
            break;
        
    }
}
     

    function playTurn(Player $player, Dice $de){
        do{
            if($player->isJail == true){
                $de->rollDice();
                if($de->getDouble() == true){
                    $player->$isTurn = true;
                }else{
                    $player->isTurn = false;
                }
            }else{
                $player->move($de);
                $player->action();
                if($de->getDouble() == true){
                    $player->isTurn = true;
                }else{
                    $player->isTurn = false;
                }
            }
        }while($player->isTurn == true);    
    }

    function turnTo(){

    }

    function playerOnGame(){
        $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$gameID, 1);
        foreach($IDplayers as $IDplayer){
            $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$gameID.' AND `IDuser`='.$IDplayer.'');
            if ($moneyPlayer<=0){
                $nbrPlayer =+0;
            }else{
                $nbrPlayer =+1;
            }
        }
        return $nbrPlayer;
    }

    function winner(){
        $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$gameID, 1);
        foreach($IDplayers as $IDplayer){
            $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$gameID.' AND `IDuser`='.$IDplayer.'');
            if ($moneyPlayer>0){
                $IDwinner = $IDplayer;
            }
        }
        $nameWinner=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDwinner);
        return $nameWinner;
    }
}

?>