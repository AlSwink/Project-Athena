CREATE DATABASE  IF NOT EXISTS `athena` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `athena`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: athena
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.31-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement` varchar(50) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `creator_id` varchar(45) DEFAULT NULL,
  `created` varchar(45) DEFAULT NULL,
  `modified` varchar(45) DEFAULT NULL,
  `department_restricted` int(11) DEFAULT NULL,
  `user_type_restricted` int(11) DEFAULT NULL,
  `user_restricted` int(11) DEFAULT NULL,
  `departments` longtext,
  `user_types` longtext,
  `users` longtext,
  `active` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,'This is a sample announcement',NULL,NULL,'1',NULL,NULL,0,0,0,NULL,NULL,NULL,1,0),(2,'Do not panic the Avengers will be here soon',NULL,NULL,'1',NULL,NULL,0,0,0,NULL,NULL,NULL,1,0),(3,'All employees must adhere to company rules and reg',NULL,NULL,'1',NULL,NULL,0,0,0,NULL,NULL,NULL,1,0),(4,'Please proceed to the next available exit',NULL,NULL,'1',NULL,NULL,0,0,0,NULL,NULL,NULL,1,0);
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('0re6qa6q3ltuhgobps050u9fqg7dskkk','10.89.96.183',1529958834,'__ci_last_regenerate|i:1529958834;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('424m6i08r3rjlvfnp2f2321r6r9qj9nn','::1',1529962576,'__ci_last_regenerate|i:1529962576;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('4hqda2tsm44k99nbdrrt3jo3k4nkmnfc','::1',1529961554,'__ci_last_regenerate|i:1529961554;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('627hs67pqjkkaok3c59qtmkgqdau2opd','10.89.96.183',1529961207,'__ci_last_regenerate|i:1529960916;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('7onjg67vhub4rskfpe1rha4at4cq68ug','10.89.96.183',1529959141,'__ci_last_regenerate|i:1529959141;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('98utpcikb05qns7ptlh1labhdmq8nbt1','::1',1530026477,'__ci_last_regenerate|i:1530026477;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('bj0eqhj12flfncu5632918pci1rjls4g','10.89.96.183',1529958167,'__ci_last_regenerate|i:1529958167;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('ca2qnk7dl1eso24luva17l0ahmfdb586','10.89.96.183',1529959467,'__ci_last_regenerate|i:1529959467;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('dgj7tbs0dudqclivguv2eg77f5rh5otn','::1',1529962826,'__ci_last_regenerate|i:1529962576;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('diduq5776tgmal2498rs8tmaugj5s3vb','10.89.96.183',1529959810,'__ci_last_regenerate|i:1529959810;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('gn2v6fppt261bripljm0rkpakg9gkfeg','::1',1530026479,'__ci_last_regenerate|i:1530026477;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('h6nbskagia4oh3q6vrhsdn35cq7j5cg9','10.89.96.183',1529957844,'__ci_last_regenerate|i:1529957844;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('i35e0q2pecckssffaik9ev306jg5ngvp','::1',1529962182,'__ci_last_regenerate|i:1529962182;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('icvce0b0vtnnvqv7kg6ngbpldp1nbglf','::1',1530018671,'__ci_last_regenerate|i:1530018671;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('jflij1ng5v18njpfhq74j9j71hrm6t01','10.89.96.183',1529960916,'__ci_last_regenerate|i:1529960916;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('kncc28vdv890l2qsu7grf1mdll6l2u3k','10.89.96.183',1529957523,'__ci_last_regenerate|i:1529957523;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('krm7u3k036tqfnnt45536fprp7ih2vjg','10.89.96.183',1529958533,'__ci_last_regenerate|i:1529958533;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('o60nncgtps8u195d8ifhngn9c6st1i4j','10.89.96.183',1529957221,'__ci_last_regenerate|i:1529957221;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('pgldc3qe27cl8enrlb1cm4ahm059r0kd','10.89.97.108',1529960449,'__ci_last_regenerate|i:1529960375;user_id|s:1:\"3\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:0:\"\";s:5:\"lname\";s:0:\"\";s:4:\"dept\";N;s:5:\"group\";N;}'),('qg78kamq3f2npjlhdc7jd5gg0eq8gb8c','10.89.96.183',1529960111,'__ci_last_regenerate|i:1529960111;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('t2hsnr58ldrent9ic9bbe6dmaikv875a','::1',1530022833,'__ci_last_regenerate|i:1530022833;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}'),('vl5eo0c6n7pumi1188l1u8n80sdbdag4','10.89.96.183',1529956721,'__ci_last_regenerate|i:1529956721;user_id|s:1:\"2\";user_menu|a:5:{i:0;a:5:{s:4:\"name\";s:12:\"Applications\";s:11:\"description\";s:47:\"General systems essential for Daily Operations.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:8:\"th-large\";}i:1;a:5:{s:4:\"name\";s:5:\"Tools\";s:11:\"description\";s:58:\"Snippets of programs designed to help perform daily tasks.\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:13:\"Replenishment\";s:11:\"description\";s:28:\"Tools for Replens Department\";s:10:\"controller\";N;s:7:\"submenu\";a:1:{i:0;a:5:{s:4:\"name\";s:14:\"Kill Intransit\";s:11:\"description\";s:0:\"\";s:10:\"controller\";s:20:\"tools/kill_intransit\";s:7:\"submenu\";N;s:4:\"icon\";N;}}s:4:\"icon\";N;}}s:4:\"icon\";s:6:\"wrench\";}i:2;a:5:{s:4:\"name\";s:7:\"Reports\";s:11:\"description\";s:68:\"Provides transparency and analytical data of the warehouse inventory\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:10:\"chart-line\";}i:3;a:5:{s:4:\"name\";s:13:\"Knowledgebase\";s:11:\"description\";s:71:\"A Vault full of information and documentation about the site processes.\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"book\";}i:4;a:5:{s:4:\"name\";s:13:\"Site Settings\";s:11:\"description\";s:26:\"Customize the current site\";s:10:\"controller\";N;s:7:\"submenu\";N;s:4:\"icon\";s:4:\"cogs\";}}user_info|a:4:{s:5:\"fname\";s:4:\"Paul\";s:5:\"lname\";s:5:\"Gillo\";s:4:\"dept\";s:1:\"1\";s:5:\"group\";s:1:\"1\";}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_keys`
--

