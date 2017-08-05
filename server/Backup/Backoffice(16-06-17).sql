/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.7.17-log : Database - backoffice
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`backoffice` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `backoffice`;

/*Table structure for table `aip_requests` */

DROP TABLE IF EXISTS `aip_requests`;

CREATE TABLE `aip_requests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `request_data` blob NOT NULL,
  `request_method` varchar(20) DEFAULT 'N/A',
  `request_uri` varchar(255) DEFAULT 'N/A',
  `browser` varchar(100) DEFAULT 'N/A',
  `os` varchar(100) DEFAULT 'N/A',
  `user_id` int(10) DEFAULT NULL,
  `body_parems` blob,
  `timestemp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `aip_requests` */

insert  into `aip_requests`(`id`,`request_data`,`request_method`,`request_uri`,`browser`,`os`,`user_id`,`body_parems`,`timestemp`) values 
(1,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537575}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,NULL,'2017-06-15 20:09:35'),
(2,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537791}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:13:11'),
(3,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537807}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:13:27'),
(4,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537834}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:13:55'),
(5,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537855}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:14:16'),
(6,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537911}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:15:11'),
(7,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497537937}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:15:37'),
(8,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497538220}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavik@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:20:21'),
(9,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497538228}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavikgovindia@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:20:28'),
(10,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497538249}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"Bhavikgovindia@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-15 20:20:49'),
(11,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497538918}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"rahul@gmail.com\",\"pass\":\"Rahul@123\"}','2017-06-15 20:31:58'),
(12,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497539245}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"pass\":\"Rahul@123\"}','2017-06-15 20:37:25'),
(13,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497625569}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',NULL,NULL,'2017-06-16 20:36:09'),
(14,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497625627}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"email\":\"bhavikgovindia@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-16 20:37:07'),
(15,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497625637}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"Username\":\"bhavikgovindia@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-16 20:37:17'),
(16,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497625648}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"bhavikgovindia@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-16 20:37:28'),
(17,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"gbBY39aflAkEk5MaMpFhxcSilxquIvwo\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497625968}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:42:48'),
(18,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"gbBY39aflAkEk5MaMpFhxcSilxquIvwo\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626030}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:43:50'),
(19,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"gbBY39aflAkEk5MaMpFhxcSilxquIvwo\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626061}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:44:22'),
(20,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497626129}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"bhavikgovindia@gmail.com\",\"pass\":\"Bhavik@123\"}','2017-06-16 20:45:29'),
(21,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"gbBY39aflAkEk5MaMpFhxcSilxquIvwo\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626135}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',NULL,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:45:35'),
(22,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626164}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:46:04'),
(23,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626179}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:46:19'),
(24,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626221}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:47:01'),
(25,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626312}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:48:32'),
(26,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626315}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:48:35'),
(27,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626472}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:51:12'),
(28,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"HTTP_TOKEN\":\"h6JPvpbV7SAUot50aytEoIbf6QqZDiZK\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/auth\\/Register\\/RegisterUser\",\"REQUEST_TIME\":1497626503}','POST','/Backoffice/index.php/auth/Register/RegisterUser','Chrome','Windows 10',1,'{\"username\":\"Rahul369\",\"email\":\"rahul@gmail.com\",\"phone\":\"7798267704\",\"pass\":\"Rahul@123\",\"is_active\":\"1\",\"role_id\":\"3\"}','2017-06-16 20:51:43'),
(29,'{\"HTTP_ORIGIN\":\"chrome-extension:\\/\\/fhbjgbiflinjbdggehcddcbncdddomop\",\"HTTP_USER_AGENT\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/60.0.3112.24 Safari\\/537.36\",\"CONTENT_TYPE\":\"application\\/json\",\"REQUEST_SCHEME\":\"http\",\"SERVER_PROTOCOL\":\"HTTP\\/1.1\",\"REQUEST_METHOD\":\"POST\",\"QUERY_STRING\":\"\",\"REQUEST_URI\":\"\\/Backoffice\\/index.php\\/guest\\/Login\\/LoginUserById\",\"REQUEST_TIME\":1497626619}','POST','/Backoffice/index.php/guest/Login/LoginUserById','Chrome','Windows 10',NULL,'{\"username\":\"rahul@gmail.com\",\"pass\":\"Rahul@123\"}','2017-06-16 20:53:39');

/*Table structure for table `user_address` */

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address` (
  `user_id` int(10) NOT NULL,
  `line_1` varchar(30) NOT NULL,
  `line_2` varchar(30) DEFAULT NULL,
  `line_3` varchar(30) DEFAULT NULL,
  `landmark` varchar(30) DEFAULT NULL,
  `pincode` varchar(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_address` */

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

insert  into `user_master`(`user_id`,`first_name`,`middle_name`,`last_name`,`date_of_birth`,`gender`,`age`) values 
(1,'Bhavik','Shashikant','Govindia','1993-08-01','male',NULL);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user_role` */

insert  into `user_role`(`role_id`,`role`) values 
(1,'Super Admin'),
(2,'Admin'),
(3,'Super User'),
(4,'User');

/*Table structure for table `users_auth` */

DROP TABLE IF EXISTS `users_auth`;

CREATE TABLE `users_auth` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` varchar(50) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users_auth` */

insert  into `users_auth`(`user_id`,`role_id`,`email`,`phone`,`username`,`pass`,`token`,`expiry`,`is_active`,`is_deleted`,`created_date`) values 
(1,1,'bhavikgovindia@gmail.com','9769893965','Bhavik','Bhavik@123','h6JPvpbV7SAUot50aytEoIbf6QqZDiZK','2017-07-28 21:50:49',1,0,'2017-06-15 20:18:53'),
(3,3,'rahul@gmail.com','7798267704','Rahul369','Rahul@123','glARyjXHljJzLZBDQ0uTscFtJ8mU8bc0','2017-07-12 18:23:39',1,0,'2017-06-16 20:51:43');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
