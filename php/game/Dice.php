<?php
class Dice
{
    private $de1;
    private $de2;
    private $score = 0;
    private $isDouble = false;


    function __construct()
    {

    }
//////////////////////////////////////////////////////////////////////////////////////////////////// GETTEURS
    function getDe1(){
        return $this->de1;
    }

    function getDe2(){
        return $this->de2;
    }

    function getScore(){
        return $this->score;
    }

    function getDouble(){
        return $this->isDouble;
    }


//////////////////////////////////////////////////////////////////////////////////////////////////// FONCTIONS
    function rollDice(){
        echo "Les dés sont lancés :</br>";
        $de1 = rand(1, 6);
        $de2 = rand(1, 6);

        $score = $de1 + $de2;
        if($de1 == $de2){
            $this->isDouble = true;
            echo "Double ".$de1." !</br>";
        }
        else{
            $this->isDouble = false;
        }

        echo "(".$de1.")(".$de2.")</br>";
        echo "Le score est de ".$score.".</br>";

        $this->score = $score;
    }

}

?>