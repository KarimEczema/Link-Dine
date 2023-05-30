-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 21 mai 2023 à 19:24
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpnote2`
--

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prenom` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `DateEmbauche` date NOT NULL,
  `ID_Travail` varchar(255) NOT NULL,
  `Salaire` int(11) NOT NULL,
  `ID_Patron` int(11) NOT NULL,
  `ID_Dept` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`ID`, `Prenom`, `Nom`, `DateEmbauche`, `ID_Travail`, `Salaire`, `ID_Patron`, `ID_Dept`, `Photo`) VALUES
(100, 'Steven', 'Chapelle', '2015-07-01', 'AD_VP', 4000, 0, 90, 'employes/chapelle.jpg'),
(101, 'Francois', 'Macron', '2013-05-01', 'IT_MGR', 3200, 100, 90, 'employes/macron.jpg'),
(102, 'Jose-Luis', 'Almazan', '2017-01-15', 'IT_PROG', 2750, 101, 90, 'employes/almazan.jpg'),
(103, 'Beatrice', 'Merkel', '2010-06-01', 'FI_MGR', 3100, 100, 100, 'employes/merkel.jpg'),
(104, 'Rana', 'Babli', '2015-05-01', 'FI_ACCOUNT', 2200, 103, 100, 'employes/babli.jpg'),
(105, 'Jaya', 'Narain', '2012-04-15', 'ST_MGR', 2100, 100, 45, 'employes/narain.jpg'),
(106, 'Travis', 'Griffith', '2014-01-05', 'ST_CLERK', 1950, 105, 45, 'employes/griffith.jpg'),
(107, 'Fatima', 'Cherif', '2007-05-01', 'FI_ACCOUNT', 2400, 103, 100, 'employes/cherif.jpg'),
(108, 'Pierre', 'Soukane', '2009-05-15', 'SA_MGR', 3225, 100, 60, 'employes/soukane.jpg'),
(109, 'Leslie', 'Hao', '2016-11-01', 'SA_REP', 1950, 108, 60, 'employes/hao.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
