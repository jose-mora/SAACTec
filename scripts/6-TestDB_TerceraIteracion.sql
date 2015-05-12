-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-05-2015 a las 06:37:49
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `TestDB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
`id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `activo` int(11) NOT NULL,
  `nivel` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `activo`, `nivel`) VALUES
(2, 'PETI', 1, 'Bachillerato'),
(3, 'Datos II', 1, 'Bachillerato'),
(4, 'AFI', 0, 'Bachillerato'),
(5, 'OCLE', 1, 'Bachillerato'),
(9, 'Compu y Sociedad', 1, 'Bachillerato'),
(10, 'Intro 1', 1, 'Bachillerato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franjas`
--

CREATE TABLE IF NOT EXISTS `franjas` (
`id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `franjas`
--

INSERT INTO `franjas` (`id`, `nombre`, `activo`) VALUES
(2, '7 am - 9 am', 0),
(3, '9 am - 11 am', 1),
(4, '3 pm - 5 pm', 1),
(6, '1 pm - 3 pm', 1),
(7, '5 pm - 7 pm', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id` int(11) NOT NULL,
  `ideGrupo` varchar(50) NOT NULL,
  `idSede` int(11) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `idFranja` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `ideGrupo`, `idSede`, `idCurso`, `idFranja`, `activo`) VALUES
(1, 'ECD1', 9, 5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE IF NOT EXISTS `preferencias` (
`idePreferencia` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ideGrupo` varchar(200) NOT NULL,
  `nivel` varchar(5) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`idePreferencia`, `email`, `ideGrupo`, `nivel`, `activo`) VALUES
(10, 'elizondo1288@hotmail.com', 'ECD1', 'C', 1),
(21, 'elizondo1288@gmail.com', 'ECD1', 'A', 1),
(23, 'elizondo1288@gmail.com', 'ECD1', 'B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
`id` int(11) NOT NULL,
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
  `nivel` varchar(70) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `tipoProfesor`, `departamentoEscuela`, `gradoAcademicoProfesor`, `cedula`, `nombre`, `apellido1`, `apellido2`, `email`, `telefono`, `celular`, `evaluacionActual`, `activo`, `jornada`, `direccion`, `nivel`) VALUES
(1, 'Con plaza', 'Escuela de computaciÃ³n', 'Bachiller', '702110185', 'Esteban', 'Elizondo', 'Camacho', 'elizondo1288@gmail.com', '8864-2030', '8864-1981', 70, 1, '50%', 'San Jose Costa Rica', ''),
(2, 'Interino', 'Escuela de computacion', 'Bachiller', '702110185', 'Jonathan', 'Mendez', 'Baltodano', 'jmendezb@yahoo.com', '8423-2189', '8423-2189', 70, 1, '100%', 'San José Costa Rica', ''),
(3, 'Con plaza', 'Escuela de computacion', 'Bachiller', '113500810', 'Teban', 'Elizondo', 'Test', 'elizondo1288@hotmail.com', '88641981', '42342423', 70, 1, '100%', 'San Jose', '1'),
(4, 'Interino', 'Escuela de computacion', 'Bachiller', '1111', 'Pedro', 'Perez', 'Peperino', 'pepe@pe.com', '33333333', '33333333', 70, 1, '100%', 'San Jose', '1'),
(5, 'Con plaza', 'Escuela de computaciÃ³n', 'Diplomado', '1231312', 'Esteban', 'Mora', 'Peperino', 'mavacara.8803@gmail.com', '88641981', '8864-1981', 70, 1, '50%', 'San Jose Costa Rica', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE IF NOT EXISTS `sedes` (
`id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`, `activo`) VALUES
(1, 'San Jose', 1),
(5, 'Cartago', 0),
(6, 'San Carlos', 0),
(7, 'Guanacaste', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `franjas`
--
ALTER TABLE `franjas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
 ADD PRIMARY KEY (`idePreferencia`), ADD KEY `email` (`email`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `franjas`
--
ALTER TABLE `franjas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
MODIFY `idePreferencia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;