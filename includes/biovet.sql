/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `animal`;
CREATE TABLE `animal` (
  `IdAnimal` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(15) NOT NULL,
  `Tipo` varchar(15) DEFAULT NULL,
  `TipoSangre` varchar(10) NOT NULL,
  `Raza` varchar(13) NOT NULL,
  `Edad` int NOT NULL,
  `Sexo` varchar(6) NOT NULL,
  `Peso` decimal(5,0) NOT NULL,
  `Numero` int NOT NULL,
  `FKFinca` int NOT NULL,
  PRIMARY KEY (`IdAnimal`),
  KEY `FK_Animal_Finca` (`FKFinca`),
  CONSTRAINT `FK_Animal_Finca` FOREIGN KEY (`FKFinca`) REFERENCES `finca` (`IdFinca`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `datoscruce`;
CREATE TABLE `datoscruce` (
  `IdDatosCruce` int NOT NULL AUTO_INCREMENT,
  `Raza` varchar(25) NOT NULL,
  `Pureza` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IdDatosCruce`),
  KEY `FK_DatosCruce_Animal` (`Raza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `fichamedica`;
CREATE TABLE `fichamedica` (
  `IdFichaMedica` int NOT NULL AUTO_INCREMENT,
  `TipoMedicamento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Antecedentes` varchar(150) DEFAULT NULL,
  `Sintomas` varchar(150) DEFAULT NULL,
  `Diagnostico` varchar(30) DEFAULT NULL,
  `DetalleMedicamento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FechaRevision` date NOT NULL,
  `FKAnimal` int NOT NULL,
  PRIMARY KEY (`IdFichaMedica`),
  KEY `FK_FichaMedica_Animal` (`FKAnimal`),
  CONSTRAINT `FK_FichaMedica_Animal` FOREIGN KEY (`FKAnimal`) REFERENCES `animal` (`IdAnimal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `finca`;
CREATE TABLE `finca` (
  `IdFinca` int NOT NULL AUTO_INCREMENT,
  `NombreFinca` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Tamano` decimal(5,0) NOT NULL,
  `FKUsuario` int NOT NULL,
  PRIMARY KEY (`IdFinca`),
  KEY `FK_Finca_Usuario` (`FKUsuario`),
  CONSTRAINT `FK_Finca_Usuario` FOREIGN KEY (`FKUsuario`) REFERENCES `usuario` (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `IdHistorial` int NOT NULL AUTO_INCREMENT,
  `TipoMedicamento` varchar(100) NOT NULL,
  `TipoSangre` varchar(10) NOT NULL,
  `Antecedentes` varchar(150) DEFAULT NULL,
  `Sintomas` varchar(150) DEFAULT NULL,
  `Diagnostico` varchar(30) DEFAULT NULL,
  `DetalleMedicamento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FechaRevision` date NOT NULL,
  `FKAnimal` int NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdHistorial`),
  KEY `FK_Historial_Animal` (`FKAnimal`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `segmentofinca`;
CREATE TABLE `segmentofinca` (
  `IdSegmentoFinca` int NOT NULL AUTO_INCREMENT,
  `Numero` int NOT NULL,
  `Tamano` decimal(5,0) NOT NULL,
  `FKFinca` int NOT NULL,
  PRIMARY KEY (`IdSegmentoFinca`),
  KEY `FK_SegmentoFinca_Finca` (`FKFinca`),
  CONSTRAINT `FK_SegmentoFinca_Finca` FOREIGN KEY (`FKFinca`) REFERENCES `finca` (`IdFinca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `NombreUser` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Apellido1` varchar(15) NOT NULL,
  `Apellido2` varchar(15) DEFAULT NULL,
  `Telefono` varchar(8) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Contrasena` varchar(60) NOT NULL,
  `Suscripcion` varchar(20) DEFAULT 'Gratis',
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;