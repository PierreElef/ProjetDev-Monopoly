-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 23 avr. 2018 à 11:07
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
-- Base de données :  `cards`
--

-- --------------------------------------------------------

--
-- Structure de la table `caisse de communauté`
--

DROP TABLE IF EXISTS `caisse de communauté`;
CREATE TABLE IF NOT EXISTS `caisse de communauté` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Message` varchar(200) DEFAULT NULL,
  `Type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `caisse de communauté`
--

INSERT INTO `caisse de communauté` (`id`, `Message`, `Type`) VALUES
(1, 'Allez au départ   ', 1),
(2, 'Allez en prison   ', 5),
(3, 'Allez bld de la villette   ', 1),
(4, 'Amende pour ivresse 2000   ', 2),
(5, 'Vous avez gagné mot-croisés 10000   ', 3),
(6, 'Allez rue Henri Martin   ', 1),
(7, 'Allez gare de lyon   ', 1),
(8, 'Amende pour excès de vitesse 1 500 ', 2),
(9, 'Payez frais de scolarité 15 000   ', 2),
(10, 'Reculez de trois cases  ', 1),
(11, 'Réparation dans maison (2500/maison 10 000/Hotel)   ', 2),
(12, 'Votre prêt rapporte 15000   ', 3),
(13, 'Libéré de prison   ', 6),
(14, 'Rdv rue de la paix  ', 1),
(15, 'Voirie 4000/maison 11500/hotel  ', 2),
(16, 'La banque vous verse 5000', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
