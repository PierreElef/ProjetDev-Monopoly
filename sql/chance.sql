-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 23 avr. 2018 à 11:08
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
-- Structure de la table `chance`
--

DROP TABLE IF EXISTS `chance`;
CREATE TABLE IF NOT EXISTS `chance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chance`
--

INSERT INTO `chance` (`ID`, `message`, `type`) VALUES
(1, 'Amende pour excès de vitesse', 2),
(2, 'La banque vous verse un dividende de 5000', 3),
(3, 'Vous êtes imposé pour les réparations de voirie (4000/maison 11500/hotel)', 2),
(4, 'Avancez jusqu’à la case départ', 1),
(5, 'Payer les frais de scolarité de 15000', 2),
(6, 'Rendez-vous Rue de la Paix', 1),
(7, 'Carte « sortie de prison »', 6),
(8, 'Rendez-vous à l’Avenue Henri-Martin. Si vous passez par la case Départ, recevez 20 000', 4),
(9, 'Faites des réparations dans toutes vos maisons (2500/maison 10000/hotel)', 2),
(10, 'Avancer au Bd de la Vilette. Si vous passez par la case Départ, recevez 20 000.', 4),
(11, 'Allez à la gare de Lyon. Si vous passez par la case Départ, recevez 20 000.', 4),
(12, 'Votre immeuble et votre prêt rapportent +15000', 3),
(13, 'Allez en prison. Ne franchissez pas la case Départ', 5),
(14, 'Reculez de 3 cases', 1),
(15, 'Amende pour ivresse 2000', 2),
(16, 'Vous avez gagné le prix de mots croisés 10000', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
