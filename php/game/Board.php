<?php
class Board{

    private $box = array();
    private $cards = array();

    function __construct(){

    }

    function addBox($box){
        $this->box[]= $box;
    }
    
    function getBoxByID($id){
        foreach($this->box as $b){
            if($b->getID() == $id){
                return $b;
            }
        }
        return false;
    }

    function getBoxNameByID($id){
        foreach($this->box as $b){
            if($b->getID() == $id){
                return $b->getName();
            }
        }
    }

    function addCard($card){
        array_push($this->cards,$card);
    }

    function getCardByID($id){
        foreach($this->$cards as $card){
            if($card->getID() == $id){
                return $card;
            }
        }
        return false;
    }
}

?>
