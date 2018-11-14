-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2018 a las 16:07:50
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
-- Base de datos: `EmployeeDatabase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EMPLOYEES`
--

CREATE TABLE `EMPLOYEES` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(60) COLLATE utf8_bin NOT NULL,
  `NICK` varchar(60) COLLATE utf8_bin NOT NULL,
  `SEXO` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT 'Otro',
  `EDAD` int(11) NOT NULL,
  `PHOTO` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `ESPECIALIDAD` varchar(535) COLLATE utf8_bin DEFAULT NULL,
  `CONTACTO` varchar(535) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `EMPLOYEES`
--

INSERT INTO `EMPLOYEES` (`ID`, `NOMBRE`, `NICK`, `SEXO`, `EDAD`, `PHOTO`, `ESPECIALIDAD`, `CONTACTO`) VALUES
(3, 'Victoriano', 'V1cky', 'Otro', 0, 'vicky.jpg', 'Sigiloso', 'i62pefev@uco.es'),
(4, 'Miguel ï¿½ngel', 'mastertato', 'Otro', 20, 'mastertato.jpg', 'Inteligente', 'i62rarum@uco.es'),
(5, 'Ãngel', 'noobturne', 'Otro', 20, 'noobturne.jpg', 'Persuasivo', 'i62reroa@uco.es'),
(6, 'chechu', 'chechuim', 'Otro', 27, 'fff', 'Persuasivo', '******************'),
(7, 'admin', 'admin', 'male', 16, '', 'Agil', '******************'),
(8, 'eloy', 'minebroker', 'Hombre', 28, '', 'Minecraft', '************');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `EMPLOYEES`
--
ALTER TABLE `EMPLOYEES`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
