<?php
function writeLog($text){
    $fichier=fopen('../../history/'.$_SESSION["idGame"].'.txt','a+');
    $texte=date('d/m/y H:i:s').' : '.$text;
    fputs($fichier, $texte);
    fclose($fichier); 
}
function writeLogNP($text){
    $fichier=fopen('../../history/'.$_SESSION["idGame"].'.txt','a+');
    fputs($fichier, $text);
    fclose($fichier); 
}
?>