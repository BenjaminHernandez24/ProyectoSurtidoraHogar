-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2021 a las 08:25:55
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
  `nombre_cli` varchar(250) NOT NULL,
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
  `cliente` varchar(250) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `pago` decimal(10,2) NOT NULL,
  `cambio` decimal(10,2) NOT NULL,
  `impresiones` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `folio` int(11) NOT NULL
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
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
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
  `descripcion_marca` varchar(200) NOT NULL,
  `estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas_producto`
--

INSERT INTO `marcas_producto` (`id_marca`, `descripcion_marca`, `estatus`) VALUES
(1, 'ECKO', 1),
(2, 'VARIAS', 1),
(3, 'VARIOS USOS', 1),
(4, 'BRI', 1),
(5, 'VARIAS MARCAS', 1),
(6, 'PHILIPS', 1),
(7, 'ACROS', 1),
(8, 'WHIRLPOOL', 1),
(9, 'FRAGA', 1),
(10, 'KELVINATOR', 1),
(11, 'KOBLENZ', 1),
(12, 'MABE', 1),
(13, 'SUPERMATIC', 1),
(14, 'TURMIX', 1),
(15, 'ACROS', 1),
(16, 'CINSA', 1),
(17, 'DAEWOO', 1),
(18, 'EASY 2 TINA', 1),
(19, 'EASY AUTOMATICAS', 1),
(20, 'GENERAL ELECTRIC', 1),
(21, 'LG', 1),
(22, 'MAYTAG', 1),
(23, 'SAMSUMG', 1),
(24, 'WHITE WESTINGHOUSE', 1),
(25, 'BLACK & DECKER', 1),
(26, 'HAMILTON BEACH', 1),
(27, 'KITCHEN AID', 1),
(28, 'LAMEX', 1),
(29, 'LASCO', 1),
(30, 'MAN', 1),
(31, 'MOULINEX', 1),
(32, 'NUTRIBULLET', 1),
(33, 'OSTER', 1),
(34, 'TAURUS', 1),
(35, 'DIAFRAGMAS ECONOMICOS', 1),
(36, 'MAGAFESA', 1),
(37, 'ONEIDA', 1),
(38, 'PRESTO', 1),
(39, 'SUNBEAN', 1),
(40, 'EASY ', 1),
(41, 'GE', 1),
(42, 'KENMORE', 1),
(43, 'BOSCH', 1),
(44, 'MYTEC', 1),
(45, 'NAVIA', 1),
(46, 'SANYO', 1),
(47, 'OLLAS EKCO', 1),
(48, 'LICUADORAS HAMILTON', 1),
(49, 'LICUADORAS MAN', 1),
(50, 'LICUADORAS TAURUS', 1),
(51, 'LICUADORAS MOULINEX', 1),
(52, 'LICUADORAS B&D', 1),
(53, 'LICUADORAS OSTER', 1),
(54, 'LICUADORAS PHILIPS', 1),
(55, 'OLLAS PRESTO', 1),
(56, 'ESTUFAS ACROS', 1),
(57, 'ESTUFAS KELVINATOR', 1),
(58, 'ESTUFAS FRAGA', 1),
(59, 'ESTUFAS IEM', 1),
(60, 'ESTUFAS VARIAS MARCAS', 1);

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
(1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(350) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `precio_publico` decimal(10,2) NOT NULL,
  `estatus` int(1) NOT NULL
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
  `subtotal` decimal(10,2) NOT NULL,
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
  `precio_a_vender` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `id_detalle_salida_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo` int(11) NOT NULL,
  `descripcion_tipo` varchar(200) NOT NULL,
  `estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo`, `descripcion_tipo`, `estatus`) VALUES
(1, 'CAFETERAS', 1),
(2, 'BANDAS', 1),
(3, 'BALEROS', 1),
(4, 'AIRES ACONDICIONADOS', 1),
(5, 'CALENTADORES PARA AGUA', 1),
(6, 'CAPACITORES', 1),
(7, 'CONEXIONES PARA GAS', 1),
(8, 'ENFRIADORES PARA AGUA', 1),
(9, 'ESTUFAS', 1),
(10, 'EXTRACTOR', 1),
(11, 'LAVADORAS', 1),
(12, 'LICUADORAS', 1),
(13, 'OLLAS DE PRESIÓN', 1),
(14, 'PLANCHAS', 1),
(15, 'PROTECTOR TERMICO', 1),
(16, 'REFRIGERADORES', 1),
(17, 'FILTROS REFRIGERADOR', 1),
(18, 'REGULADORES', 1),
(19, 'RELAYS', 1),
(20, 'SECADORAS PARA ROPA', 1),
(21, 'TUBOS CAPILARES', 1),
(22, 'VENTILADORES', 1),
(23, 'ARTICULOS CON EMPAQUE', 1),
(24, 'COMPRESORES', 1);

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
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
