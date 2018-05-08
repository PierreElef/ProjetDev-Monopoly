<?php
function joinGame($idPlayer, $gameID){

    $nbrPlayerNeed = getSql('SELECT `nbrNeeded` FROM `game` WHERE `ID`='.$gameID.'');
    $nbrOnLine = getSql('SELECT `nbrOnLine` FROM `game` WHERE `ID`='.$gameID.'');
    $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$gameID, 1);
    
    if ($nbrPlayerNeed==$nbrOnLine){
        $canJoin = false;
        foreach ($IDplayers as $IDplayer){
            if ($idPlayer==$IDplayer){
                settype($gameID, "int");
                $_SESSION["idGame"]=$gameID;
                header('Location: waitGamev2.php');
                break;
            }
        }
    }else{
        $canJoin = true;
        
        $playerOnGame = false;
    }

    if ($canJoin == false){
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
                            requetSql('UPDATE `game` SET `IDplayer2`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID);
                            $playerOnGame=true;
                            requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$gameID.',15000000,1,0,"#003AFF")');
                            break;
                        }
                    case 3:
                        if ($IDplayer3onGame==NULL){
                            requetSql('UPDATE `game` SET `IDplayer3`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID);
                            $playerOnGame=true;
                            requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$gameID.',15000000,1,0,"#4FAB5B")');
                            break;
                        }
                    case 4:
                        if ($IDplayer4onGame==NULL){
                            requetSql('UPDATE `game` SET `IDplayer4`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID);
                            $playerOnGame=true;
                            requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$gameID.',15000000,1,0,"#ffac00")');
                            break;
                        }
                    case 5:
                        if ($IDplayer5onGame==NULL){
                            requetSql('UPDATE `game` SET `IDplayer5`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID);
                            $playerOnGame=true;
                            requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$gameID.',15000000,1,0,"#d8789f")');
                            break;
                        }
                    case 6:
                        if ($IDplayer6onGame==NULL){
                            requetSql('UPDATE `game` SET `IDplayer6`='.$idPlayer.',`nbrOnLine`='.$nbrOnLine.' WHERE `ID`='.$gameID);
                            $playerOnGame=true;
                            requetSql('INSERT INTO `player`(`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES ('.$idPlayer.','.$gameID.',15000000,1,0,"#00c8d8")');
                            break;
                    }
                }
            }
            settype($gameID, "int");
            $_SESSION["idGame"]=$gameID;
        }
        header('Location: waitGamev2.php');
    }
}
?>