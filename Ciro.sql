-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ciro
CREATE DATABASE IF NOT EXISTS `ciro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ciro`;

-- Volcando estructura para tabla ciro.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `identificacion` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre_cli` varchar(100) NOT NULL,
  `apellido_cli` varchar(100) NOT NULL,
  `telefono_cli` bigint(10) NOT NULL,
  `direccion_cli` varchar(120) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=1069239278 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ciro.orden
CREATE TABLE IF NOT EXISTS `orden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` bigint(20) DEFAULT NULL,
  `nombre_orden` varchar(100) DEFAULT NULL,
  `descripcion_orden` varchar(250) DEFAULT NULL,
  `valor_orden` float DEFAULT NULL,
  `fecha_orden` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega_orden` date DEFAULT NULL,
  `estado` int(1) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_orden_clientes` (`identificacion`),
  CONSTRAINT `FK_orden_clientes` FOREIGN KEY (`identificacion`) REFERENCES `clientes` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ciro.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_changed` varchar(100) NOT NULL,
  `password_confirm` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
