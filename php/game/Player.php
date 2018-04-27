<?php

class Player
{
//////////////////////////////////////////////////////////////////////////////////////////////////// PROPRIETES
//////////////////////////////////////////////////////////// CONSTANTE
    private $id;
    private $name;
    private $color;
//////////////////////////////////////////////////////////// EVOLUTIVE
    private $pos = 0;
    private $cash = 500;
    public $isJail = false;
    public $isTurn = true;
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////// CONSTRUCTEUR
    function __construct($name)
    {
        $this->name = $name;
        echo $this->getName()." a rejoint la partie<br><br>";
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////// MUTATEURS
//////////////////////////////////////////////////////////// GETTEURS
    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getColor()
    {
        return $this->color;
    }

    function getPos()
    {
        return $this->pos;
    }

    function getCash()
    {
        return $this->cash;
    }

    function getJailStatu()
    {
        return $this->isJail;
    }

    function getTurnStatu()
    {
        return $this->isTurn;
    }
//////////////////////////////////////////////////////////// SETTEURS
    function setPos($pos)
    {
        $this->pos = $pos;
    }

    function setCash($newCash)
    {
        $this->cash = $newCash;
    }

    function jailOn()
    {
        $this->isJail = True;
    }

    function jailOff()
    {
        $this->isJail = False;
    }

    function turnOn()
    {
        $this->isTurn = True;
    }

    function turnOff()
    {
        $this->isTurn = False;
    } 
////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////// FONCTIONS COMPLEXES
//////////////////////////////////////////////////////////// DEPLACEMENT
    function move(Dice $de)
    {
        echo "DEPLACEMENT :<br>";
        echo $this->getName()." est sur la case ".$this->getPos().".<br>";
        $de->rollDice();
        $this->pos += $de->getScore();

        // Savoir si on passe par la case départ
        if($this->pos < 40)
        {
            $this->pos = $this->pos;
        }
        else if($this->pos >= 40)
        {
            $this->pos -= 40;
            $this->cash += 200;
            echo $this->getName()." passe par la case départ et empoche 200e.<br>";
        }

        echo $this->getName()." se déplace jusqu'à la case ".$this->getPos().".<br><br>";
    }

    //////////////////////////////////////////////////////////// ACTIONS

    /* 
    1 rue 
    2 gare 
    3 compagnie
    4 départ/prison
    5 piocher une carte
    6 taxe
    7 parc gratuit 
    8 aller en prison
    */
    function action(Box $box)
    {
        $type = $box->getType($this->pos);
        switch($type)
        {
            case 1:
                echo "Le joueur est sur une case propriété.<br>";
                break;
            
            case 2:
                echo "Le joueur est sur une case gare.<br>";
                break;
            case 3:
                echo "Le joueur est sur une case compagnie.<br>";
                break;
            case 4: 
                echo "Le joueur est sur une case départ ou prison.<br>";
                break;
            case 5: 
                echo "Le joueur est sur une case ou il pioche une carte.<br>";
                break;
            case 6:
                echo "Le joueur est sur une case ou il va payer. <br>";
                break;
            case 7:
                echo "Le joueur est sur le park gratuit.<br>";
                break;
            case 8:
                echo "Le joueur est sur la case aller en prison.<br>"
                $this->goInJail();
                break; 

        }
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////// FONCTIONS SECONDAIRES
    function goInJail()
    {
        $this->setPos(11);
        $this->jailOn();
    }

}


?>


