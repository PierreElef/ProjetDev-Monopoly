<?php
    session_start();
    include('../commun/getSQL.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
    <title>Monopoly</title>
</head>
<html>
<body style="background-color: #dae9d4;">
    <header class="container header">
        <?php include("../../html/header2.html")?>
        <div class="row justify-content-end">
            <div class="col-8">
                <?php
                    echo '<h1 class="text-center">Partie en cours - '.getSql('SELECT `name` FROM `user` WHERE `ID`='.$_SESSION["id"]).'</h1>'
                ?>
            </div>
            <div class="col-2">
                <form name="quitSession" method="post" action="#" class="p-1">
                    <input type="hidden" name="quit" value=1>
                    <input type="image" src="../../images/quit.png" alt="Submit" width="32" height="32">
                </form>
                <?php
                    if (isset($_POST['quit'])){
                        session_destroy();
                        header('Location: ../menu/connexion.php');
                    } 
                ?>
            </div>
        </div>
    </header>
    <div class="row mt-4 mb-4" style="border-top:1px solid black;">
        <div class="col-xl-4 col-lg-6 ml-1 mr-1 text-center" style="border-right:1px solid black">
                <h2>Historique</h2>
                <?php 
                    $file='../../history/'.$_SESSION["idGame"].'.txt'; 
                    $contenu=file_get_contents($file); 
                    echo '<textarea rows="25" class="history">'.$contenu.'</textarea>';
                ?>
            </div>
        <div id="board" class="col-xl-4 col-lg-5 ml-1 mr-1">
            <h2 class="text-center">Déroulement du tour</h2>
            <?php 
                if (isset($_POST['diceButton'])){
                    $_SESSION["choise"]=1;
                }
                if (isset($_POST['buyButton'])){
                    //faire acheter
                    $_SESSION["choise"]=2;
                }
                if (isset($_POST['passButton'])){
                    //faire passer le tour
                    $_SESSION["choise"]=3;
                }
                if (isset($_POST['buildButton'])){
                    //faire rajouter une maison
                    $_SESSION["choise"]=4;
                }
                if (isset($_POST['sellButton'])){
                    //faire vendre la case $_POST['boxIDtoSell']
                    $_SESSION["choise"]=5;
                }
                if (isset($_POST['cardJailButton'])){
                    //faire utiliser la carte sortie de prison
                    $_SESSION["choise"]=6;
                }
                if (isset($_POST['other'])){
                    //rafraichir
                    $_SESSION["choise"]=7;
                }
                include('main.php');
            ?>
        </div>
        <div class="col-xl-4 col-lg-12 row text-center" style="border-left:1px solid black">
            <h2>Commande de jeu</h2>
            <div id="playerStats" class="col-xl-12 col-lg-6">
                <table class="table table-bordered status-table">
                <tr style="font-weight: bold; background-color: #fff">
                        <td>Joueur</td>
                        <td>Argent</td>
                        <td>Position</td>
                    </tr>
                    <?php
                        $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
                        foreach($IDplayers as $IDplayer){
                            $moneyPlayer=getSql('SELECT `money` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
                            $positionPlayer=getSql('SELECT `position` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
                            $positionName=getSql('SELECT `name` FROM `box` WHERE `ID`='.$positionPlayer.'');
                            $namePlayer=getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer.'');
                            $colorPlayer=getSql('SELECT `color` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"].' AND `IDuser`='.$IDplayer.'');
                            echo '<tr style="background-color: #fff">';
                            echo '<td style="color:'.$colorPlayer.'"><b>'.$namePlayer.'</b></td>';
                            echo '<td>'.$moneyPlayer.'</td>';
                            echo '<td>'.$positionPlayer.' : '.utf8_encode($positionName).'</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
                <p>Voir <a href="properties.php" target="_blank">Plateau et propriétés</a></p>
            </div>
            <div class="col-xl-12 col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <!--Bouton Lancer le dé--> 
                        <form action="#" method="post">
                            <input type="hidden" name="diceButton" value="1">
                            <?php 
                                if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==false){
                                    echo'<input class="buttonGame" type="submit" value="Lancer les dés">';
                                }else{
                                    echo'<input class="buttonGame" type="submit" value="Lancer le dé" disabled>';
                                }
                            ?>
                        </form><br/><br/>
                        <!--Bouton Acheter--> 
                        <form action="#"  method="post">
                            <input type="hidden" name="buyButton" value="1">
                            <?php 
                                if ($_SESSION["isTurn"]==true AND $_SESSION["actionDone"]==false AND $_SESSION["pulledDice"]==true AND ($_SESSION["onStreet"]==true OR $_SESSION["onStation"]==true OR $_SESSION["onEnergie"]==true) AND $_SESSION["isOwner"]==false){
                                    echo'<input class="buttonGame" type="submit" value="Acheter">';
                                }else{
                                    echo'<input class="buttonGame" type="submit" value="Acheter" disabled>';
                                }
                            ?>
                        </form><br/><br/>
                        <!--Bouton Passer--> 
                        <form action="#"  method="post">
                            <input type="hidden" name="passButton" value="1">
                            <?php 
                                if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==true AND $_SESSION["actionDone"]==false){
                                    echo'<input class="buttonGame" type="submit" value="Passer">';
                                }else{
                                    echo'<input class="buttonGame" type="submit" value="Passer" disabled>';
                                }
                            ?>
                        </form>
                    </div>
                    <div class="col-6">
                        <!--Bouton construire-->
                        <form action="#" method="post">
                            <input type="hidden" name="buildButton" value="1">
                            <?php 
                                if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==true AND $_SESSION["onStreet"]==true AND $_SESSION["actionDone"]==false AND $_SESSION["isOwner"]==true){
                                    echo'<input class="buttonGame" type="submit" value="Construire">';
                                }else{
                                    echo'<input class="buttonGame" type="submit" value="Construire" disabled>';
                                }
                            ?>
                        </form><br/>
                        <!--Bouton vendre-->        
                        <form action="#" method="post">
                            <input type="hidden" name="sellButton" value="1">
                            <?php 
                                if ($_SESSION["isTurn"]==true AND $_SESSION["pulledDice"]==true AND ($_SESSION["onStreet"]==true OR $_SESSION["onStation"]==true OR $_SESSION["onEnergie"]==true) AND $_SESSION["isOwner"]==true){
                                    echo'<datalist id="boxes">';
                                    $boxSells=array(2, 4, 6, 7, 9, 10, 12, 13, 14, 15, 16, 17, 19, 20, 22, 24, 25, 26, 27, 28, 29, 30, 32, 33, 35, 36, 38, 40);
                                    foreach($boxSells as $boxSell){
                                        echo'<option value='.$boxSell.'>';
                                    }
                                    echo'</datalist>';
                                    echo'<input class="buttonGame" type="submit" value="Vendre">';
                                    echo'<input class="buttonGame" type="list" name="boxIDtoSell" list="boxes">';
                                }else{
                                    echo'<input class="buttonGame" type="list" name="boxIDtoSell" list="boxes" disabled>';
                                    echo'<input class="buttonGame" type="submit" value="Vendre" disabled>';
                                }
                                
                            ?>
                        </form>
                        <!--Bouton carte prison--> 
                        <form action="#" method="post"><br/><br/>
                            <input type="hidden" name="cardJailButton" value="1">
                            <?php 
                                if ($_SESSION["isTurn"]==true AND $_SESSION["onJail"]==true AND $_SESSION["cardJail"]==true){
                                    echo'<input class="buttonGame" type="submit" value="Carte Prison">';
                                }else{
                                    echo'<input class="buttonGame" type="submit" value="Carte Prison" disabled>';
                                }
                            ?>
                        </form>
                        <form action="#" method="post"><br/><br/>
                            <input type="hidden" name="other" value="1">
                            <input class="buttonGame" type="submit" value="Refresh">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include("../../html/footer.html")?>
    </footer>
</body>
</html>