-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 14-05-2024 a las 21:57:06
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_bitacora`
--
CREATE DATABASE IF NOT EXISTS `db_bitacora` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `db_bitacora`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_colonias`
--

DROP TABLE IF EXISTS `cat_colonias`;
CREATE TABLE IF NOT EXISTS `cat_colonias` (
  `id_colonia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sector` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_colonia`)
) ENGINE=InnoDB AUTO_INCREMENT=290 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_colonias`
--

INSERT INTO `cat_colonias` (`id_colonia`, `nombre`, `tipo`, `sector`, `region`, `activo`) VALUES
(1, 'SAN JAVIER AMPLIACION', 'COL', 1, 1, 1),
(2, 'BENITO JUÁREZ CENTRO', 'COL', 1, 1, 1),
(3, 'EL TRIANGULO', 'COL', 1, 1, 1),
(4, 'TLALNEPANTLA CENTRO', 'COL', 1, 1, 1),
(5, 'TLALNEPANTLA', 'FRACC. IND', 1, 1, 1),
(6, 'SAN NICOLÁS', 'FRACC. IND', 1, 1, 1),
(7, 'TLAXCOLPAN', 'FRACC. IND', 1, 1, 1),
(8, 'SAN LORENZO', 'FRACC. IND', 1, 1, 1),
(9, 'LA RIVIERA', 'FRACC', 1, 1, 1),
(10, 'LA ROMANA', 'FRACC', 1, 1, 1),
(11, 'RANCHO SAN ANTONIO', 'FRACC', 2, 1, 1),
(12, 'SAN JAVIER', 'FRACC', 1, 1, 1),
(13, 'LA LOMA', 'PUEBLO', 2, 1, 1),
(14, 'ALTAVISTA', 'U.H', 1, 1, 1),
(15, 'TLALCALLI', 'U.H', 2, 1, 1),
(16, '21 DE MARZO', 'COL', 10, 3, 1),
(17, 'COOPERATIVA LA ROMANA', 'COL', 10, 3, 1),
(18, 'EL OLIVO I', 'COL', 10, 3, 1),
(19, 'FRANJA FÉRREA ', 'COL', 10, 3, 1),
(20, 'FRANJA MUNICIPAL', 'COL', 10, 3, 1),
(21, 'HOGAR OBRERO', 'COL', 10, 3, 1),
(22, 'ISIDRO FABELA', 'COL', 10, 3, 1),
(23, 'LA BLANCA', 'COL', 10, 3, 1),
(24, 'LOMAS DEL CALAVARIO', 'COL', 10, 3, 1),
(25, 'LOS PARAJES', 'COL', 10, 3, 1),
(26, 'REFORMA URBANA', 'COL', 10, 3, 1),
(27, 'TLAYAPA', 'COL', 10, 3, 1),
(28, 'LA PROVIDENCIA', 'COL', 8, 2, 1),
(29, 'LA AZTECA', 'COL', 9, 1, 1),
(30, 'BARRIENTOS', 'FRACC. IND', 9, 1, 1),
(32, 'COMUNIDAD BETANIA', 'FRACC', 9, 1, 1),
(33, 'EL OLIVO II PARTE ALTA', 'FRACC', 10, 3, 1),
(34, 'EL OLIVO II PARTE BAJA', 'FRACC', 10, 3, 1),
(35, 'SAN PEDRO BARRIENTOS', 'PUEBLO ', 9, 1, 1),
(36, 'SANTA MARIA TLAYACAMPA', 'PUEBLO ', 10, 3, 1),
(37, 'BARRIENTOS GUSTAVO BAZ', 'U.H', 9, 1, 1),
(38, 'MAGISTERIAL BARRIENTOS', 'U.H', 9, 1, 1),
(39, 'NIÑOS HEROES', 'FRACC. IND', 9, 1, 1),
(40, 'RINCONADA LA BLANCA', 'U.H', 10, 3, 1),
(42, 'BARRIENTOS', 'U.H', 10, 3, 1),
(43, 'BELLAVISTA PUENTE DE VIGAS', 'COL', 2, 1, 1),
(44, 'LA ESCUELA', 'COL', 2, 1, 1),
(45, 'LA MORA', 'COL', 2, 1, 1),
(46, 'ROSARIO I SECTOR CROC VII', 'U.H', 3, 1, 1),
(47, 'LAS ARMAS', 'FRACC. IND', 3, 1, 1),
(50, 'PUENTE DE VIGAS', 'FRACC. IND', 2, 1, 1),
(51, 'XOCOYAHUALCO', 'PUEBLO ', 4, 2, 1),
(52, 'PUENTE DE VIGAS', 'PUEBLO', 2, 1, 1),
(53, 'SAN JERONIMO TEPETLACALCO', 'PUEBLO', 2, 1, 1),
(54, 'SAN JOSE PUENTE DE VIGAS', 'PUEBLO', 3, 1, 1),
(55, 'LOS CEDROS', 'U.H', 3, 1, 1),
(56, 'MONSERRAT', 'U.H', 2, 1, 1),
(57, 'SEDENA', 'U.H', 2, 1, 1),
(58, 'ROSARIO I SECTOR CROC II', 'U.H', 3, 1, 1),
(59, 'ROSARIO I SECTOR CROC III-A', 'U.H', 3, 1, 1),
(60, 'ROSARIO I SECTOR CROC III-B', 'U.H', 3, 1, 1),
(61, 'ROSARIO I SECTOR CROC V BUGAMBILIAS', 'U.H', 3, 1, 1),
(62, 'ROSARIO I SECTOR II-CA', 'U.H', 3, 1, 1),
(63, 'ROSARIO I SECTOR II-CB', 'U.H', 3, 1, 1),
(64, 'ROSARIO I SECTOR II-CD', 'U.H', 3, 1, 1),
(65, 'ROSARIO I SECTOR III-A', 'U.H', 3, 1, 1),
(66, 'ROSARIO I SECTOR III-B', 'U.H', 3, 1, 1),
(67, 'ROSARIO I SECTOR III-C', 'U.H', 3, 1, 1),
(68, 'ROSARIO II GASERA', 'U.H', 3, 1, 1),
(69, 'ROSARIO II SECTOR I', 'U.H', 3, 1, 1),
(70, 'ROSARIO II SECTOR II', 'U.H', 3, 1, 1),
(71, 'ROSARIO II SECTOR III', 'U.H', 3, 1, 1),
(72, 'ROSARIO II HIPÓDROMO TEXTIL', 'U.H', 3, 1, 1),
(73, 'TLALNEMEX', 'COL', 2, 1, 1),
(74, 'LOS REYES IXTACALA 1RA. SECCIÓN', 'FRACC', 2, 1, 1),
(75, 'LA COMUNIDAD', 'FRACC', 2, 1, 1),
(76, 'LOS REYES IXTACALA 2DA. SECCIÓN', 'FRACC', 2, 1, 1),
(77, 'LOS REYES', 'FRACC. IND', 2, 1, 1),
(78, 'LOS REYES', 'PUEBLO', 2, 1, 1),
(79, 'SAN PABLO XALPA', 'PUEBLO', 3, 1, 1),
(80, 'TEJAVANES', 'U.H', 2, 1, 1),
(81, 'GUSTAVO BAZ PRADA LOS REYES IXTACALA', 'U.H', 2, 1, 1),
(82, 'EL CORTIJO', 'U.H', 2, 1, 1),
(83, 'HOGARES FERROCARRILEROS', 'U.H', 2, 1, 1),
(84, 'EL MIRADOR', 'COL', 4, 2, 1),
(85, 'MIGUEL HIDALGO', 'COL', 5, 2, 1),
(86, 'VISTA HERMOSA', 'COL', 4, 2, 1),
(87, 'VISTA HERMOSA AMPLIACION', 'FRACC', 4, 2, 1),
(88, 'ARCOS ELECTRA', 'FRACC', 5, 2, 1),
(89, 'ELECTRA', 'FRACC', 5, 2, 1),
(90, 'LAS ROSAS', 'FRACC', 5, 2, 1),
(91, 'PLAZAS DE LA COLINA', 'FRACC', 4, 2, 1),
(92, 'RESIDENCIAL DEL PARQUE', 'FRACC', 4, 2, 1),
(94, 'RINCONADA DEL PARAISO', 'FRACC', 5, 2, 1),
(95, 'VALLE DE LOS PINOS 2°. SECCIÓN', 'FRACC', 5, 2, 1),
(96, 'VALLE DEL PARAISO', 'FRACC', 5, 2, 1),
(97, 'VALLE SOL', 'FRACC', 5, 2, 1),
(98, 'VIVEROS DE LA LOMA', 'FRACC', 5, 2, 1),
(99, 'VIVEROS DEL RIO', 'FRACC', 5, 2, 1),
(100, 'VIVEROS DEL VALLE', 'FRACC', 5, 2, 1),
(101, 'VALLE VERDE', 'FRACC', 6, 2, 1),
(102, 'CONJUNTO PINTORES', 'FRACC', 4, 2, 1),
(103, 'REAL OCHO', 'U.H', 4, 2, 1),
(104, 'CONDOMINIOS VILLA SATELITE', 'U.H', 4, 2, 1),
(105, 'ADOLFO LOPEZ MATEOS', 'U.H', 5, 2, 1),
(106, 'NATURA', 'U.H', 4, 2, 1),
(107, 'TEPETLACALCO A.C.', 'U.H', 5, 2, 1),
(108, 'BENITO JUAREZ TEQUEX', 'COL', 8, 2, 1),
(109, 'TEQUEXQUINÁHUAC PARTE ALTA', 'COL', 8, 2, 1),
(110, 'LOMA AZUL', 'COL', 7, 2, 1),
(111, 'LOMAS DE ATLALCO', 'COL', 7, 2, 1),
(112, 'LOMAS TULPAN', 'COL', 7, 2, 1),
(113, 'ROBLES PATERA', 'COL', 7, 2, 1),
(114, 'RIVERA DEL BOSQUE', 'FRACC', 9, 1, 1),
(115, 'CUMBRES DEL VALLE', 'FRACC', 8, 2, 1),
(116, 'LAS ARBOLEDAS', 'FRACC', 7, 2, 1),
(117, 'LOMAS BOULEVARES', 'FRACC', 8, 2, 1),
(118, 'RESIDENCIAL EL DORADO', 'FRACC', 8, 2, 1),
(119, 'VALLE HERMOSO', 'FRACC', 9, 1, 1),
(120, 'LA JOYA CHICA', 'FRACC', 7, 2, 1),
(121, 'LOMAS DE VALLE DORADO', 'FRACC', 7, 2, 1),
(122, 'LOS PIRULES', 'FRACC', 7, 2, 1),
(123, 'LOS PIRULES AMPLIACIÓN', 'FRACC', 7, 2, 1),
(124, 'RINCON DEL VALLE', 'FRACC', 7, 2, 1),
(125, 'VALLE DORADO', 'FRACC', 7, 2, 1),
(126, 'TEQUEXQUINAHUAC', 'PUEBLO', 9, 1, 1),
(127, 'CONJUNTO URBANO TERRAZE', 'U.H', 9, 1, 1),
(128, 'CONDOMINIO TEQUEXQUINAHUAC', 'U.H', 9, 1, 1),
(129, 'IMSS TLALNEPANTLA', 'U.H', 9, 1, 1),
(130, 'EL GRAN DORADO', 'U.H', 7, 2, 1),
(131, 'JOSE MARIA VELASCO', 'U.H', 9, 1, 1),
(132, 'SAN LUCAS TEPETLACALCO AMPLIACIÓN', 'COL', 6, 2, 1),
(133, 'SAN ANDRÉS ATENCO AMPLIACIÓN', 'COL', 7, 2, 1),
(134, 'LOMAS DE SAN ANDRÉS ATENCO', 'COL', 7, 2, 1),
(135, 'LOMAS DE SAN ANDRÉS ATENCO AMPLIACIÓN', 'COL', 7, 2, 1),
(136, 'EX HACIENDA DE SANTA MÓNICA', 'COL', 6, 2, 1),
(137, 'FRANCISCO VILLA', 'COL', 6, 2, 1),
(138, 'LEANDRO VALLE', 'COL', 6, 2, 1),
(139, 'BOSQUES DE MÉXICO', 'FRACC', 6, 2, 1),
(140, 'CLUB DE GOLF BELLAVISTA', 'FRACC', 6, 2, 1),
(141, 'JACARANDAS', 'FRACC', 6, 2, 1),
(142, 'JACARANDAS AMPLIACION', 'FRACC', 6, 2, 1),
(143, 'JARDINES DE BELLAVISTA', 'FRACC', 6, 2, 1),
(144, 'MAGISTERIAL VISTA BELLA', 'FRACC', 6, 2, 1),
(145, 'RESIDENCIAL PRIVANZA', 'FRACC', 6, 2, 1),
(146, 'RINCÓN DE BELLA VISTA', 'FRACC', 6, 2, 1),
(148, 'VALLE DE SANTA MÓNICA', 'FRACC', 6, 2, 1),
(149, 'VILLAS DE SANTA MÓNICA', 'FRACC', 6, 2, 1),
(150, 'LAS MARGARITAS 1° SECCIÓN', 'FRACC', 6, 2, 1),
(151, 'LAS MARGARITAS 2° SECCIÓN', 'FRACC', 6, 2, 1),
(152, 'VALLE DE LOS PINOS 1° SECCIÓN', 'FRACC', 6, 2, 1),
(153, 'SAN LUCAS TEPETLACALCO', 'PUEBLO', 6, 2, 1),
(154, 'SAN ANDRÉS ATENCO', 'PUEBLO', 7, 2, 1),
(155, 'BOSQUES DE CEYLÁN', 'COL', 14, 3, 1),
(156, 'CEYLÁN IXTACALA', 'COL', 14, 3, 1),
(157, 'LA JOYA IXTACALA', 'COL', 14, 3, 1),
(158, 'PRADO IXTACALA', 'COL', 14, 3, 1),
(159, 'PRENSA NACIONAL', 'COL', 14, 3, 1),
(160, 'SAN ANTONIO IXTACALA', 'COL', 14, 3, 1),
(161, 'SAN FELIPE IXTACALA', 'COL', 14, 3, 1),
(162, 'SAN JUAN IXTACALA AMPLIACIÓN NORTE\r\n', 'COL', 14, 3, 1),
(163, 'VENUSTIANO CARRANZA', 'COL', 14, 3, 1),
(164, 'MIRAFLORES', 'FRACC', 14, 3, 1),
(165, 'NUEVA IXTACALA', 'FRACC', 14, 3, 1),
(166, 'PRADO VALLEJO', 'FRACC', 14, 3, 1),
(167, 'ROSARIO CEYLAN', 'FRACC', 14, 3, 1),
(168, 'SAN PABLO XALPA', 'FRACC. IND', 14, 3, 1),
(169, 'SAN JUAN IXTACALA', 'PUEBLO', 14, 3, 1),
(171, 'EL TEJOCOTE', 'U.H', 14, 3, 1),
(172, 'EX HACIENDA DE EN MEDIO', 'U.H', 14, 3, 1),
(173, 'MARAVILLAS CEYLÁN', 'U.H', 14, 3, 1),
(174, 'P.I.P.S.A.', 'U.H', 14, 3, 1),
(175, 'TABLA HONDA', 'COL', 13, 3, 1),
(176, 'AHUEHUETES', 'COL', 13, 3, 1),
(177, 'F.F.C.C. CECILIA MORA VDA. DE GÓMEZ', 'COL', 12, 3, 1),
(178, 'FERROCARRILERA SAN RAFAEL', 'COL', 12, 3, 1),
(179, 'JESÚS GARCÍA CORONA', 'COL', 1, 1, 1),
(181, 'FERROCARRILERA EL HOYO', 'COL', 1, 1, 1),
(182, 'LA NUEVA FERROCARRILERA', 'COL', 1, 1, 1),
(183, 'MEDIA LUNA', 'COL', 13, 3, 1),
(184, 'RANCHO SAN RAFAEL AMATES', 'COL', 12, 3, 1),
(185, 'RÍO SAN JAVIER', 'COL', 13, 3, 1),
(186, 'VALLE CEYLAN AMPLIACION', 'FRACC', 13, 3, 1),
(187, 'IZCALLI DEL RÍO', 'FRACC', 13, 3, 1),
(188, 'IZCALLI PIRÁMIDE', 'FRACC', 13, 3, 1),
(189, 'SAN RAFAEL', 'FRACC', 12, 3, 1),
(190, 'VALLE CEYLAN', 'FRACC', 13, 3, 1),
(191, 'SAN BUENAVENTURA', 'FRACC. IND', 13, 3, 1),
(192, 'TABLA HONDA', 'FRACC. IND', 13, 3, 1),
(193, 'SAN BARTOLO TENAYUCA', 'PUEBLO', 13, 3, 1),
(194, 'SAN RAFAEL PUEBLO', 'PUEBLO', 12, 3, 1),
(195, 'TABLA HONDA', 'U.H', 12, 3, 1),
(196, 'IZCALLI PIRÁMIDE II', 'U.H', 13, 3, 1),
(197, 'JARDINES DE SANTA CECILIA INFONAVIT', 'U.H', 12, 3, 1),
(198, 'LOMA ESCONDIDA', 'U.H', 13, 3, 1),
(199, 'SAN BUENAVENTURA', 'U.H', 13, 3, 1),
(200, 'CONDOMINIO RESIDENCIAL SANTA CECILIA', 'U.H', 12, 3, 1),
(201, 'CONDOMINIOS SAN RAFAEL', 'U.H', 12, 3, 1),
(202, 'CUAUHTÉMOC', 'COL', 11, 3, 1),
(203, 'EL ROSAL', 'COL', 11, 3, 1),
(204, 'EX EJIDO DE SANTA CECILIA', 'COL', 11, 3, 1),
(205, 'GUSTAVO BAZ PRADA', 'COL', 11, 3, 1),
(206, 'GUSTAVO BAZ PRADA AMPLIACIÓN', 'COL', 11, 3, 1),
(207, 'INDEPENDENCIA', 'COL', 11, 3, 1),
(208, 'INDEPENDENCIA AMPLIACIÓN', 'COL', 11, 3, 1),
(209, 'LOS ANGELES', 'COL', 11, 3, 1),
(210, 'HUGO CERVANTES DEL RÍO', 'FRACC', 11, 3, 1),
(211, 'IZCALLI ACATITLAN', 'FRACC', 11, 3, 1),
(212, 'JARDINES DE SANTA CECILIA', 'FRACC', 12, 3, 1),
(213, 'LA CAÑADA', 'FRACC', 11, 3, 1),
(214, 'LOMA BONITA', 'FRACC', 11, 3, 1),
(215, 'SANTA CECILIA', 'FRACC', 12, 3, 1),
(216, 'VALLE DE LAS PIRÁMIDES', 'FRACC', 12, 3, 1),
(217, 'SANTA CECILIA ACATITLÁN', 'PUEBLO', 11, 3, 1),
(218, 'VALLE DEL TENAYO', 'U.H', 12, 3, 1),
(219, 'EL TENAYO', 'U.H', 11, 3, 1),
(220, 'EL TENAYO NORTE', 'COL', 11, 3, 1),
(221, 'ACUEDUCTO TENAYUCA', 'COL', 13, 3, 1),
(222, 'LA ARBOLEDA AMPLIACION', 'COL', 12, 3, 1),
(223, 'EL ARENAL', 'COL', 13, 3, 1),
(224, 'EL PUERTO', 'COL', 11, 3, 1),
(225, 'EL TENAYO CENTRO', 'COL', 11, 3, 1),
(226, 'EL TENAYO SUR', 'COL', 12, 3, 1),
(227, 'EX EJIDOS DE SAN LUCAS PATONI', 'COL', 12, 3, 1),
(228, 'LA ARBOLEDA', 'COL', 12, 3, 1),
(229, 'LA CANTERA', 'COL', 12, 3, 1),
(230, 'LA PURÍSIMA', 'COL', 13, 3, 1),
(231, 'LA SIDERAL', 'COL', 12, 3, 1),
(232, 'LAS PALOMAS\r\n', 'COL', 12, 3, 1),
(233, 'PODER DE DIOS', 'COL', 13, 3, 1),
(234, 'CHALMA LA BARRANCA', 'FRACC', 11, 3, 1),
(235, 'CHALMA LA UNIÓN', 'FRACC', 11, 3, 1),
(236, 'SAN LUCAS PATONI', 'PUEBLO', 12, 3, 1),
(237, 'SAN MIGUEL CHALMA', 'PUEBLO', 11, 3, 1),
(238, 'MONTES AZULES', 'U.H', 13, 3, 1),
(239, 'PRIVADA DE SAN MIGUEL CHALMA', 'U.H', 11, 3, 1),
(240, 'CROC SOLIDARIDAD', 'U.H', 13, 3, 1),
(241, 'LÁZARO CÁRDENAS 1RA. SECCIÓN', 'COL', 15, 4, 1),
(242, 'LÁZARO CÁRDENAS 2DA. SECCIÓN', 'COL', 15, 4, 1),
(243, 'LÁZARO CÁRDENAS 3RA. SECCIÓN', 'COL', 15, 4, 1),
(245, 'MAGISTERIAL SIGLO XXI\r\n', 'U.H', 15, 4, 1),
(246, 'ATRÁS DEL TEQUIQUIL', 'COL', 16, 4, 1),
(247, 'CONSTITUYENTES DE 1857', 'COL', 17, 4, 1),
(248, 'DIVISIÓN DEL NORTE', 'COL', 17, 4, 1),
(249, 'F.F.C.C. CONCEPCION ZEPEDA VDA. DE GOMEZ', 'COL', 17, 4, 1),
(250, 'LA LAGUNA', 'COL', 17, 4, 1),
(251, 'LOMAS DE SAN JUAN IXHUATEPEC', 'COL', 16, 4, 1),
(252, 'MARINA NACIONAL', 'COL', 17, 4, 1),
(253, 'SAN JUAN IXHUATEPEC', 'PUEBLO', 16, 4, 1),
(254, 'CONSTITUCIÓN DE 1917', 'COL', 18, 4, 1),
(255, 'DR. JORGE JIMÉNEZ CANTÚ', 'COL', 18, 4, 1),
(256, 'EX EJIDOS DE TEPEOLULCO', 'COL', 19, 4, 1),
(257, 'LA PETROLERA', 'COL', 18, 4, 1),
(258, 'SAN ISIDRO IXHUATEPEC', 'COL', 18, 4, 1),
(259, 'SAN JOSÉ IXHUATEPEC', 'COL', 18, 4, 1),
(260, 'LOMAS DE LINDAVISTA EL COPAL', 'FRACC', 16, 4, 1),
(261, 'BAHÍA DEL COPAL', 'U.H', 16, 4, 1),
(263, 'COLINAS DE SAN JOSÉ', 'U.H', 18, 4, 1),
(264, 'LAS MANZANAS', 'U.H', 18, 4, 1),
(265, 'JARDINES DE SANTA MÓNICA', 'FRACC', 6, 2, 1),
(266, 'BELLAVISTA SATÉLITE', 'FRACC', 6, 2, 1),
(267, 'LA CUCHILLA', 'COL', 1, 1, 1),
(268, 'SAN JERONIMO TEPETLACALCO', 'FRACC. IND', 2, 1, 1),
(273, 'SAN JOSE PUENTE DE VIGAS', 'FRACC. IND', 3, 1, 1),
(275, 'LA LOMA', 'FRACC. IND', 5, 2, 1),
(279, 'NIÑOS HEROES', 'U.H', 9, 1, 1),
(280, 'ARTEMISA', 'U.H', 14, 3, 1),
(282, 'BOSQUES DE LINDAVISTA', 'U.H', 15, 4, 1),
(283, 'LA PRESA', 'FRACC. IND', 15, 4, 1),
(284, 'ENCUESTRE SAN JOSÉ', 'U.H', 16, 4, 1),
(285, 'LOS PREDIOS', 'U.H', 19, 4, 1),
(286, 'LOMA LINDA', 'U.H', 19, 4, 1),
(288, 'TLAYAPA', 'U.H', 10, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_cuadrantes`
--

DROP TABLE IF EXISTS `cat_cuadrantes`;
CREATE TABLE IF NOT EXISTS `cat_cuadrantes` (
  `id_cuadrante` int(11) NOT NULL AUTO_INCREMENT,
  `id_zona` int(11) DEFAULT NULL COMMENT '1 PONIENTE 2 ORIENTE',
  `sector` int(11) DEFAULT NULL,
  `cuadrante` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cuadrante`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_cuadrantes`
--

INSERT INTO `cat_cuadrantes` (`id_cuadrante`, `id_zona`, `sector`, `cuadrante`, `activo`) VALUES
(1, 1, 1, 'C-011', 1),
(2, 1, 1, 'C-012', 1),
(3, 1, 1, 'C-013', 1),
(4, 1, 1, 'C-014', 1),
(5, 1, 2, 'C-021', 1),
(6, 1, 2, 'C-022', 1),
(7, 1, 2, 'C-023', 1),
(8, 1, 2, 'C-024', 1),
(9, 1, 2, 'C-025', 1),
(10, 1, 3, 'C-031', 1),
(11, 1, 3, 'C-032', 1),
(12, 1, 3, 'C-033', 1),
(13, 1, 3, 'C-034', 1),
(14, 1, 4, 'C-041', 1),
(15, 1, 4, 'C-042', 1),
(16, 1, 4, 'C-043', 1),
(17, 1, 4, 'C-044', 1),
(18, 1, 5, 'C-051', 1),
(19, 1, 5, 'C-052', 1),
(20, 1, 5, 'C-053', 1),
(21, 1, 5, 'C-054', 1),
(22, 1, 5, 'C-055', 1),
(23, 1, 6, 'C-061', 1),
(24, 1, 6, 'C-062', 1),
(25, 1, 6, 'C-063', 1),
(26, 1, 6, 'C-064', 1),
(27, 1, 6, 'C-065', 1),
(28, 1, 7, 'C-071', 1),
(29, 1, 7, 'C-072', 1),
(30, 1, 7, 'C-073', 1),
(31, 1, 7, 'C-074', 1),
(32, 1, 7, 'C-075', 1),
(33, 1, 8, 'C-081', 1),
(34, 1, 8, 'C-082', 1),
(35, 1, 8, 'C-083', 1),
(36, 1, 8, 'C-084', 1),
(37, 1, 9, 'C-091', 1),
(38, 1, 9, 'C-092', 1),
(39, 1, 9, 'C-093', 1),
(40, 1, 9, 'C-094', 1),
(41, 1, 9, 'C-095', 1),
(42, 1, 9, 'C-096', 1),
(43, 1, 10, 'C-101', 1),
(44, 1, 10, 'C-102', 1),
(45, 1, 10, 'C-103', 1),
(46, 1, 10, 'C-104', 1),
(47, 1, 10, 'C-105', 1),
(48, 1, 11, 'C-111', 1),
(49, 1, 11, 'C-112', 1),
(50, 1, 11, 'C-113', 1),
(51, 1, 11, 'C-114', 1),
(52, 1, 11, 'C-115', 1),
(53, 1, 12, 'C-121', 1),
(54, 1, 12, 'C-122', 1),
(55, 1, 12, 'C-123', 1),
(56, 1, 12, 'C-124', 1),
(57, 1, 12, 'C-125', 1),
(58, 1, 13, 'C-131', 1),
(59, 1, 13, 'C-132', 1),
(60, 1, 13, 'C-133', 1),
(61, 1, 13, 'C-134', 1),
(62, 1, 13, 'C-135', 1),
(63, 1, 14, 'C-141', 1),
(64, 1, 14, 'C-142', 1),
(65, 1, 14, 'C-143', 1),
(66, 1, 14, 'C-144', 1),
(67, 1, 14, 'C-145', 1),
(68, 2, 15, 'C-151', 1),
(69, 2, 15, 'C-152', 1),
(70, 2, 15, 'C-153', 1),
(71, 2, 15, 'C-154', 1),
(72, 2, 15, 'C-155', 1),
(73, 2, 16, 'C-161', 1),
(74, 2, 16, 'C-162', 1),
(75, 2, 16, 'C-163', 1),
(76, 2, 16, 'C-164', 1),
(77, 2, 17, 'C-171', 1),
(78, 2, 17, 'C-172', 1),
(79, 2, 18, 'C-181', 1),
(80, 2, 18, 'C-182', 1),
(81, 2, 18, 'C-183', 1),
(82, 2, 18, 'C-184', 1),
(83, 2, 19, 'C-191', 1),
(84, 2, 19, 'C-192', 1),
(85, 2, 15, 'C-156', 1),
(86, 2, 15, 'C-157', 1),
(87, 2, 16, 'C-165', 1),
(88, 2, 17, 'C-173', 1),
(89, 2, 18, 'C-185', 1),
(90, 2, 19, 'C-193', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_departamento`
--

DROP TABLE IF EXISTS `cat_departamento`;
CREATE TABLE IF NOT EXISTS `cat_departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `abreviatura` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `class` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `icon` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` int(11) DEFAULT '1',
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_departamento`
--

INSERT INTO `cat_departamento` (`id_departamento`, `departamento`, `abreviatura`, `class`, `icon`, `activo`) VALUES
(1, 'SEGURIDAD PÚBLICA', 'SP', 'btn btn-info', 'fa fa-user-secret text-info', 1),
(2, 'TRÁNSITO MUNICIPAL', 'TM', 'btn btn-warning', 'fa fa-taxi text-warning', 1),
(3, 'PROTECCIÓN CIVIL Y BOMBEROS', 'PCyB', 'btn btn-danger', 'fa fa-ambulance text-danger', 1),
(4, 'RETROALIMENTACIÓN', 'R', 'btn btn-primary-bright', 'fa fa-clipboard text-primary', 1),
(5, 'TLALNETEL', 'T', 'btn btn-accent-light', 'fa fa-phone text-acccent', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_emergencia`
--

DROP TABLE IF EXISTS `cat_emergencia`;
CREATE TABLE IF NOT EXISTS `cat_emergencia` (
  `id_emergencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_departamento` int(11) DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_emergencia`)
) ENGINE=MyISAM AUTO_INCREMENT=183 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_emergencia`
--

INSERT INTO `cat_emergencia` (`id_emergencia`, `id_departamento`, `descripcion`, `activo`) VALUES
(1, 3, 'ACORDONAMIENTO DE ZONA EN RIESGO', 1),
(2, 3, 'ARBOL CAIDO', 1),
(3, 3, 'ARBOL EN RIESGO', 1),
(4, 3, 'CABLES CAIDOS', 1),
(5, 3, 'CABLES EN CORTO', 1),
(6, 3, 'CABLES EN RIESGO', 1),
(7, 3, 'DERRAME DE COMBUSTIBLES', 1),
(8, 3, 'DERRAME DE PRODUCTOS QUIMICOS', 1),
(9, 3, 'ENFERMO', 1),
(10, 3, 'ENJAMBRE', 1),
(11, 3, 'EXPLOSION', 1),
(12, 3, 'FUGA DE GAS', 1),
(13, 3, 'INCENDIO', 1),
(14, 3, 'INUNDACIONES', 1),
(15, 3, 'LESIONADO', 1),
(16, 3, 'OLOR A GAS', 1),
(17, 3, 'POSTE EN RIESGO', 1),
(18, 3, 'RESCATE', 1),
(19, 3, 'SERVICIOS EN PREVENCION', 1),
(20, 1, 'ALARMAS', 0),
(21, 1, 'ALTERACION DEL ORDEN PUBLICO', 1),
(22, 1, 'ATROPELLADO', 0),
(23, 1, 'FALTAS A LA MORAL', 1),
(24, 1, 'HOMICIDIO (ACCIDENTE)', 0),
(25, 1, 'INTENTO DE VIOLACION', 1),
(26, 1, 'MUERTO', 0),
(27, 1, 'REMISIONES J.C.', 1),
(28, 1, 'REMISIONES M.P.', 1),
(29, 1, 'RIÑAS', 1),
(30, 1, 'ROBO A BANCOS', 1),
(31, 1, 'ROBO ARTICULOS TIENDA DE AUTOSERVICIO', 0),
(32, 1, 'ROBO DE AUTOPARTES', 1),
(33, 1, 'SECUESTRO', 1),
(34, 1, 'SOSPECHOSO', 1),
(35, 1, 'SUICIDIO', 0),
(36, 1, 'VEHICULOS RECUPERADOS', 1),
(37, 1, 'VEHICULOS ROBADOS', 1),
(38, 2, 'CHOQUE', 1),
(39, 2, 'CHOQUE CON LESIONADOS', 1),
(40, 2, 'RETIRO DE VEHICULOS', 1),
(41, 2, 'SEGURIDAD VIAL', 1),
(42, 2, 'VIALIDAD', 1),
(43, 1, 'ACTIVACIÓN DE ALARMA', 1),
(44, 2, 'OBSTRUCCION DE VIALIDAD', 1),
(45, 3, 'PREVENCION', 1),
(46, 1, 'DERRIBO O PODA DE ARBOLES', 1),
(47, 5, 'SERVICIO TLALNETEL', 1),
(48, 4, 'AGRADECIMIENTOS', 1),
(49, 4, 'FALSA O BROMA', 1),
(50, 1, 'TOMANDO EN VÍA PÚBLICA', 1),
(51, 1, 'BOTON DE PANICO', 1),
(52, 1, 'ROBO A CASA HABITACION', 1),
(53, 1, 'ASALTO', 0),
(54, 1, 'INHALANDO TOXICOS', 0),
(55, 3, 'HUNDIMIENTO DE PAVIMENTO', 1),
(56, 1, 'ROBO', 1),
(57, 3, 'DESLAVE', 1),
(58, 4, 'INFORMACION', 1),
(59, 1, 'GRAFITIS', 1),
(60, 1, 'ABUSO DE CONFIANZA', 1),
(61, 1, 'ABUSO SEXUAL', 1),
(62, 1, 'ACOSO SEXUAL', 1),
(63, 1, 'ACTOS LIBIDINOSOS', 1),
(64, 1, 'ALLANAMIENTO', 1),
(65, 1, 'ALLANAMIENTO DE MORADA', 0),
(66, 1, 'ATAQUE PELIGROSO', 0),
(67, 1, 'ATAQUES A LAS VIAS DE C Y T', 1),
(68, 2, 'CHOQUE CON DAÑOS', 1),
(69, 2, 'CHOQUE CON LESIONES', 1),
(72, 1, 'COHECHO', 1),
(73, 1, 'CORRUPCIÓN DE MENORES', 1),
(74, 1, 'DAÑOS AL AYUNTAMIENTO', 1),
(75, 1, 'DAÑOS EN LOS BIENES', 1),
(76, 1, 'DELITOS CONTRA LA FLORA Y LA FAUNA', 1),
(77, 1, 'DELITOS CONTRA LA SALUD', 1),
(78, 1, 'DENUNCIA DE HECHOS', 1),
(79, 1, 'DESACATO DE ORDEN JUDICIAL', 1),
(80, 1, 'DESPOJO', 1),
(81, 1, 'ENCUBRIMIENTO POR RECEPTACIÓN ', 1),
(82, 1, 'EXTORSIÓN', 1),
(83, 1, 'EXTRACCIÓN O POSESIÓN DE HIDROCARBUROS', 1),
(84, 1, 'FALSIFICACIÓN/USO DE DOCUMENTOS FALSOS', 1),
(85, 1, 'FRAUDE', 1),
(86, 1, 'MENOR LOCALIZADO', 1),
(87, 1, 'HOSTIGAMIENTO', 1),
(135, 1, 'HOMICIDIO (DOLOSO)', 1),
(136, 1, 'DECESO (ENFERMEDAD)', 1),
(137, 1, 'DECESO (OTRAS CAUSAS)', 1),
(88, 1, 'LESIONES POR ARMA BLANCA', 1),
(89, 1, 'LESIONES POR ARMA DE FUEGO', 1),
(90, 1, 'LESIONES POR GOLPES/RIÑA', 1),
(91, 1, 'MENOR EXTRAVIADO', 1),
(92, 1, 'MUERTE NATURAL', 0),
(93, 1, 'MUERTE POR ASFIXIA', 1),
(94, 1, 'MUERTE OTRAS CAUSAS', 0),
(95, 1, 'MUERTE POR ACCIDENTE', 0),
(96, 1, 'PORTACIÓN DE ARMA ', 1),
(97, 1, 'PORTACIÓN DE ARTEFACTOS EXPLOSIVOS', 0),
(98, 1, 'PORTACIÓN, TRÁFICO Y ACOPIO DE ARMAS PROHIBIDAS ', 1),
(99, 1, 'PRIVACIÓN DE LA LIBERTAD', 1),
(100, 1, 'QUEBRANTAMIENTO DE SELLOS', 1),
(101, 1, 'RESISTENCIA', 1),
(102, 1, 'ROBO A COMERCIO', 1),
(103, 1, 'ROBO A CUENTAHABIENTE', 1),
(104, 1, 'ROBO A INTERIOR DE VEHÍCULO', 1),
(105, 1, 'ROBO A TRASEÚNTE', 1),
(106, 1, 'ROBO A TRANSPORTE PÚBLICO', 1),
(107, 1, 'ROBO A TRANSPORTISTA', 1),
(108, 1, 'ROBO DE COMBUSTIBLE', 1),
(109, 1, 'SIMULACIÓN DE VEHÍCULO OFICIAL', 1),
(134, 1, 'HOMICIDIO (CULPOSO)', 1),
(138, 1, 'DECESO (SUICIDIO)', 1),
(139, 1, 'DELITOS CONTRA EL AMBIENTE ', 1),
(140, 1, 'DESCUBRIMIENTO/APORTACIÓN DE INDICIOS', 1),
(141, 1, 'VIOLENCIA CONTRA LA MUJER', 1),
(142, 1, 'PERSONA EXTRAVIADA', 1),
(143, 1, 'PERSONA LOCALIZADA', 1),
(144, 1, 'ROBO A CAJERO AUTOMATICO', 1),
(145, 1, 'ROBO DE ARMA', 1),
(146, 1, 'TENTATIVA DE SECUESTRO', 1),
(147, 1, 'TENTATIVA DE SUICIDIO', 1),
(148, 1, 'USURPACIÓN DE IDENTIDAD', 1),
(149, 1, 'PEDIR DADIVAS', 1),
(150, 1, 'PERSONA AGRESIVA', 1),
(151, 1, 'PODA DE ÁRBOL', 1),
(152, 1, 'RUIDO EXCESIVO', 1),
(153, 1, 'ABORTO', 1),
(154, 1, 'ACTIVACIÓN DE ALARMA', 0),
(155, 1, 'APOYO AL MP/OTRAS CORPORACIONES', 1),
(156, 2, 'APOYO VIAL', 1),
(157, 1, 'ATENCIÓN CIUDADANA', 1),
(158, 3, 'ATENCIÓN MÉDICA', 1),
(159, 1, 'CONSULTA DE PERSONA', 1),
(160, 1, 'CONSULTA DE PLACA', 1),
(161, 1, 'HERIDO POR MORDEDURA DE ANIMAL', 0),
(162, 1, 'HERIDO POR QUEMADURA', 0),
(163, 1, 'LESIONADO OTRA CAUSAS', 0),
(164, 1, 'LESIONADO POR ATROPELLAMIENTO', 1),
(165, 1, 'LESIONADO POR CAIDA', 1),
(166, 1, 'OPERATIVO', 1),
(167, 1, 'PERSONA EN SITUACIÓN DE CALLE', 1),
(168, 3, 'RESCATE ANIMAL', 1),
(169, 3, 'TRANSFORMADOR EN RIESGO', 1),
(170, 2, 'VEHICULO DESCOMPUESTO', 1),
(171, 4, 'CANCELADA', 1),
(172, 4, 'OTRO MUNICIPIO', 1),
(174, 1, 'VIOLENCIA EN CONTRA DE ADULTOS MAYORES (3ra EDAD)', 1),
(175, 1, 'VIOLENCIA EN CONTRA DE MENORES ', 1),
(110, 1, 'TENTATIVA DE ROBO ', 1),
(111, 1, 'TENTATIVA DE VIOLACIÓN ', 1),
(112, 1, 'USO INDEBIDO DE INSIGNIAS', 1),
(113, 1, 'USURPACIÓN DE FUNCIONES PÚBLICAS/PROFESIÓN', 1),
(114, 1, 'VIOLACIÓN ', 1),
(115, 1, 'VIOLENCIA INTRAFAMILIAR', 1),
(116, 2, 'VOLCADURA', 1),
(117, 1, 'DESPERDICIAR AGUA', 1),
(118, 1, 'ENTORPECER LAS LABORES DE LOS OFICIALES', 1),
(119, 1, 'INGERIR BEBIDAS ALCOHOLICAS', 1),
(120, 1, 'INGRESAR A LUGAR PROHIBIDO SIN AUTORIZACIÓN ', 0),
(121, 1, 'INHALAR SUSTANCIAS TOXICAS', 1),
(122, 2, 'OBSTRUIR LA VÍA PÚBLICA', 1),
(123, 1, 'ORINAR O DEFECAR EN LA VÍA PÚBLICA', 1),
(124, 1, 'PINTAR O MALTRATAR PROPIEDAD AJENA', 0),
(125, 1, 'PODAR ARBOLES SIN PERMISO', 0),
(126, 1, 'REPARTIR O PEGAR PROPAGANDA', 1),
(127, 1, 'TIRAR BASURA', 1),
(128, 1, 'TRATAR DE MANERA VIOLENTA Y DESCONSIDERADA', 0),
(129, 1, 'UTILIZAR LENGUAJE QUE OFENDE', 0),
(130, 1, 'DUPLICADO', 0),
(131, 1, 'BROMA', 0),
(132, 1, 'PRUEBA', 1),
(133, 1, 'FALSA', 0),
(176, 1, 'SINIESTRO', 1),
(177, 1, 'DETONACIONES DE ARMA DE FUEGO', 1),
(178, 1, 'LESIONES OTRAS CAUSAS', 1),
(179, 1, 'DECESO', 1),
(180, 1, 'MALTRATO ANIMAL', 1),
(181, 1, 'ABUSO DE AUTORIDAD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_operativo`
--

DROP TABLE IF EXISTS `cat_operativo`;
CREATE TABLE IF NOT EXISTS `cat_operativo` (
  `id_operativo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_operativo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_operativo`
--

INSERT INTO `cat_operativo` (`id_operativo`, `descripcion`, `activo`) VALUES
(1, 'BOM', 1),
(2, 'FRIM', 1),
(3, 'PRESENCIA', 1),
(4, 'ZONA BANCARIA Y COMERCIAL', 1),
(5, 'ZONAS ESCOLARES', 1),
(6, 'LICONSAS', 1),
(7, 'PROXIMIDAD SOCIAL', 1),
(8, 'BITÁCORAS', 1),
(9, 'FILTRO', 1),
(10, 'PLAN III', 1),
(11, 'RASTRILLO', 1),
(12, 'IGLESIA', 1),
(13, 'PARQUES RECREATIVOS', 1),
(14, 'GTO', 1),
(15, 'REGIÓN 27', 1),
(16, 'OTROS ', 1),
(17, 'CORDON DE SEGURIDAD', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_procedencia`
--

DROP TABLE IF EXISTS `cat_procedencia`;
CREATE TABLE IF NOT EXISTS `cat_procedencia` (
  `id_procedencia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id_llamada',
  `descripcion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_procedencia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_procedencia`
--

INSERT INTO `cat_procedencia` (`id_procedencia`, `descripcion`, `activo`) VALUES
(1, '911', 1),
(2, 'LLAMADA CIUDADANO', 1),
(3, 'TWITTER', 1),
(4, 'MONITOREO', 1),
(5, 'BOTON DE PÁNICO', 1),
(6, 'RADIO FRECUENCIA', 1),
(7, 'WHATSAPP', 1),
(8, 'NUESTRA CIUDAD SEGURA', 0),
(9, 'CELULAR SECTOR 19', 0),
(10, 'REDES VECINALES', 1),
(11, 'ALERTA VECINAL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipo_cierre`
--

DROP TABLE IF EXISTS `cat_tipo_cierre`;
CREATE TABLE IF NOT EXISTS `cat_tipo_cierre` (
  `id_tipo_cierre` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_tipo_cierre`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_tipo_cierre`
--

INSERT INTO `cat_tipo_cierre` (`id_tipo_cierre`, `descripcion`, `activo`) VALUES
(1, 'PROCEDENTE ', 1),
(2, 'IMPROCEDENTE', 1),
(3, 'MEDICO', 1),
(4, 'OTRA CORPORACIÓN', 1),
(11, 'ATENDIDO', 1),
(12, 'NO ATENDIDO', 1),
(13, 'SIN INCIDENCIA', 1),
(14, 'CON INCIDENCIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipo_emergencia`
--

DROP TABLE IF EXISTS `cat_tipo_emergencia`;
CREATE TABLE IF NOT EXISTS `cat_tipo_emergencia` (
  `id_tipo_emergencia` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_tipo_emergencia`),
  UNIQUE KEY `cat_tipo_id_tipo_pk` (`id_tipo_emergencia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_tipo_emergencia`
--

INSERT INTO `cat_tipo_emergencia` (`id_tipo_emergencia`, `descripcion`, `activo`) VALUES
(1, 'DELITO', 1),
(2, 'FALTA ADMINISTRATIVA', 1),
(3, 'OTROS SERVICIOS', 1),
(4, 'NO CONSIDERADOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_zona`
--

DROP TABLE IF EXISTS `cat_zona`;
CREATE TABLE IF NOT EXISTS `cat_zona` (
  `id_zona` int(11) NOT NULL AUTO_INCREMENT,
  `zona` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `folios` int(11) NOT NULL DEFAULT '0' COMMENT 'contador de folios',
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_zona`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_zona`
--

INSERT INTO `cat_zona` (`id_zona`, `zona`, `folios`, `activo`) VALUES
(1, 'Poniente', 0, 1),
(2, 'Oriente', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

DROP TABLE IF EXISTS `tbl_bitacora`;
CREATE TABLE IF NOT EXISTS `tbl_bitacora` (
  `id_tbl_bitacora` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_bitacora` bigint(20) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_zona` int(11) NOT NULL COMMENT '1 PONIENTE 2 ORIENTE\n',
  `id_departamento` int(11) NOT NULL,
  `id_usr_captura` int(11) NOT NULL,
  `date_capture` datetime DEFAULT NULL,
  `unidad` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `despacho` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `reportedesp` varchar(2500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_tbl_bitacora`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notas`
--

DROP TABLE IF EXISTS `tbl_notas`;
CREATE TABLE IF NOT EXISTS `tbl_notas` (
  `id_notas` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL COMMENT 'tbl_servicios',
  `id_zona` int(11) NOT NULL COMMENT 'cat_zona',
  `id_usuario` int(11) NOT NULL COMMENT 'ws_usuario',
  `fecha_captura` datetime DEFAULT NULL,
  `descripcion` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_notas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios`
--

DROP TABLE IF EXISTS `tbl_servicios`;
CREATE TABLE IF NOT EXISTS `tbl_servicios` (
  `id_tbl_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_zona` int(11) DEFAULT NULL COMMENT '1 PONIENTE 2 ORIENTE',
  `id_status` int(11) DEFAULT '0',
  `usuario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usr_captura` int(11) DEFAULT '0' COMMENT 'ws_usuario',
  `fecha_captura` datetime DEFAULT NULL,
  `id_emergencia` int(11) DEFAULT '0' COMMENT 'cat_emergencia',
  `id_operativo` int(11) DEFAULT '0' COMMENT 'cat_operativo',
  `id_llamada` int(11) DEFAULT '0' COMMENT 'cat_procedencia',
  `id_cuadrante` int(11) DEFAULT '0' COMMENT 'cat_cuadrante',
  `id_turno` int(11) DEFAULT '0' COMMENT '1 PRIMERO 2 SEGUNDO 3 TERCERO 4 CUARTO',
  `id_colonia` int(11) DEFAULT '0' COMMENT 'cat_colonia',
  `fecha` date DEFAULT NULL,
  `hora` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora_` time DEFAULT NULL,
  `calle` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `calle1` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `calle2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `colonia` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(8000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `actividads` bit(1) NOT NULL DEFAULT b'0',
  `bandera` varchar(100) COLLATE utf8_spanish_ci DEFAULT 'sigue',
  `Prioridad` varchar(10) COLLATE utf8_spanish_ci DEFAULT 'MEDIA',
  `otros_operativos` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_tbl_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios_dtl`
--

DROP TABLE IF EXISTS `tbl_servicios_dtl`;
CREATE TABLE IF NOT EXISTS `tbl_servicios_dtl` (
  `id_servicio_dtl` int(11) NOT NULL AUTO_INCREMENT,
  `id_resultado` decimal(10,0) NOT NULL,
  `id_servicio` decimal(10,0) NOT NULL,
  `id_usr_captura` int(11) DEFAULT NULL,
  `fecha_captura` datetime DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_zona` int(11) DEFAULT NULL,
  `resultado` varchar(8000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `unidad` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hrecibe` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hasignacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `harribo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_emergencia` int(11) DEFAULT NULL,
  `emergencia2` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usr_emergencia` int(11) DEFAULT NULL,
  `usuario_emergencia` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipoCierre` int(11) DEFAULT NULL,
  `otro_cierre` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_servicio_dtl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_`
--

DROP TABLE IF EXISTS `usuario_`;
CREATE TABLE IF NOT EXISTS `usuario_` (
  `id_usuario` decimal(18,0) NOT NULL COMMENT 'TRIAL',
  `no_empleado` decimal(18,0) DEFAULT NULL COMMENT 'TRIAL',
  `nombre` varchar(50) DEFAULT NULL COMMENT 'TRIAL',
  `usuario` varchar(50) DEFAULT NULL COMMENT 'TRIAL',
  `contraseña` varchar(50) DEFAULT NULL COMMENT 'TRIAL',
  `actividad` varchar(50) DEFAULT NULL COMMENT 'TRIAL',
  `departamento` varchar(50) DEFAULT NULL COMMENT 'TRIAL',
  `activo` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'TRIAL',
  `id_rol` int(11) DEFAULT NULL COMMENT 'TRIAL',
  `zona` varchar(50) DEFAULT NULL COMMENT 'TRIAL',
  `trial272` char(1) DEFAULT NULL COMMENT 'TRIAL'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `usuario_`
--

INSERT INTO `usuario_` (`id_usuario`, `no_empleado`, `nombre`, `usuario`, `contraseña`, `actividad`, `departamento`, `activo`, `id_rol`, `zona`, `trial272`) VALUES
('215', '121982', 'MIRIAM FLORES MORENO', 'MIRIAM', 'M1R14M', 'ADMINISTRADOR', 'PRESIDENCIA', 1, 1, '2', 'T'),
('394', '126287', 'ZUÑIGA AGUILAR MALITZI', 'MALITZI21', 'AGUILAR0606', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('384', '127166', 'ARVIZU RODRIGUEZ ILSE ESTEFANIA', 'ARVIZUILSE', 'ILSEARRO12', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('385', '123739', 'BAUTISTA JIMENEZ JORGE IGNACIO ', 'JORGEBAUTISTA', 'mateo1209', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('249', '119958', 'FROYLAN PELCASTRE SOLORZANO', 'FROYP', 'FROYP', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('256', '112222', 'FLORES ZAMORA RICARDO', 'RICARDOF', 'ZZZAMORA', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('207', '121771', 'URIARTE FRANCO DANIEL\r\n', 'URUARTEF', 'FRANCODU', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('208', '121754', 'MARTÍNEZ LUGO JOSÉ RICARDO', 'MARTINEZLU', '4682', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('390', '110114', 'ARCINIEGA SOLACHE JOSE LUIS', 'SOLACHE', 'solh', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('252', '111773', 'ANTONIO RODRIGUEZ PEREZ', 'ANTONIOR', 'ANTONIOR', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('210', '110149', 'GARCIA TLAPALAMATL GABRIEL ', 'GARCIATT', 'GG74', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('387', '119380', 'FEREGRINO COLIN FEDERICO ', 'FEDE', 'YOLA1970', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('16', '104246', 'PATRICIA RAMIREZ MELENDEZ', 'PATRICIA', '104246', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('213', '106085', 'MUNGUIA CORONA JAVIER', 'JAVIER', 'CORONA', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('253', '113143', 'FELIPE LEOCADIO MARTINEZ', 'FELIPELE', 'FELIPELE', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('397', '127390', 'GLORIA ALEJANDRA REYES CRUZ', 'ALEJANDRA', 'A112722', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('254', '118541', 'MARIA DEL CARMEN CHAPULIN GONZALEZ', 'CARMENCHG', 'CHAPUG', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('73', '117627', 'SARA CARBAJAL MIRANDA', 'SCARBAJAL', 'SCARBAJAL', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('79', '117325', 'ANGEL ANDRES BARRAGAN REYES', 'ABARRAGAN', 'ABARRAGANFELINO4', 'ADMINISTRADOR', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('260', '112607', 'GUZMAN PEREZ MARIO', 'GUZMANPM', 'GUZMANPM', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('243', '108025', 'CARLOS GARCIA HERNANDEZ ', 'GARCIA ', 'GAHC', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('106', '106581', 'JOSE ARMANDO CUELLAR UGALDE', 'ACUELLAR', 'ACUELLAR', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('113', '111786', 'ZAMORA CORTESTERESA ARLEN', 'AZAMORA', '20012006', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('279', '125770', 'RAVELO VELAZQUEZ ALFREDO IVAN', 'RAVELOVAI', 'ravelovai', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('362', '126286', 'ERIKA ITZEL SANTOS RUIZ ', 'SANTOSR', '18084764', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('336', '126293', 'MIGUEL ANGEL LOPEZ MALDONADO', 'MIGUELLM', 'NASUS260392', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('368', '119287', 'GIOVANNY ALEJANDRO RODRIGUEZ CERDA', 'GIOVANNYRC', 'gioarc', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('138', '102658', 'SEVERIANO GATICA L?ZARO JES?S', 'SGATICAL', 'SGATICAL', 'ADMINISTRADOR', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('371', '126275', 'CLAUDIA ALEJANDRA PADRON MEDINA', 'CLAUDIA78', 'CLAUSS78', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('372', '111880', 'MORENO VEGA DAVID', 'DAVIDMV', 'dvega', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('373', '126266', 'HERNANDEZ DIAZ MARIA ISABEL', 'HEDI020115', 'ISABEL21', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('304', '126252', 'AMADO LONGORIA ERIKA CITLALI ', 'ERIKACITLALLI', 'SANTI16', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('377', '126288', 'ZURITA SUAREZ ALEXIS HUMBERTO', 'ZUSA9429', 'MC5626', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('148', '120063', 'LOPEZ SILVA JOSE GUSTAVO', 'LOPEZS', 'LOPEZS', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('153', '112004', 'GARCIA RAZO CRISTIAN', 'GARCIAR', 'RAZOC', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('115', '108309', 'LOZADA BEYRA ANA VERONICA', 'BEYRA', 'romy', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('157', '110149', 'GARCIA TLALPALAMATL GABRIEL', 'GARCIAT', 'GABRIELG', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('162', '121475', 'TAHUILAN MARTINEZ LAURA ESTEFANIA', 'LAURAM', 'ESTEFANIAT', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('386', '106528', 'JOAQUIN RODRIGUEZ ADONIRAM ', 'ADONIRDZ', '8520', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('392', '127169', 'GUTIERREZ DORANTES JOSE DE JESUS', 'GUTIERREZJJ', 'jesus2005', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('166', '120233', 'SANCHEZ CID RODRIGO DANIEL', 'RODRIGOC', 'daniels', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('233', '123735', 'PEDRO GERARDO AGUILAR RESENDIZ ', 'PEDROG', 'gerpe', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('278', '105149', 'JUVENAL CATARINO CASIANO', 'JUVENALC', 'CATARINOC', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('349', '126258', 'DEBORAH JAEL GALLEGOS DÍAZ ', 'DEBORAH', 'puerquito', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('343', '126255', 'ROSA MARIA CHAVEZ RAMIREZ', 'ROSAMARIA', '2BNICOYBARBY', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('313', '126279', 'ROCHA VARGAS JANETH GUADALUPE', 'JANETH0312', '1003171012', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('177', '119382', 'PEREZ TRUJILLO SALVADOR ', 'TRUJILLOS', 'PEREZT', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('315', '126277', 'PEREZ RODRIGUEZ ARIAS PAOLA', 'ARTEMISA23', 'PAO112784', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('316', '126260', 'GARCIA ANAYA MICHEL BRUNO', 'MICHELGARCIA', '921027', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('181', '114489', 'CADENA REYES PATRICIA', 'CADENAR', '2015', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('324', '126283', 'ROSAS VARGAS BETHSAIDA', 'ROSBETH', '83754194', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('325', '126268', 'HERNANDEZ SOTO GUADALUPE ELIZABETH', 'ELIZHS', 'BENJAS12', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('364', '126271', 'DANIELA MEDRANO FUENTES ', 'MEDRANO', 'DMF030903', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('185', '113300', 'SANCHEZ HERNANDEZ ROBERTO', 'SANCHEZH', 'ALAN', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('186', '119291', 'YAÑEZ MORENO RICARDO SALVADOR', 'YAÑEZM', 'MORENOR', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('327', '126276', 'PELCASTRE NAVARRETE CRISTOPHER TADEO', 'CRIS9REX4', 'CRIS2NAV8', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('188', '106581', 'CUELLAR UGALDE JOSE ARMANDO', 'CUELLARU', 'UGALDEJ', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('376', '126294', 'MORA QUEZADA ARELIS FERNANDA', 'AREMORA', 'FQUEZADA', 'GENERAL', 'TLALNETEL', 1, 2, '2', 'T'),
('331', '126257', 'DUARTE MARTINEZ PERLA', 'MERCURIO100', 'MERCURIO101', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('333', '126267', 'HERNANDEZ HERNANDEZ ROSALIA', 'RHH27', 'BARUCH', 'GENERAL', 'TLALNETEL', 1, 2, '1', 'T'),
('337', '126254', 'DIANA IRIS BOLAÑOS CORONA', 'DIANA21', 'IRIS81', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('339', '126284', 'NAHOMI DANAE SANCHEZ DEL AGUILA ', 'NAHOMIDS', '231181', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('370', '126723', 'EDGAR EDUC GARCIA GARCIA', 'EDGAREGG', 'EDUCGG', 'ADMINISTRADOR', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('196', '115035', 'LEON DIMAS MIGUEL ANGEL', 'LEOND', 'LEOND', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('344', '126273', 'KARLA KARINA MENDEZ HERNANDEZ ', 'KARLAK', 'karina94', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('346', '126261', 'BRENDA GONZALEZ COLIN', 'BRENDAGC', 'colin26', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('347', '126280', 'KARLA PAOLA RODRIGUEZ BELTRAN', 'BELTRAN', 'KARLARB', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('358', '126264', 'ROSA ISELA GONZALEZ RAMIREZ ', 'ROSAISELA', 'ROSA1234', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('359', '126269', 'KARLA ESTHEFANIA HUITRON GALINDO', 'HUITRON', 'asd890hg2', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('144', '119215', 'JULIAN MAGADAN DAMIAN', 'JMAGADAN', 'MDAMIAN', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('296', '126282', 'ROJAS RESENDIZ KAREN ELIZABETH', 'ELIROJAS25', '19122020', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('374', '121476', 'TORRES MEJIA ROSA', 'TORRES', 'TORRESM', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('310', '126271', 'MEDRANO FUENTES DANIELA', 'DANIELAMEDRANO', 'DMF030903', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('328', '126272', 'LOMELI RAMIREZ TANNYA', 'LOMELIR22', 'RAMIREZ22', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('219', '119171', 'STHEFANY ARTEAGA BELTRAN', 'SARTIAGA', 'ABELTRAN', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('220', '121751', 'MARIBEL HERNANDEZ HERNANDEZ', 'MARIBELH', 'MARIHH', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('365', '126270', 'CINTHIA JANET LEON SANCHEZ ', 'LEON', 'CJLS1996', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('258', '106085', 'MUNGUIA CORONA FRANCISCO JAVIER', 'MUNGUIA1962', 'fm5567', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('381', '127171', 'RODRIGUEZ BELMAT GUSTAVO IRWING', 'RODRIGUEZGUSTAVO', 'GUSTAVO1234', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('230', '123807', 'CHRISTIANNE MICHELLE RAMIREZ ALTAMIRANO', 'CHRIS', '0332CHR', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('151', '104647', 'JOSE PEREZ PEREZ', 'JPEREZ', 'PPEREZ', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('389', '127171', 'RODRIGUEZ BELMANT GUSTAVO IRWING', 'RODRIGUEZ GUSTAVO ', 'gustavo1234', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('277', '119207', 'MORAN FUENTES JESUS ENRIQUE', 'ENRIQUEM', 'MORANF', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('154', '113477', 'FELIX RAMOS ROBLES', 'FRAMOS', 'RROBLES', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('155', '115149', 'JUVENAL CATARION CASIANO', 'JCATARINO', 'CCACIANO', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('396', '127391', 'MONRROY RODRIGUEZ DULCE DANIELA', 'MONROY', 'CRISTY13', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('157', '120118', 'JESUS VILLANUEVA GARCIA', 'VILLANUEVAG', 'JGARCIA', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('295', '126262', 'GONZALEZ HERNANDEZ DULCE DALILA', 'CANDYDALILA', '132516', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('317', '126256', 'CONTRERAS CERON MARLENE STEPHANI', 'MARCONTRERAS', 'REUCMAR23', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('335', '126285', 'JAQUELINE SANTOS GALVAN', 'YAQUI', 'YAQUI99', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('112', '119215', 'MAGADAN DAMIAN JULIAN', 'MAGADAN', '1961980', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('216', '119945', 'ALBA NAYELI IBARRA MEJIA', 'ALBA', 'JAZIEL', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('382', '126276', 'PELCASTRE NAVARRETE CRISTOPHER TADEO', 'PELCAS65', 'PELCASTAD', 'GENERAL', 'TLALNETEL', 1, 2, '1', 'T'),
('236', '123772', 'MONICA SANTIAGO MARTINEZ', 'MONICA', '123772', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('383', '114085', 'CARRERA CANO DARWIN', 'CANO78', 'cano78', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('391', '114593', 'VELASCO HERNANDEZ FRANCISCO JAVIER', 'VELASCO', 'LOBO', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('398', '120110', 'CASTILLO CENTENO JULIO CESAR', 'KASTILLO', '120110', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('282', '125617', 'RUIZ HERNANDEZ DIANA BELEN', 'DIANAR', 'RUHD960207', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('290', '126281', 'ROJAS PEREZ ORLANDO SAMUEL', 'ORLANDOROJAS', '2608', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('366', '126295', 'BRYAN MORALES ZAMORA', 'BRYANMZ', '13080407', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('323', '126269', 'HUITRON GALINDO KARLA ESTHEFANIA', 'HUITRON', '2002137', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('246', '123585', 'CAMARILLO SANTOS MIGUEL ANGEL', 'ANGELCS', 'santosc', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '2', 'T'),
('255', '110910', 'MARTINEZ MAGALLANES ERENDIDA', 'ERENDIRA', 'DIEGO', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('388', '127176', 'TRUJILLO PEREZ KEREN LIZBET', 'TRUJILLO KEREN', 'GATOS2020', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('393', '127170', 'NAVARRETE PEREZ ARTURO', 'ARTURONAVA', '198314', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('357', '126279', 'JANETH GUADALUPE ROCHA VARGAS ', 'JANETH0312', 'RENATA10', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('322', '126274', 'MORALES MORALES EDWIN ALLAN', 'EDWINMRS', '721801', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('267', '122212', 'MEJIA GUTIERREZ EDUARDO ANDRES', 'MEJIA ANDRES', 'andresm', 'GENERAL', 'CENTRAL DE EMERGENCIAS', 1, 2, '1', 'T'),
('332', '126296', 'REYES ALARCON FRIDA NAHOMY', 'NAHOMY', 'LIAM0709', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('341', '126297', 'ADRIANA TORRES HUERTA ', 'LEONARDO', 'DANAESA', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('342', '126290', 'KELY MICHELLE AGUILAR GONZALEZ', 'KELYAGUILAR', '8325', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('348', '126265', 'AMERICA ITZEL GUERRERO PATIÑO ', 'AMERICAI', 'itzelgp', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('395', '117624', 'BAUTISTA FRAGOSO KARLA GUADALUPE', 'KBAUTISTA', 'ACXESA88', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '1', 'T'),
('380', '127172', 'RODRIGUEZ BELMANT JESUS ADOLFO ', 'RODRIGUEZJESUS', 'SERATO159', 'GENERAL', 'SEGURIDAD PÚBLICA', 1, 2, '2', 'T'),
('203', '121741', 'BENITEZ AGUILAR GABRIELA NAYELI', 'BENITEZAG', 'CENTELLA2019', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('209', '121764', 'PÉREZ DE LA CRUZ BERNARDO ÁNGEL', 'PEREZLC', 'BERNARDOA', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('211', '101030', 'JAVIER ZENTENO', 'JAVIER', 'sARY', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('15', '108222', 'NICANOR NOLASCO CERVANTES', 'NICANOR', 'nicanorc1965', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('96', '118247', 'MARGARITA MARTINEZ SILVA', 'MSILVA', 'MSILVA', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('100', '118244', 'AVELYN VERONICA FONSECA PEREZ', 'FAVELYN', 'FAVELYN', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('134', '120567', 'SANCHEZ GUZMAN VERONICA', 'SANCHESZG', 'VERONICAS', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('174', '121472', 'RODRIGUEZ GONZALEZ YAZMIN', 'GONZALEZY', 'YAZMINRGZ1', 'USUARIO ESTANDAR', 'CENTRAL DE EMERGENCIAS', 1, 3, '1', 'T'),
('276', '123765', 'BRENDA JESSICA PACHECO DAVILA', 'BRENDA', 'BRENAMOR', 'USUARIO ESTANDAR', 'SEGURIDAD PÚBLICA', 1, 3, '1', 'T');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ws_menu`
--

DROP TABLE IF EXISTS `ws_menu`;
CREATE TABLE IF NOT EXISTS `ws_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) DEFAULT NULL,
  `texto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `link` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `class` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ws_menu`
--

INSERT INTO `ws_menu` (`id_menu`, `id_grupo`, `texto`, `title`, `link`, `class`, `orden`, `activo`) VALUES
(1, 0, 'Administrador', '', ' ', 'screwdriver-wrench', 20, 1),
(2, 1, 'Usuarios', 'Ver lista de Usuarios', '/users', NULL, 1, 1),
(3, 1, 'Roles', 'Ver lista de Roles', '/rol', NULL, 2, 1),
(4, 0, 'Emergencias', '', '/users', 'screwdriver-wrench', 1, 0),
(6, 0, 'Bitacoras', '', '  ', 'screwdriver-wrench', 2, 0),
(7, 6, 'Lista de Bitacoras ', 'Ver lista de Emergencias', '/rol', NULL, 1, 0),
(8, 0, 'Catálogos', '', ' ', 'screwdriver-wrench', 3, 1),
(9, 8, 'Colonias', 'Ver catálogos de colonias', '/colonias', NULL, 1, 1),
(10, 8, 'Cuadrantes', 'Ver catálogos de cuadrantes', '/cuadrantes', NULL, 2, 1),
(11, 8, 'Operativo', 'Ver catálogos de operativos', '/operativos', NULL, 3, 1),
(12, 8, 'Procedencia de llamada', 'Ver catálogos de procedencias', '/procedencia', NULL, 4, 1),
(13, 8, 'Tipo de emergencia', 'Ver catálogos de tipos de emergencia', '/tipo_emergencia', NULL, 5, 1),
(14, 8, 'Tipo de cierre', 'Ver catálogos de tipo de cierre de emergencia', '/tipo_cierre', NULL, 6, 1),
(15, 8, 'Emergencias', 'Ver catálogos de emergencias', '/emergencias', NULL, 8, 1),
(16, 8, 'Departamentos', 'Ver catálogos de departamentos', '/departamentos', NULL, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ws_rol`
--

DROP TABLE IF EXISTS `ws_rol`;
CREATE TABLE IF NOT EXISTS `ws_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pag_ini` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ws_rol`
--

INSERT INTO `ws_rol` (`id_rol`, `rol`, `pag_ini`, `descripcion`, `activo`) VALUES
(1, 'Super Usuario', 'index.php', 'Rol de super usuario', 1),
(2, 'Administrador', NULL, 'Administrador del sistema', 1),
(3, 'Usuario Captura', NULL, 'Usuario captura / seguimiento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ws_rol_menu`
--

DROP TABLE IF EXISTS `ws_rol_menu`;
CREATE TABLE IF NOT EXISTS `ws_rol_menu` (
  `id_rol_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `imp` tinyint(4) DEFAULT NULL,
  `edit` tinyint(4) DEFAULT NULL,
  `elim` tinyint(4) DEFAULT NULL,
  `nuevo` tinyint(4) DEFAULT NULL,
  `exportar` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_rol_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ws_rol_menu`
--

INSERT INTO `ws_rol_menu` (`id_rol_menu`, `id_rol`, `id_menu`, `imp`, `edit`, `elim`, `nuevo`, `exportar`) VALUES
(6, 1, 3, 1, 1, 1, 1, 1),
(5, 1, 2, 1, 1, 1, 1, 1),
(4, 1, 1, 0, 0, 0, 0, 0),
(7, 1, 8, 0, 0, 0, 0, 0),
(8, 1, 9, 0, 1, 1, 1, 1),
(9, 1, 10, 0, 1, 1, 1, 1),
(10, 1, 11, 0, 1, 1, 1, 1),
(11, 1, 12, 0, 1, 1, 1, 1),
(12, 1, 13, 0, 1, 1, 1, 1),
(13, 1, 14, 0, 1, 1, 1, 1),
(14, 1, 15, 0, 1, 1, 1, 1),
(15, 1, 16, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ws_usuario`
--

DROP TABLE IF EXISTS `ws_usuario`;
CREATE TABLE IF NOT EXISTS `ws_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_carpeta` int(11) DEFAULT '0',
  `id_rol` int(11) DEFAULT NULL,
  `id_zona` int(11) DEFAULT NULL COMMENT '1 Poniente     2 Oriente',
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave_anterior` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `no_empleado` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apepa` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apema` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `admin` int(11) DEFAULT '0',
  `activo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ws_usuario`
--

INSERT INTO `ws_usuario` (`id_usuario`, `id_carpeta`, `id_rol`, `id_zona`, `usuario`, `clave_anterior`, `clave`, `no_empleado`, `nombre`, `apepa`, `apema`, `admin`, `activo`) VALUES
(1, 0, 1, 1, 'MIRIAM', 'M1R14M', '2f52db3b058e4c5b6f6866ed12eaa15dd23ee299e9ab4e2cf5fad2524e688dbf', 121982, 'MIRIAM', 'FLORES', 'MORENO', 1, 1),
(2, 0, 2, 2, 'MALITZI21', 'AGUILAR0606', '4b39e38c00d6cf0b73e44642243c24d4', 126287, 'ZUÑIGA AGUILAR MALITZI', NULL, NULL, 0, 1),
(3, 0, 3, 1, 'ARVIZUILSE', 'ILSEARRO12', 'f380ddd318210d562eba3a34a1c93a24', 127166, 'ILSE ESTEFANIA', 'ARVIZU', 'RODRIGUEZ', 0, 1),
(4, 0, 2, 2, 'JORGEBAUTISTA', 'mateo1209', '577b99b679ac418e5104a88f5b061949', 123739, 'BAUTISTA JIMENEZ JORGE IGNACIO ', NULL, NULL, 0, 1),
(5, 0, 2, 1, 'FROYP', 'FROYP', '8999fa73e4fab63b8e673b03d3541ff6', 119958, 'FROYLAN PELCASTRE SOLORZANO', NULL, NULL, 0, 1),
(6, 0, 2, 2, 'RICARDOF', 'ZZZAMORA', 'f245d6e9384606078564d2db3d594ec9', 112222, 'FLORES ZAMORA RICARDO', NULL, NULL, 0, 1),
(7, 0, 2, 1, 'URUARTEF', 'FRANCODU', '8ee2bb3cff785227098817c7d5f7b3a2', 121771, 'URIARTE FRANCO DANIEL\r\n', NULL, NULL, 0, 1),
(8, 0, 2, 1, 'MARTINEZLU', '4682', '75ebb02f92fc30a8040bbd625af999f1', 121754, 'MARTÍNEZ LUGO JOSÉ RICARDO', NULL, NULL, 0, 1),
(9, 0, 2, 1, 'SOLACHE', 'solh', '55f0e106d4b3bd543a5def2340b74cf3', 110114, 'ARCINIEGA SOLACHE JOSE LUIS', NULL, NULL, 0, 1),
(10, 0, 2, 1, 'ANTONIOR', 'ANTONIOR', 'be549cc273b1f3871064f4dec20ea0f0', 111773, 'ANTONIO RODRIGUEZ PEREZ', NULL, NULL, 0, 1),
(11, 0, 2, 1, 'GARCIATT', 'GG74', '3cc8b2f9766465dfe761c60b6e7a277b', 110149, 'GARCIA TLAPALAMATL GABRIEL ', NULL, NULL, 0, 1),
(12, 0, 2, 2, 'FEDE', 'YOLA1970', 'b80aa9577fda0530a816004677b3fdad', 119380, 'FEREGRINO COLIN FEDERICO ', NULL, NULL, 0, 1),
(13, 0, 2, 1, 'PATRICIA', '104246', '014a8bd3dd9e1021883848d2ce80602e', 104246, 'PATRICIA RAMIREZ MELENDEZ', NULL, NULL, 0, 1),
(14, 0, 2, 1, 'JAVIER', 'CORONA', 'b7cf40e3eb701ae3b1e1cd98d67488c4', 106085, 'MUNGUIA CORONA JAVIER', NULL, NULL, 0, 1),
(15, 0, 2, 1, 'FELIPELE', 'FELIPELE', 'e943bb0d419f78f58827f38f2952d685', 113143, 'FELIPE LEOCADIO MARTINEZ', NULL, NULL, 0, 1),
(16, 0, 2, 2, 'ALEJANDRA', 'A112722', '6704e0da7d5af239fc7e3868c57ccdd1', 127390, 'GLORIA ALEJANDRA REYES CRUZ', NULL, NULL, 0, 1),
(17, 0, 2, 2, 'CARMENCHG', 'CHAPUG', '1870e3f21bd782ee02f70154a9960f8f', 118541, 'MARIA DEL CARMEN CHAPULIN GONZALEZ', NULL, NULL, 0, 1),
(18, 0, 2, 1, 'SCARBAJAL', 'SCARBAJAL', '04330b44951c77a78e72a42fa73f54ce', 117627, 'SARA CARBAJAL MIRANDA', NULL, NULL, 0, 1),
(19, 0, 2, 1, 'ABARRAGAN', 'ABARRAGANFELINO4', 'e52de82c13b69d7c58f475f799aa1de6', 117325, 'ANGEL ANDRES BARRAGAN REYES', NULL, NULL, 0, 1),
(20, 0, 2, 1, 'GUZMANPM', 'GUZMANPM', '110968f2333f287f0f95b0063e134f17', 112607, 'GUZMAN PEREZ MARIO', NULL, NULL, 0, 1),
(21, 0, 2, 1, 'GARCIA ', 'GAHC', 'e91b570606d71cb4c0896835fad88a8e', 108025, 'CARLOS GARCIA HERNANDEZ ', NULL, NULL, 0, 1),
(22, 0, 2, 1, 'ACUELLAR', 'ACUELLAR', 'a866a02e71330204794099bf1e0d5e1c', 106581, 'JOSE ARMANDO CUELLAR UGALDE', NULL, NULL, 0, 1),
(23, 0, 2, 1, 'AZAMORA', '20012006', '78ae362f2b0a830f29dfa49dfb169874', 111786, 'ZAMORA CORTESTERESA ARLEN', NULL, NULL, 0, 1),
(24, 0, 2, 1, 'RAVELOVAI', 'ravelovai', '15425e31b11644dc8cac4d3636c0e976', 125770, 'RAVELO VELAZQUEZ ALFREDO IVAN', NULL, NULL, 0, 1),
(25, 0, 2, 2, 'SANTOSR', '18084764', 'd839bba6cdabe7ed723e2534d5a6e6e1', 126286, 'ERIKA ITZEL SANTOS RUIZ ', NULL, NULL, 0, 1),
(26, 0, 2, 2, 'MIGUELLM', 'NASUS260392', '80dfa390f5181f8fea405c1f78864ee7', 126293, 'MIGUEL ANGEL LOPEZ MALDONADO', NULL, NULL, 0, 1),
(27, 0, 2, 2, 'GIOVANNYRC', 'gioarc', '9cd37f2c1922d52e35a9befa26043580', 119287, 'GIOVANNY ALEJANDRO RODRIGUEZ CERDA', NULL, NULL, 0, 1),
(28, 0, 2, 1, 'SGATICAL', 'SGATICAL', '5535abaa4008e65df0247e62bffe19ea', 102658, 'SEVERIANO GATICA L?ZARO JES?S', NULL, NULL, 0, 1),
(29, 0, 2, 2, 'CLAUDIA78', 'CLAUSS78', 'ffaaac46561306cb29c268bd2b59e915', 126275, 'CLAUDIA ALEJANDRA PADRON MEDINA', NULL, NULL, 0, 1),
(30, 0, 2, 1, 'DAVIDMV', 'dvega', 'dc114059d5d06e04fdf0e79169b1b1fd', 111880, 'MORENO VEGA DAVID', NULL, NULL, 0, 1),
(31, 0, 2, 1, 'HEDI020115', 'ISABEL21', 'e9bc4da2e8bca8e52d2aa791a11191da', 126266, 'HERNANDEZ DIAZ MARIA ISABEL', NULL, NULL, 0, 1),
(32, 0, 2, 1, 'ERIKACITLALLI', 'SANTI16', 'e5ca3b698a875d78febc1c81fb0d5f0e', 126252, 'AMADO LONGORIA ERIKA CITLALI ', NULL, NULL, 0, 1),
(33, 0, 2, 1, 'ZUSA9429', 'MC5626', '4fe1f22d093d96f71b139b62b17e9929', 126288, 'ZURITA SUAREZ ALEXIS HUMBERTO', NULL, NULL, 0, 1),
(34, 0, 2, 1, 'LOPEZS', 'LOPEZS', '53aae5d8762f3aec1b004a4af67aea09', 120063, 'LOPEZ SILVA JOSE GUSTAVO', NULL, NULL, 0, 1),
(35, 0, 2, 1, 'GARCIAR', 'RAZOC', 'dcce0a734b8609676cf9835c373281ee', 112004, 'GARCIA RAZO CRISTIAN', NULL, NULL, 0, 1),
(36, 0, 2, 1, 'BEYRA', 'romy', '1ff70a20b5bf17ac9bea662c19c2fa42', 108309, 'LOZADA BEYRA ANA VERONICA', NULL, NULL, 0, 1),
(37, 0, 2, 1, 'GARCIAT', 'GABRIELG', '9bad98ee3df8dc141205a34301197fe0', 110149, 'GARCIA TLALPALAMATL GABRIEL', NULL, NULL, 0, 1),
(38, 0, 2, 1, 'LAURAM', 'ESTEFANIAT', '2bed91c3885a8055c68c1808a4c69fd5', 121475, 'TAHUILAN MARTINEZ LAURA ESTEFANIA', NULL, NULL, 0, 1),
(39, 0, 2, 2, 'ADONIRDZ', '8520', 'a709909b1ea5c2bee24248203b1728a5', 106528, 'JOAQUIN RODRIGUEZ ADONIRAM ', NULL, NULL, 0, 1),
(40, 0, 2, 1, 'GUTIERREZJJ', 'jesus2005', '59bc02f0b59f93cf51af5f63eb6d0f0b', 127169, 'GUTIERREZ DORANTES JOSE DE JESUS', NULL, NULL, 0, 1),
(41, 0, 2, 1, 'RODRIGOC', 'daniels', '7cd068f5aeb8deff0ec5a97d4bd82ccc', 120233, 'SANCHEZ CID RODRIGO DANIEL', NULL, NULL, 0, 1),
(42, 0, 2, 2, 'PEDROG', 'gerpe', 'ecfa924b677a7d94fc8e0d1f88fd0ed0', 123735, 'PEDRO GERARDO AGUILAR RESENDIZ ', NULL, NULL, 0, 1),
(43, 0, 2, 2, 'JUVENALC', 'CATARINOC', 'ef87a9089b094da96d4d3957e3a3dc49', 105149, 'JUVENAL CATARINO CASIANO', NULL, NULL, 0, 1),
(44, 0, 2, 2, 'DEBORAH', 'puerquito', '0986ac66a99b27c84c62c5bae094ec60', 126258, 'DEBORAH JAEL GALLEGOS DÍAZ ', NULL, NULL, 0, 1),
(45, 0, 2, 2, 'ROSAMARIA', '2BNICOYBARBY', '7d3ff0ecd387c928f8e57d19bea38fb1', 126255, 'ROSA MARIA CHAVEZ RAMIREZ', NULL, NULL, 0, 1),
(46, 0, 2, 1, 'JANETH0312', '1003171012', '21403d824877d8b7cf375d55e0497961', 126279, 'ROCHA VARGAS JANETH GUADALUPE', NULL, NULL, 0, 1),
(47, 0, 2, 1, 'TRUJILLOS', 'PEREZT', '682abe5ce969e25d461cb0fa8d849522', 119382, 'PEREZ TRUJILLO SALVADOR ', NULL, NULL, 0, 1),
(48, 0, 2, 1, 'ARTEMISA23', 'PAO112784', 'b41d61b617a8d01eb1c47111a2c97084', 126277, 'PEREZ RODRIGUEZ ARIAS PAOLA', NULL, NULL, 0, 1),
(49, 0, 2, 1, 'MICHELGARCIA', '921027', '16da8ef58305e01ebf4ae2e5358e3688', 126260, 'GARCIA ANAYA MICHEL BRUNO', NULL, NULL, 0, 1),
(50, 0, 2, 1, 'CADENAR', '2015', '65d2ea03425887a717c435081cfc5dbb', 114489, 'CADENA REYES PATRICIA', NULL, NULL, 0, 1),
(51, 0, 2, 1, 'ROSBETH', '83754194', '3c5d239cb898b63efe360aee1fae3fe6', 126283, 'ROSAS VARGAS BETHSAIDA', NULL, NULL, 0, 1),
(52, 0, 2, 1, 'ELIZHS', 'BENJAS12', 'ffb645ecfaa81892ad5d0a2e5d950ce5', 126268, 'HERNANDEZ SOTO GUADALUPE ELIZABETH', NULL, NULL, 0, 1),
(53, 0, 2, 2, 'MEDRANO', 'DMF030903', '80ca4b0fa32df5312b571742ab11ada7', 126271, 'DANIELA MEDRANO FUENTES ', NULL, NULL, 0, 1),
(54, 0, 2, 1, 'SANCHEZH', 'ALAN', '5e637884f67a3f166395706093dd2331', 113300, 'SANCHEZ HERNANDEZ ROBERTO', NULL, NULL, 0, 1),
(55, 0, 2, 1, 'YAÑEZM', 'MORENOR', '0735afb5a925b0b8d0f4e34a6a114e25', 119291, 'YAÑEZ MORENO RICARDO SALVADOR', NULL, NULL, 0, 1),
(56, 0, 2, 1, 'CRIS9REX4', 'CRIS2NAV8', 'a7461f2a285ac0fab9e4a55b08f33cd5', 126276, 'PELCASTRE NAVARRETE CRISTOPHER TADEO', NULL, NULL, 0, 1),
(57, 0, 2, 1, 'CUELLARU', 'UGALDEJ', 'fd26b7d19473c8d46107069497715149', 106581, 'CUELLAR UGALDE JOSE ARMANDO', NULL, NULL, 0, 1),
(58, 0, 2, 2, 'AREMORA', 'FQUEZADA', 'ecd3564df1598b323cccd595ec1d2331', 126294, 'MORA QUEZADA ARELIS FERNANDA', NULL, NULL, 0, 1),
(59, 0, 2, 2, 'MERCURIO100', 'MERCURIO101', 'e9c1bf748c85b0a50f925199c81ca285', 126257, 'DUARTE MARTINEZ PERLA', NULL, NULL, 0, 1),
(60, 0, 2, 1, 'RHH27', 'BARUCH', 'c6cd24bf48c60db70614d4c80560fde9', 126267, 'HERNANDEZ HERNANDEZ ROSALIA', NULL, NULL, 0, 1),
(61, 0, 2, 2, 'DIANA21', 'IRIS81', '850cbde69ab48c1b7cf6f242a2d69e2e', 126254, 'DIANA IRIS BOLAÑOS CORONA', NULL, NULL, 0, 1),
(62, 0, 2, 2, 'NAHOMIDS', '231181', '00faec9c1af94f34fed560a664a37341', 126284, 'NAHOMI DANAE SANCHEZ DEL AGUILA ', NULL, NULL, 0, 1),
(63, 0, 2, 2, 'EDGAREGG', 'EDUCGG', 'd8da82be873e3d78189b1d5e65f94276', 126723, 'EDGAR EDUC GARCIA GARCIA', NULL, NULL, 0, 1),
(64, 0, 2, 1, 'LEOND', 'LEOND', '045b9348f81671d325a9981859cdb785', 115035, 'LEON DIMAS MIGUEL ANGEL', NULL, NULL, 0, 1),
(65, 0, 2, 2, 'KARLAK', 'karina94', '2e570dff49a759bdee183fd16d10b825', 126273, 'KARLA KARINA MENDEZ HERNANDEZ ', NULL, NULL, 0, 1),
(66, 0, 2, 2, 'BRENDAGC', 'colin26', 'd05fd870a30d3860c9259fadde4900d3', 126261, 'BRENDA GONZALEZ COLIN', NULL, NULL, 0, 1),
(67, 0, 2, 2, 'BELTRAN', 'KARLARB', 'a285175d28213a1dd3e214906907c56f', 126280, 'KARLA PAOLA RODRIGUEZ BELTRAN', NULL, NULL, 0, 1),
(68, 0, 2, 2, 'ROSAISELA', 'ROSA1234', 'd0ae62c0abdd570b87d99d43707806a2', 126264, 'ROSA ISELA GONZALEZ RAMIREZ ', NULL, NULL, 0, 1),
(69, 0, 2, 2, 'HUITRON', 'asd890hg2', '07fe10f5a1f1647799d7a3c6d2d85c31', 126269, 'KARLA ESTHEFANIA HUITRON GALINDO', NULL, NULL, 0, 1),
(70, 0, 2, 2, 'JMAGADAN', 'MDAMIAN', '8b933c185ca31f4e0b7c196f80261021', 119215, 'JULIAN MAGADAN DAMIAN', NULL, NULL, 0, 1),
(71, 0, 2, 1, 'ELIROJAS25', '19122020', 'd4fd7bf6c844ee6363cd6d866c2e32e6', 126282, 'ROJAS RESENDIZ KAREN ELIZABETH', NULL, NULL, 0, 1),
(72, 0, 2, 1, 'TORRES', 'TORRESM', '6cd86fad06a4f6e59e723cf49a3bffba', 121476, 'TORRES MEJIA ROSA', NULL, NULL, 0, 1),
(73, 0, 2, 1, 'DANIELAMEDRANO', 'DMF030903', '80ca4b0fa32df5312b571742ab11ada7', 126271, 'MEDRANO FUENTES DANIELA', NULL, NULL, 0, 1),
(74, 0, 2, 1, 'LOMELIR22', 'RAMIREZ22', '31120875c672dd04f995b19ef2b8a448', 126272, 'LOMELI RAMIREZ TANNYA', NULL, NULL, 0, 1),
(75, 0, 2, 2, 'SARTIAGA', 'ABELTRAN', '5b1e27e5231adaf1abf599f62bf2a821', 119171, 'STHEFANY ARTEAGA BELTRAN', NULL, NULL, 0, 1),
(76, 0, 2, 2, 'MARIBELH', 'MARIHH', 'b72369322e203ca44d3e51b4c637c0d8', 121751, 'MARIBEL HERNANDEZ HERNANDEZ', NULL, NULL, 0, 1),
(77, 0, 2, 2, 'LEON', 'CJLS1996', 'ba7be243715134e4629b109a648dba36', 126270, 'CINTHIA JANET LEON SANCHEZ ', NULL, NULL, 0, 1),
(78, 0, 2, 1, 'MUNGUIA1962', 'fm5567', '1faea4782a4524541734f1d9045c7710', 106085, 'MUNGUIA CORONA FRANCISCO JAVIER', NULL, NULL, 0, 1),
(79, 0, 2, 2, 'RODRIGUEZGUSTAVO', 'GUSTAVO1234', '3d15494df7a8f235122ce28fcca698f7', 127171, 'RODRIGUEZ BELMAT GUSTAVO IRWING', NULL, NULL, 0, 1),
(80, 0, 2, 1, 'CHRIS', '0332CHR', '8bb3e6159a6aaa9384d808b453374d0c', 123807, 'CHRISTIANNE MICHELLE RAMIREZ ALTAMIRANO', NULL, NULL, 0, 1),
(81, 0, 2, 2, 'JPEREZ', 'PPEREZ', '31dd9d819576099e1745bf7f3104292e', 104647, 'JOSE PEREZ PEREZ', NULL, NULL, 0, 1),
(82, 0, 2, 2, 'RODRIGUEZ GUSTAVO ', 'gustavo1234', '626e37c8c70e24bfc210c8318f72930e', 127171, 'RODRIGUEZ BELMANT GUSTAVO IRWING', NULL, NULL, 0, 1),
(83, 0, 2, 2, 'ENRIQUEM', 'MORANF', '059415ef742bdb50821a215c693451b2', 119207, 'MORAN FUENTES JESUS ENRIQUE', NULL, NULL, 0, 1),
(84, 0, 2, 2, 'FRAMOS', 'RROBLES', '76bf7b42d78910520cb41bcbe02f0911', 113477, 'FELIX RAMOS ROBLES', NULL, NULL, 0, 1),
(85, 0, 2, 2, 'JCATARINO', 'CCACIANO', '59fb28aaf594f980e89c1bfe25af92ee', 115149, 'JUVENAL CATARION CASIANO', NULL, NULL, 0, 1),
(86, 0, 2, 1, 'MONROY', 'CRISTY13', '29caf94c718ca400c5022a54758a29eb', 127391, 'MONRROY RODRIGUEZ DULCE DANIELA', NULL, NULL, 0, 1),
(87, 0, 2, 2, 'VILLANUEVAG', 'JGARCIA', '78e3e2072ed4b0387236e8284727e0d5', 120118, 'JESUS VILLANUEVA GARCIA', NULL, NULL, 0, 1),
(88, 0, 2, 1, 'CANDYDALILA', '132516', '3cdb9715b5157401cb2840e11ad587d3', 126262, 'GONZALEZ HERNANDEZ DULCE DALILA', NULL, NULL, 0, 1),
(89, 0, 2, 1, 'MARCONTRERAS', 'REUCMAR23', '56648c5de11b3b15bbccc32ca27859b1', 126256, 'CONTRERAS CERON MARLENE STEPHANI', NULL, NULL, 0, 1),
(90, 0, 2, 2, 'YAQUI', 'YAQUI99', '1ce6d4b789f9302de787e452fbab7655', 126285, 'JAQUELINE SANTOS GALVAN', NULL, NULL, 0, 1),
(91, 0, 2, 2, 'MAGADAN', '1961980', '4f3ba3fb6c602d19ed90b06d460274a5', 119215, 'MAGADAN DAMIAN JULIAN', NULL, NULL, 0, 1),
(92, 0, 2, 1, 'ALBA', 'JAZIEL', '654112c0e46255fd7a38bf2464b30c71', 119945, 'ALBA NAYELI IBARRA MEJIA', NULL, NULL, 0, 1),
(93, 0, 2, 1, 'PELCAS65', 'PELCASTAD', 'dbaf7ba865f9e7d0835baab5dd830240', 126276, 'PELCASTRE NAVARRETE CRISTOPHER TADEO', NULL, NULL, 0, 1),
(94, 0, 2, 1, 'MONICA', '123772', '5e3bee80611b37f4e3587e491eabe27f', 123772, 'MONICA SANTIAGO MARTINEZ', NULL, NULL, 0, 1),
(95, 0, 2, 1, 'CANO78', 'cano78', '64170ccfce65e549405d06c152ecc395', 114085, 'CARRERA CANO DARWIN', NULL, NULL, 0, 1),
(96, 0, 2, 1, 'VELASCO', 'LOBO', 'f418ef9d0463220704c090028780b706', 114593, 'VELASCO HERNANDEZ FRANCISCO JAVIER', NULL, NULL, 0, 1),
(97, 0, 2, 1, 'KASTILLO', '120110', 'bb7d3a72748d611cb54c1ef75828a46a', 120110, 'CASTILLO CENTENO JULIO CESAR', NULL, NULL, 0, 1),
(98, 0, 2, 1, 'DIANAR', 'RUHD960207', '96288c16c7a069c94c953064060c7ea1', 125617, 'RUIZ HERNANDEZ DIANA BELEN', NULL, NULL, 0, 1),
(99, 0, 2, 1, 'ORLANDOROJAS', '2608', 'd756d3d2b9dac72449a6a6926534558a', 126281, 'ROJAS PEREZ ORLANDO SAMUEL', NULL, NULL, 0, 1),
(100, 0, 2, 2, 'BRYANMZ', '13080407', 'fbf1f1dfbc9ae9bb25bb41bb8cd06f0d', 126295, 'BRYAN MORALES ZAMORA', NULL, NULL, 0, 1),
(101, 0, 2, 1, 'HUITRON', '2002137', '98bdbc0e296b33cc9383cbdeba1c9d18', 126269, 'HUITRON GALINDO KARLA ESTHEFANIA', NULL, NULL, 0, 1),
(102, 0, 2, 2, 'ANGELCS', 'santosc', '74d14d4001a3028c628622055045a110', 123585, 'CAMARILLO SANTOS MIGUEL ANGEL', NULL, NULL, 0, 1),
(103, 0, 2, 1, 'ERENDIRA', 'DIEGO', '0af701cde8c17d98e00d88e21fb6fcf8', 110910, 'MARTINEZ MAGALLANES ERENDIDA', NULL, NULL, 0, 1),
(104, 0, 2, 2, 'TRUJILLO KEREN', 'GATOS2020', '73af70ab859bbbbfe481d71d97ba1f3d', 127176, 'TRUJILLO PEREZ KEREN LIZBET', NULL, NULL, 0, 1),
(105, 0, 2, 1, 'ARTURONAVA', '198314', 'ba31eddb78bdfcd24b78ce633a239be7', 127170, 'NAVARRETE PEREZ ARTURO', NULL, NULL, 0, 1),
(106, 0, 2, 2, 'JANETH0312', 'RENATA10', 'ad0321f6d987a92042a84a36a5ac6801', 126279, 'JANETH GUADALUPE ROCHA VARGAS ', NULL, NULL, 0, 1),
(107, 0, 2, 1, 'EDWINMRS', '721801', '8d0d890a179dfcf1b54bdb1621c449d1', 126274, 'MORALES MORALES EDWIN ALLAN', NULL, NULL, 0, 1),
(108, 0, 2, 1, 'MEJIA ANDRES', 'andresm', 'c14db4bb14f83287a0d2c658ca3786bf', 122212, 'MEJIA GUTIERREZ EDUARDO ANDRES', NULL, NULL, 0, 1),
(109, 0, 2, 2, 'NAHOMY', 'LIAM0709', '99a4db59a56a8fa109cd0288ed095fda', 126296, 'REYES ALARCON FRIDA NAHOMY', NULL, NULL, 0, 1),
(110, 0, 2, 2, 'LEONARDO', 'DANAESA', '71d3321f363dc86080fe223630559e14', 126297, 'ADRIANA TORRES HUERTA ', NULL, NULL, 0, 1),
(111, 0, 2, 2, 'KELYAGUILAR', '8325', '4be49c79f233b4f4070794825c323733', 126290, 'KELY MICHELLE AGUILAR GONZALEZ', NULL, NULL, 0, 1),
(112, 0, 2, 2, 'AMERICAI', 'itzelgp', 'd15548ad53a42719b2fda7baa7a2ff72', 126265, 'AMERICA ITZEL GUERRERO PATIÑO ', NULL, NULL, 0, 1),
(113, 0, 2, 1, 'KBAUTISTA', 'ACXESA88', '5e1f88c7db0d7fcf61f35a329e306704', 117624, 'BAUTISTA FRAGOSO KARLA GUADALUPE', NULL, NULL, 0, 1),
(114, 0, 2, 2, 'RODRIGUEZJESUS', 'SERATO159', 'aba77abf5b41c104b4a6621e6d37557f', 127172, 'RODRIGUEZ BELMANT JESUS ADOLFO ', NULL, NULL, 0, 1),
(115, 0, 3, 1, 'BENITEZAG', 'CENTELLA2019', '567322c14cd790ffbb2ffcf784e1a782', 121741, 'BENITEZ AGUILAR GABRIELA NAYELI', NULL, NULL, 0, 1),
(116, 0, 3, 1, 'PEREZLC', 'BERNARDOA', '8b97c8d3b7298e342b2f04b194bcc934', 121764, 'PÉREZ DE LA CRUZ BERNARDO ÁNGEL', NULL, NULL, 0, 1),
(117, 0, 3, 1, 'JAVIER', 'sARY', 'f46f8715c8e847e17d9037ba212818af', 101030, 'JAVIER ZENTENO', NULL, NULL, 0, 1),
(118, 0, 3, 1, 'NICANOR', 'nicanorc1965', '08718f9b05ad7ab758a6415a9afaa54c', 108222, 'NICANOR NOLASCO CERVANTES', NULL, NULL, 0, 1),
(119, 0, 3, 1, 'MSILVA', 'MSILVA', '9758bc1cac5124867e595b1e40c05c5b', 118247, 'MARGARITA MARTINEZ SILVA', NULL, NULL, 0, 1),
(120, 0, 3, 1, 'FAVELYN', 'FAVELYN', 'ea85d04a1391261bd0f69fceeb354b29', 118244, 'AVELYN VERONICA FONSECA PEREZ', NULL, NULL, 0, 1),
(121, 0, 3, 1, 'SANCHESZG', 'VERONICAS', 'cb9b82d4e0ecc9b99b74be8b4ea3fa75', 120567, 'SANCHEZ GUZMAN VERONICA', NULL, NULL, 0, 1),
(122, 0, 3, 1, 'GONZALEZY', 'YAZMINRGZ1', 'd2fb146cef016770bc34678793c8b6d7', 121472, 'YAZMIN', 'RODRIGUEZ', 'GONZALEZ', 0, 1),
(123, 0, 3, 1, 'BRENDA', 'BRENAMOR', 'fce5c21489669a2867265b6f30935e9e', 123765, 'BRENDA JESSICA', 'PACHECO ', 'DAVILA', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ws_usuario_menu`
--

DROP TABLE IF EXISTS `ws_usuario_menu`;
CREATE TABLE IF NOT EXISTS `ws_usuario_menu` (
  `id_usuario_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `imp` tinyint(4) DEFAULT NULL,
  `edit` tinyint(4) DEFAULT NULL,
  `elim` tinyint(4) DEFAULT NULL,
  `nuevo` tinyint(4) DEFAULT NULL,
  `exportar` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ws_usuario_menu`
--

INSERT INTO `ws_usuario_menu` (`id_usuario_menu`, `id_usuario`, `id_menu`, `imp`, `edit`, `elim`, `nuevo`, `exportar`) VALUES
(81, 1, 1, 0, 0, 0, 0, 0),
(82, 1, 2, 1, 1, 1, 1, 1),
(83, 1, 3, 1, 1, 1, 1, 1),
(84, 1, 8, 0, 0, 0, 0, 0),
(85, 1, 9, 0, 1, 1, 1, 1),
(86, 1, 10, 0, 1, 1, 1, 1),
(87, 1, 11, 0, 1, 1, 1, 1),
(88, 1, 12, 0, 1, 1, 1, 1),
(89, 1, 13, 0, 1, 1, 1, 1),
(90, 1, 14, 0, 1, 1, 1, 1),
(91, 1, 15, 0, 1, 1, 1, 1),
(92, 1, 16, 0, 1, 1, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
