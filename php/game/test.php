<?php
$orderCard=array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16);
shuffle($orderCard); 
$_SESSION['orderCard']=serialize($orderCard);
$sql='INSERT INTO `cards`(`IDgame`';
for($i=0;$i<17;$i++){
    $j=$i+1;
    $sql=$sql.', `order'.$j.'`';
}
$sql=$sql.') VALUES ('.$_SESSION["idGame"];
for($i=0;$i<16;$i++){
    $sql=$sql.', '.$orderCard[$i];
}
$sql=$sql.')';
echo $sql;