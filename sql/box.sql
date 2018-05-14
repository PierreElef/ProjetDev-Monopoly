-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 14 mai 2018 à 08:25
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
