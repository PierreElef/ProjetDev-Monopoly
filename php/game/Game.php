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
        }
    }

    function playTurn(Player $player, Dice $de){
        do{
            if($player->isJail == true){
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
        }while($player->isTurn == true);    
    }

    function turnTo(){
        //a qui le tour
        $IDtoPlay = getSql('SELECT `IDtoPlay` FROM `turn` WHERE `IDgame`='.$_SESSION["idGame"]);
        echo "C'est au tour de ".getSql('SELECT `name` FROM `box` WHERE `ID`='.$IDtoPlay)."<br/>";
        return $IDtoPlay;
    }

    function playerOnGame(){
        $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
        foreach($IDplayers as $IDplayer){
            $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
            if ($moneyPlayer<=0){
                $nbrPlayer =+0;
            }else{
                $nbrPlayer =+1;
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