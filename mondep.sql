-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 14 mai 2022 à 19:56
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mondep`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Nom` varchar(255) NOT NULL,
  `Admin_Email` varchar(255) NOT NULL,
  `Admin_Pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Nom`, `Admin_Email`, `Admin_Pass`) VALUES
(1, 'admin', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `Etu_ID` int(11) NOT NULL,
  `Etu_Nom` varchar(255) NOT NULL,
  `Etu_Prenom` varchar(255) NOT NULL,
  `Etu_Nis` date NOT NULL,
  `Etu_Bac` int(11) NOT NULL,
  `Etu_Avatar` varchar(255) NOT NULL,
  `Spe_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `mep`
--

CREATE TABLE `mep` (
  `MEP_ID` int(11) NOT NULL,
  `Mod_ID` int(11) NOT NULL,
  `Prof_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `Mod_ID` int(11) NOT NULL,
  `Mod_Nom` varchar(255) NOT NULL,
  `Mod_Coef` int(11) NOT NULL,
  `Mod_Credit` int(11) NOT NULL,
  `Spe_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE `prof` (
  `Prof_ID` int(11) NOT NULL,
  `Prof_Nom` varchar(255) NOT NULL,
  `Prof_Prenom` varchar(255) NOT NULL,
  `Prof_Email` varchar(255) NOT NULL,
  `Prof_Pass` varchar(255) NOT NULL,
  `Prof_Avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `Spe_ID` int(11) NOT NULL,
  `Spe_Nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_module`
--

CREATE TABLE `suivi_module` (
  `Suivi_ID` int(11) NOT NULL,
  `Note` float DEFAULT NULL,
  `Nb_Absences` int(11) NOT NULL DEFAULT 0,
  `Mod_ID` int(11) NOT NULL,
  `Etu_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`Etu_ID`),
  ADD KEY `Spe_ID` (`Spe_ID`);

--
-- Index pour la table `mep`
--
ALTER TABLE `mep`
  ADD PRIMARY KEY (`MEP_ID`),
  ADD KEY `Mod_ID` (`Mod_ID`),
  ADD KEY `Prof_ID` (`Prof_ID`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`Mod_ID`),
  ADD KEY `Spe_ID` (`Spe_ID`);

--
-- Index pour la table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`Prof_ID`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`Spe_ID`);

--
-- Index pour la table `suivi_module`
--
ALTER TABLE `suivi_module`
  ADD PRIMARY KEY (`Suivi_ID`),
  ADD KEY `Etu_ID` (`Etu_ID`),
  ADD KEY `Mod_ID` (`Mod_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `Etu_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `mep`
--
ALTER TABLE `mep`
  MODIFY `MEP_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `Mod_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `prof`
--
ALTER TABLE `prof`
  MODIFY `Prof_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `Spe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `suivi_module`
--
ALTER TABLE `suivi_module`
  MODIFY `Suivi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`Spe_ID`) REFERENCES `specialite` (`Spe_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mep`
--
ALTER TABLE `mep`
  ADD CONSTRAINT `mep_ibfk_1` FOREIGN KEY (`Mod_ID`) REFERENCES `module` (`Mod_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mep_ibfk_2` FOREIGN KEY (`Prof_ID`) REFERENCES `prof` (`Prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`Spe_ID`) REFERENCES `specialite` (`Spe_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivi_module`
--
ALTER TABLE `suivi_module`
  ADD CONSTRAINT `suivi_module_ibfk_1` FOREIGN KEY (`Etu_ID`) REFERENCES `etudiant` (`Etu_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suivi_module_ibfk_2` FOREIGN KEY (`Mod_ID`) REFERENCES `module` (`Mod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
