-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2017 a las 01:23:57
-- Versión del servidor: 10.0.32-MariaDB-0+deb8u1
-- Versión de PHP: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `grupo36`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL,
  `nombre_hospital` varchar(70) NOT NULL,
  `descripcion_hospital` text NOT NULL,
  `mail_hospital` varchar(50) NOT NULL,
  `elem_pagina` int(5) NOT NULL,
  `estado_pagina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre_hospital`, `descripcion_hospital`, `mail_hospital`, `elem_pagina`, `estado_pagina`) VALUES
(1, 'Gutierrez La Plata', 'El Hospital Gutierrez de La Plata fue inaugurado el 6 de Agosto de 1954. En ese entonces, el hospital funcionaba solo en el área central del edificio, siendo que las dos alas anexas eran ocupadas por casas de admisión de menores. En 1956, por resolución ministerial, la casa de admisión Dardo Rocha es trasladada para dar lugar al Hogar Materno Infantil “Dra. Cecilia Grierson”, y posteriormente la Casa del Niño Alfredo Palacios.', 'contacto@hospital.com', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_salud`
--

CREATE TABLE IF NOT EXISTS `control_salud` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `peso` float NOT NULL,
  `vacunas_completas` tinyint(1) NOT NULL,
  `maduracion_acorde` tinyint(1) NOT NULL,
  `maduracion_observaciones` text NOT NULL,
  `ex_fisico_normal` tinyint(1) NOT NULL,
  `ex_fisico_observaciones` varchar(255) DEFAULT NULL,
  `pc` int(11) DEFAULT NULL,
  `ppc` int(11) DEFAULT NULL,
  `talla` int(11) DEFAULT NULL,
  `alimentacion` varchar(255) NOT NULL,
  `observaciones_generales` varchar(255) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `eliminado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `control_salud`
--

INSERT INTO `control_salud` (`id`, `fecha`, `peso`, `vacunas_completas`, `maduracion_acorde`, `maduracion_observaciones`, `ex_fisico_normal`, `ex_fisico_observaciones`, `pc`, `ppc`, `talla`, `alimentacion`, `observaciones_generales`, `paciente_id`, `usuario_id`, `eliminado`) VALUES
(1, '2017-05-10', 3.3, 1, 1, 'Observaciones', 1, 'srh', 55, 34, 55, 'Alimentacion', 'Generales', 9, 1, 0),
(2, '2017-05-17', 3.4, 1, 1, 'Observaciones', 1, 'srh', 55, 35, 55, 'Alimentacion', 'Generales', 9, 1, 0),
(3, '2017-05-24', 3.7, 1, 1, 'Observaciones', 1, 'srh', 55, 35, 55, 'Alimentacion', 'Generales', 9, 1, 0),
(4, '2017-06-01', 3.9, 1, 1, 'Observaciones', 1, 'srh', 55, 36, 55, 'Alimentacion', 'Generales', 9, 1, 0),
(5, '2017-06-08', 4.2, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 55, 'Alimentacion', 'Generales', 9, 1, 0),
(6, '2017-06-16', 4.3, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 58, 'Alimentacion', 'Generales', 9, 1, 0),
(7, '2017-06-25', 4.8, 1, 1, 'Observaciones', 1, 'srh', 55, 38, 58, 'Alimentacion', 'Generales', 9, 1, 0),
(8, '2017-07-05', 4.3, 1, 1, 'Observaciones', 1, 'srh', 55, 38, 58, 'Alimentacion', 'Generales', 9, 1, 0),
(9, '2017-07-13', 4.7, 1, 1, 'Observaciones', 1, 'srh', 55, 39, 58, 'Alimentacion', 'Generales', 9, 1, 0),
(10, '2017-07-21', 5, 1, 1, 'Observaciones', 1, 'srh', 55, 40, 60, 'Alimentacion', 'Generales', 9, 1, 0),
(11, '2017-07-29', 5.3, 1, 1, 'Observaciones', 1, 'srh', 55, 40, 60, 'Alimentacion', 'Generales', 9, 1, 0),
(12, '2017-08-07', 5.8, 1, 1, 'Observaciones', 1, 'srh', 55, 41, 60, 'Alimentacion', 'Generales', 9, 1, 0),
(13, '2017-08-15', 5.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 60, 'Alimentacion', 'Generales', 9, 1, 0),
(14, '2017-08-23', 5.7, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 60, 'Alimentacion', 'Generales', 9, 1, 0),
(15, '2017-09-02', 5.9, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 9, 1, 0),
(16, '2017-09-10', 6.1, 1, 1, 'Observaciones', 1, 'srh', 55, 35, 63, 'Alimentacion', 'Generales', 9, 1, 0),
(17, '2017-09-18', 5.8, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 9, 1, 0),
(18, '2017-09-26', 6.2, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 9, 1, 0),
(19, '2017-10-05', 6.3, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 9, 1, 0),
(20, '2017-10-13', 6, 1, 1, 'Observaciones', 1, 'srh', 55, 39, 65, 'Alimentacion', 'Generales', 9, 1, 0),
(21, '2017-10-20', 6.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 65, 'Alimentacion', 'Generales', 9, 1, 0),
(22, '2017-11-20', 6.5, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 68, 'Alimentacion', 'Generales', 9, 1, 0),
(23, '2017-12-20', 6.6, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 68, 'Alimentacion', 'Generales', 9, 1, 0),
(24, '2018-01-20', 6.4, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 68, 'Alimentacion', 'Generales', 9, 1, 0),
(25, '2018-02-20', 7, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 72, 'Alimentacion', 'Generales', 9, 1, 0),
(26, '2018-03-20', 7.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 72, 'Alimentacion', 'Generales', 9, 1, 0),
(27, '2018-04-20', 7.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 72, 'Alimentacion', 'Generales', 9, 1, 0),
(28, '2018-05-20', 8.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 75, 'Alimentacion', 'Generales', 9, 1, 0),
(29, '2018-06-20', 8, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 75, 'Alimentacion', 'Generales', 9, 1, 0),
(30, '2018-07-20', 8.5, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 78, 'Alimentacion', 'Generales', 9, 1, 0),
(31, '2018-08-20', 8.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 78, 'Alimentacion', 'Generales', 9, 1, 0),
(32, '2018-09-20', 9.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 78, 'Alimentacion', 'Generales', 9, 1, 0),
(33, '2018-10-20', 9.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 80, 'Alimentacion', 'Generales', 9, 1, 0),
(34, '2018-11-20', 10.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 80, 'Alimentacion', 'Generales', 9, 1, 0),
(35, '2018-12-20', 10.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 80, 'Alimentacion', 'Generales', 9, 1, 0),
(36, '2019-01-20', 11.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 90, 'Alimentacion', 'Generales', 9, 1, 0),
(37, '2019-04-20', 13.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 90, 'Alimentacion', 'Generales', 9, 1, 0),
(38, '2019-07-20', 15.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 95, 'Alimentacion', 'Generales', 9, 1, 0),
(39, '2019-10-20', 16.5, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 95, 'Alimentacion', 'Generales', 9, 1, 0),
(40, '2019-12-20', 18.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 110, 'Alimentacion', 'Generales', 9, 1, 0),
(41, '2017-05-10', 3.3, 1, 1, 'Observaciones', 1, 'srh', 55, 34, 55, 'Alimentacion', 'Generales', 10, 1, 0),
(42, '2017-05-17', 3.4, 1, 1, 'Observaciones', 1, 'srh', 55, 35, 55, 'Alimentacion', 'Generales', 10, 1, 0),
(43, '2017-05-24', 3.7, 1, 1, 'Observaciones', 1, 'srh', 55, 35, 55, 'Alimentacion', 'Generales', 10, 1, 0),
(44, '2017-06-01', 3.9, 1, 1, 'Observaciones', 1, 'srh', 55, 36, 55, 'Alimentacion', 'Generales', 10, 1, 0),
(45, '2017-06-08', 4.2, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 55, 'Alimentacion', 'Generales', 10, 1, 0),
(46, '2017-06-16', 4.3, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 58, 'Alimentacion', 'Generales', 10, 1, 0),
(47, '2017-06-25', 4.8, 1, 1, 'Observaciones', 1, 'srh', 55, 38, 58, 'Alimentacion', 'Generales', 10, 1, 0),
(48, '2017-07-05', 4.3, 1, 1, 'Observaciones', 1, 'srh', 55, 38, 58, 'Alimentacion', 'Generales', 10, 1, 0),
(49, '2017-07-13', 4.7, 1, 1, 'Observaciones', 1, 'srh', 55, 39, 58, 'Alimentacion', 'Generales', 10, 1, 0),
(50, '2017-07-21', 5, 1, 1, 'Observaciones', 1, 'srh', 55, 40, 60, 'Alimentacion', 'Generales', 10, 1, 0),
(51, '2017-07-29', 5.3, 1, 1, 'Observaciones', 1, 'srh', 55, 40, 60, 'Alimentacion', 'Generales', 10, 1, 0),
(52, '2017-08-07', 5.8, 1, 1, 'Observaciones', 1, 'srh', 55, 41, 60, 'Alimentacion', 'Generales', 10, 1, 0),
(53, '2017-08-15', 5.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 60, 'Alimentacion', 'Generales', 10, 1, 0),
(54, '2017-08-23', 5.7, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 60, 'Alimentacion', 'Generales', 10, 1, 0),
(55, '2017-09-02', 5.9, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 10, 1, 0),
(56, '2017-09-10', 6.1, 1, 1, 'Observaciones', 1, 'srh', 55, 35, 63, 'Alimentacion', 'Generales', 10, 1, 0),
(57, '2017-09-18', 5.8, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 10, 1, 0),
(58, '2017-09-26', 6.2, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 10, 1, 0),
(59, '2017-10-05', 6.3, 1, 1, 'Observaciones', 1, 'srh', 55, 37, 63, 'Alimentacion', 'Generales', 10, 1, 0),
(60, '2017-10-13', 6, 1, 1, 'Observaciones', 1, 'srh', 55, 39, 65, 'Alimentacion', 'Generales', 10, 1, 0),
(61, '2017-10-20', 6.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 65, 'Alimentacion', 'Generales', 10, 1, 0),
(62, '2017-11-20', 6.5, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 68, 'Alimentacion', 'Generales', 10, 1, 0),
(63, '2017-12-20', 6.6, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 68, 'Alimentacion', 'Generales', 10, 1, 0),
(64, '2018-01-20', 6.4, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 68, 'Alimentacion', 'Generales', 10, 1, 0),
(65, '2018-02-20', 7, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 72, 'Alimentacion', 'Generales', 10, 1, 0),
(66, '2018-03-20', 7.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 72, 'Alimentacion', 'Generales', 10, 1, 0),
(67, '2018-04-20', 7.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 72, 'Alimentacion', 'Generales', 10, 1, 0),
(68, '2018-05-20', 8.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 75, 'Alimentacion', 'Generales', 10, 1, 0),
(69, '2018-06-20', 8, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 75, 'Alimentacion', 'Generales', 10, 1, 0),
(70, '2018-07-20', 8.5, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 78, 'Alimentacion', 'Generales', 10, 1, 0),
(71, '2018-08-20', 8.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 78, 'Alimentacion', 'Generales', 10, 1, 0),
(72, '2018-09-20', 9.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 78, 'Alimentacion', 'Generales', 10, 1, 0),
(73, '2018-10-20', 9.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 80, 'Alimentacion', 'Generales', 10, 1, 0),
(74, '2018-11-20', 10.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 80, 'Alimentacion', 'Generales', 10, 1, 0),
(75, '2018-12-20', 10.9, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 80, 'Alimentacion', 'Generales', 10, 1, 0),
(76, '2019-01-20', 11.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 90, 'Alimentacion', 'Generales', 10, 1, 0),
(77, '2019-04-20', 13.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 90, 'Alimentacion', 'Generales', 10, 1, 0),
(78, '2019-07-20', 15.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 95, 'Alimentacion', 'Generales', 10, 1, 0),
(79, '2019-10-20', 16.5, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 95, 'Alimentacion', 'Generales', 10, 1, 0),
(80, '2019-12-20', 18.2, 1, 1, 'Observaciones', 1, 'srh', 55, 42, 110, 'Alimentacion', 'Generales', 10, 1, 0),
(81, '2017-11-16', 45123, 1, 1, '43efw', 1, 'wefwe', 23, 232, 23, '23r', 'svfsdv', 12, 17, NULL),
(82, '2017-11-22', 32, 1, 1, 'wefqw', 1, 'wgver', 32424523, 23, 23, 'gfdsvgs', 'rgvrs', 12, 17, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_demograficos`
--

CREATE TABLE IF NOT EXISTS `datos_demograficos` (
`id` int(11) NOT NULL,
  `heladera` tinyint(1) NOT NULL,
  `electricidad` tinyint(1) NOT NULL,
  `mascota` varchar(1) NOT NULL,
  `tipo_vivienda_id` int(11) NOT NULL,
  `tipo_calefaccion_id` int(11) NOT NULL,
  `tipo_agua_id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_demograficos`
--

INSERT INTO `datos_demograficos` (`id`, `heladera`, `electricidad`, `mascota`, `tipo_vivienda_id`, `tipo_calefaccion_id`, `tipo_agua_id`, `paciente_id`) VALUES
(1, 1, 1, '1', 1, 1, 1, 9),
(2, 1, 1, '1', 1, 1, 1, 10),
(3, 1, 1, '1', 1, 1, 1, 11),
(4, 1, 1, '1', 1, 1, 1, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
`id` int(11) NOT NULL,
  `nombre` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `nombre`) VALUES
(1, '8:00'),
(2, '8.30'),
(3, '9:00'),
(4, '9:30'),
(5, '10:00'),
(6, '10:30'),
(7, '11:00'),
(8, '11:30'),
(9, '12:00'),
(10, '12:30'),
(11, '13:00'),
(12, '13:30'),
(13, '14:00'),
(14, '14:30'),
(15, '15:00'),
(16, '15:30'),
(17, '16:00'),
(18, '16:30'),
(19, '17:00'),
(20, '17:30'),
(21, '18:00'),
(22, '18:30'),
(23, '19:00'),
(24, '19:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id` int(11) NOT NULL,
  `rta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
`id` int(11) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` tinytext NOT NULL,
  `numero_documento` int(11) NOT NULL,
  `obra_social_id` int(11) NOT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='				';

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `apellido`, `nombre`, `domicilio`, `telefono`, `fecha_nac`, `genero`, `numero_documento`, `obra_social_id`, `tipo_documento_id`, `eliminado`) VALUES
(9, 'Gonzales', 'Ana', '44 y 21', '1241241', '2017-05-10', 'F', 123412, 1, 1, 0),
(10, 'Kitioupfr', 'Carlos', 'wgvw', '4545665', '2017-05-10', 'M', 42369856, 1, 1, 0),
(11, 'stjhst', 'sjrtjs', 'tjstjnsrt', '43734', '2017-11-15', 'M', 54457, 1, 1, 1),
(12, 'Rodrigo', 'Lopez', '25852', '66695656', '2017-09-06', 'M', 596655, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 ROW_FORMAT=REDUNDANT;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`) VALUES
(1, 'paciente_index'),
(2, 'paciente_create'),
(3, 'paciente_destroy'),
(4, 'paciente_update'),
(5, 'paciente_show'),
(6, 'paciente_listarpacientes'),
(7, 'index_index'),
(8, 'index_show'),
(9, 'usuario_logout'),
(10, 'configuracion_update'),
(11, 'index_indexadmin'),
(12, 'usuario_index'),
(13, 'usuario_create'),
(14, 'usuario_destroy'),
(15, 'usuario_update'),
(16, 'usuario_show'),
(17, 'usuario_suspend'),
(18, 'usuario_login'),
(19, 'usuario_activate'),
(20, 'paciente_agregarpaciente'),
(21, 'datosdemograficos_show'),
(22, 'datosdemograficos_create'),
(23, 'datosdemograficos_index'),
(24, 'datosdemograficos_update'),
(25, 'controlsalud_index'),
(26, 'controlsalud_create'),
(27, 'controlsalud_insertarcontroldesalud'),
(28, 'controlsalud_update'),
(29, 'controlsalud_destroy'),
(30, 'controlsalud_show'),
(32, 'grafico_index'),
(33, 'grafico_show'),
(34, 'grafico_getpaciente'),
(35, 'grafico_getcontrolsalud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'ROL_ADMINISTRADOR'),
(2, 'ROL_PEDIATRA'),
(3, 'ROL_RECEPCIONISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_tiene_permiso`
--

CREATE TABLE IF NOT EXISTS `rol_tiene_permiso` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_tiene_permiso`
--

INSERT INTO `rol_tiene_permiso` (`rol_id`, `permiso_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(2, 1),
(2, 2),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 9),
(2, 11),
(2, 16),
(2, 18),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 30),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 9),
(3, 11),
(3, 16),
(3, 18),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE IF NOT EXISTS `turnos` (
`id` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dni` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `id_horario`, `fecha`, `dni`) VALUES
(1, 2, '2017-11-11', '37423419');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `eliminado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `activo`, `updated_at`, `created_at`, `first_name`, `last_name`, `eliminado`) VALUES
(1, 'administrador@hospital.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '2017-11-21 16:11:04', '2017-10-04 00:00:00', 'Administrador', 'Pepe', 0),
(17, 'pediatra@hospital.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '2017-10-23 15:00:21', '2017-10-23 15:00:20', 'Pediatra', 'Carlos', 0),
(18, 'recepcionista@hospital.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, '2017-10-23 15:04:58', '2017-10-23 15:04:58', 'Recepcionista', 'Ana', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_rol`
--

CREATE TABLE IF NOT EXISTS `usuario_tiene_rol` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_tiene_rol`
--

INSERT INTO `usuario_tiene_rol` (`usuario_id`, `rol_id`) VALUES
(1, 1),
(17, 2),
(18, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `control_salud`
--
ALTER TABLE `control_salud`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_control_salud_paciente1_idx` (`paciente_id`), ADD KEY `fk_control_salud_Usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `datos_demograficos`
--
ALTER TABLE `datos_demograficos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_datos_demograficos_tipo_vivienda1_idx` (`tipo_vivienda_id`), ADD KEY `fk_datos_demograficos_tipo_calefaccion1_idx` (`tipo_calefaccion_id`), ADD KEY `fk_datos_demograficos_tipo_agua1_idx` (`tipo_agua_id`), ADD KEY `fk_datos_demograficos_paciente1_idx` (`paciente_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_paciente_obra_social1_idx` (`obra_social_id`), ADD KEY `fk_paciente_tipo_documento1_idx` (`tipo_documento_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_tiene_permiso`
--
ALTER TABLE `rol_tiene_permiso`
 ADD PRIMARY KEY (`rol_id`,`permiso_id`), ADD KEY `fk_rol_has_permiso_permiso1_idx` (`permiso_id`), ADD KEY `fk_rol_has_permiso_rol1_idx` (`rol_id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_horiarios` (`id_horario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `usuario_tiene_rol`
--
ALTER TABLE `usuario_tiene_rol`
 ADD PRIMARY KEY (`usuario_id`,`rol_id`), ADD KEY `fk_Usuario_has_rol_rol1_idx` (`rol_id`), ADD KEY `fk_Usuario_has_rol_Usuario_idx` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `control_salud`
--
ALTER TABLE `control_salud`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT de la tabla `datos_demograficos`
--
ALTER TABLE `datos_demograficos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `control_salud`
--
ALTER TABLE `control_salud`
ADD CONSTRAINT `fk_control_salud_Usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_control_salud_paciente1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `datos_demograficos`
--
ALTER TABLE `datos_demograficos`
ADD CONSTRAINT `fk_datos_demograficos_paciente1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol_tiene_permiso`
--
ALTER TABLE `rol_tiene_permiso`
ADD CONSTRAINT `fk_rol_has_permiso_permiso1` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_rol_has_permiso_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
ADD CONSTRAINT `FK_horiarios` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id`);

--
-- Filtros para la tabla `usuario_tiene_rol`
--
ALTER TABLE `usuario_tiene_rol`
ADD CONSTRAINT `fk_Usuario_has_rol_Usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Usuario_has_rol_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
