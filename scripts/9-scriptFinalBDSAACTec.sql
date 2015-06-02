CREATE DATABASE  IF NOT EXISTS `testdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `testdb`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: testdb
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `activo` int(1) DEFAULT '0',
  `nivel` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'Bases de datos I',1,'Bachillerato'),(2,'Bases de datos II',1,'Bachillerato'),(3,'Planeacion Estrategica de TI',1,'Maestria'),(4,'Matematicas I',0,'Doctorado'),(5,'Modelos de desarrollo de software',1,'Maestria'),(6,'Taller de modelos de desarrollo de software',1,'Maestria'),(7,'Proyecto I',0,'Licenciatura');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franjas`
--

DROP TABLE IF EXISTS `franjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `franjas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `activo` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franjas`
--

LOCK TABLES `franjas` WRITE;
/*!40000 ALTER TABLE `franjas` DISABLE KEYS */;
INSERT INTO `franjas` VALUES (1,'Lunes: 6 pm - 9 pm',1),(2,'Martes: 6 pm - 9 pm',1),(3,'Miercoles: 6 pm - 9 pm',1),(4,'Jueves: 6 pm - 9 pm',1),(5,'Viernes: 6 pm - 9 pm',1);
/*!40000 ALTER TABLE `franjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ideGrupo` varchar(50) NOT NULL,
  `idSede` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `idFranja` int(11) NOT NULL,
  `activo` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos`
--

LOCK TABLES `grupos` WRITE;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
INSERT INTO `grupos` VALUES (1,'MDS-040',2,5,2,1),(2,'TMDS-040',2,6,3,1),(3,'BDI-040',1,1,1,1),(4,'BDII-040',1,2,4,1),(5,'PETI-040',1,3,5,1);
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historiconotas`
--

DROP TABLE IF EXISTS `historiconotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historiconotas` (
  `idhistoriconotas` int(11) NOT NULL AUTO_INCREMENT,
  `idProfesor` int(11) NOT NULL,
  `periodo` varchar(150) NOT NULL,
  `nota` int(3) NOT NULL,
  `anular` tinyint(1) NOT NULL,
  PRIMARY KEY (`idhistoriconotas`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiconotas`
--

