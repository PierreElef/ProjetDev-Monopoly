<?php
class Game{
    function __construct(){

    }
    
    function choise(){
        switch ($_SESSION["choise"]){
            case 1 :
                //jet de dés
                $_SESSION["pulledDice"]=true;
            break;
            case 2 :
                //achat
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;      
            break;
            case 3 :
                //passe le tour
                $_SESSION["isTurn"]=false;
            break;
            case 4 :
                //construire
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break;
            case 5 :
                //vendre
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break;
            case 6 :
                //carte prison
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break;
            case 7 :
                $_SESSION["isTurn"]=true;
                $_SESSION["pulledDice"]=false;
                $_SESSION["onStreet"]=false;
                $_SESSION["onStation"]=false;
                $_SESSION["onEnergie"]=false;
                $_SESSION["isOwner"]=false;
                $_SESSION["onJail"]=false;
                $_SESSION["CardsJail"]=false;
                $_SESSION["actionDone"]=false;
            break;
        }
    }

    function playTurn(Player $player, Dice $de){
        do{
            if($player->getJailStatu() == true){
                if($_SESSION["pulledDice"]=false OR $_SESSION["choise"]==6){
                    $de->rollDice();
                    if($de->getDouble() == true){
                        $player->turnOn();
                    }else{
                        $player->turnOff();
                    }
                }

            }else{
                if($_SESSION["pulledDice"]=false){
                    $player->move($de);
                }
                if ($_SESSION["pulledDice"]==true){
                    $player->action();
                }
                if($de->getDouble() == true OR $_SESSION["actionDone"]==true){
                    $player->turnOn();
                }else{
                    $player->turnOff();
                }
            }
        }while($player->getTurnStatu() == true);    
    }

    function turnTo(){
        //a qui le tour
        return getSql('SELECT `IDtoPlay` FROM `turn` WHERE `IDgame`='.$_SESSION["idGame"]);
    }

    function turnNext(){

    }

    function playerOnGame(){
        $nbrPlayer=0;
        $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
        foreach($IDplayers as $IDplayer){
            $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
            if ($moneyPlayer>0){
                $nbrPlayer=$nbrPlayer+1;
            }
        }
        return $nbrPlayer;
    }

    function winner(){
        $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
        foreach($IDplayers as $IDplayer){
            $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
            if ($moneyPlayer>0){
                $IDwinner = $IDplayer;
            }
        }
        $nameWinner=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDwinner);
        return $nameWinner;
    }
}

?>