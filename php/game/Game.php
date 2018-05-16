<?php
class Game{
    function __construct(){

    }
    
    function playTurn(Player $player, Dice $de, Board $board, Box $box){
        //si joueur est en prison
        if($player->getJailStatus() == true OR $_SESSION["onJail"]==true){
            echo $player->getName()." est en prison.<br/>";
            echo "Tour en prison : ".$_SESSION["turnJail"]."<br/>";
            if($_SESSION["pulledDice"]==false){
                if($_SESSION["choise"]==1){
                    $de->rollDice();
                    if($de->getDouble() == true OR $_SESSION["choise"]==6 OR $_SESSION["turnJail"]==3){
                        echo $player->getName()." sort de prison.<br/>";
                        $player->jailOff();
                        $player->turnOn();
                        $_SESSION["turnJail"]=0;
                    }else{
                        echo $player->getName()." reste en prison<br/>";
                        $player->turnOff();
                        $_SESSION["pulledDice"]=false;
                        $_SESSION["turnJail"]=$_SESSION["turnJail"]+1;
                        $this->turnNext();
                    }
                }
            }
        //si le joueur n'est pas en prison
        }else{
            //si le joueur a lancé les dés
            if($_SESSION["pulledDice"]==true){
                //si l'action est en cours
                if ($_SESSION["actionDoing"]==true){
                    //faire l'action de la case
                    $player->action($board, $box);
                }
            }elseif($_SESSION["choise"]==1){
                echo $player->getName()." lance les dés<br/>";
                //le joueur lance le dé
                $player->move($de, $box);
                //action en cours
                $_SESSION["actionDoing"]=true;
                //changement de case
                $newBox=$board->getBoxByID($player->getPosition());
                $newBoxType=$newBox->getType();
                //faire l'action de la case
                $player->action($board, $newBox);
            }
            if($de->getDouble() == true OR $_SESSION["actionDone"]==false){
                $player->turnOn();
            }else{
                $player->turnOff();
                $_SESSION["pulledDice"]=false;
                $this->turnNext();
            }
        } 
    }

    function turnTo(){
        //a qui le tour
        $IDtoPlay=getSql('SELECT `IDtoPlay` FROM `turn` WHERE `IDgame`='.$_SESSION["idGame"].'');
        return $IDtoPlay;
    }

    function turnNext(){
        //passer au tour suivant
        $order=$_SESSION['order'];
        $nextPlayer=NULL;
        $nbrPlayer=$this->playerOnGame();
        for($i=0;$i<$nbrPlayer;$i++){
            if($order[$i]==$_SESSION["id"]){
                $j=$i+1;
                if($j==$nbrPlayer){
                    $nextPlayer=$order[0];
                }else{
                    $nextPlayer=$order[$j];
                }
            }
        }
        echo "C'est au tour de ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$nextPlayer)."<br/>";
        requetSql('UPDATE `turn` SET `IDtoPlay`='.$nextPlayer.' WHERE `IDgame`='.$_SESSION["idGame"]);
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