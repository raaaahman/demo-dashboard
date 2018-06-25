-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 25 Juin 2018 à 20:43
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `demo-dashboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `langage`
--

CREATE TABLE `langage` (
  `id_langage` tinyint(3) UNSIGNED NOT NULL,
  `nom_langage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `langage`
--

INSERT INTO `langage` (`id_langage`, `nom_langage`) VALUES
(1, 'PhP'),
(2, 'ASP'),
(3, 'JavaScript'),
(4, 'HTML'),
(5, 'CSS');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id_niveau` tinyint(3) UNSIGNED NOT NULL,
  `description_niveau` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `description_niveau`) VALUES
(1, 'Je suis une grosse quiche, je ne comprends rien à l\'informatique'),
(2, 'Je suis un vrai geek, j\'explique tout à ma mère');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `code_pays` varchar(2) NOT NULL,
  `nom_pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`code_pays`, `nom_pays`) VALUES
('ar', 'Argentine'),
('bb', 'Barbade'),
('bd', 'Bangladesh'),
('be', 'Belgique'),
('bj', 'Bénin'),
('ch', 'Suisse'),
('de', 'Allemagne'),
('es', 'Espagne'),
('fr', 'France'),
('it', 'Italie'),
('jp', 'Japon'),
('kh', 'Cambodge'),
('km', 'Comores');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `identifiant_utilisateur` int(7) UNSIGNED NOT NULL,
  `civilite` enum('M.','Mlle','Mme') NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `adresse_complement` varchar(100) NOT NULL,
  `mot_de_passe` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `abonnement_newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `pref_accept_conditions` tinyint(1) DEFAULT '0',
  `pref_heure_repas` time NOT NULL,
  `date_dispo` date NOT NULL,
  `motivation` enum('0','10','20','30','40','50','60','70','80','90','100') NOT NULL DEFAULT '50',
  `biographie` blob NOT NULL,
  `philosophie` blob NOT NULL,
  `code_commune_insee_ville` varchar(15) NOT NULL,
  `id_langage_langage` tinyint(3) UNSIGNED NOT NULL,
  `id_niveau_niveau` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `code_commune_insee` varchar(15) NOT NULL,
  `code_postal` varchar(15) NOT NULL,
  `nom_ville` varchar(80) NOT NULL,
  `code_pays_pays` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`code_commune_insee`, `code_postal`, `nom_ville`, `code_pays_pays`) VALUES
('000', '00000', 'Metropolis', 'xx'),
('00652', '1200', 'Genève', 'ch'),
('055', '13000', 'Marseille', 'fr'),
('056', '75000', 'Paris', 'fr'),
('085', '06250', 'Mougins', 'fr'),
('088', '06000', 'Nice', 'fr'),
('280', '28000', 'Madrid', 'es');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `langage`
--
ALTER TABLE `langage`
  ADD PRIMARY KEY (`id_langage`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`code_pays`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`identifiant_utilisateur`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`code_commune_insee`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `langage`
--
ALTER TABLE `langage`
  MODIFY `id_langage` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id_niveau` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `identifiant_utilisateur` int(7) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
