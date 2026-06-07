# ************************************************************
# Sequel Ace SQL dump
# Version 20095
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.5.5-10.4.21-MariaDB)
# Database: leave_management
# Generation Time: 2026-06-07 09:03:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table audit_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `audit_logs`;

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_audit_user` (`user_id`),
  CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;

INSERT INTO `audit_logs` (`id`, `user_id`, `activity`, `created_at`)
VALUES
	(1,13,'User Logged In','2026-06-07 13:04:46'),
	(2,13,'Applied Leave Request','2026-06-07 13:05:08'),
	(3,5,'User Logged In','2026-06-07 13:20:08'),
	(4,5,'User Logged In','2026-06-07 13:21:38'),
	(5,5,'Rejected Leave ID 12','2026-06-07 13:21:50'),
	(6,5,'Approved Leave ID 8','2026-06-07 13:30:13'),
	(7,5,'Approved Leave ID 7','2026-06-07 13:30:41'),
	(8,5,'Rejected Leave ID 5','2026-06-07 13:30:56'),
	(9,1,'User Logged In','2026-06-07 13:31:41'),
	(10,5,'User Logged In','2026-06-07 13:33:18'),
	(11,5,'Rejected Leave ID 5','2026-06-07 13:34:04'),
	(12,6,'User Logged In','2026-06-07 13:34:25'),
	(13,13,'User Logged In','2026-06-07 13:38:18'),
	(14,15,'User Logged In','2026-06-07 13:40:58'),
	(15,15,'Applied Leave Request','2026-06-07 13:41:16'),
	(16,1,'User Logged In','2026-06-07 13:45:01'),
	(17,15,'User Logged In','2026-06-07 13:50:16'),
	(18,13,'User Logged In','2026-06-07 13:50:32'),
	(19,6,'User Logged In','2026-06-07 13:51:01'),
	(20,13,'User Logged In','2026-06-07 13:51:21'),
	(21,7,'User Logged In','2026-06-07 13:51:43'),
	(22,6,'User Logged In','2026-06-07 13:51:55'),
	(23,18,'User Logged In','2026-06-07 13:53:20'),
	(24,7,'User Logged In','2026-06-07 13:53:39'),
	(25,16,'User Logged In','2026-06-07 13:54:37'),
	(26,18,'User Logged In','2026-06-07 13:55:05'),
	(27,16,'User Logged In','2026-06-07 14:02:31'),
	(28,1,'User Logged In','2026-06-07 14:02:52'),
	(29,19,'User Logged In','2026-06-07 14:04:19');

/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `department` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  KEY `fk_employee_user` (`user_id`),
  CONSTRAINT `fk_employee_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;

INSERT INTO `employees` (`id`, `user_id`, `employee_id`, `employee_name`, `mobile`, `department`, `designation`, `created_at`)
VALUES
	(4,7,'1234','Archana K R','7353604927','CSE4','Administrator789','2026-06-06 09:47:06'),
	(10,13,'345','jhon gg','6364773489','Finance','Finance66','2026-06-06 10:37:50'),
	(11,14,'56789','meera','8792150146','developer','developer','2026-06-06 16:34:25'),
	(12,15,'907','56789','7353604921','CSE','Administrator','2026-06-06 16:44:45'),
	(15,18,'90','Hem','6574836574','CSEsss','12309','2026-06-06 19:55:01'),
	(16,19,'EMP1234','Ramesh','8792150146','sv','Administratorsss','2026-06-07 14:03:31');

