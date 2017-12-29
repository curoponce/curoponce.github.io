-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2017 a las 19:52:28
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbventaslaravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_venta` decimal(11,0) NOT NULL,
  `descripcion` varchar(512) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `id_categoria`, `codigo`, `nombre`, `stock`, `precio_venta`, `descripcion`, `imagen`, `estado`) VALUES
(1, 1, 'AA101566', 'filtro de aire', 33, '35', NULL, 'filtro.jpg', 'Activo'),
(2, 2, 'AB126985', 'poncho de palier 4T', 119, '8', NULL, 'ponchos.jpg', 'Activo'),
(3, 3, 'AA885987', 'limpiaparabrisa', 12, '15', NULL, 'plumilla.jpg', 'Inactivo'),
(4, 4, 'AA698544', 'tuerca castillo', 316, '3', NULL, 'tuerca-castillo.jpg', 'Activo'),
(5, 5, 'AA958674', 'Aceite Shell HX5', 56, '21', NULL, 'shell.jpg', 'Activo'),
(6, 1, 'AX569777', 'llanta MRF', 49, '135', NULL, 'llanta-mrf.jpg', 'Activo'),
(7, 7, 'AA587112', 'Aro original Torito Bajaj 4T', 13, '75', NULL, 'aro-torito.jpg', 'Inactivo'),
(8, 1, 'AA201562', 'Filtro de aceite Bajaj 4T', 98, '5', NULL, 'filtro-aceite.jpg', 'Activo'),
(9, 1, 'AD236578', 'Filtro de aceite Bajaj 4T FL', 496, '15', NULL, 'filtro-fl.jpg', 'Activo'),
(10, 1, 'JK587495', 'poncho de palier TVS', 110, '5', NULL, 'poncho-tvs.jpg', 'Inactivo'),
(11, 3, 'AZ151141', 'Amortiguador superior', 19, '55', NULL, 'amortiguador.jpg', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(256) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `status`) VALUES
(1, 'Filtros  Torito Bajaj 4T', 'en esta categoria se encontrara los diferentes filtros para los autocarros torito bajaj 4T', 1),
(2, 'GuardaPolvo', 'esta categoria es para los distintos tipos de guardapolvos (ponchos de palier) disponibles para autocarros torito BAJAJ 4T', 1),
(3, 'Repuestos', 'en esta categoria se puede agregar los distintos repuestos pertenecientes a los autocarros torito bajaj 4T', 1),
(4, 'Tuercas', 'tuercas de motor, parte interna y externa, etc', 1),
(5, 'Lubricantes', 'Contamos con las marcas más importantes del mundo de los lubricantes, los cuales apuntan a una clientela específica, cada cual en su segmento definido, pero ambos complementadose en la calidad que los respalda.', 1),
(6, 'neumaticos', 'aqui encontraras distintos tipos de marcas de neumaticos', 1),
(7, 'Aros', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ingresos`
--

CREATE TABLE `detalles_ingresos` (
  `id_detalle_ingreso` int(11) NOT NULL,
  `id_ingreso` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalles_ingresos`
--

INSERT INTO `detalles_ingresos` (`id_detalle_ingreso`, `id_ingreso`, `id_articulo`, `cantidad`, `precio_compra`) VALUES
(2, 2, 1, 50, '15000.00'),
(3, 3, 1, 6, '14000.00'),
(4, 4, 9, 225, '3.00'),
(5, 4, 6, 10, '115.00'),
(6, 4, 4, 155, '1.00'),
(7, 5, 9, 225, '3.00'),
(8, 5, 6, 10, '115.00'),
(9, 5, 4, 155, '1.00'),
(10, 6, 2, 25, '5.00'),
(11, 6, 11, 10, '44.00'),
(12, 6, 9, 10, '21.00'),
(13, 7, 10, 85, '4.00'),
(14, 7, 6, 10, '115.00');

--
-- Disparadores `detalles_ingresos`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalles_ingresos` FOR EACH ROW BEGIN 
  UPDATE articulos SET stock = stock + NEW.cantidad
    WHERE articulos.id_articulo = NEW.id_articulo;
   
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_ventas`
--

CREATE TABLE `detalles_ventas` (
  `id_detalle_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalles_ventas`
--

INSERT INTO `detalles_ventas` (`id_detalle_venta`, `id_venta`, `id_articulo`, `cantidad`, `precio_venta`, `descuento`) VALUES
(1, 1, 1, 5, '23000.00', '0.00'),
(2, 2, 1, 30, '23000.00', '5.00'),
(3, 2, 2, 100, '80.00', '0.00'),
(4, 3, 1, 1, '35.00', '1.00'),
(5, 3, 2, 1, '8.00', '0.50'),
(6, 3, 7, 1, '75.00', '5.00'),
(7, 4, 4, 2, '3.00', '0.50'),
(8, 4, 11, 1, '55.00', '3.00'),
(9, 5, 7, 1, '75.00', '3.00'),
(10, 5, 10, 10, '5.00', '0.00'),
(11, 6, 6, 1, '135.00', '5.00'),
(12, 7, 1, 2, '35.00', '2.00');

--
-- Disparadores `detalles_ventas`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalles_ventas` FOR EACH ROW BEGIN 
  UPDATE articulos SET stock = stock - NEW.cantidad
    WHERE articulos.id_articulo = NEW.id_articulo;
   
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_ingreso` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) DEFAULT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingreso`, `id_proveedor`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `estado`) VALUES
(2, 2, 'Factura', '001', '554', '2016-11-13 16:39:54', '16.00', 'Aceptado'),
(3, 2, 'Ticket', '001', '776', '2016-11-13 16:40:48', '16.00', 'Aceptado'),
(4, 4, 'Factura', '0001', '0001', '2017-12-10 23:10:44', '18.00', 'Aceptado'),
(5, 4, 'Factura', '0001', '0001', '2017-12-10 23:11:14', '18.00', 'Cancelado'),
(6, 5, 'Factura', '0002', '0002', '2017-12-10 23:12:22', '18.00', 'Aceptado'),
(7, 6, 'Factura', '0003', '0003', '2017-12-10 23:13:08', '18.00', 'Aceptado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jbarron_web@hotmail.com', '47f20d34a7254b2747fa7df08dc248711c0f9cb9c85884ca5616d74f8af56aaf', '2016-11-15 16:29:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `a_paterno` varchar(50) DEFAULT NULL,
  `a_materno` varchar(50) DEFAULT NULL,
  `tipo_persona` varchar(20) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(15) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombre`, `a_paterno`, `a_materno`, `tipo_persona`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`) VALUES
