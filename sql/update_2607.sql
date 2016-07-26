/*
SQLyog Community v12.15 (32 bit)
MySQL - 5.1.30-community : Database - wom_psi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wom_psi` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `wom_psi`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `pass` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`pass`) values 
('21232f297a57a5a743894a0e4a801fc3');

/*Table structure for table `kraeplinrs_mapping` */

DROP TABLE IF EXISTS `kraeplinrs_mapping`;

CREATE TABLE `kraeplinrs_mapping` (
  `kraeplin_rs` varchar(3) DEFAULT NULL,
  `kraeplin_ss` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `kraeplinrs_mapping` */

insert  into `kraeplinrs_mapping`(`kraeplin_rs`,`kraeplin_ss`) values 
('0','0'),
('1','0'),
('2','0'),
('3','0'),
('4','0'),
('5','0'),
('6','0'),
('7','0'),
('8','0'),
('9','0'),
('10','0'),
('11','0'),
('12','0'),
('13','1'),
('14','1'),
('15','1'),
('16','1'),
('17','2'),
('18','2'),
('19','2'),
('20','2'),
('21','3'),
('22','3'),
('23','3'),
('24','3'),
('25','4'),
('26','4'),
('27','4'),
('28','4'),
('29','5'),
('30','5'),
('31','5'),
('32','5'),
('33','6'),
('34','6'),
('35','6'),
('36','6'),
('37','6'),
('38','7'),
('39','7'),
('40','7'),
('41','7'),
('42','8'),
('43','8'),
('44','8'),
('45','8'),
('46','9'),
('47','9'),
('48','9'),
('49','9'),
('50','10'),
('51','10'),
('52','10'),
('53','10'),
('54','11'),
('55','11'),
('56','11'),
('57','11'),
('58','12'),
('59','12'),
('60','12'),
('61','12'),
('62','13'),
('63','13'),
('64','13'),
('65','13'),
('66','14'),
('67','14'),
('68','14'),
('69','14'),
('70','15'),
('71','15'),
('72','15'),
('73','15'),
('74','15'),
('75','16'),
('76','16'),
('77','16'),
('78','16'),
('79','17'),
('80','17'),
('81','17'),
('82','17'),
('83','18'),
('84','18'),
('85','18'),
('86','18'),
('87','19'),
('88','19'),
('89','19'),
('90','19'),
('91','20'),
('92','20'),
('93','20'),
('94','20'),
('95','20'),
('96','20'),
('97','20'),
('98','20'),
('99','20'),
('100','20'),
('101','20'),
('102','20'),
('103','20'),
('104','20'),
('105','20'),
('106','20'),
('107','20'),
('108','20'),
('109','20'),
('110','20'),
('111','20'),
('112','20'),
('113','20'),
('114','20'),
('115','20'),
('116','20'),
('117','20'),
('118','20'),
('119','20'),
('120','20');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
