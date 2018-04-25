<!DOCTYPE html>
<html lang="fr">
<head>
	
	<meta charset="utf-8">
	<title>test tirage cartes</title>
</head>
<body>
<?php
include ('getSql.php');
$réponse; 
 	for ((isset($_POST['$ID']))) 
 	{
 		$message=requetSql('SELECT `Message` FROM `caisse de communaut` WHERE `id`=$ID');
 		$type=requetSql('SELECT `Type` FROM `caisse de communaut` WHERE `id`=$ID');
 		echo '$message';
 		echo '$type';
	}
?>	
<form method="post" action="#">
	carte:<input type="number" name="$ID"/>
	<input type="submit" value="test">
</form>
</body>