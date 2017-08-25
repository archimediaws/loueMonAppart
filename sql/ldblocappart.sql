CREATE DATABASE locappart;
CREATE TABLE `categories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;



INSERT INTO `categories` VALUES (1,'studio'),(2,'T1'),(3,'T2'),(4,'T3'),(5,'T4');

CREATE TABLE `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8


CREATE TABLE `annonce` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `poster_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date_post` datetime DEFAULT NULL,
  `category_id` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poster_id` (`poster_id`),
  KEY `post_ibfk_2_idx` (`category_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`poster_id`) REFERENCES `user` (`id`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


INSERT INTO `annonce` VALUES (1,1,'loue studio','Bonjour,\r\n \r\nJe loue unstudio avec vue sur mer le week-end ou le soir \r\n \r\nJe souhaite apprendre à programmer en Java pour développer des applications voire application Android.\r\n \r\nMerci','2017-06-28 20:16:44',1),(2,1,'Groupe programmation Android','Bonjour,\r\n \r\nJe suis à la recherche d\'un groupe/club ou formation de programmation avec des sessions le week-end ou le soir ?\r\n \r\nJe souhaite apprendre à programmer en Java pour développer des applications voire application Android.\r\n \r\nMerci','2017-07-10 20:21:06',1),(3,1,'Search Android Partner and PHP','I am looking to team up with an android expert able to do amazing things with a mobile phone','2017-07-18 23:56:54',2);
