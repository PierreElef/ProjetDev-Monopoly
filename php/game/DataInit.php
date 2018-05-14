<?php 
function initGame(){
    //Création de la partie
    $game = new Game;
    $_SESSION['game']=serialize($game);
    $_SESSION["isTurn"]=false;
    $_SESSION["pulledDice"]=false;
    $_SESSION["onStreet"]=false;
    $_SESSION["onStation"]=false;
    $_SESSION["onEnergie"]=false;
    $_SESSION["isOwner"]=false;
    $_SESSION["onJail"]=false;
    $_SESSION["CardsJail"]=false;
}

function initPlayer(){
    //Création de la partie
    $player = new Player;
    $_SESSION['player']=serialize($player);
}

function initBoard(){
    //Création du plateau
    $board = new Board;
    //Création des cases
    $board->addBox(new Box(1, "Départ",4,NULL,NULL,NULL));
    $board->addBox(new Box(2, "Rue Saint-Rome",1,1,1500000,300000));
    $board->addBox(new Box(3, "Caisse de communauté",5,NULL,NULL,NULL));
    $board->addBox(new Box(4, "Rue de la Colombette",1,1,1500000,300000));
    $board->addBox(new Box(5, "Impot sur le revenu",6,NULL,NULL,NULL));
    $board->addBox(new Box(6, "Gare St-Agne",2,10,1500000,300000));
    $board->addBox(new Box(7, "Avenue des Minimes",1,2,1500000,300000));
    $board->addBox(new Box(8, "Chance",5,NULL,NULL,NULL));
    $board->addBox(new Box(9, "Rue du Faubourg Bonnefoy",1,2,1500000,300000));
    $board->addBox(new Box(10, "Avenue de Muret",1,2,1500000,300000));
    $board->addBox(new Box(11, "Prison",4,NULL,NULL,NULL));
    $board->addBox(new Box(12, "Grande rue St-Michel",1,3,1500000,300000));
    $board->addBox(new Box(13, "Compagnie de distribution d'électricité",3,11,1500000,500000));
    $board->addBox(new Box(14, "Rue de la République",1,3,1500000,300000));
    $board->addBox(new Box(15, "Rue Bayard",1,3,1500000,300000));
    $board->addBox(new Box(16, "Gare St-Cyprien",2,10,1500000,300000));
    $board->addBox(new Box(17, "Avenue de Grande Bretagne",1,4,1500000,300000));
    $board->addBox(new Box(18, "Caisse de communauté",5,NULL,NULL,NULL));
    $board->addBox(new Box(19, "Avenue de St-Exupéry",1,4,1500000,300000));
    $board->addBox(new Box(20, "Avenue Jean Rieux",1,4,1500000,300000));
    $board->addBox(new Box(21, "Parc Gratuit",7,NULL,NULL,NULL));
    $board->addBox(new Box(22, "Allée des Demoiselles",1,5,1500000,300000));
    $board->addBox(new Box(23, "Chance",5,NULL,NULL,NULL));
    $board->addBox(new Box(24, "Rue des Chalets",1,5,1500000,300000));
    $board->addBox(new Box(25, "Allées Jean Jaurès",1,5,1500000,300000));
    $board->addBox(new Box(26, "Gare Toulouse Matabiau",2,10,1500000,300000));
    $board->addBox(new Box(27, "Rue du Languedoc",1,6,1500000,300000));
    $board->addBox(new Box(28, "Place St-Etienne",1,6,1500000,300000));
    $board->addBox(new Box(29, "Compagnie de distribution des eaux",3,11,1500000,500000));
    $board->addBox(new Box(30, "Rue Ozenne",1,6,1500000,300000));
    $board->addBox(new Box(31, "Allez en prison",8,NULL,NULL,NULL));
    $board->addBox(new Box(32, "Rue St-Antoine du T",1,7,1500000,300000));
    $board->addBox(new Box(33, "Rue du Metz",1,7,1500000,300000));
    $board->addBox(new Box(34, "Caisse de communauté",5,NULL,NULL,NULL));
    $board->addBox(new Box(35, "Rue Alsace-Lorraire",1,7,1500000,300000));
    $board->addBox(new Box(36, "Aeroport Toulouse-Blagnac",2,10,1500000,300000));
    $board->addBox(new Box(37, "Chance",5,NULL,NULL,NULL));
    $board->addBox(new Box(38, "Place du Capitole",1,8,1500000,300000));
    $board->addBox(new Box(39, "Taxe de Luxe",6,NULL,NULL,NULL));
    $board->addBox(new Box(40, "Rue Croix-Baragnon",1,8,1500000,300000));

    //Création des cartes
    //Création cartes Communauté
    $board->addCard(new Cards(1,1, "Allez au départ",1,NULL,NULL,NULL));
    $board->addCard(new Cards(2,6, "Allez en prison",NULL,NULL,NULL,NULL));
    $board->addCard(new Cards(3,1, "Allez Grande Rue Saint-Michel",12,NULL,NULL,NULL));
    $board->addCard(new Cards(4,2, "Amende pour ivresse -200 000 €",NULL,-200000,NULL,NULL));
    $board->addCard(new Cards(5,2, "Vous avez gagné le concours de mot-croisés +1 000 000 €",NULL,1000000,NULL,NULL));
    $board->addCard(new Cards(6,1, "Allez aux Allées Jean-Jaurés",25,NULL,NULL,NULL));
    $board->addCard(new Cards(7,1, "Allez gare de St-Cyprien",16,NULL,NULL,NULL));
    $board->addCard(new Cards(8,2, "Amende pour excès de vitesse -150 000 €",NULL,-150000,NULL,NULL));
    $board->addCard(new Cards(9,2, "Payer les frais de scolarité -1 500 000 €",NULL,-1500000,NULL,NULL));
    $board->addCard(new Cards(10,5, "Reculez de trois cases",NULL,NULL,NULL,NULL));
    $board->addCard(new Cards(11,4, "Réparation dans vos maisons -250 000€/maison -1 000 000€/hôtel",NULL,NULL,-250000,-1000000));
    $board->addCard(new Cards(12,2, "Votre prêt rapporte +1 500 000€",NULL,1500000,NULL,NULL));
    $board->addCard(new Cards(13,3, "Libéré de prison",NULL,NULL,NULL,NULL));
    $board->addCard(new Cards(14,1, "Rendez-vous Rue Croix Baragnon",40,NULL,NULL,NULL));
    $board->addCard(new Cards(15,4, "Voirie  -400 000€/maison -1 000 000€/hôtel",NULL,NULL,-400000,-1000000));
    $board->addCard(new Cards(16,2, "La banque vous verse +500 000€",NULL,500000,NULL,NULL));
    
    //Création cartes Chance
    $board->addCard(new Cards(17,2, "Amende pour excès de vitesse -100 000€",NULL,-100000,NULL,NULL));
    $board->addCard(new Cards(18,2, "La banque vous verse un dividente +500 000€",NULL,500000,NULL,NULL));
    $board->addCard(new Cards(19,4, "Voirie -400 000€/maison -1 150 000€/hôtel",NULL,NULL,-400000,-1150000));
    $board->addCard(new Cards(20,1, "Allez au départ",1,NULL,NULL,NULL));
    $board->addCard(new Cards(21,2, "Payez frais de scolarité -1 500 000€",NULL,-1500000,NULL,NULL));
    $board->addCard(new Cards(22,1, "Allez Rue Croix Baragnon",40,NULL,NULL,NULL));
    $board->addCard(new Cards(23,3, "Libéré de prison",NULL,NULL,NULL,NULL));
    $board->addCard(new Cards(24,1, "Allez aux Allées Jean-Jaurés",25,NULL,NULL,NULL));
    $board->addCard(new Cards(25,4, "Faites de réparations dans toutes vos maisons -250 000/maison -1 000 000/hôtel",NULL,NULL,-250000,-1000000));
    $board->addCard(new Cards(26,1, "Allez Grande Rue Saint-Michel",12,NULL,NULL,NULL));
    $board->addCard(new Cards(27,1, "Allez gare de St-Cyprien",16,NULL,NULL,NULL));
    $board->addCard(new Cards(28,2, "Votre immeuble et votre prêt rapportent + 1 500 000€",NULL,1500000,NULL,NULL));
    $board->addCard(new Cards(29,6, "Allez en prison",NULL,NULL,NULL,NULL));
    $board->addCard(new Cards(30,5, "Reculez de trois cases",NULL,NULL,NULL,NULL));
    $board->addCard(new Cards(31,2, "Ammende pour ivresse - 200 000€",NULL,-200000,NULL,NULL));
    $board->addCard(new Cards(32,2, "Vous avez gagné le prix de mots croisés de 1 000 000€",NULL,1000000,NULL,NULL));

    $_SESSION['board']=serialize($board);
}

