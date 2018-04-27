<?php
session_start();
$IDgame=$_SESSION["idGame"];
settype($IDgame, "int");
include('../commun/getSQL.php');

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

    function getOwner($id){
        $sql='SELECT  `'.$id.'` FROM `owner` WHERE `IDgame`='.$IDgame;
        return getSql($sql);
    }

    function buy($idPlayer){
        $sql='UPDATE `owner` SET `'.$id.'`='.$idPlayer.' WHERE `IDgame`='.$IDgame;
        requetSql($sql);
    }

    function build($idPlayer){
        $sql='UPDATE `owner` SET `'.$id.'`='.$idPlayer.' WHERE `IDgame`='.$IDgame;
        requetSql($sql);
    }

    function getPrice(){
        return $this->initialRent;
    }

}

?>