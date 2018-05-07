<?php
session_start();
$gameID=$_SESSION["idGame"];
settype($gameID, "int");
include('../commun/getSQL.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Monopoly</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container text-center">
        <h1>Êtes-vous sûr de vouloir effacer le jeu ?</h1>
        <div class="row justify-content-md-center">
            <form class="p-2">
                <input type="hidden" name="yes" value="1">
                <input class="buttonGame" type="submit" value="Oui">                      
            </form>
            <form class="p-2" action="GameIF.php">
                <input class="buttonGame" type="submit" value="Non">
            </form>               
        </div>
    </div>
</body>
</html>
<?php
if (isset($_POST['yes'])){
    requetSql('DELETE FROM `game` WHERE `IDgame`='.$gameID);
    requetSql('DELETE FROM `building` WHERE `IDgame`='.$gameID);
    requetSql('DELETE FROM `owner` WHERE `IDgame`='.$gameID);
    requetSql('DELETE FROM `player` WHERE `IDgame`='.$gameID);
    requetSql('DELETE FROM `turn` WHERE `IDgame`='.$gameID);
    header('Location: ../menu/PlayGame.php');
} 

?>