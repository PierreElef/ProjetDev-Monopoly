<?php
session_start();
include ('Box.php');
include ('Card.php');

class Board{

    private $box = [];
    private $communitychestCard = [];
    private $chanceCard= [];

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

    function addCommunityChestCard($card){
        $this->communitychestCard[]= $card;
    }

    function addChanceCard($card){
        $this->chanceCard[]= $card;
    }

    
}

?>
