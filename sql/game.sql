-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 02 mai 2018 à 10:29
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
