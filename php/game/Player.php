<?php
session_start();
$gameID=$_SESSION["idGame"];
settype($gameID, "int");
include('../commun/getSQL.php');

class Player{
////////////////////////////////////////////// PROPRIETES
////////////////////////////////////////////// CONSTANTE
    private $id;
    private $name;
    private $color;
////////////////////////////////////////////// EVOLUTIVE
    private $pos;
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
        $this->color = getSql('SELECT `color` FROM `player` WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
        $this->money = getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
        $this->isJail = getSql('SELECT `jailStatus` FROM `player` WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
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

    function getPos(){
        return $this->pos;
    }

    function getMoney(){
        return $this->money;
    }

    function getJailStatu(){
        return $this->isJail;
    }

    function getTurnStatu(){
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
    function setPos($pos){
        $this->pos = $pos;
        requetSql('UPDATE `player` SET `position`='.$this->pos.' WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
    }

    function setMoney($newMoney){
        $this->money =+ $newMoney;
        requetSql('UPDATE `player` SET `money`='.$this->money.' WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
    }

    function jailOn(){
        $this->isJail = 1;
        requetSql('UPDATE `player` SET `jailStatus`='.1.' WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
    }

    function jailOff(){
        $this->isJail = 0;
        requetSql('UPDATE `player` SET `jailStatus`='.0.' WHERE `IDuser`='.$this->id.'AND `IDgame`='.$gameID);
    }

    function turnOn(){
        $this->isTurn = True;
        $_SESSION["isTurn"]=True;
    }

    function turnOff(){
        $this->isTurn = False;
        $_SESSION["isTurn"]=False;
    } 
////////////////////////////////////////////// FONCTIONS COMPLEXES
////////////////////////////////////////////// DEPLACEMENT
    function move(Dice $de)
    {
        echo "DEPLACEMENT :<br>";
        echo $this->getName()." est sur la case ".$this->getPos().".<br>";
        $de->rollDice();
        $this->pos += $de->getScore();

        // Savoir si on passe par la case départ
        if($this->pos < 40)
        {
            $this->pos = $this->pos;
        }
        else if($this->pos >= 40)
        {
            $this->pos -= 40;
            $this->money += 200;
            echo $this->getName()." passe par la case départ et empoche 200e.<br>";
        }

        echo $this->getName()." se déplace jusqu'à la case ".$this->getPos().".<br><br>";
    }

////////////////////////////////////////////// ACTIONS

    /* 
    1 rue 
    2 gare 
    3 compagnie
    4 départ/prison
    5 piocher une carte
    6 taxe
    7 parc gratuit 
    8 aller en prison
    */
    function action(Box $box)
    {
        $typeBox = $box->getType($this->pos);
        $ownerID= $box->getOwner();
        switch($typeBox)
        {
            case 1:
                echo "Le joueur est sur une case propriété.<br>";
                if($ownerID==NULL){
                    $box->buy($this->id);
                    setMoney(-1500000);
                }elseif ($ownerID==$this->id){
                    if($box->nbrHouse()>=4){
                        $box->buildHouse();
                        $this->nbrHouse =+ 1;
                        $this->setMoney(-1500000);
                    }else{
                        if($box->nbrHotel()!==1){
                            $box->buildHotel();
                            $this->nbrHouse =- 4;
                            $this->nbrHotel =+ 1;
                            $this->setMoney(-1500000);
                        }
                    }
                }else{
                    if($this->money>$box->getRentStreet()){
                        //si assez argent
                        $newMoney = -$box->getRentStreet();
                        $this->setMoney($newMoney);
                        $MoneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.'AND `IDgame`='.$gameID);
                        requetSql('UPDATE `player` SET `money`='.$MoneyOnwer + $box->getRentStreet().' WHERE `IDuser`='.$ownerID.'AND `IDgame`='.$gameID);
                    }else{
                        //si pas assez argent
                    }
                }
                break;
            case 2:
                echo "Le joueur est sur une case gare.<br>";
                if($ownerID==NULL){
                    $box->buy($this->id);
                    setMoney(-1500000);
                }elseif ($ownerID==$this->id){
                    break;
                }else{
                    if($this->money>$box->getRentStation()){
                        //si assez argent
                        $newMoney = -$box->getRentStation();
                        $this->setMoney($newMoney);
                        $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.'AND `IDgame`='.$gameID);
                        requetSql('UPDATE `player` SET `money`='.$moneyOnwer + $box->getRentStation().' WHERE `IDuser`='.$ownerID.'AND `IDgame`='.$gameID);
                    }else{
                        //si pas assez argent
                    }
                }
                break;
            case 3:
                echo "Le joueur est sur une case compagnie.<br>";
                if($ownerID==NULL){
                    $box->buy($this->id);
                    setMoney(-1500000);
                }elseif ($ownerID==$this->id){
                    break;
                }else{
                    if($this->money>$box->getRentEnergie()){
                        //si assez argent
                        $newMoney = -$box->getRentEnergie();
                        $this->setMoney($newMoney);
                        $moneyOnwer=getSql('SELECT `money` FROM `player` WHERE `IDuser`='.$ownerID.'AND `IDgame`='.$gameID);
                        requetSql('UPDATE `player` SET `money`='.$moneyOnwer + $box->getRentEnergie().' WHERE `IDuser`='.$ownerID.'AND `IDgame`='.$gameID);
                    }else{
                        //si pas assez argent
                    }
                }
                break;
            case 4: 
                echo "Le joueur est sur une case départ ou prison.<br>";
                break;
            case 5: 
                echo "Le joueur est sur une case où il pioche une carte.<br>";
                break;
            case 6:
                echo "Le joueur est sur une case où il va payer.<br>";
                $newMoney = -2000000;
                $this->setMoney($newMoney);
                $jackpot = getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$gameID);
                requetSql('UPDATE `game` SET `jackpot`='.$jackpot - $newMoney.' WHERE `ID`='.$gameID);
                break;
            case 7:
                echo "Le joueur est sur le park gratuit.<br>";
                $jackpot = getSql('SELECT `jackpot` FROM `game` WHERE `ID`='.$gameID);
                $this->setMoney($jackpot);
                requetSql('UPDATE `game` SET `jackpot`= 0 WHERE `ID`='.$gameID);
                break;
            case 8:
                echo "Le joueur est sur la case aller en prison.<br>"
                $this->goInJail();
                break; 

        }
    }
////////////////////////////////////////////// FONCTIONS SECONDAIRES
    function goInJail(){
        $this->setPos(11);
        $this->jailOn();
    }

    function changeCardJail(){
        if ($this->cardJail == false){
            $this->cardJail = true;
            $_SESSION["cardJail"]=true;
        }else{
            $this->cardJail = false;
            $_SESSION["cardJail"]=false;
        }
    }

    function actionCard(Cards $card){
        $type = $cards->getType($card)
        switch ($type){
            case 1:
                $this->setPosition($cards->getPosition());
                echo $player->getName()." est aller à la case".$this->getBoxNameByID($player->getPosition())".";
            break;
            case 2:
                $this->setMoney($this->money+$cards->getAmount());
                echo $this->name." a ".$this->money."€.";
            break;
            case 3:
                if($this->cardJail==false){
                    $this->changeCardJail();
                    break;
                }else{
                    echo $this->name.' a déjà une carte "Sortir de Prison"';
                    break;
                };
            case 4:
                $amount=$this->nbrHouse*$cards->getAmountHouse()+$this->nbrHotel*$cards->getAmountHotel();
                $this->setMoney($this->money-$amount);
                echo $player->getName()." a perdu ".$amount."€";
            break;
            case 5:
                $player->setPosition($player->getPosition()-3);
                echo $player->getName()."a reculé de trois cases.";
            break;
        }
    }

}

?>