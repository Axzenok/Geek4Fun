-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 mai 2024 à 20:18
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cosplaykalvinalexis`
--
CREATE DATABASE IF NOT EXISTS `cosplaykalvinalexis` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cosplaykalvinalexis`;

DELIMITER $$
--
-- Fonctions
--
DROP FUNCTION IF EXISTS `ajout_utilisateur`$$
CREATE DEFINER=`CosplayKalvinAlexis`@`%` FUNCTION `ajout_utilisateur` (`nom` VARCHAR(60), `prenom` VARCHAR(60), `mail` VARCHAR(255), `dateDeNaissance` DATE, `ville` VARCHAR(60), `telephone` VARCHAR(12), `login` VARCHAR(60), `motDePasse` VARCHAR(512), `droitImage` BOOLEAN, `accepterCharte` BOOLEAN, `id_type_entre` INT(5)) RETURNS TINYINT(1) NO SQL BEGIN
-- Déclaration
DECLARE ajoutEffectue BOOLEAN DEFAULT 0;

-- Handlers

-- Insertion
INSERT INTO utilisateur(utilisateur_nom, utilisateur_prenom, utilisateur_mail, utilisateur_dateDeNaissance, 
                        utilisateur_ville, utilisateur_telephone, utilisateur_login, utilisateur_motDePasse,
                       	utilisateur_droitImage, utilisateur_accepterCharte, id_type)
	VALUES (nom, prenom, mail, dateDeNaissance, 
            ville, telephone, login, motDePasse, 
            droitImage, accepterCharte, id_type_entre);

SET ajoutEffectue = 1;

RETURN ajoutEffectue;

END$$

DROP FUNCTION IF EXISTS `func_updLogin`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `func_updLogin` (`leLogin` VARCHAR(30), `id` INT(2)) RETURNS INT  BEGIN
DECLARE retour INT;

DECLARE CONTINUE HANDLER FOR 1062
	SET retour  = -1062;

DECLARE CONTINUE HANDLER FOR 1452
	SET retour  = -1452;

    SELECT COUNT(*) INTO retour
    FROM utilisateur
    WHERE utilisateur.utilisateur_login  = leLogin;
    
   
    IF retour > 0 THEN
        SET retour = "-1";
    ELSE
    	UPDATE `user` SET `utilisateur_login ` = leLogin WHERE `utilisateur_id ` = id; 
        SET retour = (SELECT id FROM utilisateur WHERE `utilisateur_id` = id AND `utilisateur_login ` = leLogin); 
    END IF;
    
    RETURN retour;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `attente`
--

