<?php
class Box{
    private $id;
    private $name;
    private $type;
    private $block;
    private $price;
    private $initialRent;

    function __construct($id, $name, $type, $block, $price, $initalRent){
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->block = $block;
        $this->price = $price;
        $this->initialRent= $initalRent;
    }

    function getID(){
        return $this->id;
    }

    function getName(){
        return $this->name;
    }

    function getType(){
        return $this->type;
    }

    function getBlock(){
        return $this->block;
    }

    function getPrice(){
        return $this->price;
    }

    function getInitalRent(){
        return $this->initialRent;
    }

    function getOwner(){
        return getSql('SELECT  `'.$this->id.'` FROM `owner` WHERE `IDgame`='.$_SESSION["idGame"]);
    }

    function buy($idPlayer){
        requetSql('UPDATE `owner` SET `'.$this->id.'`='.$idPlayer.' WHERE `IDgame`='.$_SESSION["idGame"]);
    }

    ////////////////////////////////////////////// Street
    function buildHouse(){
        if(nbrHouse()==NULL){
            requetSql('INSERT INTO `building`(`IDgame`, `IDbox`, `nbrHouse`, `nbrHotel`) VALUES ('.$_SESSION["idGame"].','.$this->id.',1,0)');
        }else{
            //ERREUR requetSql('UPDATE `building` SET `nbrHouse`='.$this->nbrHouse()+1.' WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDbox`='.$this->id);
        }
    }

    function buildHotel(){
        //ERREUR requetSql('UPDATE `building` SET `nbrHotel`='.$this->nbrHotel()+1.' WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDbox`='.$this->id;
    }

    function nbrHouse(){
        return getSql('SELECT  `nbrHouse` FROM `building` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDbox`='.$this->id);
    }
    function nbrHotel(){
        return getSql('SELECT  `nbrHotel` FROM `building` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDbox`='.$this->id);
    }

    function getRentStreet(){
       $rent=array(300000,1000000,3000000,7000000,10000000,12000000);
       return $rent[$this->nbrHouse()+$this->nbrHotel()];
    }

    ////////////////////////////////////////////// Station
    function getRentStation(){
        return 500000;
    }

    ////////////////////////////////////////////// Energie
    function getRentEnergie(){
        return 500000;
    }
}

?>