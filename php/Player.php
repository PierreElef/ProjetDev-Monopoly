<?php
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
    }

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

    

}