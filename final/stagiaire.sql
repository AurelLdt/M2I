-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 21 avr. 2021 à 14:08
-- Version du serveur :  10.5.9-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exam_m2i`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'matthieumota@gmail.com', '$2y$10$jdyPAl1wQod4Ycy5CoJkpudpqu3Fge//4/bNz41gxf644og/lMYii');

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `name`) VALUES
(1, 'html'),
(2, 'php'),
(3, 'javascript'),
(4, 'css'),
(5, 'sql');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `created_at`, `name`, `phone`, `birthday`) VALUES
(1, '2021-04-21 10:38:28', 'Fiorella', '0638635153', '2014-09-01'),
(2, '2021-04-21 10:38:28', 'Marina', '0627133410', '2014-11-07'),
(3, '2021-04-21 10:38:28', 'Matthieu', '0682344281', '2002-04-09'),
(9, '2021-04-21 00:00:00', 'Toto', '0123456789', '2021-04-21'),
(10, '2021-04-21 00:00:00', 'Tata', '0123456789', '2021-04-21'),
(11, '2021-04-21 00:00:00', 'Titi', '0123456789', '2021-04-21'),
(12, '2021-04-21 00:00:00', 'Titi2', '0123456789', '2021-04-21');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire_a_competence`
--

CREATE TABLE `stagiaire_a_competence` (
  `stagiaire_id` int(11) NOT NULL,
  `competence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stagiaire_a_competence`
--

INSERT INTO `stagiaire_a_competence` (`stagiaire_id`, `competence_id`) VALUES
(9, 1),
(9, 4),
(10, 2),
(10, 4),
(11, 3),
(11, 5),
(12, 3),
(12, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stagiaire_a_competence`
--
ALTER TABLE `stagiaire_a_competence`
  ADD KEY `competence_id` (`competence_id`),
  ADD KEY `stagiaire_id` (`stagiaire_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `stagiaire_a_competence`
--
ALTER TABLE `stagiaire_a_competence`
  ADD CONSTRAINT `stagiaire_a_competence_ibfk_1` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`),
  ADD CONSTRAINT `stagiaire_a_competence_ibfk_2` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
