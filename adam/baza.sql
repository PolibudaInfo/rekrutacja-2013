CREATE TABLE IF NOT EXISTS `ogloszenia` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`ID`)
);