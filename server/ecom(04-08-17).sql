/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.7.17-log : Database - ecom
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ecom` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ecom`;

/*Table structure for table `aip_requests` */

DROP TABLE IF EXISTS `aip_requests`;

CREATE TABLE `aip_requests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `request_data` blob NOT NULL,
  `request_method` varchar(20) DEFAULT 'N/A',
  `request_uri` varchar(255) DEFAULT 'N/A',
  `remote_addr` varchar(255) DEFAULT 'N/A',
  `server_addr` varchar(255) DEFAULT 'N/A',
  `mac` varchar(50) DEFAULT 'N/A',
  `browser` varchar(100) DEFAULT 'N/A',
  `os` varchar(100) DEFAULT 'N/A',
  `user_token` varchar(100) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `body_parems` blob,
  `timestemp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `aip_requests` */

/*Table structure for table `buyer_master` */

DROP TABLE IF EXISTS `buyer_master`;

CREATE TABLE `buyer_master` (
  `user_id` int(10) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `buyer_name` varchar(50) DEFAULT NULL,
  `position_in_company` varchar(50) DEFAULT NULL,
  `alternate_number` bigint(10) DEFAULT NULL,
  `total_num_of_employees` int(10) DEFAULT NULL,
  `total_annual_revenue` int(10) DEFAULT NULL,
  `year_of_establishment` year(4) DEFAULT NULL,
  `frequency_of_requirement` enum('monthly','quarterly','yearly') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pincode` int(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `buyer_master` */

insert  into `buyer_master`(`user_id`,`company_name`,`buyer_name`,`position_in_company`,`alternate_number`,`total_num_of_employees`,`total_annual_revenue`,`year_of_establishment`,`frequency_of_requirement`,`address`,`pincode`,`city`,`state`,`country`,`is_deleted`,`deleted_by`,`updated_by`,`created_by`,`deleted_date`,`updated_date`,`created_date`) values 
(1,'margosatree','Bhavik','HOD',9898989898,1,1,2017,'monthly','103 Krishna',401202,'Thane','Maharashtra','India',0,NULL,1,1,NULL,'2017-08-05 01:12:01','2017-08-05 01:11:32');

/*Table structure for table `category_master` */

DROP TABLE IF EXISTS `category_master`;

CREATE TABLE `category_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `category_master` */

insert  into `category_master`(`id`,`parent_id`,`type_id`,`product_name`,`desc`) values 
(1,0,0,'root','root'),
(2,1,1,'Men\'s Fashion',NULL),
(3,1,1,'Beauty, Health, Grocery',NULL),
(4,1,1,'Books',NULL),
(5,1,1,'Women\'s Fashion',NULL),
(6,1,1,'Sports, Fitness, Bags, Luggage',NULL),
(7,2,2,'Clothing',NULL),
(8,2,2,'T-shirts & Polos',NULL),
(9,2,2,'Shirts',NULL),
(10,2,2,'Jeans',NULL),
(11,2,2,'Innerwear',NULL),
(12,2,2,'Watches',NULL),
(13,3,2,'Beauty & Grooming',NULL),
(14,3,2,'Luxury Beauty',NULL),
(15,3,2,'Make-up',NULL),
(16,3,2,'Health & Personal Care',NULL),
(17,3,2,'Household Supplies',NULL),
(18,4,2,'All Books',NULL),
(19,4,2,'Fiction Books',NULL),
(20,4,2,'Editor\'s Corner',NULL),
(21,4,2,'School Textbooks',NULL),
(22,4,2,'Children\'s Books',NULL),
(23,5,2,'Clothing',NULL),
(24,5,2,'Western Wear',NULL),
(25,5,2,'Ethnic Wear',NULL),
(26,5,2,'Lingerie & Nightwear',NULL),
(27,5,2,'Top Brands',NULL),
(28,6,2,'Cricket',NULL),
(29,6,2,'Badminton',NULL),
(30,6,2,'Cycling',NULL),
(31,6,2,'Football',NULL),
(32,6,2,'Running',NULL),
(33,1,1,'Electronic',NULL),
(34,33,2,'Storage',NULL),
(35,34,3,'Pendrive',NULL);

/*Table structure for table `product_master` */

DROP TABLE IF EXISTS `product_master`;

CREATE TABLE `product_master` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `tag_id` int(10) NOT NULL,
  PRIMARY KEY (`id`,`category_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `product_master` */

insert  into `product_master`(`id`,`category_id`,`tag_id`) values 
(1,2,9),
(2,35,12),
(3,35,13),
(4,35,14),
(4,35,15);

/*Table structure for table `product_seller` */

DROP TABLE IF EXISTS `product_seller`;

CREATE TABLE `product_seller` (
  `id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `price` double(20,4) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `product_seller` */

insert  into `product_seller`(`id`,`seller_id`,`product_id`,`code`,`price`,`quantity`) values 
(1,1,1,'ABCD',100.0000,10),
(2,1,1,'ABCDE',95.0000,20),
(3,1,4,'SENPEN',100.0000,2),
(4,2,1,'ACDS',100.0000,10);

/*Table structure for table `seller_master` */

DROP TABLE IF EXISTS `seller_master`;

CREATE TABLE `seller_master` (
  `user_id` int(10) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `owner_employee` varchar(50) DEFAULT NULL,
  `position_in_company` varchar(50) DEFAULT NULL,
  `alternate_number` bigint(10) DEFAULT NULL,
  `type_of_seller` enum('manufacturer','wholesaler') DEFAULT NULL,
  `total_num_of_employees` int(10) DEFAULT NULL,
  `total_annual_revenue` int(10) DEFAULT NULL,
  `year_of_establishment` year(4) DEFAULT NULL,
  `product_list` varchar(255) DEFAULT NULL,
  `company_registration_doc` varchar(255) DEFAULT NULL,
  `gst_registration_doc` varchar(255) DEFAULT NULL,
  `license_doc` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pincode` int(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `complete_percentage` int(10) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `deleted_by` int(10) DEFAULT NULL,
  `updated_by` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `seller_master` */

insert  into `seller_master`(`user_id`,`company_name`,`owner_employee`,`position_in_company`,`alternate_number`,`type_of_seller`,`total_num_of_employees`,`total_annual_revenue`,`year_of_establishment`,`product_list`,`company_registration_doc`,`gst_registration_doc`,`license_doc`,`address`,`pincode`,`city`,`state`,`country`,`complete_percentage`,`is_deleted`,`deleted_by`,`updated_by`,`created_by`,`deleted_date`,`updated_date`,`created_date`) values 
(2,'margosatree','Bhavik','Head',9898989898,'manufacturer',1,1,2017,'Head','YPVNRrESuQbX1SwL9A53aoMZ9VHnqDwcvV2NYOResRXPLoSk0Wvj85lB9hgMn6Xp.jpg','Hx3V779UyRqhAUNeR94I8tLgwdHVtEk4KgY2X1yXeowaF0hjCPIbLTN8Ddn4uj1Y.jpg','4AMIJraoqt8irytPHl5poWxYjzGgTRmtlSZFNimV71SjZrxocPRtc0y29260i0ay.jpg','Surani',401202,'Thane','Maharashtra','India',NULL,0,NULL,2,2,NULL,'2017-08-05 01:46:05','2017-08-05 01:38:00');

/*Table structure for table `tag_master` */

DROP TABLE IF EXISTS `tag_master`;

CREATE TABLE `tag_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `tag_master` */

insert  into `tag_master`(`id`,`tag`) values 
(1,'half sleves '),
(2,'red colour'),
(3,'round neck'),
(4,'prined'),
(5,'polot-shirt'),
(6,'ucb'),
(7,'woodland'),
(8,'john player'),
(9,'zara'),
(10,'lee cooper'),
(11,'pape'),
(12,'16 gb'),
(13,'64 gb'),
(14,'128 gb '),
(15,'sandisk'),
(16,'trans'),
(17,'philips'),
(18,'dell'),
(19,'hp'),
(20,'techmax'),
(21,'willy'),
(22,'tech book'),
(23,'school book'),
(24,'health book'),
(25,'notebook'),
(26,'bat'),
(27,'ball'),
(28,'mrf');

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `test` */

insert  into `test`(`id`,`first_name`,`last_name`) values 
(1,'Bhavik','govindia'),
(2,'n','b'),
(3,'n','b');

/*Table structure for table `user_address` */

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `user_id` int(10) NOT NULL,
  `line` varchar(30) NOT NULL,
  `landmark` varchar(30) DEFAULT NULL,
  `pincode` varchar(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_address` */

/*Table structure for table `user_auth` */

DROP TABLE IF EXISTS `user_auth`;

CREATE TABLE `user_auth` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` varchar(200) NOT NULL,
  `token` varchar(32) NOT NULL,
  `expiry` datetime DEFAULT NULL,
  `expiry_millies` bigint(20) DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_ban` tinyint(1) NOT NULL DEFAULT '0',
  `fail_attempt` int(10) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `user_auth` */

insert  into `user_auth`(`user_id`,`role_id`,`email`,`phone`,`username`,`pass`,`token`,`expiry`,`expiry_millies`,`is_email_verified`,`is_phone_verified`,`is_admin_verified`,`is_active`,`is_deleted`,`is_ban`,`fail_attempt`,`deleted_date`,`updated_date`,`created_date`) values 
(1,3,'bhavik6999@gmail.com',9769893965,'Bhavikgo','$2a$10$/B6/0x517/M.JdCe07W4geDCqKLZZg1UEk/b2eh5n/6LqU7.KjZfe','X2UQ1NkO0VBkFVPVQt6UmgYv88nZ8krB','2017-08-05 04:29:43',1501887583000,1,1,0,1,0,0,0,NULL,'2017-08-05 01:06:31','0000-00-00 00:00:00'),
(2,4,'bhavikgovindia@gmail.com',9769893966,'Bhavik','$2a$10$nk.L4X1IH0mdIHhG0KrjX.dIYBdjIRWy7spe3iyM239k25zdnf/kO','0veK37IqicHzY6f3WBGlQhFKXB3I5WrS','2017-08-05 04:31:51',1501887711000,1,1,0,1,0,0,0,NULL,'2017-08-05 01:31:05','0000-00-00 00:00:00');

/*Table structure for table `user_auth_virtual` */

DROP TABLE IF EXISTS `user_auth_virtual`;

CREATE TABLE `user_auth_virtual` (
  `guest_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `user_auth_virtual` */

/*Table structure for table `user_master` */

DROP TABLE IF EXISTS `user_master`;

CREATE TABLE `user_master` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_master` */

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  `prifix` varchar(10) NOT NULL,
  `prifix_long` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user_role` */

insert  into `user_role`(`role_id`,`role`,`prifix`,`prifix_long`) values 
(1,'Super Admin','SA','SuperAdmin'),
(2,'Admin','A','Admin'),
(3,'Buyer','B','Buyer'),
(4,'Seller','S','Seller');

/*Table structure for table `user_verify` */

DROP TABLE IF EXISTS `user_verify`;

CREATE TABLE `user_verify` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `guest_id` int(10) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_otp` varchar(25) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `phone_otp` varchar(25) DEFAULT NULL,
  `prifix` tinyint(1) NOT NULL COMMENT '1 = Reg, 2 = Forgot, 3 = Reset',
  `expiry_millies` bigint(20) NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user_verify` */

insert  into `user_verify`(`id`,`guest_id`,`token`,`email`,`email_otp`,`phone`,`phone_otp`,`prifix`,`expiry_millies`,`created_date`) values 
(2,NULL,'EFmO6u6DlSN9ZTFH7As52XZTYDrC5AKJ','bhavik6999@gmail.com','37512896',NULL,NULL,2,1501887214000,'2017-08-05 01:23:34'),
(3,NULL,'X0NZI694sqjziYNxFHv5n2RsZN67pPyk','bhavik6999@gmail.com','97335800',NULL,NULL,2,1501887397000,'2017-08-05 01:26:37');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
