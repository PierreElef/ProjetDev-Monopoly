<?php
    session_start();
    include('../commun/getSQL.php');
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
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<html>
<body>
<div class="container">
        <header class="header">
            <?php include("../../html/header.html")?>
            <div class="row justify-content-end">
                <div class="col-8">
                    <h1 class="text-center">Changer les paramètres</h1>
                </div>
                <div class="col-2">
                    <div class="row m-2">
                        <form name="changeSettings" method="post" action="#" class="p-1">
                            <input type="hidden" name="change" value=1>
                            <input type="image" src="../images/settings.png" alt="Submit" width="32" height="32">
                        </form>
                        <form name="quitSession" method="post" action="#" class="p-1">
                            <input type="hidden" name="quit" value=1>
                            <input type="image" src="../images/quit.png" alt="Submit" width="32" height="32">
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <div class="m-2 p-2 text-center">
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
                $sql="UPDATE `user` SET `name`='".$newName."' WHERE `ID`=".$id;
                requetSql($sql);
             }
            if (isset($_POST['newPWD'])){
                $newPWD=$_POST['newPWD'];
                $sql="UPDATE `user` SET `password`='".$newPWD."' WHERE `ID`=".$id;
                requetSql($sql);
            } 
            if (isset($_POST['return'])){
                header('Location: PlayGame.php');
            } 
            function returnName($id){
                $name =  getSql('SELECT `name` FROM `user` WHERE `id`="'.$id.'"');
                return $name;
            }
            function returnPWD($id){
                $pwd = getSql('SELECT `password` FROM `user` WHERE `id`="'.$id.'"');
                return $pwd;
            }
            if (isset($_POST['change'])){
                header('Location: changeSettings.php');
            }
            if (isset($_POST['quit'])){
                session_destroy();
                header('Location: connexion.php');
            }
        ?>
        
        <?php include("../../html/footer.html")?>
    </div>
</body>
</html>