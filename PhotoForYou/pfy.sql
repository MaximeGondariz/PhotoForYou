-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 07 mai 2021 à 14:30
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pfy`
--
CREATE DATABASE IF NOT EXISTS `pfy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pfy`;

-- --------------------------------------------------------

--
-- Structure de la table `associe`
--

DROP TABLE IF EXISTS `associe`;
CREATE TABLE IF NOT EXISTS `associe` (
  `id_pho` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY (`id_pho`,`id_cat`),
  KEY `associe_fk1` (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `associe`
--

INSERT INTO `associe` (`id_pho`, `id_cat`) VALUES
(32, 1),
(32, 2),
(43, 2),
(43, 9),
(43, 10);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(60) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `libelle`) VALUES
(1, 'Paysage'),
(2, 'Comic'),
(9, 'Portrait'),
(10, 'Beauté');

--
-- Déclencheurs `categories`
--
DROP TRIGGER IF EXISTS `categories_BEFORE_DELETE`;
DELIMITER $$
CREATE TRIGGER `categories_BEFORE_DELETE` BEFORE DELETE ON `categories` FOR EACH ROW BEGIN
	delete from associe where id_cat = old.id_categorie;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `IdClient` int(11) NOT NULL,
  `nbphotos` int(11) NOT NULL,
  PRIMARY KEY (`IdClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`IdClient`, `nbphotos`) VALUES
(2, 2),
(3, 0),
(5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `photographes`
--

DROP TABLE IF EXISTS `photographes`;
CREATE TABLE IF NOT EXISTS `photographes` (
  `IdPhotographe` int(11) NOT NULL,
  `nbphotos` int(11) NOT NULL,
  PRIMARY KEY (`IdPhotographe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photographes`
--

INSERT INTO `photographes` (`IdPhotographe`, `nbphotos`) VALUES
(1, 0),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_photos` int(11) NOT NULL AUTO_INCREMENT,
  `id_photographe` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `pixels_X` int(11) NOT NULL,
  `pixels_Y` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id_photos`,`id_photographe`),
  KEY `photos_ibfk_1` (`id_photographe`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photos`, `id_photographe`, `libelle`, `pixels_X`, `pixels_Y`, `poids`, `prix`) VALUES
(32, 4, 'Capture.PNG', 1842, 715, 0, 12),
(43, 4, 'tick2.jpg', 2000, 2000, 2, 8);

--
-- Déclencheurs `photos`
--
DROP TRIGGER IF EXISTS `photos_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `photos_AFTER_INSERT` AFTER INSERT ON `photos` FOR EACH ROW BEGIN
	update photographes
    set nbphotos = nbphotos+1
    where IdPhotographe = (select new.id_photographe);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `photos_BEFORE_DELETE`;
DELIMITER $$
CREATE TRIGGER `photos_BEFORE_DELETE` BEFORE DELETE ON `photos` FOR EACH ROW BEGIN
	update photographes
    set nbphotos = nbphotos-1
    where IdPhotographe = old.id_photographe;
    delete from associe
    where id_pho = old.id_photos;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `photo_achete`
--

DROP TABLE IF EXISTS `photo_achete`;
CREATE TABLE IF NOT EXISTS `photo_achete` (
  `idphoto_acheté` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `pixels_X` int(11) NOT NULL,
  `pixels_Y` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  PRIMARY KEY (`idphoto_acheté`,`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo_achete`
--

INSERT INTO `photo_achete` (`idphoto_acheté`, `id_client`, `libelle`, `pixels_X`, `pixels_Y`, `poids`) VALUES
(2, 2, 'Capture.PNG', 1842, 715, 0),
(3, 2, 'tick2.jpg', 2000, 2000, 2);

--
-- Déclencheurs `photo_achete`
--
DROP TRIGGER IF EXISTS `photo_acheté_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `photo_acheté_AFTER_INSERT` AFTER INSERT ON `photo_achete` FOR EACH ROW BEGIN
	update clients
    set nbphotos = nbphotos+1
    where IdClient = (select new.id_client);
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `photo_acheté_BEFORE_DELETE`;
DELIMITER $$
CREATE TRIGGER `photo_acheté_BEFORE_DELETE` BEFORE DELETE ON `photo_achete` FOR EACH ROW BEGIN
	update clients
    set nbphotos = nbphotos-1
    where IdClient = old.id_client;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `IdUsers` int(11) NOT NULL AUTO_INCREMENT,
  `NomUsers` varchar(30) NOT NULL,
  `PrenomUsers` varchar(40) NOT NULL,
  `EmailUsers` varchar(70) NOT NULL,
  `mdpUsers` varchar(100) NOT NULL,
  `TypeUsers` char(1) NOT NULL,
  `Credit` int(11) NOT NULL,
  PRIMARY KEY (`IdUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`IdUsers`, `NomUsers`, `PrenomUsers`, `EmailUsers`, `mdpUsers`, `TypeUsers`, `Credit`) VALUES
(1, 'hiver', 'automne', 'printemps@print.temps', '$2y$10$vnoAyl9woVk8o.EKJGU/pu8OZfPCRdTpqmeqQfEAZN8YPL9TviqL2', 'P', 0),
(2, 'arte', 'arte', 'arte@arte.arte', '$2y$10$1h6pSKq/UWE1aYEdVpmaKu9udtA.SvJIBVTPF6mSiX/8LZ74tLhfi', 'C', 346),
(3, 'qsdf', 'qsdf', 'q@s.df', '$2y$10$ytUGBW/Va.xQeVw/N87zt.LxrBxsnIFiJ655zs8gGNqOgZtquEOR2', 'C', 0),
(4, 'azerty', 'azerty', 'az@er.ty', '$2y$10$Lh6R1Y/ymTucN0bDoCLCuefwCjECtWXxkWiqMd97iRKLmtQOkpT/S', 'P', 20),
(5, 'dgf', 'dfg', 'dfg@sfd.f', '$2y$10$LuCgg31xjKAfMWpvdr3mL.1W5JZWRa0ZfRoVTiFaWzOQLzepph6BG', 'C', 0);

--
-- Déclencheurs `users`
--
DROP TRIGGER IF EXISTS `users_AFTER_INSERT`;
DELIMITER $$
CREATE TRIGGER `users_AFTER_INSERT` AFTER INSERT ON `users` FOR EACH ROW BEGIN
	IF new.TypeUsers = "P" then
		Insert into photographes values (new.IdUsers,0);
	else
		Insert into clients values (new.IdUsers);
	END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `users_BEFORE_DELETE`;
DELIMITER $$
CREATE TRIGGER `users_BEFORE_DELETE` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
	IF old.TypeUsers = "P" then
		delete from photographes where IdPhotographe = old.IdUsers;
	else
		delete from clients where IdClient = old.IdUsers;
	END IF;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `associe`
--
ALTER TABLE `associe`
  ADD CONSTRAINT `associe_fk1` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `associe_fk2` FOREIGN KEY (`id_pho`) REFERENCES `photos` (`id_photos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `client` FOREIGN KEY (`IdClient`) REFERENCES `users` (`IdUsers`);

--
-- Contraintes pour la table `photographes`
--
ALTER TABLE `photographes`
  ADD CONSTRAINT `photographe_fk1` FOREIGN KEY (`IdPhotographe`) REFERENCES `users` (`IdUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`id_photographe`) REFERENCES `photographes` (`IdPhotographe`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
