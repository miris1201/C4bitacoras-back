-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jul 11, 2023 at 07:38 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `template-back`
--
CREATE DATABASE IF NOT EXISTS `template-back` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `template-back`;

-- --------------------------------------------------------

--
-- Table structure for table `ws_menu`
--

DROP TABLE IF EXISTS `ws_menu`;
CREATE TABLE IF NOT EXISTS `ws_menu` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) NOT NULL,
  `texto` varchar(28) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `title` varchar(75) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `class` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `sec` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Se muestra o no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ws_menu`
--

INSERT INTO `ws_menu` (`id`, `id_grupo`, `texto`, `title`, `link`, `class`, `orden`, `sec`, `activo`) VALUES
(1, 0, 'Administrador', '', '', 'screwdriver-wrench', 5, '', 1),
(2, 1, 'Usuarios', 'Ver Lista de usuarios', '/users', '', 1, '', 1),
(3, 1, 'Roles', 'Ver lista de Roles', '/rol', '', 2, '', 1),
(4, 0, 'Catálogos', '', '', 'folder-closed', 3, '', 1),
(5, 4, 'Operadores', '', '/operadores', '', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_parametro`
--

DROP TABLE IF EXISTS `ws_parametro`;
CREATE TABLE IF NOT EXISTS `ws_parametro` (
  `id_parametro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del parametro',
  `cve_parametro` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '' COMMENT 'Clave del parametro',
  `valor` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '' COMMENT 'Valor del parametro',
  `activo` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Esta activo',
  PRIMARY KEY (`id_parametro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Parametros del sistema';

--
-- Dumping data for table `ws_parametro`
--

INSERT INTO `ws_parametro` (`id_parametro`, `cve_parametro`, `valor`, `activo`) VALUES
(1, 'Sistema activo', '1', 1),
(2, 'Anio Activo', '2021', 1),
(3, 'Mes activo', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_rol`
--

DROP TABLE IF EXISTS `ws_rol`;
CREATE TABLE IF NOT EXISTS `ws_rol` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rol` varchar(90) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 activo, 0 inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ws_rol`
--

INSERT INTO `ws_rol` (`id`, `rol`, `descripcion`, `activo`) VALUES
(1, 'Super Usuario', 'Rol del Fabricante', 1),
(2, 'Administrador', 'Rol de administrador ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_rol_menu`
--

DROP TABLE IF EXISTS `ws_rol_menu`;
CREATE TABLE IF NOT EXISTS `ws_rol_menu` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `imp` tinyint(4) NOT NULL DEFAULT '0',
  `edit` tinyint(4) NOT NULL DEFAULT '0',
  `elim` tinyint(4) NOT NULL DEFAULT '0',
  `nuevo` tinyint(4) NOT NULL DEFAULT '0',
  `exportar` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ws_rol_menu`
--

INSERT INTO `ws_rol_menu` (`id`, `id_rol`, `id_menu`, `imp`, `edit`, `elim`, `nuevo`, `exportar`) VALUES
(19, 1, 1, 0, 0, 0, 0, 0),
(20, 1, 2, 1, 1, 1, 1, 1),
(21, 1, 3, 1, 1, 1, 1, 1),
(22, 1, 4, 0, 0, 0, 0, 0),
(23, 1, 5, 0, 1, 1, 1, 1),
(24, 1, 6, 0, 1, 1, 1, 1),
(25, 1, 7, 0, 1, 1, 1, 1),
(26, 1, 8, 0, 1, 1, 1, 1),
(27, 1, 9, 0, 0, 0, 0, 0),
(28, 1, 10, 0, 1, 1, 1, 1),
(29, 1, 11, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_usuario`
--

DROP TABLE IF EXISTS `ws_usuario`;
CREATE TABLE IF NOT EXISTS `ws_usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_carpeta` int(11) NOT NULL DEFAULT '0',
  `id_rol` tinyint(4) NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apepa` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `apema` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` tinyint(4) DEFAULT '1' COMMENT '1 es masculino, 2 femenino',
  `correo` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `imp` tinyint(1) NOT NULL,
  `edit` tinyint(1) NOT NULL,
  `elim` tinyint(1) NOT NULL,
  `nuev` tinyint(1) NOT NULL,
  `img` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Avatar de usuario',
  `admin` tinyint(4) DEFAULT NULL COMMENT '1 Si es admin, 0 es usuario estandard',
  `token` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ws_usuario`
--

INSERT INTO `ws_usuario` (`id_usuario`, `id_carpeta`, `id_rol`, `usuario`, `clave`, `nombre`, `apepa`, `apema`, `sexo`, `correo`, `fecha_ingreso`, `imp`, `edit`, `elim`, `nuev`, `img`, `admin`, `token`, `activo`) VALUES
(1, 0, 1, 'turing', 'ffeba47590f3c5d44ff4146ad600ec8a04bffa4cc42cce4bde782d34202332c1', 'Super', 'Administrador', ' ', 1, '', '2015-08-25', 1, 1, 1, 1, 'avatar5.png', 1, 'f848eea8567fb1454f47a3d76e12fb4f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_usuario_menu`
--

DROP TABLE IF EXISTS `ws_usuario_menu`;
CREATE TABLE IF NOT EXISTS `ws_usuario_menu` (
  `id_usuario_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `imp` tinyint(4) NOT NULL,
  `edit` tinyint(4) NOT NULL,
  `elim` tinyint(4) NOT NULL,
  `nuevo` tinyint(4) NOT NULL,
  `exportar` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_usuario_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=576 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_usuario_menu`
--

INSERT INTO `ws_usuario_menu` (`id_usuario_menu`, `id_usuario`, `id_menu`, `imp`, `edit`, `elim`, `nuevo`, `exportar`) VALUES
(181, 1, 13, 0, 1, 1, 1, 1),
(180, 1, 12, 0, 0, 0, 0, 0),
(179, 1, 11, 0, 1, 1, 1, 1),
(178, 1, 10, 0, 1, 1, 1, 1),
(177, 1, 9, 0, 0, 0, 0, 0),
(176, 1, 17, 0, 1, 1, 1, 1),
(175, 1, 16, 0, 1, 1, 1, 1),
(174, 1, 15, 0, 1, 1, 1, 1),
(173, 1, 14, 0, 1, 1, 1, 1),
(172, 1, 8, 0, 1, 1, 1, 1),
(171, 1, 7, 0, 1, 1, 1, 1),
(170, 1, 6, 0, 1, 1, 1, 1),
(169, 1, 5, 0, 1, 1, 1, 1),
(168, 1, 4, 0, 0, 0, 0, 0),
(167, 1, 3, 1, 1, 1, 1, 1),
(166, 1, 2, 1, 1, 1, 1, 1),
(165, 1, 1, 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
