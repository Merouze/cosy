-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 nov. 2023 à 14:43
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
-- Base de données : `dtcosycaen`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `message_client` varchar(500) DEFAULT NULL,
  `mail_client` varchar(60) DEFAULT NULL,
  `telephone_client` varchar(20) DEFAULT NULL,
  `adresse_client` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_prenom`, `message_client`, `mail_client`, `telephone_client`, `adresse_client`) VALUES
(1, 'Doe', 'Bonjour', 'john.doe@example.com', '0634567890', '123 Main '),
(2, 'Smith', 'Bienvenue', 'jane.smith@example.com', '0676543210', '456 Oak '),
(3, 'Johnson', 'Salut', 'bob.johnson@example.com', '0651234567', '789 Elm '),
(4, 'AUrelien', 'Message du client', 'mail@example.com', '0123456789', NULL),
(5, 'Damien', 'Message du client', 'mail@example.com', '0123456789', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int NOT NULL AUTO_INCREMENT,
  `nom_logement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_logement`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `nom_logement`) VALUES
(1, 'ZénitHouse'),
(2, 'Cosy Zénith'),
(3, 'Cosy Gare');

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

DROP TABLE IF EXISTS `prix`;
CREATE TABLE IF NOT EXISTS `prix` (
  `id_client` int NOT NULL,
  `id_reservation` int NOT NULL,
  `prix_total` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_client`,`id_reservation`),
  KEY `id_reservation` (`id_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prix_logement`
--

DROP TABLE IF EXISTS `prix_logement`;
CREATE TABLE IF NOT EXISTS `prix_logement` (
  `id_prix_logement` int NOT NULL AUTO_INCREMENT,
  `prix` decimal(8,2) DEFAULT NULL,
  `id_logement` int DEFAULT NULL,
  `id_saison` int DEFAULT NULL,
  PRIMARY KEY (`id_prix_logement`),
  KEY `id_logement` (`id_logement`),
  KEY `id_saison` (`id_saison`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `prix_logement`
--

INSERT INTO `prix_logement` (`id_prix_logement`, `prix`, `id_logement`, `id_saison`) VALUES
(1, '80.00', 1, 1),
(2, '60.00', 2, 1),
(3, '50.00', 3, 1),
(4, '100.00', 1, 2),
(5, '80.00', 2, 2),
(6, '70.00', 3, 2),
(7, '120.00', 1, 3),
(8, '100.00', 2, 3),
(9, '90.00', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `id_logement` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_logement` (`id_logement`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_debut`, `date_fin`, `id_logement`) VALUES
(1, '2023-01-01', '2023-01-10', 1),
(2, '2023-02-01', '2023-02-10', 1),
(3, '2023-03-01', '2023-03-10', 1),
(4, '2023-01-01', '2023-01-10', 2),
(5, '2023-02-15', '2023-02-10', 2),
(6, '2023-03-15', '2023-03-10', 2),
(7, '2023-01-20', '2023-01-10', 3),
(8, '2023-02-20', '2023-02-10', 3),
(9, '2023-03-20', '2023-03-10', 3);

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `id_saison` int NOT NULL AUTO_INCREMENT,
  `type_saison` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_saison`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`id_saison`, `type_saison`) VALUES
(1, 'Basse Saison'),
(2, 'Moyenne Saison'),
(3, 'Haute Saison');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


















-- SELECT 
--         reservation.id_reservation,
--         reservation.date_debut,
--         reservation.date_fin,
--         reservation.nombre_nuit,
--         logement.nom_logement,
--         client.nom_prenom,
--         client.telephone_client,
--         client.mail_client,
--         client.adresse_client
--     FROM 
--         reservation
--     INNER JOIN
--         client ON reservation.id_client = client.id_client
--     INNER JOIN
--         logement ON reservation.id_logement = logement.id_logement
--     ORDER BY
--         reservation.date_debut DESC
        