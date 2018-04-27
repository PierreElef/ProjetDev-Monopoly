<?php
    session_start();
    include('../commun/getSQL.php');
    $IDgame=$_SESSION["idGame"];
    settype($IDgame, "int");
    $positionPlayers=array()

    $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$IDgame, 1);
    foreach($IDplayers as $IDplayer){
        $positionPlayer=getSql('SELECT `position` FROM `player` WHERE `IDgame`='.$IDgame.' AND `IDuser`='.$IDplayer.'');
        array_push($positionPlayers, $positionPlayer);
    }

    json_encode($positionPlayers);
    
?>
