<?php

class Cards{
    private $id;
    private $type; //1- mouvement, 2- ajout/retirer sous, 3-liberer de prison, 4- retirer sous en fonction de maisons/hotels, 5- reculer
    private $message;
    private $position;
    private $amount;
    private $amountHouse;
    private $amountHotel;
    
    function __construct($id, $type, $message, $position, $amount, $amountHouse, $amountHotel){
        $this->id = $id;
        $this->type = $type;
        $this->message = $message;
        $this->position = $position;
        $this->amount = $amount;
        $this->amountHouse = $amountHouse;
        $this->amountHotel = $amountHotel;
        echo "carte créée";
    }

    function getId(){
        return $this->id;
    }

    function getType(){
        return $this->type;
    }

    function getMessage(){
        return $this->message;
    }

    function getPosition(){
        return $this->position;
    }

    function getAmount(){
        return $this->amount;
    }

    function getAmountHouse(){
        return $this->amountHouse;
    }

    function getAmountHotel(){
        return $this->amountHotel;

    }

}

?>