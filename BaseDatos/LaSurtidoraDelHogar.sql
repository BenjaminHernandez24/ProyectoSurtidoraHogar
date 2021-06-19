-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2021 a las 05:42:25
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.19

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
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL,
  `nombre_cli` varchar(80) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `Estatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prod_categoria`
--

CREATE TABLE `detalle_prod_categoria` (
  `id_categoria` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_salida_inventario_venta`
--

CREATE TABLE `detalle_salida_inventario_venta` (
  `id_detalle_salida_venta` int(11) NOT NULL,
  `cliente` varchar(80) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `iva` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `pago` decimal(10,0) NOT NULL,
  `cambio` decimal(10,0) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_inventario_compra`
--

CREATE TABLE `entrada_inventario_compra` (
  `id_entrada_compra` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `precio_unitario` decimal(10,0) NOT NULL,
  `precio_pub` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_producto`
--

CREATE TABLE `marcas_producto` (
  `id_marca` int(11) NOT NULL,
  `descripcion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(11) NOT NULL,
  `cod_prod` varchar(80) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `stock_llenado` int(11) NOT NULL,
  `stock_alerta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_prov` int(11) NOT NULL,
  `nom_empresa` varchar(80) NOT NULL,
  `tel_empresa` varchar(20) NOT NULL,
  `nom_prov` varchar(80) NOT NULL,
  `tel_prov` varchar(20) NOT NULL,
  `No_cuenta` varchar(30) NOT NULL,
  `Clave_interbancaria` varchar(30) NOT NULL,
  `estatus` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_inventario_devolucion`
--

CREATE TABLE `salida_inventario_devolucion` (
  `id_salida_inventario_devolucion` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_inventario_merma`
--

CREATE TABLE `salida_inventario_merma` (
  `id_salida_inventario_merma` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `descripcion` varchar(80) NOT NULL,
  `num_piezas` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_inventario_venta`
--

CREATE TABLE `salida_inventario_venta` (
  `id_salida_inventario_venta` int(11) NOT NULL,
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
  `descripcion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indices de la tabla `detalle_prod_categoria`
--
ALTER TABLE `detalle_prod_categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Indices de la tabla `detalle_salida_inventario_venta`
--
ALTER TABLE `detalle_salida_inventario_venta`
  ADD PRIMARY KEY (`id_detalle_salida_venta`);

--
-- Indices de la tabla `entrada_inventario_compra`
--
ALTER TABLE `entrada_inventario_compra`
  ADD PRIMARY KEY (`id_entrada_compra`),
  ADD KEY `id_prov` (`id_prov`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Indices de la tabla `marcas_producto`
--
ALTER TABLE `marcas_producto`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indices de la tabla `salida_inventario_devolucion`
--
ALTER TABLE `salida_inventario_devolucion`
  ADD PRIMARY KEY (`id_salida_inventario_devolucion`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `salida_inventario_merma`
--
ALTER TABLE `salida_inventario_merma`
  ADD PRIMARY KEY (`id_salida_inventario_merma`),
  ADD KEY `id_inventario` (`id_inventario`);

--
-- Indices de la tabla `salida_inventario_venta`
--
ALTER TABLE `salida_inventario_venta`
  ADD PRIMARY KEY (`id_salida_inventario_venta`),
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
-- AUTO_INCREMENT de la tabla `detalle_prod_categoria`
--
ALTER TABLE `detalle_prod_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_salida_inventario_venta`
--
ALTER TABLE `detalle_salida_inventario_venta`
  MODIFY `id_detalle_salida_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada_inventario_compra`
--
ALTER TABLE `entrada_inventario_compra`
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
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_prov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_inventario_devolucion`
--
ALTER TABLE `salida_inventario_devolucion`
  MODIFY `id_salida_inventario_devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_inventario_merma`
--
ALTER TABLE `salida_inventario_merma`
  MODIFY `id_salida_inventario_merma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida_inventario_venta`
--
ALTER TABLE `salida_inventario_venta`
  MODIFY `id_salida_inventario_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_prod_categoria`
--
ALTER TABLE `detalle_prod_categoria`
  ADD CONSTRAINT `marca_detalle_categoria` FOREIGN KEY (`id_marca`) REFERENCES `marcas_producto` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_detalle_categoria` FOREIGN KEY (`id_prod`) REFERENCES `productos` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_producto_detalle_categoria` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_producto` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrada_inventario_compra`
--
ALTER TABLE `entrada_inventario_compra`
  ADD CONSTRAINT `inventario_entrada` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `proveedor_entrada_inventario` FOREIGN KEY (`id_prov`) REFERENCES `proveedores` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `producto_inventario` FOREIGN KEY (`id_prod`) REFERENCES `productos` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_inventario_devolucion`
--
ALTER TABLE `salida_inventario_devolucion`
  ADD CONSTRAINT `salida_devolucion` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_inventario_merma`
--
ALTER TABLE `salida_inventario_merma`
  ADD CONSTRAINT `salida_merma` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_inventario_venta`
--
ALTER TABLE `salida_inventario_venta`
  ADD CONSTRAINT `detalle_salida_salida` FOREIGN KEY (`id_detalle_salida_venta`) REFERENCES `detalle_salida_inventario_venta` (`id_detalle_salida_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salida_venta` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
