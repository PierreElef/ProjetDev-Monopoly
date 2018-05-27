-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 27 mai 2018 à 09:50
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
-- Structure de la table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `IDgame` int(11) NOT NULL,
  `cardToPick` int(11) DEFAULT NULL,
  `order1` int(11) DEFAULT NULL,
  `order2` int(11) DEFAULT NULL,
  `order3` int(11) DEFAULT NULL,
  `order4` int(11) DEFAULT NULL,
  `order5` int(11) DEFAULT NULL,
  `order6` int(11) DEFAULT NULL,
  `order7` int(11) DEFAULT NULL,
  `order8` int(11) DEFAULT NULL,
  `order9` int(11) DEFAULT NULL,
  `order10` int(11) DEFAULT NULL,
  `order11` int(11) DEFAULT NULL,
  `order12` int(11) DEFAULT NULL,
  `order13` int(11) DEFAULT NULL,
  `order14` int(11) DEFAULT NULL,
  `order15` int(11) DEFAULT NULL,
  `order16` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDgame`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`IDgame`, `cardToPick`, `order1`, `order2`, `order3`, `order4`, `order5`, `order6`, `order7`, `order8`, `order9`, `order10`, `order11`, `order12`, `order13`, `order14`, `order15`, `order16`) VALUES
(35, 6, 1, 12, 13, 10, 2, 7, 4, 15, 5, 16, 6, 8, 3, 9, 11, 14),
(36, 6, 7, 15, 10, 2, 6, 11, 5, 4, 8, 16, 3, 9, 13, 12, 14, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
