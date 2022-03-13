-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2020 a las 04:45:02
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dalladb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombre`, `apellido`, `correo`, `clave`, `foto`) VALUES
(1, 'Paula', 'Petunia', '123@123.com', '202cb962ac59075b964b07152d234b70', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `apellido`, `correo`, `clave`, `foto`, `estado`) VALUES
(1, 'Pompilio', 'Simpson', '1@1.com', 'c4ca4238a0b923820dcc509a6f75849b', 'estudiante.png', 1),
(2, 'Juan', 'Gomez', '2@2.com', 'c81e728d9d4c2f636f067f89cc14862c', NULL, 1),
(3, '', '', '3@3.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor` varchar(45) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `fecha`, `valor`, `idCliente`, `estado`) VALUES
(1593717673, '2020-07-02', '100000', 1, 1),
(1593717726, '2020-07-02', '100000', 1, 1),
(1593717998, '2020-07-02', '40500', 1, 1),
(1593729970, '2020-07-02', '173300', 1, 1),
(1593738175, '2020-07-02', '47800', 1, 1),
(1593888968, '2020-07-04', '113300', 1, 1),
(1593915346, '2020-07-04', '282200', 1, 1),
(1593916692, '2020-07-04', '191200', 1, 1),
(1593921942, '2020-07-04', '251000', 2, 1),
(1593921990, '2020-07-04', '251000', 2, 1),
(1593922018, '2020-07-04', '95600', 2, 1),
(1593922044, '2020-07-04', '95600', 2, 1),
(1593922112, '2020-07-04', '95600', 2, 1),
(1593922228, '2020-07-04', '125500', 2, 1),
(1594074748, '2020-07-06', '93300', 1, 1),
(1594140998, '2020-07-07', '143400', 1, 1),
(1594141984, '2020-07-07', '136500', 1, 1),
(1594340613, '2020-07-09', '424300', 1, 1),
(1594340667, '2020-07-09', '247600', 1, 1),
(1594341613, '2020-07-09', '305400', 1, 1),
(1594342540, '2020-07-09', '412000', 1, 1),
(1594582319, '2020-07-12', '152000', 1, 1),
(1594597989, '2020-07-12', '251000', 1, 1),
(1594598062, '2020-07-12', '47800', 1, 1),
(1594598211, '2020-07-12', '143400', 1, 1),
(1594600277, '2020-07-12', '95600', 1, 1),
(1594600416, '2020-07-12', '129050', 1, 1),
(1594669501, '2020-07-13', '134700', 2, 1),
(1594673038, '2020-07-13', '135600', 1, 1),
(1594765426, '2020-07-14', '163000', 1, 1),
(1594766467, '2020-07-14', '', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaproducto`
--

CREATE TABLE `facturaProducto` (
  `idFacturaProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturaproducto`
--

INSERT INTO `facturaProducto` (`idFacturaProducto`, `cantidad`, `precio`, `idFactura`, `idProducto`) VALUES
(62, 1, 50000, 1593717673, 11),
(64, 1, 50000, 1593717726, 10),
(76, 1, 37500, 1593717998, 34),
(77, 1, 3000, 1593717998, 19),
(139, 3, 106500, 1594582319, 20),
(145, 3, 143400, 1594598211, 72),
(146, 2, 95600, 1594600277, 72),
(147, 2, 95600, 1594600416, 58),
(148, 1, 33450, 1594600416, 66),
(151, 1, 67800, 1594669501, 32),
(152, 2, 66900, 1594669501, 66),
(153, 2, 135600, 1594673038, 67),
(159, 1, 67400, 1594765426, 55),
(160, 2, 95600, 1594765426, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE `log` (
  `Id` int(11) NOT NULL,
  `Accion` varchar(45) NOT NULL,
  `Datos` varchar(45) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Actor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`Id`, `Accion`, `Datos`, `Fecha`, `Hora`, `Actor`) VALUES
(341, 'Inicio sesion', 'Paula', '2020-07-14', '21:36:28', '123@123.com'),
(342, 'Inicio sesion', 'Paula', '2020-07-14', '21:36:28', '123@123.com'),
(343, 'Inicio sesion', 'Paula', '2020-07-14', '21:37:12', '123@123.com'),
(344, 'Inicio sesion', '', '2020-07-14', '21:37:27', '4@4.com'),
(345, 'Inicio sesion', 'Paula', '2020-07-14', '21:37:38', '123@123.com'),
(346, 'Inicio sesion', 'Pompilio', '2020-07-14', '21:38:22', '1@1.com'),
(347, 'Compra', 'Factura numero: 1594765426', '2020-07-14', '21:38:58', '1@1.com'),
(348, 'Inicio sesion', 'Paula', '2020-07-14', '21:39:20', '123@123.com'),
(349, 'Edicion producto ', '9-blusa mujer-8-13500-1.jpg-2.jpg-3.jpg', '2020-07-14', '21:43:35', '123@123.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cantidad` tinyint(4) NOT NULL,
  `precio` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `foto` varchar(45) NOT NULL,
  `foto2` varchar(45) NOT NULL,
  `foto3` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `cantidad`, `precio`, `idProveedor`, `foto`, `foto2`, `foto3`) VALUES
