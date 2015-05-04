CREATE TABLE IF NOT EXISTS `Cameras` (
  `ID` int(5) NOT NULL,
  `ID_Client` int(5) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Emplacement` varchar(50) NOT NULL,
  `IP` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Clients` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `Connexions` (
  `ID` int(5) NOT NULL,
  `ID_Client` int(5) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `IP` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Cameras` ADD PRIMARY KEY (`ID`,`ID_Client`), ADD KEY `ID_Client` (`ID_Client`);
ALTER TABLE `Cameras` ADD CONSTRAINT `Cameras_fk` FOREIGN KEY (`ID_Client`) REFERENCES `Clients` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `Clients` ADD PRIMARY KEY (`ID`);

ALTER TABLE `Connexions` ADD PRIMARY KEY (`ID`,`ID_Client`), ADD KEY `ID_Client` (`ID_Client`);
ALTER TABLE `Connexions` ADD CONSTRAINT `Connexions_fk` FOREIGN KEY (`ID_Client`) REFERENCES `Clients` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
