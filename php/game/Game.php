<?php
session_start();
$ID=$_SESSION["id"];
$gameID=$_SESSION["idGame"];

class Game
{
    function __construct()
    {

    }

    function playTurn(Player $player, Dice $de)
    {
        do
        {
            if($player->isJail == true)
            {
                $de->rollDice();
                if($de->getDouble() == true)
                {
                    $player->$isTurn = true;
                }
                else
                {
                    $player->isTurn = false;
                }
            }
            else
            {
                $player->move($de);
                $player->action();
                if($de->getDouble() == true)
                {
                    $player->isTurn = true;
                }
                else
                {
                    $player->isTurn = false;
                }
            }
        }while($player->isTurn == true);    
    }

}

?>