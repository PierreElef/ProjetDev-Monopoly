<?php
    session_start();
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
    <div class="container">
        <header class="header">
            <?php include("../html/header.html")?>
            <div class="row justify-content-end">
                <div class="col-8">
                    <h1 class="text-center">Jouer au Monopoly</h1>
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
            include('getSQL.php');
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
        <?php include("../html/footer.html")?>
    </div>
</body>
</html>