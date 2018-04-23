<?php
0
class Player {
    private $id;
    private $name;
    private $color;
    private $money;
    private $positionID;
    private $positionX;
    private $positionY;
    private $jailStatus;

    function __construct($name, $color){
        
        $this->name = $name;
        $this->color = $color;
        $this->money = 15000000;
        $this->positionID = 1;
        $this->jailStatus = 0;
        $this->id = $this->getIDonDB($name);
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
    }
    function setColor($color){
        $this->color = $color;
    }
    function setMoney($money){
        $this->money = $money;
    }
    function setPostion($position){
        $this->position = $position;
    }
    function setJailStatus($jailStatus){
        $this->jailStatus = $jailStatus;
    }

    //fonctions qui maj la base de données monopoly/player

    function getIDonDB($name)
    {
        $request='SELECT `ID` FROM `player` WHERE `username`="'.$name.'"';
        $id=getSql($request);
        return $id;
    }

}
?>