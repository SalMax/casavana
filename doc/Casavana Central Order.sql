-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-02-2013 a las 20:47:31
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `casavana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `DNI` varchar(45) NOT NULL,
  PRIMARY KEY (`DNI`),
  KEY `DNI_Admin` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`DNI`) VALUES
('25597487M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `DNI` varchar(45) NOT NULL,
  `N_Pedidos` int(11) NOT NULL,
  `Desembolso` decimal(10,2) NOT NULL,
  PRIMARY KEY (`DNI`),
  KEY `DNI` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestor`
--

CREATE TABLE IF NOT EXISTS `gestor` (
  `DNI` varchar(45) NOT NULL,
  PRIMARY KEY (`DNI`),
  KEY `DNI_Gestor` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `Ref` varchar(10) NOT NULL,
  `DNI_Cliente` varchar(45) NOT NULL,
  `DNI_Gestor` varchar(45) DEFAULT NULL,
  `Coste` decimal(10,2) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Fecha Pedido` date NOT NULL,
  `Fecha Modificacion` date NOT NULL,
  PRIMARY KEY (`Ref`),
  KEY `Cliente` (`DNI_Cliente`),
  KEY `DNI_PGestor` (`DNI_Gestor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla de Productos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido - producto`
--

CREATE TABLE IF NOT EXISTS `pedido - producto` (
  `Pedido` varchar(10) NOT NULL,
  `Producto` varchar(10) NOT NULL,
  KEY `Pedido` (`Pedido`),
  KEY `Producto` (`Producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `Ref` varchar(10) NOT NULL,
  `DNI_Gestor` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` text,
  `Coste` decimal(10,2) NOT NULL,
  `Margen` decimal(10,2) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL,
  PRIMARY KEY (`Ref`),
  KEY `DNI_PPGestor` (`DNI_Gestor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla de Productos';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Ref`, `DNI_Gestor`, `Nombre`, `Descripcion`, `Coste`, `Margen`, `Precio`, `Categoria`, `Estado`) VALUES
('1', '', 'Mistol', NULL, '10.00', '5.00', '15.00', 'Vajilla', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Dni` varchar(45) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido1` varchar(45) NOT NULL,
  `Apellido2` varchar(45) DEFAULT NULL,
  `Direccion` varchar(45) NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `Fecha Alta` date NOT NULL,
  `Fecha Ultimo Acceso` date NOT NULL,
  `Estado` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Usuario` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `DNI_Administrador` varchar(45) NOT NULL,
  PRIMARY KEY (`Dni`),
  KEY `DNI_Administrador_Us` (`DNI_Administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Dni`, `Nombre`, `Apellido1`, `Apellido2`, `Direccion`, `Telefono`, `Fecha Alta`, `Fecha Ultimo Acceso`, `Estado`, `Email`, `Usuario`, `Clave`, `DNI_Administrador`) VALUES
('25597487M', 'Pablo', 'Torres', 'Alba', 'Granada', '662288046', '2013-11-02', '2013-11-02', 'Activo', 'pta1988@gmail.com', 'pta1988', 'pta1988', '25597487M');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `DNI_Admin` FOREIGN KEY (`DNI`) REFERENCES `usuario` (`Dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `DNI` FOREIGN KEY (`DNI`) REFERENCES `usuario` (`Dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gestor`
--
ALTER TABLE `gestor`
  ADD CONSTRAINT `DNI_Gestor` FOREIGN KEY (`DNI`) REFERENCES `usuario` (`Dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `Cliente` FOREIGN KEY (`DNI_Cliente`) REFERENCES `cliente` (`DNI`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DNI_PGestor` FOREIGN KEY (`DNI_Gestor`) REFERENCES `gestor` (`DNI`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido - producto`
--
ALTER TABLE `pedido - producto`
  ADD CONSTRAINT `Producto` FOREIGN KEY (`Producto`) REFERENCES `producto` (`Ref`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Pedido` FOREIGN KEY (`Pedido`) REFERENCES `pedido` (`Ref`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
