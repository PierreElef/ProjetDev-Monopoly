<?php
class Game{
    function __construct(){

    }
    
    function playTurn(Player $player, Dice $de, Board $board, Box $box){
        //si le joueur est en prison
        if($player->getJailStatu() == true){
            if($_SESSION["pulledDice"]==false){
                if($_SESSION["choise"]==1 OR $_SESSION["choise"]==6){
                    $de->rollDice();
                    if($de->getDouble() == true){
                        $player->turnOn();
                    }else{
                        $player->turnOff();
                    }
                }
            }
        //si le joueur n'est pas en prison
        }else{
            //si le joueur a lancé les dés
            if ($_SESSION["pulledDice"]==true){
                //si l'action est en cours
                if ($_SESSION["actionDoing"]==true){
                    //faire l'action de la case
                    echo"faire action<br/>";
                    $player->action($box);
                }
            }else{
                echo"le joueur lance les dés<br/>";
                //le joueur lance le dé
                $player->move($de, $box);
                //action en cours
                $_SESSION["actionDoing"]=true;
                //changement de case
                $newBox=$board->getBoxByID($player->getPos());
                $newBoxType=$newBox->getType();
                //faire l'action de la case
                $player->action($newBox);
                //si la case est une rue/gare/energie
                if($newBoxType!==4 OR $newBoxType!==5 OR $newBoxType!==6 OR $newBoxType!==7 OR $newBoxType!==8){
                    //action en cours 
                    $_SESSION["actionDoing"]=true;
                    $_SESSION["actionDone"]=false;
                    $_SESSION["pulledDice"]=true;
                }else{
                    //action terminé                    
                    $_SESSION["actionDoing"]=false;
                    $_SESSION["actionDone"]=true;
                    $_SESSION["pulledDice"]=false;
                }
            }
        }
        if($de->getDouble() == true OR $_SESSION["actionDone"]==true){
            $player->turnOn();
        }else{
            $player->turnOff();
            $this->turnNext();
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
                $_SESSION["onJail"]=false;
                $_SESSION["actionDoing"]=false;
                $_SESSION["actionDone"]=false;
            break;
        }
    }
}
?>