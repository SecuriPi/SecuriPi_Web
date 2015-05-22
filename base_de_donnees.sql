--
-- Base de données :  `SecuriPi`
--

-- --------------------------------------------------------

--
-- Structure de la table `Cameras`
--

CREATE TABLE IF NOT EXISTS `Cameras` (
	`ID` int(5) NOT NULL,
	`ID_Client` int(5) NOT NULL,
	`Nom` varchar(50) NOT NULL,
	`Emplacement` varchar(50) NOT NULL,
	`IP` varchar(20) NOT NULL,
	`Port` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE IF NOT EXISTS `Clients` (
	`ID` int(11) NOT NULL,
	`Nom` varchar(50) NOT NULL,
	`Prenom` varchar(50) NOT NULL,
	`Login` varchar(50) NOT NULL,
	`Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Clients`
--

INSERT INTO `Clients` (`ID`, `Nom`, `Prenom`, `Login`, `Password`) VALUES
(1, 'Dabre', 'Thomas', 'thomas', MD5('P@ssword'));

-- --------------------------------------------------------

--
-- Structure de la table `Connexions`
--

CREATE TABLE IF NOT EXISTS `Connexions` (
	`ID` int(5) NOT NULL,
	`ID_Client` int(5) NOT NULL,
	`Date` date NOT NULL,
	`Heure` time NOT NULL,
	`IP` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour la table `Cameras`
--
ALTER TABLE `Cameras` ADD PRIMARY KEY (`ID`,`ID_Client`), ADD KEY `ID_Client` (`ID_Client`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients` ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Connexions`
--
ALTER TABLE `Connexions` ADD PRIMARY KEY (`ID`,`ID_Client`), ADD KEY `ID_Client` (`ID_Client`);

--
-- AUTO_INCREMENT pour la table `Cameras`
--
ALTER TABLE `Cameras` MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour la table `Cameras`
--
ALTER TABLE `Cameras` ADD CONSTRAINT `Cameras_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `Clients` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `Connexions`
--
ALTER TABLE `Connexions` ADD CONSTRAINT `Connexions_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `Clients` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
