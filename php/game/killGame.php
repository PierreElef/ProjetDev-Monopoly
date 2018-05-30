<?php
session_start();
include('../commun/getSQL.php');
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
</head>
<html>
<body>
    <div class="container text-center">
        <h1>Êtes-vous sûr de vouloir effacer le jeu ?</h1>
        <div class="row justify-content-md-center">
            <form class="p-2" method="post" action="#">
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
    requetSql('DELETE FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
    requetSql('DELETE FROM `building` WHERE `IDgame`='.$_SESSION["idGame"]);
    requetSql('DELETE FROM `owner` WHERE `IDgame`='.$_SESSION["idGame"]);
    requetSql('DELETE FROM `player` WHERE `IDgame`='.$_SESSION["idGame"]);
    requetSql('DELETE FROM `turn` WHERE `IDgame`='.$_SESSION["idGame"]);
    requetSql('DELETE FROM `cards` WHERE `IDgame`='.$_SESSION["idGame"]);
    header('Location: ../menu/PlayGame.php');
} 

?>