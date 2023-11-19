-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-11-2023 a las 22:25:45
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elcorraldb`
--
CREATE DATABASE IF NOT EXISTS `elcorraldb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `elcorraldb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_errores`
--

DROP TABLE IF EXISTS `bitacora_errores`;
CREATE TABLE IF NOT EXISTS `bitacora_errores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion_error` varchar(256) NOT NULL,
  `error_num` int NOT NULL,
  `fechaHora` timestamp NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `funcion` varchar(30) NOT NULL,
  `script_sql` varchar(256) NOT NULL,
  `datos_pantalla` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `bitacora_errores`
--

INSERT INTO `bitacora_errores` (`id`, `descripcion_error`, `error_num`, `fechaHora`, `modulo`, `funcion`, `script_sql`, `datos_pantalla`) VALUES
(1, 'Error en consultar Error al ejecutare el Script de consulta: 1146 - Table elcorraldb.monedas doesnt exist', 1, '2023-11-19 20:07:04', 'ManCuentas', 'datMonedas::consultaLista', 'SELECT * FROM monedas WHERE estado = 1 ORDER BY id_moneda ASC', 'ManCuentas'),
(2, 'Error en consultar Error al ejecutare el Script de consulta: 1146 - Table elcorraldb.cuentas doesnt exist', 1, '2023-11-19 20:10:30', 'manCuentas', 'datCuentas::insertar', '', ', , 1, manCuentas, '),
(3, 'Error en ejecutar Error al ejecutar el Script: 1048 - Column campo cannot be null', 1, '2023-11-19 20:15:24', 'manCuentas', 'datCuentas::insertar', 'INSERT INTO cuentas VALUES (1,604320137,1,  NULL, 0)', '604320137, , 1, manCuentas, '),
(4, 'Error en ejecutar Error al ejecutar el Script: 1048 - Column campo cannot be null', 1, '2023-11-19 20:15:45', 'manCuentas', 'datCuentas::insertar', 'INSERT INTO cuentas VALUES (1,604320137,1,  NULL, 0)', '604320137, 1, 1, manCuentas, ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo_cliente` varchar(10) NOT NULL,
  `direccion_fisica` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellidos`, `fecha_nacimiento`, `tipo_cliente`, `direccion_fisica`, `email`) VALUES
(604320137, 'Raul', 'Portuguez Sarmiento', '1996-06-16', '1', 'en mi casa 2', 'rportuguezs@hotmail.com'),
(604220866, 'Andrea', 'Alvaro Varela', '1995-04-04', 'Comun', 'en su casa conmigo', 'andie48@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contabilidad`
--

DROP TABLE IF EXISTS `contabilidad`;
CREATE TABLE IF NOT EXISTS `contabilidad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cuenta_contable` varchar(30) NOT NULL,
  `monto` double NOT NULL,
  `num_documento` int NOT NULL,
  `cr_db` varchar(2) NOT NULL,
  `id_usuario` int NOT NULL,
  `id_servicio` int NOT NULL,
  `fecha_contable` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contabilidad`
--

INSERT INTO `contabilidad` (`id`, `cuenta_contable`, `monto`, `num_documento`, `cr_db`, `id_usuario`, `id_servicio`, `fecha_contable`) VALUES
(1, '211', 100, 1234, 'CR', 604320137, 1, '2023-11-19 00:00:00'),
(2, '212', 100, 1234, 'DB', 604320137, 1, '2023-11-19 21:47:13'),
(3, '211', 200.01, 12345, 'CR', 604220866, 2, '2023-11-19 21:49:47'),
(4, '212', 200.01, 12345, 'DB', 604220866, 2, '2023-11-19 21:49:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE IF NOT EXISTS `cuentas` (
  `id_cuenta` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_moneda` int NOT NULL,
  `campo` int DEFAULT NULL,
  `saldo` double NOT NULL,
  PRIMARY KEY (`id_cuenta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_cuenta`, `id_cliente`, `id_moneda`, `campo`, `saldo`) VALUES
(1, 604320137, 1, NULL, 0),
(2, 604320137, 2, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_sub_titulos`
--

DROP TABLE IF EXISTS `menu_sub_titulos`;
CREATE TABLE IF NOT EXISTS `menu_sub_titulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sub_titulo` varchar(20) NOT NULL,
  `url` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `menu_sub_titulos`
--

INSERT INTO `menu_sub_titulos` (`id`, `titulo`, `sub_titulo`, `url`) VALUES
(1, 'Mantenimiento', 'Clientes', 'manClientes.php'),
(2, 'Mantenimiento', 'Tarjetas', 'manTarjetas.php'),
(3, 'Mantenimiento', 'Cuentas', 'manCuentas.php'),
(4, 'Mantenimiento', 'Servicios', 'manServicios.php'),
(5, 'Transacciones', 'Depositos', 'traDeposito.php'),
(6, 'Transacciones', 'Avances de efectivo', 'traAvances.php'),
(7, 'Transacciones', 'Reversiones', 'traReversion.php'),
(8, 'Transacciones', 'Pago de servicios', 'traPagoServicios.php'),
(9, 'Administración', 'Usuarios', 'manUsuario.php'),
(10, 'Administración', 'Roles', 'manRoles.php'),
(11, 'Administración', 'Menus', 'manMenu.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_titulos`
--

DROP TABLE IF EXISTS `menu_titulos`;
CREATE TABLE IF NOT EXISTS `menu_titulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  `url` varchar(256) NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `menu_titulos`
--

INSERT INTO `menu_titulos` (`id`, `titulo`, `url`, `id_rol`) VALUES
(1, 'Mantenimiento', '', 99999),
(2, 'Transacciones', '', 99999),
(3, 'Contabilidad', 'conContabilidad.php', 99999),
(4, 'Administración', '', 99999),
(5, 'Manual de usuario', 'manualUsuario.php', 99999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

DROP TABLE IF EXISTS `monedas`;
CREATE TABLE IF NOT EXISTS `monedas` (
  `id_moneda` int NOT NULL,
  `nombre_moneda` varchar(20) NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id_moneda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id_moneda`, `nombre_moneda`, `estado`) VALUES
(1, 'Colones', 1),
(2, 'Dolares', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL COMMENT 'Identificador del usuario',
  `clave` varchar(30) NOT NULL COMMENT 'Contraseña del usuario',
  `id_rol` int NOT NULL COMMENT 'Identificador del rol asociado al usuario',
  `fecha_creacion` date NOT NULL COMMENT 'Fecha de creación',
  `estado` tinyint(1) NOT NULL,
  `fecha_ulti_ingreso` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `clave`, `id_rol`, `fecha_creacion`, `estado`, `fecha_ulti_ingreso`) VALUES
(604320137, '1234', 99999, '2023-10-26', 1, '2023-11-19 21:38:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
