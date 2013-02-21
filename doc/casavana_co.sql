-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-02-2013 a las 06:43:13
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `casavana_co`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `DNI` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`DNI`),
  KEY `DNI_Admin` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`DNI`) VALUES
('22222222M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `DNI` varchar(45) CHARACTER SET latin1 NOT NULL,
  `N_Pedidos` int(11) NOT NULL,
  `Desembolso` decimal(10,2) NOT NULL,
  PRIMARY KEY (`DNI`),
  KEY `DNI` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestor`
--

CREATE TABLE IF NOT EXISTS `gestor` (
  `DNI` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`DNI`),
  KEY `DNI_Gestor` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `Ref` varchar(10) CHARACTER SET latin1 NOT NULL,
  `DNI_Cliente` varchar(45) CHARACTER SET latin1 NOT NULL,
  `DNI_Gestor` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Coste` decimal(10,2) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Estado` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Fecha Pedido` date NOT NULL,
  `Fecha Modificacion` date NOT NULL,
  PRIMARY KEY (`Ref`),
  KEY `Cliente` (`DNI_Cliente`),
  KEY `DNI_PGestor` (`DNI_Gestor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de Productos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproducto`
--

CREATE TABLE IF NOT EXISTS `pedidoproducto` (
  `Pedido` varchar(10) CHARACTER SET latin1 NOT NULL,
  `Producto` varchar(10) CHARACTER SET latin1 NOT NULL,
  `N` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`N`),
  KEY `Producto` (`Producto`),
  KEY `Pedido` (`Pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `Ref` varchar(10) CHARACTER SET latin1 NOT NULL,
  `DNI_Gestor` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Descripcion` text CHARACTER SET latin1,
  `Coste` decimal(10,2) NOT NULL,
  `Margen` decimal(10,2) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Categoria` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Estado` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Ref`),
  KEY `DNI_PPGestor` (`DNI_Gestor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de Productos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `DNI` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Apellido1` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Apellido2` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `Direccion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Telefono` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Fecha Alta` date NOT NULL,
  `Fecha Ultimo Acceso` date NOT NULL,
  `Estado` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Email` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Usuario` varchar(45) CHARACTER SET latin1 NOT NULL,
  `Clave` varchar(45) CHARACTER SET latin1 NOT NULL,
  `DNI_Administrador` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`DNI`, `Nombre`, `Apellido1`, `Apellido2`, `Direccion`, `Telefono`, `Fecha Alta`, `Fecha Ultimo Acceso`, `Estado`, `Email`, `Usuario`, `Clave`, `DNI_Administrador`) VALUES
('22222222M', 'Pablo', 'Pablo', 'Pablo', 'Granada', '669988745', '2013-02-11', '2013-02-11', 'Activo', 'pablo@casavana.com', 'pablo', 'pablo', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `DNI_Admin` FOREIGN KEY (`DNI`) REFERENCES `usuario` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `DNI` FOREIGN KEY (`DNI`) REFERENCES `usuario` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gestor`
--
ALTER TABLE `gestor`
  ADD CONSTRAINT `DNI_Gestor` FOREIGN KEY (`DNI`) REFERENCES `usuario` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `Cliente` FOREIGN KEY (`DNI_Cliente`) REFERENCES `cliente` (`DNI`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DNI_PGestor` FOREIGN KEY (`DNI_Gestor`) REFERENCES `gestor` (`DNI`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD CONSTRAINT `Pedido` FOREIGN KEY (`Pedido`) REFERENCES `pedido` (`Ref`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Producto` FOREIGN KEY (`Producto`) REFERENCES `producto` (`Ref`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `DNI_PPGestor` FOREIGN KEY (`DNI_Gestor`) REFERENCES `gestor` (`DNI`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
