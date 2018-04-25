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
		$owner->requetSql();
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
	function requetSql($sql)
	{
	    $user = 'root';
	    $password = '';
	    $db = 'cards';
	    $host = 'localhost';
	    $port = 3306;   
	    // Connexion à la BDD
	    $link = mysqli_init();
	    $success = mysqli_real_connect(	$link,$host,$user,$password,$db,$port);
	    // Execution de la requete ET renvoi d'erreur si echec d'execution
	    mysqli_query($link, $sql) or die ('Erreur SQL. Detail : '.mysqli_error($link));
	    // Fermeture de la connexion
	    mysqli_close($link);
	    
	}

}



?>