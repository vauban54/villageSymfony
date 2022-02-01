-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 01 fév. 2022 à 10:07
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `village_symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motif_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `civilite_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638D0EEB819` (`motif_id`),
  KEY `IDX_4C62E63839194ABF` (`civilite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `motif_id`, `nom`, `prenom`, `telephone`, `e_mail`, `content`, `civilite_id`, `created_at`) VALUES
(6, 7, 'Lapin', 'Pierrot', '0383546234', 'pierrot.lapin@gmail.com', 'Quand aura lieu le marché car je n\'ai plus de carottes ?', 3, '2022-02-01 09:54:15'),
(7, 9, 'Rabbit', 'Roger', '0625495716', 'roger.rabbit@gmail.com', 'Il faudrait ajouté un passage piéton au niveau de l\'arrêt de bus dans le quartier St Georges', 3, '2022-02-01 09:59:34'),
(8, 7, 'Frog', 'Crazy', NULL, 'crazy.frog@gmail.com', 'Quels sont les horaires d\'ouverture de la mairie ?', 3, '2022-02-01 10:02:20');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E63839194ABF` FOREIGN KEY (`civilite_id`) REFERENCES `civilite` (`id`),
  ADD CONSTRAINT `FK_4C62E638D0EEB819` FOREIGN KEY (`motif_id`) REFERENCES `motif` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
