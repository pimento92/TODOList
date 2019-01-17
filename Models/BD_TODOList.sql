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
  `id_pri` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom_pri` varchar(20) NOT NULL,
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
  `pri_tar` int(2) DEFAULT '1' NOT NULL,
  `id_tar` MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fecha_tar` date NOT NULL,
  `estado_tar` enum('ABIERTA','CERRADA') NOT NULL,
  `desc_tar` varchar(150) NOT NULL,
  `creador_tar` varchar(60) NOT NULL,
  `cat_tar` int DEFAULT '1' NOT NULL,
  FOREIGN KEY (`creador_tar`) REFERENCES USUARIO(`email_usr`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`cat_tar`) REFERENCES CATEGORIA(`id_cat`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`pri_tar`) REFERENCES PRIORIDAD(`id_pri`) ON DELETE NO ACTION ON UPDATE CASCADE
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

CREATE TABLE IF NOT EXISTS `POSEE` (
  `tarea_fas` int NOT NULL,
  `id_fas` int NOT NULL,
  `email_con` varchar(60) NOT NULL,
  FOREIGN KEY (`tarea_fas`) REFERENCES FASE(`tarea_fas`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`id_fas`) REFERENCES FASE(`id_fas`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`email_con`) REFERENCES CONTACTO(`email_con`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT pk_posee PRIMARY KEY (`tarea_fas`,`id_fas`,`email_con`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ADJUNTA` (
  `tarea_fas` int NOT NULL,
  `id_fas` int NOT NULL,
  `id_arch` int NOT NULL,
  FOREIGN KEY (`tarea_fas`) REFERENCES FASE(`tarea_fas`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`id_fas`) REFERENCES FASE(`id_fas`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`id_arch`) REFERENCES ARCHIVO(`id_arch`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT pk_adjunta PRIMARY KEY (`tarea_fas`,`id_fas`,`id_arch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- creamos a los admins e inserciones de prueba
--

INSERT INTO USUARIO (`email_usr`,`pass_usr`,`nom_usr`,`apel_usr`,`fechna_usr`,`telf_usr`,`tipo_usr`) VALUES ('jmrod92@gmail.com','calacu2018','Juan','Márquez Rodríguez','1992-02-21','669811012','ADMIN');
INSERT INTO USUARIO (`email_usr`,`pass_usr`,`nom_usr`,`apel_usr`,`fechna_usr`,`telf_usr`,`tipo_usr`) VALUES ('admin@gmail.com','admin','Pepita','Administrador','1995-02-21','677777777','ADMIN');
INSERT INTO USUARIO (`email_usr`,`pass_usr`,`nom_usr`,`apel_usr`,`fechna_usr`,`telf_usr`,`tipo_usr`) VALUES ('basico@gmail.com','basico','Marta','Regular','1997-02-21','666666666','BASICO');

INSERT INTO CATEGORIA (`nom_cat`,`desc_cat`) VALUES ('SIN CATEGORIA','Tarea sin categoria asignada');
INSERT INTO CATEGORIA (`nom_cat`,`desc_cat`) VALUES ('HOGAR','Tarea relativa a trabajo en el hogar');
INSERT INTO CATEGORIA (`nom_cat`,`desc_cat`) VALUES ('ESEI','Tarea relativa a trabajo en la universidad');
INSERT INTO CATEGORIA (`nom_cat`,`desc_cat`) VALUES ('IU','Tarea relativa a trabajo en Interfaces de Usuario');

INSERT INTO PRIORIDAD (`nom_pri`,`desc_pri`, `codcolor_pri`) VALUES ('SIN PRIORIDAD','Tarea sin prioridad asignada', '#9a9a9a');
INSERT INTO PRIORIDAD (`nom_pri`,`desc_pri`, `codcolor_pri`) VALUES ('URGENCIA ALTA','Grado alto de urgencia', '#ff0000');
INSERT INTO PRIORIDAD (`nom_pri`,`desc_pri`, `codcolor_pri`) VALUES ('URGENCIA MEDIA','Grado medio de urgencia', '#ffff00');
INSERT INTO PRIORIDAD (`nom_pri`,`desc_pri`, `codcolor_pri`) VALUES ('URGENCIA BAJA','Grado bajo de urgencia', '#00ff00');

INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('UI.jpg','Prototipo falso de la interfaz');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('DefinicionEntregaET4.pdf','ET4');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('DefinicionEntregaET5.pdf','ET5');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('DefinicionEvaluacionQA4.pdf','QA4');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('DefinicionEvaluacionQA5.pdf','QA5');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('camaejemplo.jpg','Ejemplo de cama bien hecha');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('listacompra.png','Lista de la compra');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('Receta.jpg','Receta del famoso plato');
INSERT INTO ARCHIVO (`url_arch`,`desc_arch`) VALUES ('mere.png','Ejemplo MERE');


INSERT INTO CONTACTO (`email_con`,`nom_con`, `desc_con`, `telf_con`) VALUES ('jriglesias@esei.uvigo.es','Javier Rodeiro', 'Profesor al cargo de Interfaces', '696969696');
INSERT INTO CONTACTO (`email_con`,`nom_con`, `desc_con`, `telf_con`) VALUES ('orge@esei.uvigo.es','Jose Luis Orge', 'Mano derecha del lord comandante', '656565655');
INSERT INTO CONTACTO (`email_con`,`nom_con`, `desc_con`, `telf_con`) VALUES ('jmrod92@gmail.com','Juan Marquez Rodriguez', 'Alumno estrella de interfaces', '696559696');
INSERT INTO CONTACTO (`email_con`,`nom_con`, `desc_con`, `telf_con`) VALUES ('abuela@gmail.com','Mitica abuela', 'Asesora en tareas del hogar', '655443322');

INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-08','ABIERTA', 'Desarrollo de la ET4', 'basico@gmail.com', '4', '2');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-07','ABIERTA', 'Desarrollo de la ET5', 'basico@gmail.com', '4', '3');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-13','ABIERTA', 'Evaluacion QA4', 'basico@gmail.com', '4', '4');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-18','CERRADA', 'Evaluacion QA5', 'basico@gmail.com', '4', '1');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-19','ABIERTA', 'Hacer la cama', 'basico@gmail.com', '2', '1');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-13','CERRADA', 'Pasear a los perros', 'basico@gmail.com', '1', '1');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-11','ABIERTA', 'Hacer la cena', 'jmrod92@gmail.com', '1', '1');
INSERT INTO TAREA (`fecha_tar`,`estado_tar`, `desc_tar`, `creador_tar`, `cat_tar`, `pri_tar`) VALUES ('2018-12-10','ABIERTA', 'Acabar bases de datos', 'jmrod92@gmail.com', '1', '3');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Elaborar acta de constitucion', '1');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Crear plantillas MVC', '1');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Implementar CRUDs', '1');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Pruebas globales', '1');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Acuerdo de modelo de evaluacion', '2');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Crear individualmente las evaluaciones', '2');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Unificar evaluaciones', '2');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Descargar .rar', '3');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Evaluar .rar', '3');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Descargar .rar', '4');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Evaluar .rar', '4');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Airear la ropa', '5');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Doblar la ropa', '5');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Coger correas', '6');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Coger bolsas fecales', '6');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Salir a la calle', '6');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','CERRADA', 'Volver a casa', '6');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Comprar ingredientes', '7');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Elaborar receta', '7');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Comer la cena', '7');

INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Realizar MERE', '8');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Realizar MR', '8');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Implementar SQL', '8');
INSERT INTO FASE (`fecha_fas`,`estado_fas`, `desc_fas`, `tarea_fas`) VALUES ('2018-12-08','ABIERTA', 'Pruebas globales', '8');

INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('1','1','jriglesias@esei.uvigo.es');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('1','1','orge@esei.uvigo.es');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('1','2','jriglesias@esei.uvigo.es');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('1','3','orge@esei.uvigo.es');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('2','1','jmrod92@gmail.com');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('3','2','jriglesias@esei.uvigo.es');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('4','2','jriglesias@esei.uvigo.es');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('5','2','abuela@gmail.com');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('6','1','jmrod92@gmail.com');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('7','1','abuela@gmail.com');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('7','2','abuela@gmail.com');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('8','1','jmrod92@gmail.com');
INSERT INTO POSEE (`tarea_fas`,`id_fas`,`email_con`) VALUES ('8','2','jmrod92@gmail.com');

INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('1','2','2');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('1','1','1');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('2','2','3');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('3','2','4');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('4','2','5');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('5','2','6');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('7','1','7');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('7','2','8');
INSERT INTO ADJUNTA(`tarea_fas`,`id_fas`,`id_arch`) VALUES ('8','1','8');



--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `datos`
--

