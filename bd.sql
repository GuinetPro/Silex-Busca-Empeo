-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: cencosud
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `crece`
--

DROP TABLE IF EXISTS `crece`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(145) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rut` varchar(45) DEFAULT NULL,
  `comuna` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `renta` varchar(45) DEFAULT NULL,
  `disponibilidad` varchar(45) DEFAULT NULL,
  `paris` varchar(45) DEFAULT NULL,
  `johnson` varchar(45) DEFAULT NULL,
  `santa_isabel` varchar(45) DEFAULT NULL,
  `jumbo` varchar(45) DEFAULT NULL,
  `easy` varchar(45) DEFAULT NULL,
  `eurofashion` varchar(45) DEFAULT NULL,
  `cencosud` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `token` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;



--
-- Table structure for table `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(145) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `rut` varchar(45) DEFAULT NULL,
  `comuna` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `tiempo_exp` varchar(45) DEFAULT NULL,
  `formacion_academica` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `pretension_renta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesionales`
--

