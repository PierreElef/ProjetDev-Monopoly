<?php
include ('Player.php');
class Card
{
	private $ID;
	private $message;
	private $type;
	private $owner=false;
	
	function setOwner(Player $player)
	{
		$this->owner=$player;

	}
	
	function takeMoneyfromPlayer($ammende)
	{

		$owner->setMoney();
		$this->message='La banque vous prends'.$ammende.'euros';

	}
	
	function giveMoneyfromPlayer($gain)
	{
		$owner->setMoney();
		$this->message='Vous gagnez'.$gain.'euros';
	}
	
	function sendPlayertoJail(Player $player)
	{
		$player->setJailStatus(true);

		
	}
	
	function changePositionPlayer(Player $player, $position)
	{
		$player->setPostion($position);
	}
	
	function leaveJail(Player $player)
	{
		$player->setJailStatus(false);	
	}

}



?>