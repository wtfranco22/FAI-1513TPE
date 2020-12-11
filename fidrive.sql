-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2020 a las 00:53:02
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fidrive`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivocargado`
--

CREATE TABLE `archivocargado` (
  `idarchivocargado` int(11) NOT NULL,
  `acnombre` varchar(150) NOT NULL,
  `acdescripcion` text NOT NULL,
  `acicono` varchar(50) NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `aclinkacceso` text NOT NULL,
  `accantidaddescarga` int(11) NOT NULL,
  `accantidadusada` int(11) NOT NULL,
  `acfechainiciocompartir` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `acefechafincompartir` timestamp NOT NULL DEFAULT '2020-12-12 23:59:59',
  `acprotegidoclave` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivocargadoestado`
--

CREATE TABLE `archivocargadoestado` (
  `idarchivocargadoestado` int(11) NOT NULL,
  `idestadotipos` int(11) NOT NULL,
  `acedescripcion` text NOT NULL,
  `idusuario` bigint(20) NOT NULL,
  `acefechaingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `acefechafin` timestamp NULL DEFAULT NULL,
  `idarchivocargado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadotipos`
--

CREATE TABLE `estadotipos` (
  `idestadotipos` int(11) NOT NULL,
  `etdescripcion` varchar(100) NOT NULL,
  `etactivo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadotipos`
--

INSERT INTO `estadotipos` (`idestadotipos`, `etdescripcion`, `etactivo`) VALUES
(1, 'Cargado', 1),
(2, 'Compartido', 1),
(3, 'No Compartido', 1),
(4, 'Eliminado', 1),
(5, 'Desactivado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `roldescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `roldescripcion`) VALUES
(1, 'administrador'),
(3, 'compa'),
(2, 'profe'),
(4, 'visitante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `uscorreo` varchar(100) NOT NULL,
  `usnombre` varchar(150) NOT NULL,
  `usapellido` varchar(150) NOT NULL,
  `uslogin` varchar(150) NOT NULL,
  `usclave` text NOT NULL,
  `usactivo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `uscorreo`,`usnombre`, `usapellido`, `uslogin`, `usclave`, `usactivo`) VALUES
(1, 'Franco',`null`, 'Rodriguez', 'FAI-1513', 'b7869558818bc87a2ab9786b7e9f821f', 1),
(2, 'Sabrina',`null`, 'Soler', 'Saso', 'd38fb092110fb7063fc6b86f44e3d543', 1),
(3, 'Viviana',`null`, 'Sánchez', 'Vivi', '3575dc24a1126d8749cc2e9f41fe4305', 1),
(4, 'María',`null`, 'Pino', 'Malapi', '61d34715fe62dfea7f22b21195d0cdb0', 1),
(5, 'Claudia',`null`, 'Carrasco', 'ClauC', '3575dc24a1126d8749cc2e9f41fe4305', 1),
(6, 'Alex',`null`, 'Barra', 'AlexB', '012e0a0ff187e16c54f39e664dc179d6', 1);

--
-- Contraseñas
--
-- FAI-1513(contraseña123), Saso(saso2020), Vivi (pwd123), Malapi(pwd2020), ClauC(pwd123), AlexB(agbr826)
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariorol`
--

INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 3),
(2, 4),
(3, 2),
(3, 4),
(4, 1),
(4, 2),
(4, 4),
(5, 2),
(5, 4),
(6, 3),
(6, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivocargado`
--
ALTER TABLE `archivocargado`
  ADD PRIMARY KEY (`idarchivocargado`),
  ADD UNIQUE KEY `acnombre` (`acnombre`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `archivocargadoestado`
--
ALTER TABLE `archivocargadoestado`
  ADD PRIMARY KEY (`idarchivocargadoestado`),
  ADD KEY `idestadotipos` (`idestadotipos`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idarchivocargado` (`idarchivocargado`);

--
-- Indices de la tabla `estadotipos`
--
ALTER TABLE `estadotipos`
  ADD PRIMARY KEY (`idestadotipos`),
  ADD UNIQUE KEY `etdescripcion` (`etdescripcion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `roldescripcion` (`roldescripcion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `uslogin` (`uslogin`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivocargado`
--
ALTER TABLE `archivocargado`
  MODIFY `idarchivocargado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivocargadoestado`
--
ALTER TABLE `archivocargadoestado`
  MODIFY `idarchivocargadoestado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadotipos`
--
ALTER TABLE `estadotipos`
  MODIFY `idestadotipos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivocargado`
--
ALTER TABLE `archivocargado`
  ADD CONSTRAINT `archivocargado_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivocargadoestado`
--
ALTER TABLE `archivocargadoestado`
  ADD CONSTRAINT `archivocargadoestado_ibfk_1` FOREIGN KEY (`idestadotipos`) REFERENCES `estadotipos` (`idestadotipos`) ON UPDATE CASCADE,
  ADD CONSTRAINT `archivocargadoestado_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `archivocargadoestado_ibfk_3` FOREIGN KEY (`idarchivocargado`) REFERENCES `archivocargado` (`idarchivocargado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `usuariorol_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

