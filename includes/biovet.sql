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
  `Raza` varchar(13) NOT NULL,
  `Edad` int NOT NULL,
  `Sexo` varchar(6) NOT NULL,
  `Peso` decimal(5,0) NOT NULL,
  `Numero` int NOT NULL,
  `FKFinca` int NOT NULL,
  PRIMARY KEY (`IdAnimal`),
  KEY `FK_Animal_Finca` (`FKFinca`),
  CONSTRAINT `FK_Animal_Finca` FOREIGN KEY (`FKFinca`) REFERENCES `finca` (`IdFinca`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `TipoSangre` varchar(10) NOT NULL,
  `Antecedentes` varchar(150) DEFAULT NULL,
  `Sintomas` varchar(150) DEFAULT NULL,
  `Diagnostico` varchar(30) DEFAULT NULL,
  `DetalleMedicamento` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FechaRevision` date NOT NULL,
  `FKAnimal` int NOT NULL,
  PRIMARY KEY (`IdFichaMedica`),
  KEY `FK_FichaMedica_Animal` (`FKAnimal`),
  CONSTRAINT `FK_FichaMedica_Animal` FOREIGN KEY (`FKAnimal`) REFERENCES `animal` (`IdAnimal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `DetalleMedicamento` varchar(30) DEFAULT NULL,
  `FechaRevision` date NOT NULL,
  `FKAnimal` int NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdHistorial`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `animal` (`IdAnimal`, `Nombre`, `Tipo`, `Raza`, `Edad`, `Sexo`, `Peso`, `Numero`, `FKFinca`) VALUES
(2, ' Russell', 'Vaca', 'Jersey', 2, 'Macho', '35', 2, 1);
INSERT INTO `animal` (`IdAnimal`, `Nombre`, `Tipo`, `Raza`, `Edad`, `Sexo`, `Peso`, `Numero`, `FKFinca`) VALUES
(3, ' animal', 'Vaca', 'Jersey', 12, 'Macho', '500', 1, 3);




INSERT INTO `fichamedica` (`IdFichaMedica`, `TipoMedicamento`, `TipoSangre`, `Antecedentes`, `Sintomas`, `Diagnostico`, `DetalleMedicamento`, `FechaRevision`, `FKAnimal`) VALUES
(1, ' Si', 'O positivo', 'Asalto con arma blanca', 'Dolor de cabeza', 'Dengue', 'Paracetamol', '2023-11-02', 2);
INSERT INTO `fichamedica` (`IdFichaMedica`, `TipoMedicamento`, `TipoSangre`, `Antecedentes`, `Sintomas`, `Diagnostico`, `DetalleMedicamento`, `FechaRevision`, `FKAnimal`) VALUES
(2, ' Vacuna', 'O negativo', 'Asalto a mano armada', 'Depresión', 'Psicópara', 'Vacuna contra la demencia', '2023-11-03', 2);


INSERT INTO `finca` (`IdFinca`, `NombreFinca`, `Ubicacion`, `Tamano`, `FKUsuario`) VALUES
(1, 'Finca Uno actualizada', 'Nicoya', '1750', 1);
INSERT INTO `finca` (`IdFinca`, `NombreFinca`, `Ubicacion`, `Tamano`, `FKUsuario`) VALUES
(3, ' Finca Tres', 'Nicoya', '1357', 2);
INSERT INTO `finca` (`IdFinca`, `NombreFinca`, `Ubicacion`, `Tamano`, `FKUsuario`) VALUES
(4, ' Finca don Elías', 'Curime', '2851', 1);
INSERT INTO `finca` (`IdFinca`, `NombreFinca`, `Ubicacion`, `Tamano`, `FKUsuario`) VALUES
(5, ' Finca don ElíasDos', 'Pedregal', '4871', 1),
(6, ' Finca María', 'Sabana', '9844', 3);

INSERT INTO `historial` (`IdHistorial`, `TipoMedicamento`, `TipoSangre`, `Antecedentes`, `Sintomas`, `Diagnostico`, `DetalleMedicamento`, `FechaRevision`, `FKAnimal`, `FechaRegistro`) VALUES
(1, ' Vacuna', 'O negativo', 'Asalto a mano armada', 'Depresión', 'Psicópara', 'Vacuna contra la demencia', '2023-11-03', 2, '2023-11-03 18:30:54');




INSERT INTO `usuario` (`IdUsuario`, `NombreUser`, `Apellido1`, `Apellido2`, `Telefono`, `Email`, `Contrasena`) VALUES
(1, ' Elías', 'Zapatero', 'Zeledón', '84650178', 'eliaszp2501@gmail.com', '$2y$10$jkAVYwlaWFBSs2P.pr5zROz9/QPTlP2YG6YYWxCgTNksGOssqyXja');
INSERT INTO `usuario` (`IdUsuario`, `NombreUser`, `Apellido1`, `Apellido2`, `Telefono`, `Email`, `Contrasena`) VALUES
(2, ' Moisés', 'Zamora', 'Matarrita', '89506510', 'moiseszp2501@gmail.com', '$2y$10$owB0bOLM6Wi53Q5OmThFwO.j24Ao6LXC/LGZek97dMT4qChSGiZLm');
INSERT INTO `usuario` (`IdUsuario`, `NombreUser`, `Apellido1`, `Apellido2`, `Telefono`, `Email`, `Contrasena`) VALUES
(3, ' María', 'Mora', 'Mena', '84960398', 'maria@gmail.com', '$2y$10$z.bFkHswExPS78RYbRJKYOl1qQbjN/9qYsMznH3LJJU5vlTpZ6dqW');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;