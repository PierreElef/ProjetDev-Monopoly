<?php
class PlayerAI{
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
    private $turnInJail;

////////////////////////////////////////////// CONSTRUCTEUR
    function __construct($id){
        $this->id = $id;
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

    function getTurnInJail(){
        return $this->turnInJail;
    }

////////////////////////////////////////////// SETTEURS
    function setPosition($pos){
        $this->position = $pos;
        requetSql('UPDATE `player` SET `position`='.$this->position.' WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        if($pos==1){
            $this->setMoney(1000000);
            echo $this->getName()." passe par la case départ et empoche 1000000€.<br/>";
        }
    }

    function setMoney($newMoney){
        $this->money = getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
        $this->money = $this->money + $newMoney;
        requetSql('UPDATE `player` SET `money`='.$this->money.' WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function jailOn(){
        $this->isJail = 1;
        $this->turnInJail = 0;
        requetSql('UPDATE `player` SET `jailStatus`=1 WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function jailOff(){
        $this->isJail = 0;
        requetSql('UPDATE `player` SET `jailStatus`=0 WHERE `IDuser`='.$this->id.' AND `IDgame`='.$_SESSION["idGame"]);
    }

    function jailStay(){
        $turnInJail=$this->turnInJail;
        $this->turnInJail = $turnInJail+1;
    }

    function turnOn(){
        $this->isTurn = True;
    }

    function turnOff(){
        $this->isTurn = False;
    } 
////////////////////////////////////////////// FONCTIONS COMPLEXES
////////////////////////////////////////////// DEPLACEMENT
    function move(Dice $de){
        $de->rollDice();
        $newPos=$this->position + $de->getScore();
        // Savoir si on passe par la case départ
        if($newPos < 40){
            $newPos = $newPos;
        }else if($newPos >= 40){
            $newPos = $newPos - 39;
            $this->setMoney(1000000);
        }
        $this->setPosition($newPos);
        writeLog($this->getName()." se déplace jusqu'à la case ".$this->getPosition().".\n");
    }

////////////////////////////////////////////// ACTIONS

    function action(Board $board, Box $box){
        //recherche type de case
        $typeBox = $box->getType();    
        writeLog($this->getName()." est sur la case ".$box->getName().".\n");
        switch($typeBox){
            //rue
            case 1:
                //recherche propriétaire de la rue
                $ownerID=$this->whoOwner($box);
                //s'il n'y a pas de propriétaire
                if($ownerID==NULL){
                    //le joueur achete (chance 1/2)
                    if(rand(1, 2)==1){
                        $this->buyBox($box);
                    }else{
                        $this->passTurn();
                    }
                //si le propriétaire est le joueur
                }elseif($ownerID==$this->id){
                    //si le joueur veut construire
                    if(rand(1, 5)==1){
                        if($box->nbrHouse()<4){
                            $box->buildHouse();
                            $this->nbrHouse =+ 1;
                            $this->setMoney(-1500000);
                            writeLog($this->getName()." construit une maison sur la case ".$box->getName().".\n");
                        }else{
                            if($box->nbrHotel()!==1){
                                $box->buildHotel();
                                $this->nbrHouse =- 4;
                                $this->nbrHotel =+ 1;
                                $this->setMoney(-1500000);
                            }
                        }
                    }else{
                        $this->passTurn();
                    }
                //si le propriétaire est un autre joueur
                }else{
                    if($this->money > $box->getRentStreet()){
                        //si assez argent
                        $newMoney = -($box->getRentStreet());
                        $this->setMoney($newMoney);
                        $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                        $newMoneyOnwer=$moneyOnwer+ $box->getRentStreet();
                        requetSql('UPDATE `player` SET `money`='.$newMoneyOnwer.' WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                        $newMoney=0-$newMoney;
                        writeLog($this->getName()." a payé ".$newMoney."€ à ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID).".\n");
                    }
                }
            break;
            //gare
            case 2:
                //recherche propriétaire de la gare
                $ownerID=$this->whoOwner($box);
                //s'il n'y a pas de propriétaire
                if($ownerID==NULL){
                    //le joueur achete (chance 1/2)
                    if(rand(1, 2)==1){
                        $this->buyBox($box);
                    }else{
                        $this->passTurn();
                    }
                //si le propriétaire est le joueur
                }else{
                    if($this->money > $box->getRentStreet()){
                        //si assez argent
                        $newMoney = -($box->getRentStreet());
                        $this->setMoney($newMoney);
                        $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                        $newMoneyOnwer=$moneyOnwer+ $box->getRentStreet();
                        requetSql('UPDATE `player` SET `money`='.$newMoneyOnwer.' WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                        $newMoney=0-$newMoney;
                        writeLog($this->getName()." a payé ".$newMoney."€ à ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID).".\n");
                    }
                }
            break;
            //energie
            case 3:
                //recherche propriétaire de la compagnie
                $ownerID=$this->whoOwner($box);
                //s'il n'y a pas de propriétaire
                if($ownerID==NULL){
                    //le joueur achete (chance 1/2)
                    if(rand(1, 2)==1){
                        $this->buyBox($box);
                    }else{
                        $this->passTurn();
                    }
                //si le propriétaire est le joueur
                }else{
                    if($this->money > $box->getRentStreet()){
                        //si assez argent
                        $newMoney = -($box->getRentStreet());
                        $this->setMoney($newMoney);
                        $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                        $newMoneyOnwer=$moneyOnwer+ $box->getRentStreet();
                        requetSql('UPDATE `player` SET `money`='.$newMoneyOnwer.' WHERE `IDuser`='.$ownerID.' AND `IDgame`='.$_SESSION["idGame"]);
                        $newMoney=0-$newMoney;
                        writeLog($this->getName()." a payé ".$newMoney."€ à ".getSql('SELECT `name` FROM `user` WHERE `ID`='.$ownerID).".\n");
                    }
                }
            break;
            case 4: 
                //départ ou prison
            break;
            case 5:
                //piocher une carte
                if($this->position==8 OR $this->position==23 OR $this->position==37){
                    $pickedCard=$board->getCardByID($this->pickCard()+16);
                }else{
                    $pickedCard=$board->getCardByID($this->pickCard());
                }
                $this->actionCard($pickedCard);
            break;
            case 6:
                //TAXE
                $newMoney = -2000000;
                $this->setMoney($newMoney);
                $jackpot = getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
                $newJackpot = $jackpot-$newMoney;
                requetSql('UPDATE `game` SET `jackpot`='.$newJackpot.' WHERE `ID`='.$_SESSION["idGame"]);
            break;
            case 7:
                //park gratuit
                $jackpot = getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
                $this->setMoney($jackpot);
                requetSql('UPDATE `game` SET `jackpot`= 0 WHERE `ID`='.$_SESSION["idGame"]);
                writeLog($this->getName()." gagne le jackpot de ".$jackpot."€.\n");
            break;
            case 8:
                //aller en prison
                $this->goInJail();
            break; 
        }
    }

    //action des cartes sur le joueur
    function actionCard(Cards $card){
        writeLog($this->getName()." a tiré la carte ''".$card->getMessage()."''.\n");
        $type = $card->getType($card);
        switch ($type){
            case 1:
                $this->setPosition($card->getPosition());
            break;
            case 2:
                if($card->getAmount()>0){
                }else{
                    $valeurPositive=0-$card->getAmount();
                }
                $this->setMoney($this->money+$card->getAmount());
            break;
            case 3:
                if($this->cardJail==false){
                    $this->giveCardJail();
                    break;
                }else{
                    break;
                }
            break;
            case 4:
                $amount=$this->nbrHouse*$card->getAmountHouse()+$this->nbrHotel*$card->getAmountHotel();
                $this->setMoney($this->money-$amount);
            break;
            case 5:
                $this->setPosition($this->getPosition()-3);
                writeLog($this->getName()." a reculé de trois cases.\n");
            break;
            case 6:
                $this->goInJail();
            break;
        }
    }

    //aller en prison
    function goInJail(){
        $this->setPosition(11);
        $this->jailOn();
        writeLog($this->getName()." est enfermé en Prison.\n");
    }

    //avoir la carte sortie de prison
    function giveCardJail(){
        $this->cardJail = true;
        $_SESSION["cardJail"]=true;
        writeLog($this->getName()." a obtenu la carte Sortie de prison.\n");
    }
    //utiliser la carte sortie de prison
    function useCardJail(){
        $this->cardJail = false;
        $_SESSION["cardJail"]=false;
        $this->jailOff();
        writeLog($this->getName()." a utilisé une carte Sortie de prison.\n");
    }

    //fonction passer son tour
    function passTurn(){
        writeLog($this->getName()." a passé son tour.\n");
    }
    //fonction acheter une case
    function buyBox($box){
        $box->buy($this->id);
        $this->setMoney(-1500000);
        writeLog($this->getName()." achète la case ".$box->getName().".\n");
        $this->passTurn();
    }
    //vendre une case
    function sellCase(){
        //Est ce que le joueur est propriétaire ?
        $boxes=array(2, 4, 6, 7, 9, 10, 12, 13, 14, 15, 16, 17, 19, 20, 22, 24, 25, 26, 27, 28, 29, 30, 32, 33, 35, 36, 38, 40);
        for($i=0;$i<27;$i++){
            if($boxes[$i]==$_POST["boxIDtoSell"]){
                $IDownerSell=getSql('SELECT  `'.$_POST["boxIDtoSell"].'` FROM `owner` WHERE `IDgame`='.$_SESSION["idGame"]);
                if($IDownerSell==$this->id){
                    requetSql('UPDATE `owner` SET `'.$_POST["boxIDtoSell"].'`= NULL WHERE `IDgame`='.$_SESSION["idGame"]);
                    $this->setMoney(150000);
                    $nameBoxSell=getSql('SELECT  `name` FROM `box` WHERE `ID`='.$_POST["boxIDtoSell"]);
                    writeLog($this->getName()." a vendu la case ".$nameBoxSell." et a récupéré 150000€.\n");
                }
            }
        }
    }


    //donner l'ID du prorpiétaire
    function whoOwner($box){
        $ownerID=$box->getOwner();
        return $ownerID;
    }

    //piocher une carte
    function pickCard(){
        $IDcard=getSql('SELECT `cardToPick` FROM `cards` WHERE `IDgame`='.$_SESSION["idGame"]);
        $this->nextCard($IDcard);
        return $IDcard;
    }

    //passer à la carte suivante
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