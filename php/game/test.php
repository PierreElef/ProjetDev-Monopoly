<?php
session_start();
include('../commun/getSQL.php');
require_once '../commun/getSQL.php';
require_once 'DataInit.php';
require_once 'Game.php';
require_once 'Box.php';
require_once 'Board.php';
require_once 'Player.php';
require_once 'Cards.php';
require_once 'Dice.php';
$ID=$_SESSION["id"];
$gameID=$_SESSION["idGame"];
$board=$_SESSION["board"];

$IDcard=pickCard();
$pickedCard=$board->getCardByID($IDcard);

echo $pickedCard->getID()."<br/>";
echo $pickedCard->getType()."<br/>";
echo $pickedCard->getMessage()."<br/>";
echo $pickedCard->getPosition()."<br/>";
echo $pickedCard->getAmount()."<br/>";
echo $pickedCard->getAmountHouse()."<br/>";

function pickCard(){
    $IDcard=getSql('SELECT `cardToPick` FROM `cards` WHERE `IDgame`='.$_SESSION["idGame"]);
    nextCard($IDcard);
    return $IDcard;
}

function nextCard($IDcard){
    $orderCard=$_SESSION['orderCard'];
    $nextCard=NULL;
    for($i=0;$i<16;$i++){
        if($orderCard[$i]==$IDcard){
            $j=$i+1;
            if($j==16){
                $nextCard=$orderCard[0];
            }else{
                $nextCard=$orderCard[$j];
            }
        }
    }
    requetSql('UPDATE `cards` SET `cardToPick`='.$nextCard.' WHERE `IDgame`='.$_SESSION["idGame"]);
}