<?php
include ('Player.php');
class Card
{
	private $ID;
	private $message='';
	private $type;
	private $owner=false;
	private $jail=false;
	function setOwner($player)
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
	
	function sendPlayertoJail()
	{
		$jail=true;
	}
	
	function changePositionPlayer()
	{

	}
	
	function leaveJail()
	{
		$jail=false;
	}

}



?>