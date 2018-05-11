<?php
class Game{
    function __construct(){

    }
    
    function playTurn(Player $player, Dice $de,Board $board, Box $box){
        if($player->getJailStatu() == true){
            if($_SESSION["pulledDice"]==false OR $_SESSION["choise"]==6){
                $de->rollDice();
                if($de->getDouble() == true){
                    $player->turnOn();
                }else{
                    $player->turnOff();
                }
            }

        }else{
            if ($_SESSION["pulledDice"]==true){
                if ($_SESSION["actionDoing"]==true){
                    echo"faire action<br/>";
                    $player->action($box);
                }else{
                    $player->move($de, $box);
                    $_SESSION["actionDoing"]=true;
                    $newBox=$board->getBoxByID($player->getPos());
                    $newBoxType=$newBox->getType();
                    if($newBoxType==4 OR $newBoxType==5 OR $newBoxType==6 OR $newBoxType==7 OR $newBoxType==8){
                        $player->action($newBox);
                        $_SESSION["actionDoing"]=false;
                        //$_SESSION["actionDone"]=true;
                    }else{
                        $player->whereAreWe($newBoxType);
                    }
                }
            }else{
                echo"Il faut lancer le dé<br/>";
            }
            if($de->getDouble() == true OR $_SESSION["actionDone"]==true){
                //$player->turnOn();
            }else{
                //$player->turnOff();
                //turnNext();
            }
        }
    }

    function turnTo(){
        //a qui le tour
        return getSql('SELECT `IDtoPlay` FROM `turn` WHERE `IDgame`='.$_SESSION["idGame"]);
    }

    /*function turnNext(){

    }*/

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

    function choise(){
        switch ($_SESSION["choise"]){
            case 1 :
                //jet de dés
                echo "Le choix fait 1<br/>";
                $_SESSION["pulledDice"]=true;
            break;
            case 2 :
                //achat
                echo "Le choix fait 2<br/>";
                $_SESSION["pulledDice"]=false;
                //$_SESSION["isTurn"]=false;      
            break;
            case 3 :
                //passe le tour
                echo "Le choix fait 3<br/>";
                //$_SESSION["isTurn"]=false;
            break;
            case 4 :
                //construire
                $_SESSION["pulledDice"]=false;
                //$_SESSION["isTurn"]=false;
            break;
            case 5 :
                //vendre
                $_SESSION["pulledDice"]=false;
                //$_SESSION["isTurn"]=false;
            break;
            case 6 :
                //carte prison
                $_SESSION["pulledDice"]=false;
                //$_SESSION["isTurn"]=false;
            break;
            case 7 :
                echo "Le choix fait 7<br/>";
                $_SESSION["isTurn"]=true;
                $_SESSION["pulledDice"]=false;
                $_SESSION["onStreet"]=false;
                $_SESSION["onStation"]=false;
                $_SESSION["onEnergie"]=false;
                $_SESSION["isOwner"]=false;
                $_SESSION["actionDoing"]=true;
                $_SESSION["actionDone"]=false;
            break;
        }
    }

}

?>