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
-- Structure de la table `turn`
--

DROP TABLE IF EXISTS `turn`;
CREATE TABLE IF NOT EXISTS `turn` (
  `IDgame` int(11) NOT NULL,
  `IDtoPlay` int(11) NOT NULL,
  `order1` int(11) DEFAULT NULL,
  `order2` int(11) DEFAULT NULL,
  `order3` int(11) DEFAULT NULL,
  `order4` int(11) DEFAULT NULL,
  `order5` int(11) DEFAULT NULL,
  `order6` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDgame`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `turn`
--

INSERT INTO `turn` (`IDgame`, `IDtoPlay`, `order1`, `order2`, `order3`, `order4`, `order5`, `order6`) VALUES
(36, 6, 6, 8, 7, NULL, NULL, NULL),
(35, 7, 7, 6, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
