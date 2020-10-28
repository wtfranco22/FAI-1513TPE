-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2020 a las 22:49:19
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Base de datos: 'fidrive'
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla 'archivocargado'
--
CREATE TABLE archivocargado (
  idarchivocargado int(11) NOT NULL,
  acnombre varchar(150) NOT NULL,
  acdescripcion text NOT NULL,
  acicono varchar(150) NOT NULL,
  idusuario int(11) NOT NULL,
  aclinkacceso text NOT NULL,
  accantidaddescarga int(11) NOT NULL,
  accantidadusada int(11) NOT NULL,
  acfechainiciocompartir timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  acefechafincompartir timestamp NOT NULL DEFAULT '1990-01-01 00:00:00',
  acprotegidoclave text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla 'archivocargadoestado'
--
CREATE TABLE archivocargadoestado (
  idarchivocargadoestado int(11) NOT NULL,
  idestadotipos int(11) NOT NULL,
  acedescripcion text NOT NULL,
  idusuario int(11) NOT NULL,
  acefechaingreso timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  acefechafin timestamp NULL DEFAULT NULL,
  idarchivocargado int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla 'estadotipos'
--
CREATE TABLE estadotipos (
  idestadotipos int(11) NOT NULL,
  etdescripcion varchar(100) NOT NULL,
  etactivo tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Volcado de datos para la tabla 'estadotipos'
--
INSERT INTO estadotipos (idestadotipos, etdescripcion, etactivo) VALUES
(1, 'Cargado', 1),
(2, 'Compartido', 1),
(3, 'No Compartido', 1),
(4, 'Eliminado', 1),
(5, 'Desactivado', 0);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla 'usuario'
--
CREATE TABLE usuario (
  idusuario int(11) NOT NULL,
  usnombre varchar(150) NOT NULL,
  usapellido varchar(150) NOT NULL,
  uslogin varchar(150) NOT NULL,
  usclave varchar(150) NOT NULL,
  usactivo tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Volcado de datos para la tabla 'usuario'
--
INSERT INTO usuario (idusuario, usnombre, usapellido, uslogin, usclave, usactivo) VALUES
(1, 'admin', 'administrador', 'FiDrive', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'visitante', 'Visitante', 'FiDrive', 'e10adc3949ba59abbe56e057f20f883e', 1);
--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla 'archivocargado'
--
ALTER TABLE archivocargado
  ADD PRIMARY KEY (idarchivocargado),
  ADD KEY idusuario (idusuario);
--
-- Indices de la tabla 'archivocargadoestado'
--
ALTER TABLE archivocargadoestado
  ADD PRIMARY KEY (idarchivocargadoestado),
  ADD KEY idestadotipos (idestadotipos),
  ADD KEY idusuario (idusuario),
  ADD KEY idarchivocargado (idarchivocargado);
--
-- Indices de la tabla 'estadotipos'
--
ALTER TABLE estadotipos
  ADD PRIMARY KEY (idestadotipos);
--
-- Indices de la tabla 'usuario'
--
ALTER TABLE usuario
  ADD PRIMARY KEY (idusuario);
--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla 'archivocargado'
--
ALTER TABLE archivocargado
  MODIFY idarchivocargado int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla 'archivocargadoestado'
--
ALTER TABLE archivocargadoestado
  MODIFY idarchivocargadoestado int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla 'estadotipos'
--
ALTER TABLE estadotipos
  MODIFY idestadotipos int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla 'usuario'
--
ALTER TABLE usuario
  MODIFY idusuario int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla 'archivocargado'
--
ALTER TABLE archivocargado
  ADD CONSTRAINT archivocargado_ibfk_1 FOREIGN KEY (idusuario) REFERENCES usuario (idusuario);
--
-- Filtros para la tabla 'archivocargadoestado'
--
ALTER TABLE archivocargadoestado
  ADD CONSTRAINT archivocargadoestado_ibfk_1 FOREIGN KEY (idestadotipos) REFERENCES estadotipos (idestadotipos),
  ADD CONSTRAINT archivocargadoestado_ibfk_2 FOREIGN KEY (idarchivocargado) REFERENCES archivocargado (idarchivocargado),
  ADD CONSTRAINT archivocargadoestado_ibfk_3 FOREIGN KEY (idusuario) REFERENCES usuario (idusuario);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;