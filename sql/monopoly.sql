-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 02 mai 2018 à 10:37
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `monopoly`
--

-- --------------------------------------------------------

--
-- Structure de la table `box`
--

DROP TABLE IF EXISTS `box`;
CREATE TABLE IF NOT EXISTS `box` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `color` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `box`
--

INSERT INTO `box` (`ID`, `name`, `color`) VALUES
(1, 'Départ', 'NULL'),
(2, 'Rue Saint-Rome', '#934828'),
(3, 'Caisse de communauté', 'NULL'),
(4, 'Rue de la Colombette', '#934828'),
(5, 'Impot sur le revenu', 'NULL'),
(6, 'Gare St-Agne', '#000000'),
(7, 'Avenue des Minimes', '#BBE4F8'),
(8, 'Chance', 'NULL'),
(9, 'Rue du Faubourg Bonnefoy', '#BBE4F8'),
(10, 'Avenue de Muret', '#BBE4F8'),
(11, 'Prison', 'NULL'),
(12, 'Grande rue St-Michel', '#DA2D86'),
(13, 'Compagnie de distribution d\'électricité', '#000000'),
(14, 'Rue de la République', '#DA2D86'),
(15, 'Rue Bayard', '#DA2D86'),
(16, 'Gare St-Cyprien', '#000000'),
(17, 'Avenue de Grande Bretagne', '#F59002'),
(18, 'Caisse de communauté', 'NULL'),
(19, 'Avenue de St-Exupéry', '#F59002'),
(20, 'Avenue Jean Rieux', '#F59002'),
(21, 'Parc Gratuit', 'NULL'),
(22, 'Allée des Demoiselles', '#E3010F'),
(23, 'Chance', 'NULL'),
(24, 'Rue des Chalets', '#E3010F'),
(25, 'Allées Jean Jaurès', '#E3010F'),
(26, 'Gare Toulouse Matabiau', '#000000'),
(27, 'Rue du Languedoc', '#FDED01'),
(28, 'Place St-Etienne', '#FDED01'),
(29, 'Compagnie de distribution des eaux', '#000000'),
(30, 'Rue Ozenne', '#FDED01'),
(31, 'Allez en prison', 'NULL'),
(32, 'Rue St-Antoine du T', '#1DA64A'),
(33, 'Rue du Metz', '#1DA64A'),
(34, 'Caisse de communauté', 'NULL'),
(35, 'Rue Alsace-Lorraire', '#1DA64A'),
(36, 'Aeroport Toulouse-Blagnac', '#000000'),
(37, 'Chance', 'NULL'),
(38, 'Place du Capitole', '#0168B3'),
(39, 'Taxe de Luxe', 'NULL'),
(40, 'Rue Croix-Baragnon', '#0168B3');

-- --------------------------------------------------------

--
-- Structure de la table `building`
--

DROP TABLE IF EXISTS `building`;
CREATE TABLE IF NOT EXISTS `building` (
  `IDgame` int(11) DEFAULT NULL,
  `IDbox` int(11) DEFAULT NULL,
  `nbrHouse` int(11) DEFAULT NULL,
  `nbrHotel` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `building`
--

INSERT INTO `building` (`IDgame`, `IDbox`, `nbrHouse`, `nbrHotel`) VALUES
(1, 2, 1, 0),
(1, 4, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDplayer1` int(11) DEFAULT NULL,
  `IDplayer2` int(11) DEFAULT NULL,
  `IDplayer3` int(11) DEFAULT NULL,
  `IDplayer4` int(11) DEFAULT NULL,
  `IDplayer5` int(11) DEFAULT NULL,
  `IDplayer6` int(11) DEFAULT NULL,
  `nbrPlayer` int(11) NOT NULL,
  `nbrOnLine` int(11) NOT NULL,
  `nbrNeeded` int(11) NOT NULL,
  `jackpot` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`ID`, `IDplayer1`, `IDplayer2`, `IDplayer3`, `IDplayer4`, `IDplayer5`, `IDplayer6`, `nbrPlayer`, `nbrOnLine`, `nbrNeeded`, `jackpot`) VALUES
(1, 6, 7, NULL, NULL, NULL, NULL, 3, 2, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `IDgame` int(11) NOT NULL,
  `2` int(11) DEFAULT NULL,
  `4` int(11) DEFAULT NULL,
  `7` int(11) DEFAULT NULL,
  `9` int(11) DEFAULT NULL,
  `10` int(11) DEFAULT NULL,
  `12` int(11) DEFAULT NULL,
  `14` int(11) DEFAULT NULL,
  `15` int(11) DEFAULT NULL,
  `17` int(11) DEFAULT NULL,
  `19` int(11) DEFAULT NULL,
  `20` int(11) DEFAULT NULL,
  `22` int(11) DEFAULT NULL,
  `24` int(11) DEFAULT NULL,
  `25` int(11) DEFAULT NULL,
  `27` int(11) DEFAULT NULL,
  `28` int(11) DEFAULT NULL,
  `30` int(11) DEFAULT NULL,
  `32` int(11) DEFAULT NULL,
  `33` int(11) DEFAULT NULL,
  `35` int(11) DEFAULT NULL,
  `38` int(11) DEFAULT NULL,
  `40` int(11) DEFAULT NULL,
  `6` int(11) DEFAULT NULL,
  `16` int(11) DEFAULT NULL,
  `26` int(11) DEFAULT NULL,
  `36` int(11) DEFAULT NULL,
  `13` int(11) DEFAULT NULL,
  `29` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDgame`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `owner`
--

INSERT INTO `owner` (`IDgame`, `2`, `4`, `7`, `9`, `10`, `12`, `14`, `15`, `17`, `19`, `20`, `22`, `24`, `25`, `27`, `28`, `30`, `32`, `33`, `35`, `38`, `40`, `6`, `16`, `26`, `36`, `13`, `29`) VALUES
(1, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, 2, 4, 7, 9, 10, 12, 14, 15, 17, 19, 20, 22, 24, 25, 27, 28, 30, 32, 33, 35, 38, 40, 6, 16, 26, 36, 13, 29);

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `IDuser` int(11) NOT NULL,
  `IDgame` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `jailStatus` bit(1) NOT NULL,
  `color` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `player`
--

INSERT INTO `player` (`IDuser`, `IDgame`, `money`, `position`, `jailStatus`, `color`) VALUES
(6, 1, 15000000, 1, b'0', '#FF0000'),
(7, 1, 15000000, 1, b'0', '#003AFF'),
(1, 1, 15000000, 1, b'0', '#4FAB5B'),
(2, 1, 15000000, 2, b'0', '#ffac00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `name`, `password`) VALUES
(1, 'HAL 9000', '1'),
(2, 'Skynet', '2'),
(4, 'Sonny', '4'),
(5, 'WALL-E', '5'),
(3, 'Jarvis', '3'),
(6, 'playerOne', 'One'),
(7, 'Pierre', 'pierre');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
