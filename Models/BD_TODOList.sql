--
-- jmarquez - 11/11/2018
-- script de creación de la bd, usuario, asignación de privilegios a ese usuario sobre la bd
-- creación de tabla e insert sobre la misma.
--
-- CREAR LA BD BORRANDOLA SI YA EXISTIESE
--
DROP DATABASE IF EXISTS `TODOLISTDB`;
CREATE DATABASE `TODOLISTDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `TODOLISTDB`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `todolistdba`@`localhost`;
	DROP USER `todolistdba`@`localhost`;
--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `todolistdba`@`localhost` IDENTIFIED BY 'todolistpass';
GRANT USAGE ON *.* TO `todolistdba`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `TODOLISTDB`.* TO `todolistdba`@`localhost` WITH GRANT OPTION;
--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS `CATEGORIA` (
  `id_cat` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom_cat` varchar(20) NOT NULL,
  `desc_cat` varchar(150) NOT NULL
)  ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `PRIORIDAD` (
  `id_cat` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom_pri` varchar(20) NOT NULL ,
  `desc_pri` varchar(150) NOT NULL,
  `codcolor_pri` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ARCHIVO` (
  `id_arch` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `url_arch` varchar(60) NOT NULL,
  `desc_arch` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `CONTACTO` (
  `email_con` varchar(60) PRIMARY KEY,
  `desc_con` varchar(150) NOT NULL,
  `telf_con` varchar(11) NOT NULL,
  `nom_con` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `USUARIO` (
  `nom_usr` varchar(30) NOT NULL,
  `apel_usr` varchar(50) NOT NULL,
  `telf_usr` varchar(11) NOT NULL,
  `email_usr` varchar(60) PRIMARY KEY,
  `pass_usr` varchar(20) NOT NULL,
  `fechna_usr` date NOT NULL,
  `tipo_usr` enum('BASICO','ADMIN') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `TAREA` (
  `pri_tar` int(2) NULL,
  `id_tar` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fecha_tar` date NOT NULL,
  `estado_tar` enum('ABIERTA','CERRADA') NOT NULL,
  `desc_tar` varchar(150) NOT NULL,
  `creador_tar` varchar(60) NOT NULL,
  `cat_tar` int NULL,
  FOREIGN KEY (`creador_tar`) REFERENCES USUARIO(`email_usr`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`cat_tar`) REFERENCES CATEGORIA(`id_cat`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`pri_tar`) REFERENCES PRIORIDAD(`num_pri`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `FASE` (
  `tarea_fas` int NOT NULL,
  `id_fas` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `fecha_fas` date NOT NULL,
  `estado_fas` enum('ABIERTA','CERRADA') NOT NULL,
  `desc_fas` varchar(150) NOT NULL,
  FOREIGN KEY (`tarea_fas`) REFERENCES TAREA(`id_tar`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT pk_fase PRIMARY KEY (`tarea_fas`,`id_fas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- creamos a los admins
--

INSERT INTO USUARIO (`email_usr`,`pass_usr`,`nom_usr`,`apel_usr`,`fechna_usr`,`telf_usr`,`tipo_usr`) VALUES ('jmrod92@gmail.com','calacu2018','Juan','Márquez Rodríguez','1992-02-21','669811012','ADMIN');

INSERT INTO CATEGORIA (`nom_cat`,`desc_cat`) VALUES ('HOGAR','Tarea relativa a trabajo en el hogar');

INSERT INTO PRIORIDAD (`nom_pri`,`desc_pri`, `codcolor_pri`) VALUES ('MÁXIMA URGENCIA','Prioridad máxima de ejecución', '#000000');

INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('/porn/BBW/gordibuena.wmv','Archivo íntimo de uso recreativo');

INSERT INTO CONTACTO (`email_con`,`nom_con`, `desc_con`, `telf_con`) VALUES ('jriglesias@esei.uvigo.es','Javier Rodeiro', 'Líder supremo del Imperio intergaláctico', '696969696');

INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-08','ABIERTA', 'Pajilla nocturna con gordibuenas', 'jmrod92@gmail.com', '1', '1');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Pillar lubricante del bueno en la farmacia de la dependienta cachonda', '1');

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `datos`
--

