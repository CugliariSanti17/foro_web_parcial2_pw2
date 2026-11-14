-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: foro_parcial_pw2
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `color_etiqueta` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Desarrollo','Todo sobre programación','azul'),(2,'Diseño','UI/UX y maquetación','amarillo'),(7,'Off-topic','Nada relacionado a la programación','rojo'),(8,'Front-end','Todo lo relacionado al Front','azul'),(9,'Back-end','Todo lo relacionado al Back','amarillo');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `respuestas` (
  `id_respuesta` int NOT NULL AUTO_INCREMENT,
  `contenido` text NOT NULL,
  `id_tema` int NOT NULL,
  `id_usuario` int NOT NULL,
  `likes` int NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id_respuesta`),
  KEY `fk_respuestas_temas` (`id_tema`),
  KEY `fk_respuestas_usuarios` (`id_usuario`),
  CONSTRAINT `fk_respuestas_temas` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`),
  CONSTRAINT `fk_respuestas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas`
--

LOCK TABLES `respuestas` WRITE;
/*!40000 ALTER TABLE `respuestas` DISABLE KEYS */;
INSERT INTO `respuestas` VALUES (1,'Hola, este es un comentario de prueba',1,1,0,'2026-11-08 11:03:58'),(4,'Sigo probando comentarios',2,1,0,'2026-11-08 11:22:07'),(6,'Comentario de prueba',3,1,4,'2026-11-08 21:17:43'),(10,'aguante boca',5,1,0,'2026-11-13 21:53:50'),(12,'Por ahora es aceptable. Boca recupero identidad y garra. Falta lo mas importante. Se puede cerrar el año de la mejor manera ganando la copa argentina y la copa sudamericana.',8,1,0,'2026-11-14 00:03:16');
/*!40000 ALTER TABLE `respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sugerencias`
--

DROP TABLE IF EXISTS `sugerencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sugerencias` (
  `id_sugerencia` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime NOT NULL,
  PRIMARY KEY (`id_sugerencia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sugerencias`
--

LOCK TABLES `sugerencias` WRITE;
/*!40000 ALTER TABLE `sugerencias` DISABLE KEYS */;
INSERT INTO `sugerencias` VALUES (1,'Santiago','Cugliari','cugliari@gmail.com','mejora_visual','No me gustan los colores de los topicos','2026-11-12 20:45:55'),(2,'Carlos','Gonzalez','CarlitosGonzalez@gmail.com','falta_temas','No puedo publicar sobre bitcoin','2026-11-12 20:59:33');
/*!40000 ALTER TABLE `sugerencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temas`
--

DROP TABLE IF EXISTS `temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temas` (
  `id_tema` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `id_categoria` int NOT NULL,
  `id_usuario` int NOT NULL,
  `vistas` int NOT NULL DEFAULT '0',
  `likes` int NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL,
  PRIMARY KEY (`id_tema`),
  KEY `fk_temas_categorias` (`id_categoria`),
  KEY `fk_temas_usuarios` (`id_usuario`),
  CONSTRAINT `fk_temas_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  CONSTRAINT `fk_temas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temas`
--

LOCK TABLES `temas` WRITE;
/*!40000 ALTER TABLE `temas` DISABLE KEYS */;
INSERT INTO `temas` VALUES (1,'¿Cómo estructurar un proyecto desde cero?','Tengo dudas sobre cómo armar las carpetas...',1,1,127,19,'2026-11-07 14:11:43'),(2,'Teoría del color aplicada a interfaces web','Les comparto esta guía que armé...',2,1,34,18,'2026-11-07 14:11:43'),(3,'Publicacion de prueba','Esto es una publicacion de prueba',1,1,20,6,'2026-11-08 21:17:16'),(5,'Publicacion parte 2819','Otra publicacion de prueba mas',1,1,36,23,'2026-11-09 17:44:31'),(8,'Campaña de Boca Juniors 2026','Que opinan de la campaña de Boca Juniors este 2026? Cumplió con las expectativas o dejo que desear?',7,1,2,0,'2026-11-14 00:02:36'),(9,'¿Qué opinan de ReactJS?','Quiero que me den su opinion sincera sobre ReactJS. Quiero empezar a usarla asi que dejen algunos tips para aprender el lenguaje',8,1,0,0,'2026-11-14 00:06:59');
/*!40000 ALTER TABLE `temas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario',
  `esta_baneado` tinyint NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin_foro','adminforo@gmail.com','12345','usuario',0,'2026-11-07 14:10:07');
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

-- Dump completed on 2026-11-14  0:11:14
