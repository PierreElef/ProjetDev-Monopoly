<?php
    session_start();
    include('getSQL.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta lan="fr">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Jouer une partie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<html>
<body>
    <div class="container text-center">
        <?php include("../html/header.html")?>
        <div class="m-2 p-2">
            <h1>Changer les paramètres</h1>
            <form name="changeName" method="post" action="#">
                <label class="m-2">Nom : </label>
                <?php 
                    $id=$_SESSION["id"]; 
                    echo "<b>".returnName($id)."</b>";
                ?>
                <label class="m-2">Nouveau Nom : </label>
                <input type="text" class="text-center" name="newName">
                <input class="btn-md m-1" type="submit" value="changer"></br>
            </form>
            <form name="changePWD" method="post" action="#">
                <label class="m-2">Password : </label>
                <?php 
                    $id=$_SESSION["id"]; 
                    echo "<b>".returnPWD($id)."</b>";
                ?>
                <label class="m-2">Nouveau password : </label>
                <input type="text" class="text-center" name="newPWD">
                <input class="btn-md m-1" type="submit" value="changer"></br>
            </form>
            <form name="returnPlayGame" method="post" action="#">
                    <input type="hidden" name="return" value=1></br>
                    <input class="btn-md m-1" type="submit" value="Retour" style="font-size:18px;">
            </form>
        </div>
        <?php 
            if (isset($_POST['newName'])){
                $id=$_SESSION["id"];
                $newName=$_POST['newName'];
                $sql="UPDATE `player` SET `username`='".$newName."' WHERE `ID`=".$id;
                requetSql($sql);
             }
            if (isset($_POST['newPWD'])){
                $newPWD=$_POST['newPWD'];
                $sql="UPDATE `player` SET `password`='".$newPWD."' WHERE `ID`=".$id;
                requetSql($sql);
            } 
            if (isset($_POST['return'])){
                header('Location: PlayGame.php');
            } 
            function returnName($id){
                $name =  getSql('SELECT `username` FROM `player` WHERE `id`="'.$id.'"');
                return $name;
            }
            function returnPWD($id){
                $pwd = getSql('SELECT `password` FROM `player` WHERE `id`="'.$id.'"');
                return $pwd;
            }
        ?>
        
        <?php include("../html/footer.html")?>
    </div>
</body>
</html>