function initDice(){
    //Création des dés
    $dice = new Dice;
    $_SESSION['dice']=serialize($dice);
}

function initAdmin(){
    //Choix de l'ordre de passage
    $IDadmin = getSql('SELECT `IDadmin` FROM `game` WHERE `ID`='.$_SESSION["idGame"]);
    if($_SESSION["id"]==$IDadmin){
        $playerPlaying=getSql('SELECT `IDtoplay` FROM `turn` WHERE `ID`='.$_SESSION["idGame"]);
        if(isset($playerPlaying){
            $order=array();
            $IDplayers= getSqlArray('SELECT `IDuser` FROM `player` WHERE `IDgame`='.$_SESSION["idGame"], 1);
            foreach($IDplayers as $IDplayer){
                if($IDplayer!==NULL){
                    array_push($order,$IDplayer);
                }
            }
            shuffle($order); 
            $_SESSION['order']=serialize($order);
            while(sizeof($order)<7){
                array_push($order,"NULL");
            }
            requetSql('INSERT INTO `turn`(`IDgame`, `IDtoPlay`, `order1`, `order2`, `order3`, `order4`, `order5`, `order6`) VALUES ('.$_SESSION["idGame"].','.$order[0].','.$order[0].','.$order[1].','.$order[2].','.$order[3].','.$order[4].','.$order[5].')');
        }else{
            $order=array();
        for($i=1;$i<7;$i++){
            $player=getSql('SELECT `order'.$i.'` FROM `turn` WHERE `IDgame`=35');
            if($player!==NULL){
                array_push($order,$player);
            }
        }
        $_SESSION['order']=serialize($order);
        }
    }else{
        $order=array();
        for($i=1;$i<7;$i++){
            $player=getSql('SELECT `order'.$i.'` FROM `turn` WHERE `IDgame`=35');
            if($player!==NULL){
                array_push($order,$player);
            }
        }
        $_SESSION['order']=serialize($order);
    }
}

?>