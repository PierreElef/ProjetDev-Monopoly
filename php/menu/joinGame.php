<?php
function joinGame($idPlayer, $gameID){
    $nbrPlayerNeed = getSql('SELECT `nbrNeeded` FROM `game` WHERE `ID`='.$gameID.'');
    $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$gameID.'');
    if ($nbrPlayerNeed==$nbrOnLine){
        echo '<p class="text-center" style="color:red">Choisir une autre partie</p>';
    }else{
        $IDplayer1onGame=getSql('SELECT `IDplayer1` FROM `game` WHERE `ID`='.$gameID.'');
        $IDplayer2onGame=getSql('SELECT `IDplayer2` FROM `game` WHERE `ID`='.$gameID.'');
        $IDplayer3onGame=getSql('SELECT `IDplayer3` FROM `game` WHERE `ID`='.$gameID.'');
        $IDplayer4onGame=getSql('SELECT `IDplayer4` FROM `game` WHERE `ID`='.$gameID.'');
        $IDplayer5onGame=getSql('SELECT `IDplayer5` FROM `game` WHERE `ID`='.$gameID.'');
        $IDplayer6onGame=getSql('SELECT `IDplayer6` FROM `game` WHERE `ID`='.$gameID.'');
        $nbrOnLine=$nbrOnLine+1;
        $playerOnGame=false;
        for ($i=2; $i<=6; $i++){
            if ($playerOnGame==false){
                switch ($i){
                    case 2:
                        if ($IDplayer2onGame==NULL){
                            $sql='UPDATE `game` SET `IDplayer2`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID.'';
                            requetSql($sql);
                            $playerOnGame=true;
                            echo "Ajouté en player2";
                            break;
                        }
                    case 3:
                        if ($IDplayer3onGame==NULL){
                            $sql='UPDATE `game` SET `IDplayer3`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID.'';
                            requetSql($sql);
                            $playerOnGame=true;
                            echo "Ajouté en player3";
                            break;
                        }
                    case 4:
                        if ($IDplayer4onGame==NULL){
                            $sql='UPDATE `game` SET `IDplayer4`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID.'';
                            requetSql($sql);
                            $playerOnGame=true;
                            echo "Ajouté en player4";
                            break;
                        }
                    case 5:
                        if ($IDplayer5onGame==NULL){
                            $sql='UPDATE `game` SET `IDplayer5`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID.'';
                            requetSql($sql);
                            $playerOnGame=true;
                            echo "Ajouté en player5";
                            break;
                        }
                    case 6:
                        if ($IDplayer6onGame==NULL){
                            $sql='UPDATE `game` SET `IDplayer6`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID.'';
                            requetSql($sql);
                            $playerOnGame=true;
                            echo "Ajouté en player6";
                            break;
                    }
                }
            }
            $_SESSION["idGame"]=$gameID;
        }
        header('Location: waitGame.php');
    }
}
?>