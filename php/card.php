<?php
include ('Player.php');
class Card
{
	private $ID;
	private $message='';
	private $type;
	private $owner =false;
	function setOwner($player)
	{
		$this->owner=$player;
	}
	
	function takeMoneyfromPlayer()
	{

	}
	
	function giveMoneyfromPlayer()
	{

	}
	
	function sendPlayertoJail()
	{

	}
	
	function changePositionPlayer()
	{

	}
	
	function leaveJail()
	{
		
	}

}



?>