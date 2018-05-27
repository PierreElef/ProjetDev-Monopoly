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
(36, NULL, 7, 7, 6, NULL, 8, 8, NULL, NULL, 6, NULL, 8, NULL, NULL, 6, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, 6, 7, NULL, NULL, NULL),
(35, 7, 7, 6, 6, 7, 6, 7, 6, 6, 7, 7, 6, 7, 6, 6, 7, 7, 7, 7, 7, 6, NULL, 6, 7, 6, 6, 7, 7);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