(1, 'joel', 'barron', 'hernandez', 'Cliente', 'RFC', 'bahj951216099', 'av piscina 2507', '4771725471', 'jbarron_web@hotmail.com'),
(2, 'Ignacio Cid', 'Diaz', 'Gonazalez', 'Inactivo', 'RFC', 'DIGI111KDIE', 'Juana de arco 111', '477654321', 'cid_pachuca@hotmail.com'),
(3, 'Alberto', 'Rodirguez', 'Marquez', 'Cliente', 'RFC', 'MARA983765JSI1', 'calle 3360676333', '4771567823', 'correo@dominio.com'),
(4, 'CROSLAND S.A.C', NULL, NULL, 'Proveedor', 'RUC', '19885577441', 'Av. Augusto Perez Aranibar Nro. 1872, San Isidro. Lima – Perú.', '016135272', 'recepcion@crosland.com.pe'),
(5, 'Indian Motos SAC', NULL, NULL, 'Proveedor', 'RUC', '12344477777', 'Av. La Marina 775 - Pueblo Libre - Lima', '(01)719-3800', 'indian@comunication.com'),
(6, 'BAJAJ S.A.C', NULL, NULL, 'Proveedor', 'RUC', '1444715211', 'Av. Augusto Perez Aranibar Nro. 1872, San Isidro. Lima - Perú', '0800-12287', 'rmrodriguez@crosland.com.pe'),
(7, 'alejandro', 'payin', 'rojas', 'Cliente', 'DNI', '58877441', 'san vicente - huaca los chinos', '985777415', 'pagin_76@gmail.com'),
(8, 'raul', 'diaz', 'marquez', 'Cliente', 'DNI', '66985547', 'san vicente - av. 9 de diciembre', '987725547', 'raul_18@hotmail.com'),
(9, 'jorge', 'benavides', 'huaman', 'Cliente', 'RUC', '115411148596', 'lunahuana', '928887469', 'jorge-1993@org.es'),
(10, 'juan', 'de la cruz', 'luciani', 'Cliente', 'DNI', '76887448', 'san vicente - las palmas', '996233158', 'delacruz_juan@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'alexis', 'admin@admin.com', '$2y$10$jZlHKEoClQLf.weM6cdQb.yRgRVsy/.LN6LYuIRYxqjfZPTvbQAIW', 'Z4s1GxbosYxOyJG5Z1o48AovOcXipleLqfRfB8ot5Cz41oyl7jPj7WzObFX5', '2017-12-11 03:02:18', '2017-12-11 03:02:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) NOT NULL,
  `serie_comprobante` varchar(7) NOT NULL,
  `num_comprobante` varchar(10) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_venta` decimal(11,2) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `total_venta`, `estado`) VALUES
(1, 1, 'Boleta', '001', '982', '2016-11-14 12:02:08', '16.00', '115000.00', 'Cancelada'),
(2, 3, 'Boleta', '001', '342', '2016-11-14 12:06:16', '16.00', '697995.00', 'Aceptada'),
(3, 3, 'Boleta', '001', '001', '2017-12-10 23:22:07', '18.00', '111.50', 'Aceptada'),
(4, 7, 'Factura', '0012', '0012', '2017-12-10 23:23:15', '18.00', '57.50', 'Aceptada'),
(5, 8, 'Ticket', '001', '001', '2017-12-10 23:24:06', '18.00', '122.00', 'Aceptada'),
(6, 9, 'Boleta', '0002', '0002', '2017-12-10 23:24:42', '18.00', '130.00', 'Aceptada'),
(7, 1, 'Boleta', '0004', '0004', '2017-12-11 00:03:51', '18.00', '68.00', 'Aceptada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_articulo_categoria_idx` (`id_categoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  ADD PRIMARY KEY (`id_detalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_idx` (`id_ingreso`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`id_articulo`);

--
-- Indices de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`id_articulo`),
  ADD KEY `fk_detalle_venta_idx` (`id_venta`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `fk_ingreso_persona_idx` (`id_proveedor`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_venta_persona_idx` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  MODIFY `id_detalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalles_ingresos`
--
ALTER TABLE `detalles_ingresos`
  ADD CONSTRAINT `fk_detalle_ingreso` FOREIGN KEY (`id_ingreso`) REFERENCES `ingresos` (`id_ingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalles_ventas`
--
ALTER TABLE `detalles_ventas`
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`id_proveedor`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_venta_persona` FOREIGN KEY (`id_cliente`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
