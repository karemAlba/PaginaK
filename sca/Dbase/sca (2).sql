-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2018 a las 00:49:19
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caidas`
--

CREATE TABLE `caidas` (
  `idc` int(11) NOT NULL,
  `no_estacion` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alfanum` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_publicacion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_inicio` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_reviso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puesto_reviso` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quien_aprobo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puesto_aprobo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permiso` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `caidas`
--

INSERT INTO `caidas` (`idc`, `no_estacion`, `razon_social`, `direccion`, `alfanum`, `fecha_publicacion`, `fecha_inicio`, `nombre_reviso`, `puesto_reviso`, `quien_aprobo`, `puesto_aprobo`, `permiso`, `tipo`) VALUES
(3, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2),
(4, '7894/sdad', 'Petro', 'CDMX', 'asd815', 'ago-18', 'Agosto 2018- Agosto 2018', 'Atenea', 'Gerente ASEA', 'Margaret', 'representante tecnico', '5646', 1),
(5, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 1),
(6, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2),
(7, '7894/sdad', 'Petro', 'CDMX', 'asd815', 'ago-18', 'Agosto 2018- Agosto 2018', 'Atenea', 'Gerente ASEA', 'Margaret', 'representante tecnico', '5646', 1),
(8, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 1),
(9, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2),
(10, '7894/sdad', 'Petro', 'CDMX', 'asd815', 'ago-18', 'Agosto 2018- Agosto 2018', 'Atenea', 'Gerente ASEA', 'Margaret', 'representante tecnico', '5646', 1),
(11, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 1),
(12, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2),
(13, '7894/sdad', 'Petro', 'CDMX', 'asd815', 'ago-18', 'Agosto 2018- Agosto 2018', 'Atenea', 'Gerente ASEA', 'Margaret', 'representante tecnico', '5646', 1),
(14, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 1),
(15, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2),
(16, '7894/sdad', 'Petro', 'CDMX', 'asd815', 'ago-18', 'Agosto 2018- Agosto 2018', 'Atenea', 'Gerente ASEA', 'Margaret', 'representante tecnico', '5646', 1),
(17, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 1),
(18, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2),
(19, '7894/sdad', 'Petro', 'CDMX', 'asd815', 'ago-18', 'Agosto 2018- Agosto 2018', 'Atenea', 'Gerente ASEA', 'Margaret', 'representante tecnico', '5646', 1),
(20, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 1),
(21, '14587-c', 'Nieto', 'Metepec', '59e3qa', 'jul-18', 'Julio 2018-julio 2018', 'Clio', 'Gerente ASEA', 'Daniel', 'SASISOPA', '689-pe', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `nombre`, `url`, `tipo`) VALUES
(1, 'Apartado I', 'Apartado I.docx', 1),
(2, 'Apartado II', 'Apartado II.docx', 1),
(3, 'Apartado III', 'Apartado III.docx', 1),
(4, 'Apartado IV', 'Apartado IV.docx', 1),
(5, 'Apartado V', 'Apartado V.docx', 1),
(6, 'Apartado VI', 'Apartado VI.docx', 1),
(7, 'Apartado VII', 'Apartado VII.docx', 1),
(8, 'Apartado VIII', 'Apartado VIII.docx', 1),
(9, 'Apartado IX', 'Apartado IX.docx', 1),
(10, 'Apartado X', 'Apartado X.docx', 1),
(11, 'Apartado XI', 'Apartado XI.docx', 1),
(12, 'Apartado XII', 'Apartado XII.docx', 1),
(13, 'Apartado XIII', 'Apartado XIII.docx', 1),
(14, 'Apartado XIV', 'Apartado XIV.docx', 1),
(15, 'Apartado XV', 'Apartado XV.docx', 1),
(16, 'Apartado XVI', 'Apartado XVI.docx', 1),
(17, 'Apartado XVII', 'Apartado XVII.docx', 1),
(18, 'Apartado XVIII', 'Apartado XVIII.docx', 1),
(19, 'Formatos', 'FORMATOS.docx', 1),
(20, 'Informe de evaluación de desempeño', 'INFORME DE EVALUACION DE DESEMPENO.docx', 1),
(21, 'Plan de atención y respuesta a emergencias', 'PLAN DE ATENCION Y RESPUESTA A EMERGENCIAS.docx', 1),
(22, 'Programa gestión de objetivos y revisión por la dirección', 'PROGRAMA GESTION DE OBJETIVOS Y REVISION POR LA DIRECCION.docx', 1),
(24, 'Documento Puente (Excel)', 'DOCUMENTO PUENTE.xlsx', 2),
(25, 'Programa implementación SASISOPA (Excel)', 'Programa implementacion SASISOPA.xlsx', 2),
(26, 'Documento Puente', 'DOCUMENTO PUENTE.docx', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ext_log_entries`
--

CREATE TABLE `ext_log_entries` (
  `id` int(11) NOT NULL,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ext_translations`
--

CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idu` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol` smallint(6) DEFAULT NULL,
  `salt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idu`, `usuario`, `password`, `rol`, `salt`, `created_at`) VALUES
(1, 'ingomar', 'PJ7UoN', 1, NULL, '2018-04-10 15:55:22'),
(2, 'ingalfredo', 'zznV31', 1, NULL, '2018-04-10 15:55:49'),
(3, 'ingclio', 'ajQhzj', 1, NULL, '2018-04-10 15:56:27'),
(4, 'admin', 'admin123', 1, NULL, '2018-04-12 19:10:54'),
(5, 'ingaldo', 'aldo1234', 1, NULL, '2018-04-12 19:11:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caidas`
--
ALTER TABLE `caidas`
  ADD PRIMARY KEY (`idc`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_class_lookup_idx` (`object_class`),
  ADD KEY `log_date_lookup_idx` (`logged_at`),
  ADD KEY `log_user_lookup_idx` (`username`),
  ADD KEY `log_version_lookup_idx` (`object_id`,`object_class`,`username`);

--
-- Indices de la tabla `ext_translations`
--
ALTER TABLE `ext_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  ADD KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caidas`
--
ALTER TABLE `caidas`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `ext_log_entries`
--
ALTER TABLE `ext_log_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ext_translations`
--
ALTER TABLE `ext_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