/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table leave_balance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leave_balance`;

CREATE TABLE `leave_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `available_days` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_balance_employee` (`employee_id`),
  KEY `fk_balance_leave_type` (`leave_type_id`),
  CONSTRAINT `fk_balance_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_balance_leave_type` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `leave_balance` WRITE;
/*!40000 ALTER TABLE `leave_balance` DISABLE KEYS */;

INSERT INTO `leave_balance` (`id`, `employee_id`, `leave_type_id`, `available_days`)
VALUES
	(7,10,1,11),
	(8,10,2,10),
	(9,10,3,9),
	(10,4,1,12),
	(11,4,2,7),
	(12,4,3,1),
	(13,11,1,12),
	(14,11,2,10),
	(15,11,3,15),
	(16,11,1,12),
	(17,11,2,10),
	(18,11,3,15),
	(19,12,1,12),
	(20,12,2,10),
	(21,12,3,15),
	(22,12,1,12),
	(23,12,2,10),
	(24,12,3,15),
	(37,15,1,12),
	(38,15,2,10),
	(39,15,3,15),
	(40,15,1,12),
	(41,15,2,10),
	(42,15,3,15),
	(43,16,1,12),
	(44,16,2,10),
	(45,16,3,15),
	(46,16,1,12),
	(47,16,2,10),
	(48,16,3,15);

/*!40000 ALTER TABLE `leave_balance` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table leave_requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leave_requests`;

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `manager_remark` text DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_request_employee` (`employee_id`),
  KEY `fk_request_leave_type` (`leave_type_id`),
  KEY `fk_request_approved_by` (`approved_by`),
  CONSTRAINT `fk_request_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_request_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_request_leave_type` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `leave_requests` WRITE;
/*!40000 ALTER TABLE `leave_requests` DISABLE KEYS */;

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type_id`, `start_date`, `end_date`, `total_days`, `reason`, `status`, `manager_remark`, `approved_by`, `approval_date`, `created_at`)
VALUES
	(5,10,3,'2026-06-07','2026-06-09',3,'cvbn','Rejected','f',NULL,'2026-06-06 00:00:00','2026-06-06 14:35:34'),
	(6,10,3,'2026-07-09','2026-07-10',2,'jh','Rejected','567654',NULL,NULL,'2026-06-06 15:37:14'),
	(7,4,2,'2026-06-08','2026-06-08',1,'sick','Approved',NULL,5,'2026-06-07 13:30:41','2026-06-07 08:27:04'),
	(8,4,3,'2026-07-09','2026-07-15',7,'d','Approved',NULL,5,'2026-06-07 13:30:13','2026-06-07 08:33:19'),
	(9,4,3,'2026-08-12','2026-08-12',1,'bv','Rejected','ss',NULL,NULL,'2026-06-07 08:40:33'),
	(10,4,2,'2026-10-12','2026-10-13',2,'gvcx','Approved',NULL,NULL,NULL,'2026-06-07 10:03:21'),
	(11,10,1,'2026-06-23','2026-06-23',1,'vbhj','Approved',NULL,NULL,NULL,'2026-06-07 11:37:20'),
	(12,10,3,'2026-08-08','2026-08-08',1,'fgbhn','Rejected','fgh',NULL,NULL,'2026-06-07 13:05:08'),
	(13,12,2,'2026-06-09','2026-06-16',8,'cvgbhj','Pending',NULL,NULL,NULL,'2026-06-07 13:41:16');

/*!40000 ALTER TABLE `leave_requests` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table leave_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leave_types`;

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(50) NOT NULL,
  `default_allocation` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `leave_types` WRITE;
/*!40000 ALTER TABLE `leave_types` DISABLE KEYS */;

INSERT INTO `leave_types` (`id`, `leave_name`, `default_allocation`)
VALUES
	(1,'Casual Leave',12),
	(2,'Sick Leave',10),
	(3,'Earned Leave',15);

/*!40000 ALTER TABLE `leave_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Manager','Employee') NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `role`, `status`, `created_at`)
VALUES
	(1,'admin@test.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Admin','Active','2026-06-06 08:37:42'),
	(5,'manager@test.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Manager','Active','2026-06-06 08:38:23'),
	(6,'employee@test.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Active','2026-06-06 08:38:23'),
	(7,'archanak633@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Inactive','2026-06-06 09:47:06'),
	(13,'john@mail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Inactive','2026-06-06 10:37:50'),
	(14,'meera@gmail.com','$2y$10$cSQfGQQOAAk63Ix6uoIwse8yzAlkaKpITu.UEWt7W675nTPQRA5rO','Employee','Inactive','2026-06-06 16:34:25'),
	(15,'swathigs108@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Active','2026-06-06 16:44:45'),
	(16,'hem@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Active','2026-06-06 19:51:17'),
	(18,'hemanth8792@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Active','2026-06-06 19:55:01'),
	(19,'ramesh@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Employee','Active','2026-06-07 14:03:31');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
