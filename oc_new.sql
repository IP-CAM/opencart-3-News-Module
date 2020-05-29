USE opencart_tp1;

DROP TABLE IF EXISTS `ocy6_news`;
CREATE TABLE `ocy6_news` (
  `id_new` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `news` varchar(100) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_new`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO ocy6_news (title, news, author) VALUES ('Les jambons', 'le forest noir cest le meilleur!','Samus'), ('Mes Articles.', 'les articles sur la Nes', 'Samus');