-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2019 a las 21:01:08
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db01ajax`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamen`
--

CREATE TABLE `departamen` (
  `ID_Dep` int(11) NOT NULL,
  `Nombre` varchar(41) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamen`
--

INSERT INTO `departamen` (`ID_Dep`, `Nombre`) VALUES
(1, 'Administracion'),
(2, 'Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `ID_Persona` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Codigo_Puesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`ID_Persona`, `Nombre`, `Email`, `Telefono`, `Codigo_Puesto`) VALUES
(1, 'A', 'a@email.com', 963852741, 4),
(2, 'B', 'b@email.com', 987654321, 1),
(3, 'C', 'c@email.com', 951847963, 3),
(4, 'D', 'd@email.com', 963963852, 4),
(5, 'E', 'e@email.com', 654456632, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `ID_Puesto` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Departamento_Asignado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`ID_Puesto`, `Nombre`, `Departamento_Asignado`) VALUES
(1, 'Contable', 1),
(2, 'Administrativo', 1),
(3, 'Ingenieros', 2),
(4, 'Desarollo', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamen`
--
ALTER TABLE `departamen`
  ADD PRIMARY KEY (`ID_Dep`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`ID_Persona`),
  ADD KEY `Codigo_Puesto` (`Codigo_Puesto`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`ID_Puesto`),
  ADD KEY `Departamento_Asignado` (`Departamento_Asignado`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`Codigo_Puesto`) REFERENCES `puesto` (`ID_Puesto`);

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`Departamento_Asignado`) REFERENCES `departamen` (`ID_Dep`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