DROP TABLE IF EXISTS `attente`;
CREATE TABLE IF NOT EXISTS `attente` (
  `id_evenement` varchar(10) NOT NULL,
  `id_utilisateur` varchar(10) NOT NULL,
  `attente_numero` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_evenement`),
  KEY `classement_FK` (`id_evenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `costume`
--

DROP TABLE IF EXISTS `costume`;
CREATE TABLE IF NOT EXISTS `costume` (
  `costume_id` int NOT NULL AUTO_INCREMENT,
  `id_theme` int NOT NULL,
  `id_utilisateur` varchar(10) NOT NULL,
  `costume_bandeSon` int DEFAULT NULL,
  `costume_photo` int DEFAULT NULL,
  PRIMARY KEY (`costume_id`),
  KEY `costume_FK` (`id_utilisateur`),
  KEY `costume_FK_1` (`id_theme`),
  KEY `costume_FK_2` (`costume_bandeSon`),
  KEY `costume_FK_3` (`costume_photo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `data`
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE IF NOT EXISTS `data` (
  `data_id` int NOT NULL AUTO_INCREMENT,
  `data_libelle` varchar(60) NOT NULL,
  `id_format` int NOT NULL,
  `data_lien` varchar(150) NOT NULL,
  PRIMARY KEY (`data_id`),
  KEY `Data_FK` (`id_format`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `evenement_id` varchar(10) NOT NULL,
  `evenement_nom` varchar(100) NOT NULL,
  `evenement_date` date DEFAULT NULL,
  `evenement_heureDebut` time DEFAULT NULL,
  PRIMARY KEY (`evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déclencheurs `evenement`
--
DROP TRIGGER IF EXISTS `before_insert_evenement`;
DELIMITER $$
CREATE TRIGGER `before_insert_evenement` BEFORE INSERT ON `evenement` FOR EACH ROW BEGIN

-- déclarations
DECLARE dateActuelle DATETIME DEFAULT NOW();

-- vérifier que la date et l'heure n'est pas déjà passée
IF evenement_date <= DATE(dateActuelle)
	OR evenement_heureDebut <= HOUR(dateActuelle) THEN 
	-- annule l'insertion 
	SIGNAL SQLSTATE '45100' 
    SET MESSAGE_TEXT = 'La date entrée n'est pas valide';
END IF;
	
-- met le nom de l'évènement en minuscule
SET new.evenement_nom = LOWER(new.evenement_nom);

-- définie l'identifiant de l'évènement
SET new.evenement_id = CONCAT(LEFT(new.evenement_nom, 5), YEAR(new.evenement_date));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `format`
--

DROP TABLE IF EXISTS `format`;
CREATE TABLE IF NOT EXISTS `format` (
  `format_id` int NOT NULL AUTO_INCREMENT,
  `format_libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`format_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notation`
--

DROP TABLE IF EXISTS `notation`;
CREATE TABLE IF NOT EXISTS `notation` (
  `notation_id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` varchar(10) NOT NULL,
  `notation_qualite` int NOT NULL,
  `notation_diffTechnique` int NOT NULL,
  `notation_materiaux` int NOT NULL,
  `notation_ressemblance` int NOT NULL,
  `notation_prestation` int NOT NULL,
  `notation_impressionPerso` int NOT NULL,
  `notation_coupDeCoeurJury` tinyint(1) NOT NULL,
  `notation_coupDeCoeurPublic` tinyint(1) NOT NULL,
  PRIMARY KEY (`notation_id`),
  KEY `notation_FK` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

DROP TABLE IF EXISTS `prix`;
CREATE TABLE IF NOT EXISTS `prix` (
  `id_evenement` varchar(10) NOT NULL,
  `id_notation` int NOT NULL,
  `prix_premierPrix` tinyint(1) NOT NULL,
  `prix_deuxiemePrix` tinyint(1) NOT NULL,
  `prix_troisiemePrix` tinyint(1) NOT NULL,
  `prix_premierPrixToutConcours` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_notation`,`id_evenement`),
  KEY `prix_FK_1` (`id_evenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` int NOT NULL AUTO_INCREMENT,
  `theme_libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déclencheurs `theme`
--
DROP TRIGGER IF EXISTS `before_insert_theme`;
DELIMITER $$
CREATE TRIGGER `before_insert_theme` BEFORE INSERT ON `theme` FOR EACH ROW BEGIN

SET new.theme_libelle = LOWER(new.theme_libelle);

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_theme`;
DELIMITER $$
CREATE TRIGGER `before_update_theme` BEFORE UPDATE ON `theme` FOR EACH ROW BEGIN

SET new.theme_libelle = LOWER(new.theme_libelle);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`type_id`, `type_libelle`) VALUES
(1, 'admin'),
(2, 'cosplayeur'),
(3, 'jury');

--
-- Déclencheurs `type`
--
DROP TRIGGER IF EXISTS `before_insert_type`;
DELIMITER $$
CREATE TRIGGER `before_insert_type` BEFORE INSERT ON `type` FOR EACH ROW BEGIN

SET new.type_libelle = LOWER(new.type_libelle);

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_type`;
DELIMITER $$
CREATE TRIGGER `before_update_type` BEFORE UPDATE ON `type` FOR EACH ROW BEGIN

SET new.type_libelle = LOWER(new.type_libelle);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` varchar(10) NOT NULL,
  `utilisateur_nom` varchar(60) NOT NULL,
  `utilisateur_prenom` varchar(60) NOT NULL,
  `utilisateur_dateDeNaissance` date NOT NULL,
  `utilisateur_mail` varchar(255) NOT NULL,
  `utilisateur_telephone` varchar(12) DEFAULT NULL,
  `utilisateur_ville` varchar(80) DEFAULT NULL,
  `utilisateur_login` varchar(60) NOT NULL,
  `utilisateur_motDePasse` varchar(512) NOT NULL,
  `utilisateur_accepterCharte` tinyint(1) NOT NULL,
  `utilisateur_droitImage` tinyint(1) NOT NULL,
  `id_type` int NOT NULL,
  PRIMARY KEY (`utilisateur_id`),
  KEY `utilisateur_FK_type` (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_dateDeNaissance`, `utilisateur_mail`, `utilisateur_telephone`, `utilisateur_ville`, `utilisateur_login`, `utilisateur_motDePasse`, `utilisateur_accepterCharte`, `utilisateur_droitImage`, `id_type`) VALUES
('', 'rebhuhn', 'alexis', '2004-06-10', 'mygamers999@gmail.com', '0602120802', 'Tours', 'arebhuhn', '$2y$10$l11OrH819qPxJbpzA.aAx.XWLlyxQ5FoN9bsEYwoE8efD2lHT3cja', 1, 1, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attente`
--
ALTER TABLE `attente`
  ADD CONSTRAINT `attente_FK` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`evenement_id`),
  ADD CONSTRAINT `attente_FK_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Contraintes pour la table `costume`
--
ALTER TABLE `costume`
  ADD CONSTRAINT `costume_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`utilisateur_id`),
  ADD CONSTRAINT `costume_FK_1` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`theme_id`),
  ADD CONSTRAINT `costume_FK_2` FOREIGN KEY (`costume_bandeSon`) REFERENCES `data` (`data_id`),
  ADD CONSTRAINT `costume_FK_3` FOREIGN KEY (`costume_photo`) REFERENCES `data` (`data_id`);

--
-- Contraintes pour la table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `Data_FK` FOREIGN KEY (`id_format`) REFERENCES `format` (`format_id`);

--
-- Contraintes pour la table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `notation_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`utilisateur_id`);

--
-- Contraintes pour la table `prix`
--
ALTER TABLE `prix`
  ADD CONSTRAINT `prix_FK` FOREIGN KEY (`id_notation`) REFERENCES `notation` (`notation_id`),
  ADD CONSTRAINT `prix_FK_1` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`evenement_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_FK` FOREIGN KEY (`id_type`) REFERENCES `type` (`type_id`),
  ADD CONSTRAINT `utilisateur_FK_type` FOREIGN KEY (`id_type`) REFERENCES `type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
