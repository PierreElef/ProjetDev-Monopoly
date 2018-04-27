<?php

class Board{

    private $box = [];
    private $communitychestCard = [];
    private $chanceCard= [];
    private $box = [];

    function __construct(){

    }

    function addBox($box){
        $this->box[]= $box;
    }
    
    function getBoxbyID($id){
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

    function action(Cards $card, Player $player){
        $type = $cards->getType($card)
        switch ($type){
            case 1:
                $player->setPosition($cards->getPosition());
                echo $player->getName()." est aller à la case".$this->getBoxNameByID($player->getPosition())".";
            break;
            case 2:
                $mon=$player->getMoney();
                $player->setMoney($mon+$cards->getAmount());
                echo $player->getName()." a ".$player->getMoney()."€.";
            break;
            case 3:
                if($player->getCardJail()==false){
                    $player->changeCardJail();
                    break;
                }else{
                    echo $player->getName()." garde sa carte Sortir de Prison";
                    break;
                };
            case 4:
                $amount=$player->getNbrHouse()*$cards->getAmountHouse()+$player->getNbrHotel()*$cards->getAmountHotel();
                $player->setMoney($player->getMoney()-$amount);
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