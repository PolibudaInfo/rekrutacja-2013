CREATE TABLE `board` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NOW(),
  `category` varchar(30) DEFAULT '',
  `submitter` varchar(30) DEFAULT '',
  `mail` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(60) DEFAULT '',
  `notice` text,
  PRIMARY KEY (`id`)
);
