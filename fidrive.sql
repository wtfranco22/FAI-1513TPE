SET SQL_MODE= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT= 0;
START TRANSACTION;
SET time_zone= "+00:00";

--
-- Base de datos: fidrive
--

-- --------------------------------------------------------
--
-- Estructura de tabla 'rol'
--

CREATE TABLE rol
(
  idrol bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  roldescripcion varchar
(50) NOT NULL
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla 'usuario'
--

CREATE TABLE usuario
(
  idusuario bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  usnombre varchar (150) NOT NULL,
  usapellido varchar (150) NOT NULL,
  uslogin varchar (150) NOT NULL,
  usclave varchar (150) NOT NULL,
  usactivo tinyint (1) NOT NULL DEFAULT 1
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla 'usuariorol'
--

CREATE TABLE usuariorol
(
  idusuario bigint(20) NOT NULL,
  idrol bigint(20) NOT NULL,
  PRIMARY KEY (idusuario,idrol),
  FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (idrol) REFERENCES rol(idrol) ON UPDATE CASCADE ON DELETE RESTRICT
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla archivocargado
--

CREATE TABLE archivocargado
(
  idarchivocargado int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  acnombre varchar(150) NOT NULL,
  acdescripcion text NOT NULL,
  acicono varchar(150) NOT NULL,
  idusuario bigint(20) NOT NULL,
  aclinkacceso text NOT NULL,
  accantidaddescarga int(11) NOT NULL,
  accantidadusada int(11) NOT NULL,
  acfechainiciocompartir timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  acefechafincompartir timestamp NOT NULL DEFAULT '2020-12-12 23:59:59',
  acprotegidoclave text NOT NULL,
  FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
  --
  -- Estructura de tabla para la tabla estadotipos
  --

 CREATE TABLE estadotipos
  (
    idestadotipos int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    etdescripcion varchar(100) NOT NULL,
    etactivo tinyint(1) NOT NULL DEFAULT 1
  )
  ENGINE=InnoDB DEFAULT CHARSET=latin1;

  -- --------------------------------------------------------

  --
  -- Estructura de tabla para la tabla archivocargadoestado
  --

  CREATE TABLE archivocargadoestado
  (
    idarchivocargadoestado int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idestadotipos int(11) NOT NULL,
    acedescripcion text NOT NULL,
    idusuario bigint(20) NOT NULL,
    acefechaingreso timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    acefechafin timestamp NULL DEFAULT NULL,
    idarchivocargado int(11) NOT NULL,
    FOREIGN KEY (idestadotipos) REFERENCES estadotipos(idestadotipos) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (idarchivocargado) REFERENCES archivocargado(idarchivocargado) ON UPDATE CASCADE ON DELETE RESTRICT
  )
  ENGINE=InnoDB DEFAULT CHARSET=latin1;

  --
  -- Volcado de datos para la tabla estadotipos
  --

  INSERT INTO estadotipos (etdescripcion, etactivo)
  VALUES
    ('Cargado', 1),
    ('Compartido', 1),
    ('No Compartido', 1),
    ('Eliminado', 1),
    ('Desactivado', 0);

  --
  -- Volcado de datos para la tabla usuario
  --

  INSERT INTO usuario
    (usnombre, usapellido, uslogin, usclave, usactivo)
  VALUES
    ('Admin', 'Administrador', 'FiDrive', 'e10adc3949ba59abbe56e057f20f883e', 1),
    ('visitante', 'Visitante', 'FiDrive', 'e10adc3949ba59abbe56e057f20f883e', 1);
