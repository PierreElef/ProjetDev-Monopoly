<?php
    //include('getSQL.php');
    $games=array();
    $games= getSqlArray('SELECT `ID` FROM `game` ORDER BY `ID`', 1);
    if (sizeof($games) > 0){
        echo '<table class="table table-striped">';
        echo '<tr style="font-weight: bold;">';
        echo "<td>Numéro de</br>la partie</td>";
        echo "<td>Nombre de</br>joueurs manquants</td>";
        echo "<td>Joueur 1</td>";
        echo "<td>Joueur 2</td>";
        echo "<td>Joueur 3</td>";
        echo "<td>Joueur 4</td>";
        echo "<td>Joueur 5</td>";
        echo "<td>Joueur 6</td>";
        echo "</tr>";
        //pour chaque valeur du tableau game
        foreach ($games as $IDgame){
            //récupération des caractéristiques du livre
            $IDplayer1 = getSql('SELECT `IDplayer1` FROM `game` WHERE `ID`='.$IDgame.'');
            if (!($IDplayer1==NULL)){
                $namePlayer1 = getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer1.'');
            }else{
                $namePlayer1 = "";
            }
            $IDplayer2 = getSql('SELECT `IDplayer2` FROM `game` WHERE `ID`='.$IDgame.'');
            if (!($IDplayer2==NULL)){
                $namePlayer2 = getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer2.'');
            }else{
                $namePlayer2 = "";
            }
            $IDplayer3 = getSql('SELECT `IDplayer3` FROM `game` WHERE `ID`='.$IDgame.'');
            if (!($IDplayer3==NULL)){
                $namePlayer3 = getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer3.'');
            }else{
                $namePlayer3 = "";
            }
            $IDplayer4 = getSql('SELECT `IDplayer4` FROM `game` WHERE `ID`='.$IDgame.'');
            if (!($IDplayer4==NULL)){
                $namePlayer4 = getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer4.'');
            }else{
                $namePlayer4 = "";
            } 
            $IDplayer5 = getSql('SELECT `IDplayer5` FROM `game` WHERE `ID`='.$IDgame.'');
            if (!($IDplayer5==NULL)){
                $namePlayer5 = getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer5.'');
            }else{
                $namePlayer5 = "";
            }  
            $IDplayer6 = getSql('SELECT `IDplayer6` FROM `game` WHERE `ID`='.$IDgame.'');
            if (!($IDplayer6==NULL)){
                $namePlayer6 = getSql('SELECT `name` FROM `user` WHERE `ID`='.$IDplayer6.'');
            }else{
                $namePlayer6 = "";
            } 
            $nbrPlayerNeed = getSql('SELECT `nbrNeeded` FROM `game` WHERE `ID`='.$IDgame.'');
            $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$IDgame.'');
            if ($nbrPlayerNeed==$nbrOnLine){
                echo '<tr style="background:green;">';
            }else{
                echo "<tr>";
            }
            echo "<td>".$IDgame."</td>";
            echo "<td>".($nbrPlayerNeed-$nbrOnLine)."</td>";
            echo "<td>".$namePlayer1."</td>";
            echo "<td>".$namePlayer2."</td>";
            echo "<td>".$namePlayer3."</td>";
            echo "<td>".$namePlayer4."</td>";
            echo "<td>".$namePlayer5."</td>";
            echo "<td>".$namePlayer6."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }else{
        //s'il n'y a pas de partie en cours
        echo '<p style="color:red">Il n\'y a de partie en cours.<p>';
    }
?>