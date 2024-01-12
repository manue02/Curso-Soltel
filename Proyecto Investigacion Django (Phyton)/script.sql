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

DROP TABLE IF EXISTS `Estudiante`;

CREATE TABLE `Estudiante` (
  `nif` varchar(9) UNIQUE NOT NULL,
  `nombre_apellido` varchar(50) NOT NULL,
  `edad` tinyint NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `universidad` varchar(50) NOT NULL,
  PRIMARY KEY PK_nif (`NIF`)
  INDEX `IDX_Estudiante_Nombre` (`nombre_apellido`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMENT 'Tabla que almacena los estudiantes de la universidad';

--
-- Dumping data for table `Estudiante`
--

INSERT INTO `Estudiante` VALUES (1,'Juan Perez',20,'Informatica','Universidad de Sevilla');
INSERT INTO `Estudiante` VALUES (2,'Maria Lopez',21,'Medicina','Universidad de Sevilla');


--
-- Table structure for table `Curso`
--

DROP TABLE IF EXISTS `Curso`;

CREATE TABLE `Curso` (
  `cine` MEDIUMINT NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `creditos` INT(11) NOT NULL,
  `profesor` varchar(50) NOT NULL,
  `universidad` varchar(50) NOT NULL,
  PRIMARY KEY PK_cine (`cine`)
  INDEX `IDX_Curso_Nombre` (`nombre`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMENT 'Tabla que almacena los cursos de la universidad';

--
-- Dumping data for table `Curso`
--

INSERT INTO `Curso` VALUES (1,'Programacion',6,'Juan Perez','Universidad de Sevilla');
INSERT INTO `Curso` VALUES (2,'Matematicas',6,'Maria Lopez','Universidad de Sevilla');


--
-- Table structure for table `EstudianteCurso`
--

DROP TABLE IF EXISTS `EstudianteCurso`;

CREATE TABLE `EstudianteCurso` (
  `nif` varchar(9) UNIQUE NOT NULL,
  `cine`MEDIUMINT NOT NULL,
  PRIMARY KEY PK_nif (`NIF`),
  PRIMARY KEY PK_cine (`cine`),
  FOREIGN KEY FK_nif (`nif`) REFERENCES `Estudiante` (`nif`) ON UPDATE CASCADE,
  FOREIGN KEY FK_cine (`cine`) REFERENCES `Curso` (`cine`) ON UPDATE CASCADE,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMENT 'Tabla intermedia entre Estudiante y Curso';
--
-- Dumping data for table `EstudianteCurso`
--
