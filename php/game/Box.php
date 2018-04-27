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

    function getInitalPrice(){
        return $this->initialRent;
    }

}

?>