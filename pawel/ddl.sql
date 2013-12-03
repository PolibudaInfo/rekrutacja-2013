CREATE TABLE `board` (
  `id` int(8) NOT NULL,
  `date` varchar(10) DEFAULT '',
  `category` varchar(30) DEFAULT '',
  `submitter` varchar(30) DEFAULT '',
  `subject` varchar(60) DEFAULT '',
  `notice` varchar(200) DEFAULT '',
  `mail` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