DROP TABLE IF EXISTS `dev_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_keys` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) DEFAULT NULL,
  `key` longtext,
  `get` varchar(45) DEFAULT NULL,
  `create` varchar(45) DEFAULT NULL,
  `update` varchar(45) DEFAULT NULL,
  `delete` varchar(45) DEFAULT NULL,
  `execute` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_keys`
--

LOCK TABLES `dev_keys` WRITE;
/*!40000 ALTER TABLE `dev_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `dev_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_positions`
--

DROP TABLE IF EXISTS `employee_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_positions` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` longtext,
  `created` varchar(45) DEFAULT NULL,
  `creator` varchar(45) DEFAULT NULL,
  `modified` varchar(45) DEFAULT NULL,
  `deleted` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_positions`
--

LOCK TABLES `employee_positions` WRITE;
/*!40000 ALTER TABLE `employee_positions` DISABLE KEYS */;
INSERT INTO `employee_positions` VALUES (1,'Helpdesk Technician',NULL,'1',NULL,'0'),(2,'Application Developer',NULL,'1',NULL,'0'),(3,'Master',NULL,'1',NULL,'0');
/*!40000 ALTER TABLE `employee_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) DEFAULT NULL,
  `e_fname` varchar(45) DEFAULT NULL,
  `e_lname` varchar(45) DEFAULT NULL,
  `p_position` varchar(45) DEFAULT NULL,
  `s_position` varchar(45) DEFAULT NULL,
  `ssn` varchar(45) DEFAULT NULL,
  `user_group` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `staffing` varchar(45) DEFAULT NULL,
  `temp_field` varchar(45) DEFAULT NULL,
  `created` varchar(45) DEFAULT NULL,
  `modified` varchar(45) DEFAULT NULL,
  `active` varchar(45) DEFAULT NULL,
  `deleted` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'1','Athena','Master',NULL,NULL,NULL,'1','1',NULL,NULL,NULL,NULL,NULL,NULL),(2,'2','Paul','Gillo','1','2','1516','1','1','3',NULL,NULL,NULL,'1','0');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(45) DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `notification` longtext,
  `created` datetime DEFAULT NULL,
  `read` datetime DEFAULT NULL,
  `seen` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'new','2','New ticket has been submitted from PACKING','2018-06-13 00:00:26',NULL,'0'),(2,'alert','2','Test Alert','2018-06-13 00:00:26',NULL,'0'),(3,'info','2','Test Info','2018-06-13 00:00:26',NULL,'0'),(4,'critical','2','Test Critical','2018-06-13 00:00:26',NULL,'0'),(5,'critical','2','Test Critical','2018-06-13 00:00:26',NULL,'0'),(6,'info','2','Test Info','2018-06-13 00:00:26',NULL,'0'),(7,'new','2','New ticket has been submitted from PACKING','2018-06-13 00:00:26',NULL,'0'),(8,'alert','2','Test Alert','2018-06-13 00:00:26',NULL,'0'),(9,'critical','2','Test Critical','2018-06-13 00:00:26',NULL,'0'),(10,'info','2','Test Info','2018-06-13 00:00:26',NULL,'0'),(11,'info','2','Test Critical','2018-06-13 00:00:26',NULL,'0');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_menus`
--

DROP TABLE IF EXISTS `site_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  `parent_id` varchar(45) DEFAULT NULL,
  `controller` longtext,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `order` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_menus`
--

LOCK TABLES `site_menus` WRITE;
/*!40000 ALTER TABLE `site_menus` DISABLE KEYS */;
INSERT INTO `site_menus` VALUES (1,'Applications','General systems essential for Daily Operations.',NULL,NULL,NULL,NULL,NULL,'th-large'),(2,'Tools','Snippets of programs designed to help perform daily tasks.',NULL,NULL,NULL,NULL,NULL,'wrench'),(3,'Reports','Provides transparency and analytical data of the warehouse inventory',NULL,NULL,NULL,NULL,NULL,'chart-line'),(4,'Knowledgebase','A Vault full of information and documentation about the site processes.',NULL,NULL,NULL,NULL,NULL,'book'),(5,'Replenishment','Tools for Replens Department','2',NULL,NULL,NULL,NULL,NULL),(6,'Kill Intransit','','5','tools/kill_intransit',NULL,NULL,NULL,NULL),(7,'Site Settings','Customize the current site',NULL,NULL,NULL,NULL,NULL,'cogs');
/*!40000 ALTER TABLE `site_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(45) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `creator_id` varchar(45) DEFAULT NULL,
  `created` varchar(45) DEFAULT NULL,
  `modified` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'login_max_attempt','3','1',NULL,NULL),(2,'site_name','XPO Logistics','1',NULL,NULL),(3,'credit_header','credits_image.jpg','1',NULL,NULL),(4,'brand','brand.png','1',NULL,NULL),(5,'max_announcements','4','1',NULL,NULL);
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_staffing`
--

DROP TABLE IF EXISTS `site_staffing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_staffing` (
  `staffing_id` int(11) NOT NULL AUTO_INCREMENT,
  `staffing_name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `creator` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`staffing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_staffing`
--

LOCK TABLES `site_staffing` WRITE;
/*!40000 ALTER TABLE `site_staffing` DISABLE KEYS */;
INSERT INTO `site_staffing` VALUES (1,'XPO Logistics',NULL,NULL,NULL),(2,'Randstad Technologies',NULL,NULL,NULL),(3,'Paramount Staffing',NULL,NULL,NULL);
/*!40000 ALTER TABLE `site_staffing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tools` (
  `tool_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `version` varchar(45) DEFAULT NULL,
  `description` text,
  `method_name` longtext,
  `creator_id` varchar(45) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`tool_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tools`
--

LOCK TABLES `tools` WRITE;
/*!40000 ALTER TABLE `tools` DISABLE KEYS */;
INSERT INTO `tools` VALUES (1,'Kill Intransit','0.0.1','In some occasions we have to kill in-transit commands to maintain inventory database integrity.<br>\n		  This tool will set both <b>ALLOC QTY</b> and <b>INTRAN QTY</b> to <b>0</b> and <b>DELETE</b> the command.<br>\n		  Use the fields below to verify the command and its QTY.','kill_intransit','2',NULL,NULL);
/*!40000 ALTER TABLE `tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_logs` (
  `usr_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` longtext,
  `ip_address` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `log_dtime` timestamp NULL DEFAULT NULL,
  `browser` varchar(45) DEFAULT NULL,
  `os` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usr_log_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logs`
--

LOCK TABLES `user_logs` WRITE;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_menus`
--

DROP TABLE IF EXISTS `user_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_menus` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) DEFAULT NULL,
  `site_menu_id` varchar(45) DEFAULT NULL,
  `permissions` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_menus`
--

LOCK TABLES `user_menus` WRITE;
/*!40000 ALTER TABLE `user_menus` DISABLE KEYS */;
INSERT INTO `user_menus` VALUES (1,'1','*','*'),(2,'2','*','*'),(5,'4','*','*'),(6,'3','*','*');
/*!40000 ALTER TABLE `user_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(45) DEFAULT NULL,
  `menu1` int(11) DEFAULT NULL,
  `menu2` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'Master',NULL,NULL),(2,'Developer',NULL,NULL),(3,'Manager',NULL,NULL),(4,'Lead',NULL,NULL),(5,'User',NULL,NULL),(6,'Guest',NULL,NULL),(7,'Demo',NULL,NULL);
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_login`
--

DROP TABLE IF EXISTS `users_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(45) DEFAULT NULL,
  `login_attempt` int(11) DEFAULT NULL,
  `first_login` varchar(45) DEFAULT NULL,
  `creator_id` varchar(45) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `reset_key` longtext,
  `locked_out` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_login`
--

LOCK TABLES `users_login` WRITE;
/*!40000 ALTER TABLE `users_login` DISABLE KEYS */;
INSERT INTO `users_login` VALUES (1,'athena','5bNF4ufR2qdH','1',0,'1','1',1,0,NULL,0,NULL,NULL),(2,'pg','U`n6:R`tcT`l','2',0,'1','1',1,0,NULL,0,NULL,NULL),(3,'dm5','9p[LMV\\\\cjqx','2',0,'1','2',1,0,'',0,NULL,NULL),(4,'bq','|aE0pfe``_^]','2',0,'1','2',1,0,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `users_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-26 12:42:42
