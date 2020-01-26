CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `username` varchar(45) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` enum('NEW','VERIFIED','DISABLED') NOT NULL DEFAULT 'NEW',
  `user_type` enum('STUDENT','ACDSTAFF','LIBRARIAN') NOT NULL DEFAULT 'STUDENT',
  `sign_up_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(7) NOT NULL,
  `examination_year` varchar(11) NOT NULL,
  `url` text NOT NULL,
  `uploader` int(11) NOT NULL,
  `uploaded_on` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_papers_user1_idx` (`uploader`),
  CONSTRAINT `fk_papers_user1` FOREIGN KEY (`uploader`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `name`, `username`, `nic`, `password`, `status`, `user_type`, `sign_up_date`) VALUES
	(1, 'Librarian', 'admin', '000000000V', '$2y$10$awdU6Qp1AGPH6yei/sBTXO5u6ENpRmk/pG73T5CtbTsJaxsLnPS9O', 'VERIFIED', 'LIBRARIAN', '2020-01-25');