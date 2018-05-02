<?php
session_start();
include 'DataInit.php';
include 'Game.php';
include 'Box.php';
include 'Player.php';

//initialisation des données sessions
if (is_null($_SESSION['game'])){	
    initGame();
    //Choix de l'ordre de passage
    $game->getPlayingOrder(); 
}
$game = unserialize($_SESSION['game']);

if (is_null($_SESSION['player'])){	
	initPlayer();
}
$player = unserialize($_SESSION['player']);

if (is_null($_SESSION['board'])){	
	initBoard();
}
$board = unserialize($_SESSION['board']);



//Début de la partie
$game->start();
    //Tant que nbr_joueur > 1
    while($nbr_player > 1){
        //Tour
            //DiceSum            
            //Check Prison
            //Si jailStatus=1
            if ($player->getJailStatus()==true){
                //Case carte Sortie de Prison
                                        //joueur : plus de carte Sortie de Prison
                                        //jailStatus=0
                                        
                                    //Case Lancer de dé
                                        //Lancer de dé
                                        
                                            //return DiceSum
                                        //Si double
                                            //jailStatus=0
                                    //Case Payer amende
                                        //payer
                                        //jailStatus=0
                                    //Case Acheter carte Sortie de Prison
                                        //donne argent
                                        //autre joueur : plus de carte Sortie de Prison
                                        //jailStatus=0
                                //Select Case
                switch(){
                    if($player->getDice()->isDouble())){ //on regarde si les dés sont des doubles
                        $player->leaveJail();
                        return true;
                    }


                    if($answer= $player->getAnswer(PlayerAnswer::JAIL)){ //montrera les réponses en fonction des questions montrées au joueur en fonction de sa situation
                        switch($answer){
                            case :
                            case ...:
                            default:

                        }
                    }else{
                        if($player->ask(PlayerAnswer::JAIL)){ // dans cette fonction, mettre des if exemple: if(monnaie > 500){"Voulez-vous payer l'amende de 500€?"}
                            return true;
                        }
                        
                    }
                   
                }
                else{
                    function playTurn(Player $player)
                    {
                        do
                            {
                                $player->move($player->getDice());
                                if($player->getPosition() > 40){
                                    $player->addPosition($player->getPosition() - 40);
                                    $player->addMoney($player->getMoney()+1 000 000);
                                }
                                $board->action($board->getBoxbyID()); //le board trouve la case sur laquelle le joueur se trouve et réalise son effet (piocher une case, payer,...)
                                if($de->getDouble() == true)
                                {
                                    $player->isTurn = true;
                                }
                                else
                                {
                                    $player->isTurn = false;
                                }
                            }
                        }while($player->isTurn == true);    
                    }
                }

            }

            // PARTIE ARTHUR 


        
                    //select case typeCase
                        //Case caseChoix
                            //Choisir action
                                //Acheter
                                    //OK si argent = OK
                                //Payer
                                    //OK si argent = OK
                                    //NOK alors 
                                        //Vendre
                                //Négocier
                                //Construire
                                    //OK si argent = OK
                        //Case caseAction
                            //select action
                                //case tirer carte
                                //case aller en prison
                                    //jailStatus=1
                                    //position=10
                                //case payer
                                //case récupérer jackpot
                    //Si dés double
                        //DoubleCheck=1
                        //nbrDouble=+1
                        //si nbrDouble = 3
                            //action GoToJail
                            //DoubleCheck=0
                    //Else
                        //DoubleCheck=0
            
    }

?>