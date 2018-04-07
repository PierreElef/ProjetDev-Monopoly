<?php
include('getSql.php');
class Player {
    private $id;
    private $name;
    private $color;
    private $money;
    private $positionID;
    private $positionX;
    private $positionY;
    private $jailStatus;

    function __construct($id, $name, $color){
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->money = 15000000;
        $this->positionID = 1;
        $this->jailStatus = 0;
        setDBName($this->name);
        setDBColor($this->color);
        setDBMoney($this->money);
        setDBPositionID($this->positionID);
        setDBJailStatus($this->jailStatus):
    }

    //fonctions get
    function getID(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getColor(){
        return $this->color;
    }
    function getMoney(){
        return $this->money;
    }
    function getPositionID(){
        return $this->positionID;
    }
    function getPositionX(){
        return $this->positionX;
    }
    function getPositionY(){
        return $this->positionY;
    }
    function getJailStatus(){
        return $this->jailStatus;
    }

    //functions set
    function setName($name){
        $this->name = $name;
        setDBName($this->name);
    }
    function setColor($color){
        $this->color = $color;
        setDBColor($this->color);
    }
    function setMoney($money){
        $this->money = $money;
        setDBMoney($this->money);
    }
    function setPostion($position){
        $this->position = $position;
        setDBPostion($this->position);
    }
    function setJailStatus($jailStatus){
        $this->jailStatus = $jailStatus;
        setDBJailStatus($this->jailStatus);
    }

    //fonctions qui maj la base de données monopoly/player
    function setDBName($name){
        requetSql('UPDATE `player` SET `name`='.$name.' WHERE `ID`='.$this->id);
    }
    function setDBColor($color){
        requetSql('UPDATE `player` SET `color`='.$color.' WHERE `ID`='.$this->id);
    }
    function setDBMoney($money){
        requetSql('UPDATE `player` SET `money`='.$money.' WHERE `ID`='.$this->id);
    }
    function setDBPositionID($positionID){
        requetSql('UPDATE `player` SET `position`='.$positionID.' WHERE `ID`='.$this->id);
    }
    function setDBJailStatus($jailStatus){
        requetSql('UPDATE `player` SET `jailStatus`='.$jailStatus.' WHERE `ID`='.$this->id);
    }

}
?>