(9, 'blusa mujer', 15, 13500, 1, '1.jpg', '2.jpg', '3.jpg'),
(10, 'blusa mujer', 0, 50900, 1, '1.jpg', '2.jpg', '3.jpg'),
(11, 'blusa mujer', 0, 67200, 1, '1.jpg', '2.jpg', '3.jpg'),
(12, 'blusa mujer', 0, 50000, 1, '1.jpg', '2.jpg', '3.jpg'),
(13, 'blusa mujer', 0, 40600, 1, '1.jpg', '2.jpg', '3.jpg'),
(14, 'blusa mujer', 0, 45700, 1, '1.jpg', '2.jpg', '3.jpg'),
(19, 'Short mujer', 3, 35600, 1, '1.jpg', '2.jpg', '3.jpg'),
(20, 'camiseta hombre', 31, 35500, 2, '1.jpg', '2.jpg', '3.jpg'),
(21, 'camisa hombre', 31, 45500, 2, '1.jpg', '2.jpg', '3.jpg'),
(22, 'camisa hombre', 29, 45500, 2, '1.jpg', '2.jpg', '3.jpg'),
(23, 'chaqueta hombre', 24, 125500, 2, '1.jpg', '2.jpg', '3.jpg'),
(29, 'pantalon hombre', 48, 47800, 2, '1.jpg', '2.jpg', '3.jpg'),
(30, 'pantalon hombre', 48, 47800, 2, '1.jpg', '2.jpg', '3.jpg'),
(31, 'vestido mujer', 24, 67800, 2, '1.jpg', '2.jpg', '3.jpg'),
(32, 'vestido mujer', 53, 67800, 2, '1.jpg', '2.jpg', '3.jpg'),
(33, 'pantalon mujer', 44, 37500, 2, '1.jpg', '2.jpg', '3.jpg'),
(34, 'camiseta hombre', 44, 37500, 2, '1.jpg', '2.jpg', '3.jpg'),
(35, 'chaqueta hombre', 44, 137500, 2, '1.jpg', '2.jpg', '3.jpg'),
(52, 'Chaqueta mujer', 50, 60900, 1, '1.jpg', '2.jpg', '3.jpg'),
(54, 'Chaqueta mujer', 70, 27800, 1, '1.jpg', '2.jpg', '3.jpg'),
(55, 'Pantalon hombre', 29, 67400, 1, '1.jpg', '2.jpg', '3.jpg'),
(56, 'Pantalon mujer', 20, 60300, 2, '1.jpg', '2.jpg', '3.jpg'),
(57, 'Chaqueta mujer', 35, 23400, 2, '1.jpg', '2.jpg', '3.jpg'),
(58, 'vestido mujer', 32, 47800, 1, '1.jpg', '2.jpg', '3.jpg'),
(59, 'vestido mujer', 67, 55400, 2, '1.jpg', '2.jpg', '3.jpg'),
(60, 'vestido mujer', 29, 33450, 1, '1.jpg', '2.jpg', '3.jpg'),
(64, 'pantalon mujer', 50, 47800, 1, '1.jpg', '2.jpg', '3.jpg'),
(65, 'pantalon mujer', 32, 54600, 2, '1.jpg', '2.jpg', '3.jpg'),
(66, 'pantalon mujer', 12, 33450, 2, '1.jpg', '2.jpg', '3.jpg'),
(67, 'camiseta hombre', 54, 67800, 1, '1.jpg', '2.jpg', '3.jpg'),
(68, 'camiseta hombre', 54, 54600, 2, '1.jpg', '2.jpg', '3.jpg'),
(69, 'camiseta hombre', 34, 50900, 2, '1.jpg', '2.jpg', '3.jpg'),
(70, 'pantalon hombre', 19, 47800, 1, '1.jpg', '2.jpg', '3.jpg'),
(71, 'pantalon hombre', 32, 54600, 2, '1.jpg', '2.jpg', '3.jpg'),
(72, 'chaqueta hombre', 45, 47800, 1, '1.jpg', '2.jpg', '3.jpg'),
(73, 'chaqueta hombre', 32, 54600, 2, '1.jpg', '2.jpg', '3.jpg'),
(74, 'chaqueta hombre', 15, 33450, 2, '1.jpg', '2.jpg', '3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `apellido`, `correo`, `clave`, `foto`, `estado`) VALUES
(1, 'Paula', 'Petunia', 'prueba@prueba.com', '202cb962ac59075b964b07152d234b70', '2.jpg', 1),
(2, 'Jorge', 'Gutierrez', 'porv@prov.com', '202cb962ac59075b964b07152d234b70', NULL, 1),
(4, '', '', '4@4.com', 'a87ff679a2f3e71d9181a67b7542122c', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `facturaProducto`
--
ALTER TABLE `facturaProducto`
  ADD PRIMARY KEY (`idFacturaProducto`,`idFactura`,`idProducto`),
  ADD KEY `idFactura` (`idFactura`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `facturaproducto`
--
ALTER TABLE `facturaProducto`
  MODIFY `idFacturaProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `log`
--
ALTER TABLE `log`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);

--
-- Filtros para la tabla `facturaproducto`
--
ALTER TABLE `facturaProducto`
  ADD CONSTRAINT `facturaProducto` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`),
  ADD CONSTRAINT `facturaProducto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