LOCK TABLES `historiconotas` WRITE;
/*!40000 ALTER TABLE `historiconotas` DISABLE KEYS */;
INSERT INTO `historiconotas` VALUES (1,1,'1 semestre 2015',89,0),(2,1,'1 cuatrimestre 2015',95,0),(3,1,'2 bimestre 2015',100,0),(4,2,'1 semestre 2015',75,0),(5,2,'2 cuatrimestre 2015',98,0),(6,2,'2 bimestre 2015',50,0),(7,3,'1 semestre 2015',30,0),(8,3,'2 cuatrimestre 2015',40,0),(9,3,'2 bimestre 2015',55,0),(10,5,'1 semestre 2015',40,0),(11,5,'2 cuatrimestre 2015',60,0),(12,5,'2 bimestre 2015',70,0);
/*!40000 ALTER TABLE `historiconotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferencias`
--

DROP TABLE IF EXISTS `preferencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferencias` (
  `idePreferencia` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `ideGrupo` varchar(200) NOT NULL,
  `nivel` varchar(5) NOT NULL,
  `activo` int(1) DEFAULT '0',
  `gastada` int(1) DEFAULT '0',
  PRIMARY KEY (`idePreferencia`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferencias`
--

LOCK TABLES `preferencias` WRITE;
/*!40000 ALTER TABLE `preferencias` DISABLE KEYS */;
INSERT INTO `preferencias` VALUES (1,'jmendezb88@yahoo.com','BDI-040','A',0,0),(2,'jmendezb88@yahoo.com','PETI-040','A',0,0),(3,'jmendezb88@yahoo.com','MDS-040','B',0,0),(4,'jmendezb88@yahoo.com','BDII-040','A',0,0),(5,'jmendezb88@yahoo.com','TMDS-040','B',0,0),(6,'elizondo1288@gmail.com','BDI-040','B',1,0),(7,'elizondo1288@gmail.com','BDII-040','A',1,0),(8,'elizondo1288@gmail.com','MDS-040','C',1,0),(9,'elizondo1288@gmail.com','PETI-040','A',1,0),(10,'elizondo1288@gmail.com','TMDS-040','C',1,0),(11,'je.moradiaz@gmail.com','BDI-040','A',1,0),(12,'je.moradiaz@gmail.com','BDII-040','B',1,0),(13,'je.moradiaz@gmail.com','MDS-040','C',1,0),(14,'je.moradiaz@gmail.com','PETI-040','B',1,0),(15,'je.moradiaz@gmail.com','TMDS-040','C',1,0),(16,'aalvarez@saactec.com','BDI-040','A',0,0),(17,'aalvarez@saactec.com','BDII-040','A',0,0),(18,'aalvarez@saactec.com','MDS-040','B',0,0),(19,'aalvarez@saactec.com','PETI-040','C',0,0),(20,'aalvarez@saactec.com','TMDS-040','A',0,0);
/*!40000 ALTER TABLE `preferencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procesoasignacion`
--

DROP TABLE IF EXISTS `procesoasignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procesoasignacion` (
  `idProcesoAsignacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `ejecutado` int(11) NOT NULL,
  PRIMARY KEY (`idProcesoAsignacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procesoasignacion`
--

LOCK TABLES `procesoasignacion` WRITE;
/*!40000 ALTER TABLE `procesoasignacion` DISABLE KEYS */;
INSERT INTO `procesoasignacion` VALUES (1,'semestre 1 2015',1,1);
/*!40000 ALTER TABLE `procesoasignacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesores`
--

DROP TABLE IF EXISTS `profesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoProfesor` varchar(150) NOT NULL,
  `departamentoEscuela` varchar(150) NOT NULL,
  `gradoAcademicoProfesor` varchar(150) NOT NULL,
  `cedula` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido1` varchar(75) NOT NULL,
  `apellido2` varchar(75) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `evaluacionActual` float NOT NULL,
  `activo` int(11) NOT NULL,
  `jornada` varchar(70) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `nivel` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesores`
--

LOCK TABLES `profesores` WRITE;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
INSERT INTO `profesores` VALUES (1,'Con plaza','Escuela de computación','Bachiller','702110185','Jose Erick','Mora','Diaz','je.moradiaz@gmail.com','8762-4742','8762-4742',70,1,'100%','Cartago, Costa Rica','1'),(2,'Con plaza','Escuela de computación','Máster','113570097','Jonathan','Mendez','Baltodano','jmendezb88@yahoo.com','8879-2303','8879-2303',70,1,'50%','San José, Costa Rica','1'),(3,'Interino','Escuela de administración','Licenciado(a)','888888888','Estaban','Elizondo','Camacho','elizondo1288@gmail.com','88888888','88888888',70,1,'75%','San José, Costa Rica','1'),(4,'Interino','Escuela de administración','Doctor(a)','777777777','Gabriela','Loaiza','Mora','gabyloaiza@gmail.com','8888-8888','8888-8888',70,0,'25%','San José, Costa Rica','1'),(5,'Con plaza','Escuela de computación','Diplomado','222222222','Adriana','Alvarez','Figueroa','aalvarez@saactec.com','8888-8888','8888-8888',70,1,'125%','San José, Costa Rica','1');
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultadoprocasignacion`
--

DROP TABLE IF EXISTS `resultadoprocasignacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultadoprocasignacion` (
  `idResultado` int(11) NOT NULL AUTO_INCREMENT,
  `idProcesoAsignacion` int(11) NOT NULL,
  `ideGrupo` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`idResultado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultadoprocasignacion`
--

LOCK TABLES `resultadoprocasignacion` WRITE;
/*!40000 ALTER TABLE `resultadoprocasignacion` DISABLE KEYS */;
INSERT INTO `resultadoprocasignacion` VALUES (1,1,'MDS-040','je.moradiaz@gmail.com'),(2,1,'TMDS-040','je.moradiaz@gmail.com'),(3,1,'BDI-040','je.moradiaz@gmail.com'),(4,1,'BDII-040','je.moradiaz@gmail.com'),(5,1,'PETI-040','elizondo1288@gmail.com');
/*!40000 ALTER TABLE `resultadoprocasignacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sedes`
--

DROP TABLE IF EXISTS `sedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sedes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `activo` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sedes`
--

LOCK TABLES `sedes` WRITE;
/*!40000 ALTER TABLE `sedes` DISABLE KEYS */;
INSERT INTO `sedes` VALUES (1,'Cartago',1),(2,'San Jose',1),(3,'Limon',1);
/*!40000 ALTER TABLE `sedes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipoUsuario` varchar(13) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','Administrador@Saactec.com','12345'),(2,'Profesor','je.moradiaz@gmail.com','123456'),(3,'Profesor','jmendezb88@yahoo.com','12345'),(4,'Profesor','elizondo1288@gmail.com','12345'),(5,'Profesor','gabyloaiza@gmail.com','12345'),(6,'Profesor','aalvarez@saactec.com','12345');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-02  1:27:46
