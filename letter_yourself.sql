/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 8.0.23 : Database - letter_yourself
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`letter_yourself` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `letter_yourself`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_account_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`name`,`status`,`created_at`) values 
(1,'suleyman_oner','ACTIVE','2021-03-11 11:11:08'),
(10,'ali_akcam','ACTİVE','2021-03-27 01:14:39'),
(11,'huseyin_gulecen','ACTİVE','2021-03-25 01:14:58'),
(12,'furkan_erkan','ACTİVE','2021-03-28 01:15:12'),
(13,'mucahit_basyigit','ACTİVE','2021-03-19 01:15:37'),
(14,'oguzhan_tılısım','ACTİVE','2021-03-22 01:15:49'),
(46,'suleymanoner','ACTIVE','2021-05-12 17:36:25'),
(64,'sdasad','ACTIVE','2021-05-19 10:50:04');

/*Table structure for table `communication` */

DROP TABLE IF EXISTS `communication`;

CREATE TABLE `communication` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `letter_id` int unsigned NOT NULL,
  `receiver_id` int unsigned NOT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_communication_letter_id` (`letter_id`),
  KEY `fk_communication_receiver_id` (`receiver_id`),
  KEY `fk_communication_account_id` (`account_id`),
  CONSTRAINT `fk_communication_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `fk_communication_letter_id` FOREIGN KEY (`letter_id`) REFERENCES `letter` (`id`),
  CONSTRAINT `fk_communication_receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `receiver` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `communication` */

insert  into `communication`(`id`,`letter_id`,`receiver_id`,`account_id`) values 
(33,45,67,46),
(34,46,68,46),
(35,47,69,46),
(36,48,70,46),
(37,47,71,46),
(38,50,72,46),
(39,51,73,46),
(40,47,74,46),
(41,53,75,46),
(42,54,76,46),
(43,55,77,46),
(44,56,78,46);

/*Table structure for table `letter` */

DROP TABLE IF EXISTS `letter`;

CREATE TABLE `letter` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_bin,
  `created_at` datetime NOT NULL,
  `send_at` datetime NOT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_letter_account_id` (`account_id`),
  CONSTRAINT `fk_letter_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `letter` */

insert  into `letter`(`id`,`title`,`body`,`created_at`,`send_at`,`account_id`) values 
(45,'edited','aaaceq','2021-06-25 14:07:55','2021-07-30 12:33:00',46),
(46,'edited2','edited2','2021-06-25 14:10:03','2021-08-26 12:35:00',46),
(47,'edited3','edited3','2021-06-25 23:01:48','2021-09-23 12:36:00',46),
(48,'new2','ssss','2021-06-25 23:05:56','2021-06-26 01:05:00',46),
(49,'aaaaaaaa','sqwq','2021-06-25 23:06:36','2222-02-23 23:02:00',46),
(50,'vvv','ccccc','2021-06-25 23:07:02','2021-06-26 01:06:00',46),
(51,'aaaz','scsad','2021-06-25 23:07:26','2021-06-26 01:07:00',46),
(52,'aaaaaaaa','casdcas','2021-06-25 23:07:49','2021-06-26 01:07:00',46),
(53,'ccc','zxcv','2021-06-25 23:08:12','2021-06-26 01:08:00',46),
(54,'cxazac','caxxaz','2021-06-25 23:08:33','2021-06-26 01:08:00',46),
(55,'aasdx','casdasd','2021-06-25 23:08:52','2021-06-26 01:08:00',46),
(56,'adsadasd','asdasd','2021-06-25 23:30:34','2021-06-26 01:30:00',46);

/*Table structure for table `persons` */

DROP TABLE IF EXISTS `persons`;

CREATE TABLE `persons` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `surname` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'PENDING',
  `role` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'USER',
  `created_at` timestamp NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `token_created_at` timestamp NULL DEFAULT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_person_email` (`email`),
  KEY `fk_person_account` (`account_id`),
  CONSTRAINT `fk_person_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `persons` */

insert  into `persons`(`id`,`name`,`surname`,`email`,`password`,`status`,`role`,`created_at`,`token`,`token_created_at`,`account_id`) values 
(1,'Suleyman','Oner','suleyman@galp.com','1234','PENDING','USER','0000-00-00 00:00:00',NULL,NULL,1),
(2,'Ali','Akcam','alihan@galp.com','12345','PENDING','USER','0000-00-00 00:00:00',NULL,NULL,10),
(3,'Huseyin','Gulecen','huseyin@galp.com','9900','PENDING','USER','0000-00-00 00:00:00',NULL,NULL,11),
(4,'Furkan','Erkan','furkan@galp.com','8798','PENDING','USER','0000-00-00 00:00:00',NULL,NULL,12),
(5,'Mucahit','Basyigit','mucahit@galp.com','190707','ACTIVE','USER','2021-03-20 10:18:48','44ef1893d526ef447c4acf9ef2547703',NULL,13),
(6,'Oguz','Tılısım','oguz@galp.com','0071907','PENDING','USER','2021-03-25 19:28:46','d1bd01c64ecb67f734aac86dac0e14b2',NULL,14),
(24,'Suleyman','Oner','suleymanoner1999@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','ACTIVE','USER','2021-05-12 17:36:25',NULL,NULL,46),
(39,'adsasd','adasd','suyo571oner@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','ACTIVE','USER','2021-05-19 10:50:04',NULL,NULL,64);

/*Table structure for table `receiver` */

DROP TABLE IF EXISTS `receiver`;

CREATE TABLE `receiver` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `receiver_email` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `receiver` */

insert  into `receiver`(`id`,`receiver_email`) values 
(67,'edited@galp.com'),
(68,'edited2@galp.com'),
(69,'edited3@galp.com'),
(70,'ss@gapl.com'),
(71,'daqs@gapl.com'),
(72,'ccc@galp.com'),
(73,'saqw@gapl.com'),
(74,'swqas@gapl.com'),
(75,'zxcas@gapl.com'),
(76,'czqwas@gapl.com'),
(77,'weweqas@gapl.com'),
(78,'xert@gapl.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
