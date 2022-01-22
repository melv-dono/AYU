-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : eu02-sql.pebblehost.com
-- Généré le :  lun. 17 jan. 2022 à 10:40
-- Version du serveur :  10.5.12-MariaDB-log
-- Version de PHP :  7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `customer_184435_ayu`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique`
--

CREATE TABLE `caracteristique` (
  `idcaracteristique` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `idequipement` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `enpanne` tinyint(1) NOT NULL,
  `etat` tinyint(1) NOT NULL,
  `numerosalle` varchar(11) NOT NULL,
  `idtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`idequipement`, `nom`, `enpanne`, `etat`, `numerosalle`, `idtype`) VALUES
(6, 'LampeB112', 0, 0, 'B112', 1);

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE `possede` (
  `numerotype` int(11) NOT NULL,
  `numerocaracteristique` int(11) NOT NULL,
  `idcaracteristique` int(11) NOT NULL,
  `idtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idreserv` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateD` datetime NOT NULL,
  `heure` datetime NOT NULL,
  `numerosalle` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idreserv`, `userid`, `dateD`, `heure`, `numerosalle`) VALUES
(1, 1, '2022-01-20 00:00:00', '2022-01-20 10:00:00', 'B112'),
(2, 1, '2022-01-20 00:00:00', '2022-01-20 11:00:00', 'B112'),
(3, 1, '2022-01-20 00:00:00', '2022-01-20 09:00:00', 'B112');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `numerosalle` varchar(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  `nbpostes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`numerosalle`, `capacite`, `nbpostes`) VALUES
('B112', 20, 20);

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `idsession` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `accesstoken` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accesstokenexpiry` date NOT NULL,
  `refreshtoken` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `refreshtokenexpiry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `idticket` int(11) NOT NULL,
  `objet` varchar(50) NOT NULL,
  `requete` text NOT NULL,
  `traite` tinyint(1) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `idtype` int(11) NOT NULL,
  `nom` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`idtype`, `nom`) VALUES
(1, 'Lampe'),
(2, 'Ordinateur'),
(3, 'Porte');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `nomutilisateur` varchar(50) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `role` enum('admin','user','prof','') NOT NULL DEFAULT 'user',
  `datecreation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userid`, `nomutilisateur`, `motdepasse`, `prenom`, `nom`, `role`, `datecreation`) VALUES
(1, 'admin', '', 'admin', 'admin', 'admin', '2021-12-07');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD PRIMARY KEY (`idcaracteristique`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`idequipement`),
  ADD KEY `fk_equipement_idtype` (`idtype`),
  ADD KEY `fk_equipement_numerosalle` (`numerosalle`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD KEY `fk_possede_idcaracteristique` (`idcaracteristique`),
  ADD KEY `fk_possede_idtype` (`idtype`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idreserv`),
  ADD KEY `fk_reservation_userid` (`userid`),
  ADD KEY `fk_reservation_numerosalle` (`numerosalle`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`numerosalle`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`idsession`),
  ADD KEY `fk_user_session` (`userid`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idticket`),
  ADD KEY `fk_tickets_user` (`userid`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idtype`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  MODIFY `idcaracteristique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `idequipement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19235;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idreserv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `idsession` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `idtype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `fk_equipement_idtype` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`),
  ADD CONSTRAINT `fk_equipement_numerosalle` FOREIGN KEY (`numerosalle`) REFERENCES `salle` (`numerosalle`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `fk_possede_idcaracteristique` FOREIGN KEY (`idcaracteristique`) REFERENCES `caracteristique` (`idcaracteristique`),
  ADD CONSTRAINT `fk_possede_idtype` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_numerosalle` FOREIGN KEY (`numerosalle`) REFERENCES `salle` (`numerosalle`),
  ADD CONSTRAINT `fk_reservation_userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_user_session` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_user` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
