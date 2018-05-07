<?php 
include ('Game.php');
include ('Box.php');

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
    $_SESSION["cardJail"]=false;
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

    //Création des dés
    $dice = new Dice;

    //Création des cartes
    //Création cartes Communauté
    $board->addCommunityChestCard(new CommunityChestCard(1, "Allez au départ"));
    $board->addCommunityChestCard(new CommunityChestCard(2, "Allez en prison"));
    $board->addCommunityChestCard(new CommunityChestCard(3, "Allez Grande Rue Saint-Michel"));
    $board->addCommunityChestCard(new CommunityChestCard(4, "Amende pour ivresse<br/>-200 000 €"));
    $board->addCommunityChestCard(new CommunityChestCard(5, "Vous avez gagné le concours de mot-croisés<br/>+1 000 000 €"));
    $board->addCommunityChestCard(new CommunityChestCard(6, "Allez aux Allées Jean-Jaurés"));
    $board->addCommunityChestCard(new CommunityChestCard(7, "Allez gare de St-Cyprien"));
    $board->addCommunityChestCard(new CommunityChestCard(8, "Amende pour excès de vitesse<br/>-150 000 €"));
    $board->addCommunityChestCard(new CommunityChestCard(9, "Payer les frais de scolarité<br/>-1 500 000 €"));
    $board->addCommunityChestCard(new CommunityChestCard(10, "Reculez de trois cases"));
    $board->addCommunityChestCard(new CommunityChestCard(11, "Réparation dans vos maisons<br/>-250 000€/maison -1 000 000€/hôtel"));
    $board->addCommunityChestCard(new CommunityChestCard(12, "Votre prêt rapporte<br/>+1 500 000€"));
    $board->addCommunityChestCard(new CommunityChestCard(13, "Libéré de prison"));
    $board->addCommunityChestCard(new CommunityChestCard(14, "Rendez-vous Rue Croix Baragnon"));
    $board->addCommunityChestCard(new CommunityChestCard(15, "Voirie <br/>-400 000€/maison -1 000 000€/hôtel"));
    $board->addCommunityChestCard(new CommunityChestCard(16, "La banque vous verse<br/>+500 000€"));

    //Création cartes Chance
    $board->addChanceCard(new ChanceCard(1, "Amende pour excès de vitesse<br/>-100 000€"));
    $board->addChanceCard(new ChanceCard(2, "La banque vous verse un dividente<br/>+500 000€"));
    $board->addChanceCard(new ChanceCard(3, "Voirie<br/>-4 000€/maison -1 150 000€/hôtel"));
    $board->addChanceCard(new ChanceCard(4, "Allez au départ"));
    $board->addChanceCard(new ChanceCard(5, "Payez frais de scolarité<br/>-1 500 000€"));
    $board->addChanceCard(new ChanceCard(6, "Allez Rue Croix Baragnon"));
    $board->addChanceCard(new ChanceCard(7, "Libéré de prison"));
    $board->addChanceCard(new ChanceCard(8, "Allez aux Allées Jean-Jaurés"));
    $board->addChanceCard(new ChanceCard(9, "Faites de réparations dans toutes vos maisons<br/>-250 000/maison -1 000 000/hôtel"));
    $board->addChanceCard(new ChanceCard(10, "Allez Grande Rue Saint-Michel"));
    $board->addChanceCard(new ChanceCard(11, "Allez gare de St-Cyprien"));
    $board->addChanceCard(new ChanceCard(12, "Votre immeuble et votre prêt rapportent<br/>+ 1 500 000€"));
    $board->addChanceCard(new ChanceCard(13, "Allez en prison"));
    $board->addChanceCard(new ChanceCard(14, "Reculez de trois cases"));
    $board->addChanceCard(new ChanceCard(15, "Ammende pour ivresse<br/>- 200 000€"));
    $board->addChanceCard(new ChanceCard(16, "Vous avez gagné le prix de mots croisés de 1 000 000€"));

    $_SESSION['board']=serialize($board);
}

?>