<?php
/*
//Connexion joueur
    //si pas compte
        //Création compte
            //id, nom, password
        //retour connexion joueur
    //si compte
        //chercher partie disponible
            //Aller Chercher partie
        //créer une partie
            //Aller Création de partie

//Création de la partie

    //Choisir du nombre de joueurs réels
    //Création joueur propre
    //partage infos avec autres joueurs 
    //Création joueurs IA

    //Création du plateau
        //Création des cases
            //Création caseChoix
                //Création des cases Rue
                //Création des cases Gare
                //Création des cases Energie
            //Création caseAction
                //Création des cases Cartes
                //Création de la case GoToJail
                //Création de la case Parc
                //Création des cases Impots/Taxe
    
    //Création des dés

    //Création des cartes
        //Création cartes Communauté
        //Création cartes Chance

    //Choix de l'ordre de passage

//Début de la partie
    //Tant que nbr_joueur > 1
        //Tour
            //DiceSum=0
            //Check Prison
            //Si jailStatus=1
                //Select Case
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

            //Si jailStatus=0
                //DoubleCheck=1
                //nbrDouble=0
                //Tant que DoubleCheck=1
                    //si DiceSum=0
                        //Lancer de dé
                            //return DiceSum
                    //récupérer newPosition
                        //newPosition=position+DiceSum
                        //si nvll_position>40
                            //newPosition = newPosition - 41
                            //donner potDeDépart
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
            

*/
?>