<?php
    session_start();
    include('../commun/getSQL.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
    <title>Monopoly - rejoindre une partie</title>
</head>
<html>
<body style="background-color: #dae9d4;">
    <header class="header">
        <?php include("../../html/header2.html")?>
        <div class="row justify-content-end">
            <div class="col-8">
                <h1 class="text-center">Jouer au Monopoly</h1>
            </div>
            <div class="col-2">
                <div class="row m-2">
                    <form name="changeSettings" method="post" action="#" class="p-1">
                        <input type="hidden" name="change" value=1>
                        <input type="image" src="../../images/settings.png" alt="Submit" width="32" height="32">
                    </form>
                    <form name="quitSession" method="post" action="#" class="p-1">
                        <input type="hidden" name="quit" value=1>
                        <input type="image" src="../../images/quit.png" alt="Submit" width="32" height="32">
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row justify-content-around m-2 text-center">
            <div class="col-3 p-2">
                <form name="createGame" method="post" action="#">
                    <input type="hidden" name="create" value=1></br>
                    <input class="btn-lg m-1" type="submit" value="Créer une partie" style="font-size:18px;">
                </form>
            </div>
            <div class="col-3 p-2">
                <form name="joinGame" method="post" action="#">
                    <input type="hidden" name="join" value=1></br>
                    <input class="btn-lg m-1" type="submit" value="Rejoindre une partie" style="font-size:18px;">
                    <label class="m-2">Numéro de la partie</label>
                    <input type="number" class="text-center" name="gameID"></br>
                </form>
            </div>
        </div>
        <?php
            $idPlayer=$_SESSION["id"];
            //créer une nouvelle partie
            if (isset($_POST['create'])){
                header('Location: createGame.php');
            }
            //rejoindre une partie
            if (isset($_POST['join'])){
                $gameID=$_POST['gameID'];
                include('joinGame.php');
                if ($gameID==NULL){
                    echo '<p class="text-center" style="color:red">Choisir une numéro de partie</p>';
                }else{
                    joinGame($idPlayer, $gameID);
                }               
            }
            if (isset($_POST['change'])){
                header('Location: changeSettings.php');
            }
            if (isset($_POST['quit'])){
                session_destroy();
                header('Location: connexion.php');
            } 
        ?>
        <div class="m-2 text-center">
            <h3>Partie en cours</h3>
            <?php
                include('GameInProgress.php');
            ?>
        </div>
    </div>
    <footer>
        <?php include("../../html/footer.html")?>
    </footer>
</body>
</html>