-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 31 juil. 2024 à 00:30
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sci_finder`
--

-- --------------------------------------------------------

--
-- Structure de la table `sci`
--

DROP TABLE IF EXISTS `sci`;

CREATE TABLE `sci` (
  `id` int(11) NOT NULL,
  `id_sci` varchar(60) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `forme_juridique` varchar(30) DEFAULT NULL,
  `etablie_en_france` tinyint(1) DEFAULT NULL,
  `salarie_en_france` tinyint(1) DEFAULT NULL,
  `denomination` varchar(255) DEFAULT NULL,
  `date_immat` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `montant_capital` double DEFAULT NULL,
  `devise_capital` varchar(5) DEFAULT NULL,
  `date_effet_fermeture` date DEFAULT NULL,
  `code_ape` varchar(5) DEFAULT NULL,
  `file_name` varchar(60) DEFAULT NULL,
  `position_in_json` int(11) DEFAULT NULL,
  `siren` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sci`
--
ALTER TABLE `sci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sci`
--
ALTER TABLE `sci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
