<?php
class Player{
////////////////////////////////////////////// PROPRIETES
////////////////////////////////////////////// CONSTANTE
    private $id;
    private $name;
    private $color;
////////////////////////////////////////////// EVOLUTIVE
    private $position;
    private $money;
    private $isJail;
    private $isTurn = true;
    private $cardJail = false;
    private $nbrHouse;
    private $nbrHotel;

////////////////////////////////////////////// CONSTRUCTEUR
    function __construct(){
        $this->id = $_SESSION["id"];
        $this->name = getSql('SELECT `name` FROM `user` WHERE `ID`='.$this->id);
        $this->color = getSql('SELECT `color` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        $this->money = getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        $this->isJail = getSql('SELECT `jailStatus` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        $this->position = getSql('SELECT `position` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        //$this->nbrHouse;
        //$this->nbrHotel;
    }

////////////////////////////////////////////// MUTATEURS
////////////////////////////////////////////// GETTEURS
    function getId(){
        return $this->id;
    }

    function getName(){
        return $this->name;
    }

    function getColor(){
        return $this->color;
    }

    function getPosition(){
        $this->position = getSql('SELECT `position` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        return $this->position;
    }

    function getMoney(){
        $this->money = getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        return $this->money;
    }

    function getJailStatus(){
        return $this->isJail;
    }

    function getTurnStatus(){
        return $this->isTurn;
    }

    function getCardJail(){
        return $this->cardJail;
    }

    function getNbrHouse(){
        return $this->nbrHouse;
    }

    function getNbrHotel(){
        return $this->nbrHotel;
    }

////////////////////////////////////////////// SETTEURS
    function setPosition($pos){
        $this->position = $pos;
        requetSql('UPDATE `player` SET `position`='.$this->position.' WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function setMoney($newMoney){
        $this->money = getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        $this->money = $this->money + $newMoney;
        requetSql('UPDATE `player` SET `money`='.$this->money.' WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function jailOn(){
        $this->isJail = 1;
        $_SESSION["onJail"]=true;
        requetSql('UPDATE `player` SET `jailStatus`=1 WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function jailOff(){
        $this->isJail = 0;
        $_SESSION["onJail"]=false;
        requetSql('UPDATE `player` SET `jailStatus`=0 WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function turnOn(){
        $this->isTurn = True;
        $_SESSION["isTurn"]=True;
    }

    function turnOff(){
        $this->isTurn = False;
        $_SESSION["isTurn"]=false;
    } 
////////////////////////////////////////////// FONCTIONS COMPLEXES
////////////////////////////////////////////// DEPLACEMENT
    function move(Dice $de, Box $box){
        echo "DEPLACEMENT :<br/>";
        echo $this->getName()." est sur la case ".$this->getPosition().".<br/>";
        $de->rollDice();
        $newPos=$this->position + $de->getScore();
            
        // Savoir si on passe par la case départ
        if($newPos < 40){
            $newPos = $newPos;
        }else if($newPos >= 40){
            $newPos = $newPos - 39;
            $newMoney=1000000;
            $this->setMoney($newMoney);
            echo $this->getName()." passe par la case départ et empoche 1000000€.<br/>";
        }
        $this->setPosition($newPos);
        echo $this->getName()." se déplace jusqu'à la case ".$this->getPosition().".<br/>";
        $_SESSION["pulledDice"]=true;
    }

////////////////////////////////////////////// ACTIONS

    function action(Board $board, Box $box){
        //recherche type de case
        $typeBox = $box->getType(); 
        //$this->whereAreWe($typeBox);     
        //action en fonction du type de case et du choix de bouton
        echo $this->getName()." est sur la case ".$box->getName()."<br/>";
        switch($typeBox){
            //rue
            case 1:
            $_SESSION["onStreet"]=true;
                //si l'action en cours
                if ($_SESSION["actionDoing"]==true){
                    //recherche propriétaire de la rue
                    $ownerID=$this->whoOwner($box);
                    //s'il n'y a pas de propriétaire
                    if($ownerID==NULL){
                        echo"Il n'y a pas de propriétaire.<br/>";
                        $_SESSION["isOwner"]=false;
                        //si le joueur veut acheter
                        if($_SESSION["choise"]==2){
                            $box->buy($this->id);
                            $this->setMoney(-1500000);
                            echo $this->getName()." achète la case ".$box->getName()."<br/>";
                            $_SESSION["onStreet"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //si le joueur veut passer son tour
                        }elseif($_SESSION["choise"]==3){
                            echo $this->getName()." a passé son tour.<br/>";
                            $_SESSION["onStreet"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //autres
                        }else{
                            echo "Que voulez vous faire ? Acheter ? Passer ? <br/>";
                            $_SESSION["onStreet"]=true;
                            $_SESSION["actionDoing"]=true;
                            $_SESSION["actionDone"]=false;
                        }
                    //si le propriétaire est le joueur
                    }elseif($ownerID==$this->id){
                        echo $this->getName()." est déjà le propriétaire de la case ".$box->getName()."<br/>";
                        $_SESSION["isOwner"]=true;
                        //si le joueur veut construire
                        if($_SESSION["choise"]==4){
                            if($box->nbrHouse()<4){
                                $box->buildHouse();
                                $this->nbrHouse =+ 1;
                                $this->setMoney(-1500000);
                                echo $this->getName()." construit une maison sur la case ".$box->getName()."<br/>";
                            }else{
                                if($box->nbrHotel()!==1){
                                    $box->buildHotel();
                                    $this->nbrHouse =- 4;
                                    $this->nbrHotel =+ 1;
                                    $this->setMoney(-1500000);
                                }
                            }
                            $_SESSION["onStreet"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //si le joueur veut passer son tour
                        }elseif($_SESSION["choise"]==3){
                            echo $this->getName()." a passé son tour.<br/>";
                            $_SESSION["onStreet"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //autres
                        }else{
                            echo "Que voulez vous faire ? Passer ? Construire ? Vendre ?<br/>";
                            $_SESSION["onStreet"]=true;
                            $_SESSION["actionDoing"]=true;
                            $_SESSION["actionDone"]=false;
                        }
                    //si le propriétaire est un autre joueur
                    }else{
                        echo"Le propriétaire est ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID)."<br/>";
                        $_SESSION["isOwner"]=false;
                        if($this->money > $box->getRentStreet()){
                            //si assez argent
                            $newMoney = -($box->getRentStreet());
                            $this->setMoney($newMoney);
                            $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                            $newMoneyOnwer=$moneyOnwer+ $box->getRentStreet();
                            requetSql('UPDATE `player` SET `money`='.$newMoneyOnwer.' WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                            $newMoney=0-$newMoney;
                            echo $this->getName()." a payé ".$newMoney."€ à ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID)."<br/>";
                        }else{
                            //si pas assez argent
                            echo"pas assez d'argent";
                        }
                        $_SESSION["onStreet"]=false;
                        $_SESSION["actionDoing"]=false;
                        $_SESSION["actionDone"]=true;
                        $_SESSION["pulledDice"]=false;
                    }
                }
            break;
            //gare
            case 2:
            $_SESSION["onStation"]=true;
                if ($_SESSION["actionDoing"]==true){
                    $ownerID=$this->whoOwner($box);
                    echo $this->getName()." est sur une case gare.<br/>";
                    if($ownerID==NULL){
                        echo"Il n'y a pas de propriétaire.<br/>";
                        $_SESSION["isOwner"]=false;
                        if($_SESSION["choise"]==2){
                            $box->buy($this->id);
                            $this->setMoney(-1500000);
                            echo $this->getName()." achète la case ".$box->getName()."<br/>";
                            $_SESSION["onStation"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //si le joueur veut passer son tour
                        }elseif($_SESSION["choise"]==3){
                            echo $this->getName()." a passé son tour.<br/>";
                            $_SESSION["onStation"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //autres
                        }else{
                            $_SESSION["onStation"]=true;
                            $_SESSION["actionDoing"]=true;
                            $_SESSION["actionDone"]=false;
                        }
                    }elseif ($ownerID==$this->id){
                        echo $this->getName()." a déjà la case ".$box->getName()."<br/>";
                        $_SESSION["isOwner"]=true;
                        $_SESSION["actionDoing"]=false;
                        $_SESSION["actionDone"]=true;
                        $_SESSION["pulledDice"]=false;
                    }else{
                        echo"Le propriétaire est ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID)."<br/>";
                        $_SESSION["isOwner"]=false;
                        if($this->money>$box->getRentStation()){
                            //si assez argent
                            $newMoney = -($box->getRentStreet());
                            $this->setMoney($newMoney);
                            $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                            $newMoneyOnwer=$moneyOnwer+ $box->getRentStreet();
                            requetSql('UPDATE `player` SET `money`='.$newMoneyOnwer.' WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                            $newMoney=0-$newMoney;
                            echo $this->getName()." a payé ".$newMoney."€ à ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID)."<br/>";
                        }else{
                            //si pas assez argent
                            echo"pas assez d'argent";
                        }
                        $_SESSION["onStation"]=false;
                        $_SESSION["actionDoing"]=false;
                        $_SESSION["actionDone"]=true;
                        $_SESSION["pulledDice"]=false;
                    }
                }
            break;
            //energie
            case 3:
            $_SESSION["onEnergie"]=true;
                if ($_SESSION["actionDoing"]==true){
                    $ownerID=$this->whoOwner($box);
                    if($ownerID==NULL){
                        echo"Il n'y a pas de propriétaire.<br/>";
                        $_SESSION["isOwner"]=false;
                        if($_SESSION["choise"]==2){
                            $box->buy($this->id);
                            $this->setMoney(-1500000);
                            echo $this->getName()." achète la case ".$box->getName()."<br/>";
                            $_SESSION["onEnergie"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //si le joueur veut passer son tour
                        }elseif($_SESSION["choise"]==3){
                            echo $this->getName()." a passé son tour.<br/>";
                            $_SESSION["onEnergie"]=false;
                            $_SESSION["actionDoing"]=false;
                            $_SESSION["actionDone"]=true;
                            $_SESSION["pulledDice"]=false;
                        //autres
                        }else{
                            $_SESSION["onEnergie"]=true;
                            $_SESSION["actionDoing"]=true;
                            $_SESSION["actionDone"]=false;
                        }
                    }elseif ($ownerID==$this->id){
                        echo $this->getName()." a déjà la case ".$box->getName()."<br/>";
                        $_SESSION["isOwner"]=true;
                        $_SESSION["actionDoing"]=false;
                        $_SESSION["actionDone"]=true;
                        $_SESSION["pulledDice"]=false;
                    }else{
                        if($this->money>$box->getRentEnergie()){
                            //si assez argent
                            $newMoney = -($box->getRentStreet());
                            $this->setMoney($newMoney);
                            $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                            $newMoneyOnwer=$moneyOnwer+ $box->getRentStreet();
                            requetSql('UPDATE `player` SET `money`='.$newMoneyOnwer.' WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                            $newMoney=0-$newMoney;
                            echo $this->getName()." a payé ".$newMoney." à ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID)."<br/>";
                        }else{
                            //si pas assez argent
                            echo"pas assez d'argent";
                        }
                    $_SESSION["onEnergie"]=false;
                    $_SESSION["actionDoing"]=false;
                    $_SESSION["actionDone"]=true;
                    $_SESSION["pulledDice"]==false;
                    }
                }
            break;
            case 4: 
                //départ ou prison
                $_SESSION["actionDoing"]=false;
                $_SESSION["actionDone"]=true;
                $_SESSION["pulledDice"]==false;
                $_SESSION["isTurn"]=false;
            break;
            case 5:
                //piocher une carte
                echo $this->getName()." pioche une carte.<br/>";
                if($this->position==8 OR $this->position==23 OR $this->position==37){
                    $pickedCard=$board->getCardByID($this->pickCard()+16);
                }else{
                    $pickedCard=$board->getCardByID($this->pickCard());
                }
                $this->actionCard($pickedCard);
                $_SESSION["actionDoing"]=false;
                $_SESSION["actionDone"]=true;
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break;
            case 6:
                //TAXE
                echo $this->getName()." est sur une case TAXE et doit payer 2000000€.<br/>";
                $newMoney = -2000000;
                $this->setMoney($newMoney);
                $jackpot = getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
                $newJackpot = $jackpot-$newMoney;
                requetSql('UPDATE `game` SET `jackpot`='.$newJackpot.' WHERE `ID`='.$_SESSION["idGame"]);
                $_SESSION["actionDoing"]=false;
                $_SESSION["actionDone"]=true;
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break;
            case 7:
                //park gratuit
                $jackpot = getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
                $this->setMoney($jackpot);
                requetSql('UPDATE `game` SET `jackpot`= 0 WHERE `ID`='.$_SESSION["idGame"]);
                echo $this->getName()." gagne le jackpot de ".$jackpot.".<br/>";
                $_SESSION["actionDoing"]=false;
                $_SESSION["actionDone"]=true;
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break;
            case 8:
                echo $this->getName()." est sur la case aller en prison.<br/>";
                $this->goInJail();
                $_SESSION["actionDoing"]=false;
                $_SESSION["actionDone"]=true;
                $_SESSION["pulledDice"]=false;
                $_SESSION["isTurn"]=false;
            break; 
        }
    }
////////////////////////////////////////////// FONCTIONS SECONDAIRES
    function goInJail(){
        $this->setPosition(11);
        $this->jailOn();
        echo $this->getName()." est enfermé en Prison.<br/>";
    }

    function giveCardJail(){
        $this->cardJail = true;
        $_SESSION["cardJail"]=true;
    }
    function useCardJail(){
        $this->cardJail = false;
        $_SESSION["cardJail"]=false;
        $this->jailOff();
    }


    function actionCard(Cards $card){
        echo'Le joueur a tiré la carte "'.$card->getMessage().'"<br/>';
        $type = $card->getType($card);
        switch ($type){
            case 1:
                $this->setPosition($card->getPosition());
                echo $this->getName()." est allé à la case ".$this->getPosition().".<br/>";
            break;
            case 2:
                $this->setMoney($this->money+$card->getAmount());
            break;
            case 3:
                if($this->cardJail==false){
                    $this->giveCardJail();
                    break;
                }else{
                    echo $this->name.' a déjà une carte "Sortir de Prison"<br/>';
                    break;
                };
            case 4:
                $amount=$this->nbrHouse*$card->getAmountHouse()+$this->nbrHotel*$card->getAmountHotel();
                $this->setMoney($this->money-$amount);
                echo $this->getName()." a perdu ".$amount."€";
            break;
            case 5:
                $this->setPosition($this->getPosition()-3);
                echo $this->getName()." a reculé de trois cases.<br/>";
            break;
            case 6:
                $this->goInJail();
            break;
        }
    }

    function whereAreWe($typeBox){
        switch($typeBox){
            case 1:
                //rue
                $_SESSION["onStreet"]=true;
            break;
            case 2:
                //gare
                $_SESSION["onStation"]=true;
            break;
            case 3:
                //energie
                $_SESSION["onEnergie"]=true;
            break;
        }
    }

    function whoOwner($box){
        $ownerID=$box->getOwner();
        if($ownerID==$this->id){
            $_SESSION["isOwner"]=true;
        }
        return $ownerID;
    }

    function pickCard(){
        $IDcard=getSql('SELECT `cardToPick` FROM `cards` WHERE `IDgame`='.$_SESSION["idGame"]);
        $this->nextCard($IDcard);
        return $IDcard;
    }

    function nextCard($IDcard){
        $orderCard=$_SESSION['orderCard'];
        $nextCard=NULL;
        for($i=0;$i<16;$i++){
            if($orderCard[$i]==$IDcard){
                $j=$i+1;
                if($j==16){
                    $nextCard=$orderCard[0];
                }else{
                    $nextCard=$orderCard[$j];
                }
            }
        }
        requetSql('UPDATE `cards` SET `cardToPick`='.$nextCard.' WHERE `IDgame`='.$_SESSION["idGame"]);
    }
}

?>