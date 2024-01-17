-- MySQL dump 10.13  Distrib 8.0.19, for osx10.14 (x86_64)
--
-- Host: 127.0.0.1    Database: DAW2
-- ------------------------------------------------------
-- Server version	8.0.19-debug

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @old_autocommit=@@autocommit;   

--
-- Current Database: `DAW2`
--

/*!40000 DROP DATABASE IF EXISTS `DAW2`*/;

CREATE DATABASE `DAW2` DEFAULT CHARACTER SET utf8mb4;

USE `DAW2`;

--
-- Table structure for table `Estudiante`
--

-- Si existe la tabla la borramos
DROP TABLE IF EXISTS `Estudiante`;

-- Creamos la tabla
CREATE TABLE `Estudiante` (
  `nif` varchar(9) UNIQUE NOT NULL,
  `nombre_apellido` varchar(50) NOT NULL,
  `edad` tinyint NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `universidad` varchar(50) NOT NULL,
  PRIMARY KEY PK_nif (`NIF`),
  INDEX IDX_Estudiante_Nombre (nombre_apellido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Estudiante`
--


