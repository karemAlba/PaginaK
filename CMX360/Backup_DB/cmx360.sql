-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2018 a las 15:03:02
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cmx360`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre`, `activo`, `idDepartamento`) VALUES
(1, 'Director General', 1, 1),
(2, 'Director Operativo', 1, 2),
(3, 'Gerente', 1, 3),
(4, 'Estratega', 1, 4),
(5, 'Jefe', 1, 3),
(6, 'Asesor', 1, 5),
(7, 'Jefe', 1, 6),
(8, 'Jefe', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idSegmento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `folio_generico` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_permiso` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estacion_servicio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `razon_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rfc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo_empresa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_empresa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `coordenada_x` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coordenada_y` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `idGrupo` int(11) NOT NULL,
  `idTipoCliente` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_responsables`
--

CREATE TABLE `cliente_responsables` (
  `id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idResponsableContacto` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colonias`
--

CREATE TABLE `colonias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_postal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idMunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `id_departamento_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `activo`, `id_departamento_padre`) VALUES
(1, 'Dirección General', 1, 0),
(2, 'Dirección Operativa', 1, 1),
(3, 'Relaciones Comerciales', 1, 2),
(4, 'Estratega Comercial', 1, 2),
(5, 'Call Center', 1, 3),
(6, 'CRE', 1, 3),
(7, 'Vinculación', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio_clientes`
--

CREATE TABLE `domicilio_clientes` (
  `id` int(11) NOT NULL,
  `calle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_fiscal` tinyint(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `idColonia` int(11) DEFAULT NULL,
  `idMunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idZona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadosciviles`
--

CREATE TABLE `estadosciviles` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatuscontratos`
--

CREATE TABLE `estatuscontratos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatuslaborales`
--

CREATE TABLE `estatuslaborales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estatuslaborales`
--

  INSERT INTO `estatuslaborales` (`id`, `nombre`) VALUES
  (1, 'Baja'),
  (2, 'Vigente'),
  (3, 'Temporal'),
  (4, 'Permanente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gradoestudios`
--

CREATE TABLE `gradoestudios` (
  `id` int(11) NOT NULL,
  `grado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `id_grupo_padre` int(11) DEFAULT NULL,
  `idTipoGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentescos`
--

CREATE TABLE `parentescos` (
  `id` int(11) NOT NULL,
  `relacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personales`
--

CREATE TABLE `personales` (
  `id` int(11) NOT NULL,
  `noi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `curp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rfc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ap_paterno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ap_materno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `antiguedad` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruta_fotografia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idGenero` int(11) NOT NULL,
  `idEstatusLaboral` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personales`
--

INSERT INTO `personales` (`id`, `noi`, `curp`, `rfc`, `nombre`, `ap_paterno`, `ap_materno`, `edad`, `telefono`, `correo`, `fecha_alta`, `fecha_ingreso`, `fecha_baja`, `antiguedad`, `ruta_fotografia`, `activo`, `idGenero`, `idEstatusLaboral`) VALUES
(1, '12356', 'RIHC890919HMCSRS03', 'RIHC890919', 'cesar', 'rios', 'hernandez', 28, '7224224818', 'cesar@kreatsolutions.com.mx', NULL, '2018-06-27', NULL, NULL, NULL, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_empresas`
--

CREATE TABLE `personal_empresas` (
  `id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idPersonal` int(11) NOT NULL,
  `idCargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personal_empresas`
--

INSERT INTO `personal_empresas` (`id`, `activo`, `idPersonal`, `idCargo`) VALUES
(1, 1, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_generales`
--

CREATE TABLE `personal_generales` (
  `id` int(11) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domicilio_ine` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `especialidad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_casa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `llamar_a` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_aviso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nss` int(11) DEFAULT NULL,
  `clinica` int(11) DEFAULT NULL,
  `tipo_sangre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hijo` int(11) DEFAULT NULL,
  `no_hija` int(11) DEFAULT NULL,
  `no_cedula` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `escuela` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_contrato_descuento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idPersonal` int(11) NOT NULL,
  `idParentesco` int(11) NOT NULL,
  `idGradoEstudio` int(11) NOT NULL,
  `idTipoDescuento` int(11) NOT NULL,
  `idEstadoCivil` int(11) NOT NULL,
  `idColonia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_laborales`
--

CREATE TABLE `personal_laborales` (
  `id` int(11) NOT NULL,
  `fecha_inicio_contrato` date DEFAULT NULL,
  `fecha_fin_contrato` date DEFAULT NULL,
  `sueldo_mensual` double DEFAULT NULL,
  `sueldo_diario` double DEFAULT NULL,
  `sueldo_integrado` double DEFAULT NULL,
  `talla_cb` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `talla_pv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `talla_pm` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `talla_c` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idTipoContrato` int(11) NOT NULL,
  `idEstatusContrato` int(11) NOT NULL,
  `idPersonal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_perfiles`
--

CREATE TABLE `persona_perfiles` (
  `id` int(11) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idPerfil` int(11) NOT NULL,
  `idPrivilegio` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idClienteResponsable` int(11) DEFAULT NULL,
  `idAcceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsablecontactos`
--

CREATE TABLE `responsablecontactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idTipoResponsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segmentos`
--

CREATE TABLE `segmentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clave` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idSector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoclientes`
--

CREATE TABLE `tipoclientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontratos`
--

CREATE TABLE `tipocontratos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodescuentos`
--

CREATE TABLE `tipodescuentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipogrupos`
--

CREATE TABLE `tipogrupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiporesponsables`
--

CREATE TABLE `tiporesponsables` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contrasena` tinyblob,
  `activo` tinyint(1) DEFAULT NULL,
  `idPersonal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `zona` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `idPais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cargos_departamentos1_idx` (`idDepartamento`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorias_segmentos1_idx` (`idSegmento`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clientes_grupos1_idx` (`idGrupo`),
  ADD KEY `fk_clientes_tipoClientes1_idx` (`idTipoCliente`),
  ADD KEY `fk_clientes_categorias1_idx` (`idCategoria`);

--
-- Indices de la tabla `cliente_responsables`
--
ALTER TABLE `cliente_responsables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_responsables_responsableContactos1_idx` (`idResponsableContacto`),
  ADD KEY `fk_cliente_responsables_clientes1_idx` (`idCliente`);

--
-- Indices de la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_colonia_municipio1_idx` (`idMunicipio`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `domicilio_clientes`
--
ALTER TABLE `domicilio_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_domicilio_cliente_cliente1_idx` (`idCliente`),
  ADD KEY `fk_domicilio_clientes_municipios1_idx` (`idMunicipio`),
  ADD KEY `fk_domicilio_clientes_colonias1_idx` (`idColonia`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estado_zona1_idx` (`idZona`);

--
-- Indices de la tabla `estadosciviles`
--
ALTER TABLE `estadosciviles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatuscontratos`
--
ALTER TABLE `estatuscontratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estatuslaborales`
--
ALTER TABLE `estatuslaborales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gradoestudios`
--
ALTER TABLE `gradoestudios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupos_tipoGrupos1_idx` (`idTipoGrupo`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_municipio_estado1_idx` (`idEstado`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personales`
--
ALTER TABLE `personales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personales_generos1_idx` (`idGenero`),
  ADD KEY `fk_personales_estatusLaborales1_idx` (`idEstatusLaboral`);

--
-- Indices de la tabla `personal_empresas`
--
ALTER TABLE `personal_empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personal_empresas_personales1_idx` (`idPersonal`),
  ADD KEY `fk_personal_empresas_cargos1_idx` (`idCargo`);

--
-- Indices de la tabla `personal_generales`
--
ALTER TABLE `personal_generales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personal_generales_personales1_idx` (`idPersonal`),
  ADD KEY `fk_personal_generales_parentescos1_idx` (`idParentesco`),
  ADD KEY `fk_personal_generales_gradoEstudios1_idx` (`idGradoEstudio`),
  ADD KEY `fk_personal_generales_tipoDescuentos1_idx` (`idTipoDescuento`),
  ADD KEY `fk_personal_generales_estadosCiviles1_idx` (`idEstadoCivil`),
  ADD KEY `fk_personal_generales_colonias1_idx` (`idColonia`);

--
-- Indices de la tabla `personal_laborales`
--
ALTER TABLE `personal_laborales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personal_laborales_tipoContratos1_idx` (`idTipoContrato`),
  ADD KEY `fk_personal_laborales_estatusContratos1_idx` (`idEstatusContrato`),
  ADD KEY `fk_personal_laborales_personales1_idx` (`idPersonal`);

--
-- Indices de la tabla `persona_perfiles`
--
ALTER TABLE `persona_perfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_perfiles_perfil1_idx` (`idPerfil`),
  ADD KEY `fk_persona_perfiles_privilegio1_idx` (`idPrivilegio`),
  ADD KEY `fk_persona_perfiles_usuarios1_idx` (`idUsuario`),
  ADD KEY `fk_persona_perfiles_cliente_responsables1_idx` (`idClienteResponsable`),
  ADD KEY `fk_persona_perfiles_accesos1_idx` (`idAcceso`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `responsablecontactos`
--
ALTER TABLE `responsablecontactos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_responsableContactos_tipoResponsables1_idx` (`idTipoResponsable`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `segmentos`
--
ALTER TABLE `segmentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_segmentos_sectores1_idx` (`idSector`);

--
-- Indices de la tabla `tipoclientes`
--
ALTER TABLE `tipoclientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipocontratos`
--
ALTER TABLE `tipocontratos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipodescuentos`
--
ALTER TABLE `tipodescuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipogrupos`
--
ALTER TABLE `tipogrupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiporesponsables`
--
ALTER TABLE `tiporesponsables`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_personales1_idx` (`idPersonal`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zona_pais1_idx` (`idPais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente_responsables`
--
ALTER TABLE `cliente_responsables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `colonias`
--
ALTER TABLE `colonias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `domicilio_clientes`
--
ALTER TABLE `domicilio_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadosciviles`
--
ALTER TABLE `estadosciviles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estatuscontratos`
--
ALTER TABLE `estatuscontratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estatuslaborales`
--
ALTER TABLE `estatuslaborales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gradoestudios`
--
ALTER TABLE `gradoestudios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parentescos`
--
ALTER TABLE `parentescos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personales`
--
ALTER TABLE `personales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_empresas`
--
ALTER TABLE `personal_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_generales`
--
ALTER TABLE `personal_generales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_laborales`
--
ALTER TABLE `personal_laborales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona_perfiles`
--
ALTER TABLE `persona_perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `responsablecontactos`
--
ALTER TABLE `responsablecontactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `segmentos`
--
ALTER TABLE `segmentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoclientes`
--
ALTER TABLE `tipoclientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocontratos`
--
ALTER TABLE `tipocontratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipodescuentos`
--
ALTER TABLE `tipodescuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipogrupos`
--
ALTER TABLE `tipogrupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiporesponsables`
--
ALTER TABLE `tiporesponsables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `FK_3C3760F61E7A331A` FOREIGN KEY (`idDepartamento`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `FK_5E9F836C616CAD3D` FOREIGN KEY (`idSegmento`) REFERENCES `segmentos` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_50FE07D717764C5A` FOREIGN KEY (`idTipoCliente`) REFERENCES `tipoclientes` (`id`),
  ADD CONSTRAINT `FK_50FE07D79BCAD8CE` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `FK_50FE07D7B2FA397B` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `cliente_responsables`
--
ALTER TABLE `cliente_responsables`
  ADD CONSTRAINT `FK_D134CE17B3D0F591` FOREIGN KEY (`idResponsableContacto`) REFERENCES `responsablecontactos` (`id`),
  ADD CONSTRAINT `FK_D134CE17E4A5F0D7` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `colonias`
--
ALTER TABLE `colonias`
  ADD CONSTRAINT `FK_BF9617F272DEB6` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`id`);

--
-- Filtros para la tabla `domicilio_clientes`
--
ALTER TABLE `domicilio_clientes`
  ADD CONSTRAINT `FK_FD98D306272DEB6` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `FK_FD98D3063D6D4568` FOREIGN KEY (`idColonia`) REFERENCES `colonias` (`id`),
  ADD CONSTRAINT `FK_FD98D306E4A5F0D7` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `estados`
--
ALTER TABLE `estados`
  ADD CONSTRAINT `FK_222B2128D47B5A80` FOREIGN KEY (`idZona`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `FK_45842FEE62F38DF` FOREIGN KEY (`idTipoGrupo`) REFERENCES `tipogrupos` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `FK_BBFAB586454C4979` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `personales`
--
ALTER TABLE `personales`
  ADD CONSTRAINT `FK_FCB31CBB7C9B6C03` FOREIGN KEY (`idEstatusLaboral`) REFERENCES `estatuslaborales` (`id`),
  ADD CONSTRAINT `FK_FCB31CBBC31120A0` FOREIGN KEY (`idGenero`) REFERENCES `generos` (`id`);

--
-- Filtros para la tabla `personal_empresas`
--
ALTER TABLE `personal_empresas`
  ADD CONSTRAINT `FK_DCE297EC2C2A146C` FOREIGN KEY (`idCargo`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `FK_DCE297ECA22947DF` FOREIGN KEY (`idPersonal`) REFERENCES `personales` (`id`);

--
-- Filtros para la tabla `personal_generales`
--
ALTER TABLE `personal_generales`
  ADD CONSTRAINT `FK_5ADF974E1CEA2EFC` FOREIGN KEY (`idParentesco`) REFERENCES `parentescos` (`id`),
  ADD CONSTRAINT `FK_5ADF974E3D6D4568` FOREIGN KEY (`idColonia`) REFERENCES `colonias` (`id`),
  ADD CONSTRAINT `FK_5ADF974E474FD11` FOREIGN KEY (`idGradoEstudio`) REFERENCES `gradoestudios` (`id`),
  ADD CONSTRAINT `FK_5ADF974E75A05220` FOREIGN KEY (`idTipoDescuento`) REFERENCES `tipodescuentos` (`id`),
  ADD CONSTRAINT `FK_5ADF974EA22947DF` FOREIGN KEY (`idPersonal`) REFERENCES `personales` (`id`),
  ADD CONSTRAINT `FK_5ADF974ED948DE9F` FOREIGN KEY (`idEstadoCivil`) REFERENCES `estadosciviles` (`id`);

--
-- Filtros para la tabla `personal_laborales`
--
ALTER TABLE `personal_laborales`
  ADD CONSTRAINT `FK_3AFB4E7BA22947DF` FOREIGN KEY (`idPersonal`) REFERENCES `personales` (`id`),
  ADD CONSTRAINT `FK_3AFB4E7BA6306359` FOREIGN KEY (`idTipoContrato`) REFERENCES `tipocontratos` (`id`),
  ADD CONSTRAINT `FK_3AFB4E7BFD8CCED2` FOREIGN KEY (`idEstatusContrato`) REFERENCES `estatuscontratos` (`id`);

--
-- Filtros para la tabla `persona_perfiles`
--
ALTER TABLE `persona_perfiles`
  ADD CONSTRAINT `FK_76D2227432DCDBAF` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `FK_76D222744B4F1F49` FOREIGN KEY (`idClienteResponsable`) REFERENCES `cliente_responsables` (`id`),
  ADD CONSTRAINT `FK_76D222745215F4BB` FOREIGN KEY (`idPrivilegio`) REFERENCES `privilegios` (`id`),
  ADD CONSTRAINT `FK_76D222747179DF81` FOREIGN KEY (`idAcceso`) REFERENCES `accesos` (`id`),
  ADD CONSTRAINT `FK_76D22274F574DEDD` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `responsablecontactos`
--
ALTER TABLE `responsablecontactos`
  ADD CONSTRAINT `FK_BCDF591C4FD9AE97` FOREIGN KEY (`idTipoResponsable`) REFERENCES `tiporesponsables` (`id`);

--
-- Filtros para la tabla `segmentos`
--
ALTER TABLE `segmentos`
  ADD CONSTRAINT `FK_BFEDC4E128B27172` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_EF687F2A22947DF` FOREIGN KEY (`idPersonal`) REFERENCES `personales` (`id`);

--
-- Filtros para la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `FK_E1A6746CDA07061` FOREIGN KEY (`idPais`) REFERENCES `paises` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
