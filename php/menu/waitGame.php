<?php
    session_start();
    include('../commun/getSQL.php');
    $ID=$_SESSION["id"];
    $IDgame=$_SESSION["idGame"];
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("../../html/head.html")?>
</head>
<html>
<body>
    <div class="container">
        <header class="header">
            <?php include("../../html/header.html")?>
            <div class="text-center">
                <h1 class="text-center">En attente de joueurs</h1>
            </div>
        </header>
        <div class="row text-center p-2">
            <div class="col-lg-8 col-md-12">
                <img src="../../images/wait.jpg" style="width:640px"></br>
                <i>Possibilité de fin de partie</i>
            </div>
            <div class="col-lg-4 align-middle p-1">
                <p></br>La partie va bientôt commencer. Il manque encore des joueurs.</p>
                <p>Préparez à jouer une partie conviviale et amicale.</p>
                <p>Vous pouvez en profiter pour relire les <a href="http://monopolyste.online.fr/regles.shtml" target="_blank">règles</a>.</br></p>
                <img src="../../images/wait2.gif" width=50%>
            </div>
        </div>
        <?php include("../../html/footer.html")?>
    </div>
    <?php
        session_start();
        include('../commun/getSQL.php');
        $IDgame=$_SESSION["idGame"];
        settype($IDgame, "int");
        $onlinePlayers=array()

        $IDplayers= getSqlArray('SELECT `nbrOnLine` FROM `game` WHERE `IDgame`='.$IDgame, 1);
        foreach($IDplayers as $IDplayer){
            $onlinePlayer=getSql('SELECT `nbrNeeded` FROM `game` WHERE `IDgame`='.$IDgame.'');
            array_push($onlinePlayers, $onlinePlayer);
        }

        json_encode($onlinePlayers);

    ?>
     <script src="jquery.js"></script>
        <script>
            $.ajax({
                url: '/getPlayer',
                setInterval(ajax,3000);  //3 second boucle
                }).done(function(){
                    if
                }

                //do something

                }).fail(function(jqXHR, textStatus){
                    if(textStatus === 'timeout')
                {     
                    alert('Failed from timeout'); 
                //do something. Try again
                }
            });​
        
        </script>
        $nbrPlayerNeed = getSql('SELECT `nbrNeeded` FROM `game` WHERE `ID`='.$IDgame.'');
            $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$IDgame.'');
            if($nbrPlayerNeed==$nbrOnLine){
        header('Location: ../game/GameIF.php');
</body>
</html>