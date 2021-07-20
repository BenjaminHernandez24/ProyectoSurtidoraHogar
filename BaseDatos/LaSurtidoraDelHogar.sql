-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2021 a las 20:07:21
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lasurtidoradelhogar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `user` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL,
  `nombre_cli` varchar(200) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `Estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida_venta`
--

CREATE TABLE `detalle_salida_venta` (
  `id_detalle_salida_venta` int(11) NOT NULL,
  `cliente` varchar(200) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `pago` decimal(10,0) NOT NULL,
  `cambio` decimal(10,0) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_compra`
--

CREATE TABLE `entrada_compra` (
  `id_entrada_compra` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `precio_unitario` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `estatus_aceptable` int(11) NOT NULL,
  `estatus_alerta` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_producto`
--

CREATE TABLE `marcas_producto` (
  `id_marca` int(11) NOT NULL,
  `descripcion_marca` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas_producto`
--

INSERT INTO `marcas_producto` (`id_marca`, `descripcion_marca`) VALUES
(1, 'Whirpool'),
(2, 'VARIAS'),
(3, 'VARIOS USOS'),
(4, 'BRI'),
(5, 'VARIAS MARCAS'),
(6, 'PHILIPS'),
(7, 'ACROS'),
(8, 'WHIRLPOOL'),
(9, 'FRAGA'),
(10, 'KELVINATOR'),
(11, 'KOBLENZ'),
(12, 'MABE'),
(13, 'SUPERMATIC'),
(14, 'TURMIX'),
(15, 'ACROS'),
(16, 'CINSA'),
(17, 'DAEWOO'),
(18, 'EASY 2 TINA'),
(19, 'EASY AUTOMATICAS'),
(20, 'GENERAL ELECTRIC'),
(21, 'LG'),
(22, 'MAYTAG'),
(23, 'SAMSUMG'),
(24, 'WHITE WESTINGHOUSE'),
(25, 'BLACK & DECKER'),
(26, 'HAMILTON BEACH'),
(27, 'KITCHEN AID'),
(28, 'LAMEX'),
(29, 'LASCO'),
(30, 'MAN'),
(31, 'MOULINEX'),
(32, 'NUTRIBULLET'),
(33, 'OSTER'),
(34, 'TAURUS'),
(35, 'DIAFRAGMAS ECONOMICOS'),
(36, 'MAGAFESA'),
(37, 'ONEIDA'),
(38, 'PRESTO'),
(39, 'SUNBEAN'),
(40, 'EASY '),
(41, 'GE'),
(42, 'KENMORE'),
(43, 'BOSCH'),
(44, 'MYTEC'),
(45, 'NAVIA'),
(46, 'SANYO'),
(47, 'OLLAS EKCO'),
(48, 'LICUADORAS HAMILTON'),
(49, 'LICUADORAS MAN'),
(50, 'LICUADORAS TAURUS'),
(51, 'LICUADORAS MOULINEX'),
(52, 'LICUADORAS B&D'),
(53, 'LICUADORAS OSTER'),
(54, 'LICUADORAS PHILIPS'),
(55, 'OLLAS PRESTO'),
(56, 'ESTUFAS ACROS'),
(57, 'ESTUFAS KELVINATOR'),
(58, 'ESTUFAS FRAGA'),
(59, 'ESTUFAS IEM'),
(60, 'ESTUFAS VARIAS MARCAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `boton` int(1) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`boton`, `total`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(300) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `precio_publico` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_prov` int(11) NOT NULL,
  `nom_empresa` varchar(150) NOT NULL,
  `tel_empresa` varchar(20) NOT NULL,
  `nom_prov` varchar(200) NOT NULL,
  `tel_prov` varchar(20) NOT NULL,
  `No_cuenta` varchar(50) NOT NULL,
  `banco` varchar(60) NOT NULL,
  `Clave_interbancaria` varchar(60) NOT NULL,
  `estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_devolucion`
--

CREATE TABLE `salida_devolucion` (
  `id_salida_devolucion` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_merma`
--

CREATE TABLE `salida_merma` (
  `id_salida_merma` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_venta`
--

CREATE TABLE `salida_venta` (
  `id_salida_venta` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `precio_a_vender` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `id_detalle_salida_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo` int(11) NOT NULL,
  `descripcion_tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo`, `descripcion_tipo`) VALUES
(1, 'Lavadora'),
(2, 'VARIAS'),
(3, 'VARIOS USOS'),
(4, 'BRI'),
(5, 'VARIAS MARCAS'),
(6, 'PHILIPS'),
(7, 'ACROS'),
(8, 'WHIRLPOOL'),
(9, 'FRAGA'),
(10, 'KELVINATOR'),
(11, 'KOBLENZ'),
(12, 'MABE'),
(13, 'SUPERMATIC'),
(14, 'TURMIX'),
(15, 'ACROS'),
(16, 'CINSA'),
(17, 'DAEWOO'),
(18, 'EASY 2 TINA'),
(19, 'EASY AUTOMATICAS'),
(20, 'GENERAL ELECTRIC'),
(21, 'LG'),
(22, 'MAYTAG'),
(23, 'SAMSUMG'),
(24, 'WHITE WESTINGHOUSE'),
(25, 'BLACK & DECKER'),
(26, 'HAMILTON BEACH'),
(27, 'KITCHEN AID'),
(28, 'LAMEX'),
(29, 'LASCO'),
(30, 'MAN'),
(31, 'MOULINEX'),
(32, 'NUTRIBULLET'),
(33, 'OSTER'),
(34, 'TAURUS'),
(35, 'DIAFRAGMAS ECONOMICOS'),
(36, 'MAGAFESA'),
(37, 'ONEIDA'),
(38, 'PRESTO'),
(39, 'SUNBEAN'),
(40, 'EASY '),
(41, 'GE'),
(42, 'KENMORE'),
(43, 'BOSCH'),
(44, 'MYTEC'),
(45, 'NAVIA'),
(46, 'SANYO'),
(47, 'OLLAS EKCO'),
(48, 'LICUADORAS HAMILTON'),
(49, 'LICUADORAS MAN'),
(50, 'LICUADORAS TAURUS'),
(51, 'LICUADORAS MOULINEX'),
(52, 'LICUADORAS B&D'),
(53, 'LICUADORAS OSTER'),
(54, 'LICUADORAS PHILIPS'),
(55, 'OLLAS PRESTO'),
(56, 'ESTUFAS ACROS'),
(57, 'ESTUFAS KELVINATOR'),
(58, 'ESTUFAS FRAGA'),
(59, 'ESTUFAS IEM'),
(60, 'ESTUFAS VARIAS MARCAS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`user`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `detalle_salida_venta`
--
ALTER TABLE `detalle_salida_venta`
  ADD PRIMARY KEY (`id_detalle_salida_venta`);

--
-- Indices de la tabla `entrada_compra`
--
ALTER TABLE `entrada_compra`
  ADD PRIMARY KEY (`id_entrada_compra`),
  ADD KEY `id_prov` (`id_prov`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_prod` (`id_producto`);

--
-- Indices de la tabla `marcas_producto`
--
ALTER TABLE `marcas_producto`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `Id_tipo` (`id_tipo`),
  ADD KEY `Id_marca` (`id_marca`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indices de la tabla `salida_devolucion`
--
ALTER TABLE `salida_devolucion`
  ADD PRIMARY KEY (`id_salida_devolucion`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `salida_merma`
--
ALTER TABLE `salida_merma`
  ADD PRIMARY KEY (`id_salida_merma`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `salida_venta`
--
ALTER TABLE `salida_venta`
  ADD PRIMARY KEY (`id_salida_venta`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `id_detalle_salida_venta` (`id_detalle_salida_venta`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_salida_venta`
--
ALTER TABLE `detalle_salida_venta`
  MODIFY `id_detalle_salida_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada_compra`
--
ALTER TABLE `entrada_compra`
  MODIFY `id_entrada_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas_producto`
--
ALTER TABLE `marcas_producto`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_devolucion`
--
ALTER TABLE `salida_devolucion`
  MODIFY `id_salida_devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_merma`
--
ALTER TABLE `salida_merma`
  MODIFY `id_salida_merma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_venta`
--
ALTER TABLE `salida_venta`
  MODIFY `id_salida_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada_compra`
--
ALTER TABLE `entrada_compra`
  ADD CONSTRAINT `inventario_entrada` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proveedor_entrada_inventario` FOREIGN KEY (`id_prov`) REFERENCES `proveedores` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `producto_inventario` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `Producto_Marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas_producto` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Producto_Tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_producto` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_devolucion`
--
ALTER TABLE `salida_devolucion`
  ADD CONSTRAINT `salida_devolucion` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_merma`
--
ALTER TABLE `salida_merma`
  ADD CONSTRAINT `salida_merma` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_venta`
--
ALTER TABLE `salida_venta`
  ADD CONSTRAINT `detalle_salida_salida` FOREIGN KEY (`id_detalle_salida_venta`) REFERENCES `detalle_salida_venta` (`id_detalle_salida_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salida_venta` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
