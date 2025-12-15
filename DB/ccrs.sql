-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2025 a las 04:23:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ccrs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `departamento` varchar(200) NOT NULL,
  `nombre_cliente` varchar(200) NOT NULL,
  `modelo_carro` varchar(200) NOT NULL,
  `ano_carro` text NOT NULL,
  `placa_carro` text NOT NULL,
  `vin_carro` text NOT NULL,
  `data_repuestos` text NOT NULL,
  `fecha` text NOT NULL,
  `nota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `id_users`, `departamento`, `nombre_cliente`, `modelo_carro`, `ano_carro`, `placa_carro`, `vin_carro`, `data_repuestos`, `fecha`, `nota`) VALUES
(16, 2, 'Servicio', 'asdasdas', 'dasdasd', '322323', 'asd3233', 'asd23122222222222', '[{\"nroParte\":\"08000\",\"nombre\":\"prueba\",\"cantidad\":\"22\"},{\"nroParte\":\"12525prubea\",\"nombre\":\"prueba prueba\",\"cantidad\":\"2\"},{\"nroParte\":\"080005252ds\",\"nombre\":\"Prueba\",\"cantidad\":\"22\"},{\"nroParte\":\"232323233\",\"nombre\":\"dasdasd\",\"cantidad\":\"22\"},{\"nroParte\":\"23eqad\",\"nombre\":\"dasd232\",\"cantidad\":\"22\"}]', '12-12-2025', 'wdqwqdqwd'),
(17, 2, 'Servicio', 'asdasdas', 'dasdasd', '322323', 'asd3233', 'asd23122222222222', '[{\"nroParte\":\"08000\",\"nombre\":\"prueba\",\"cantidad\":\"22\"},{\"nroParte\":\"12525prubea\",\"nombre\":\"prueba prueba\",\"cantidad\":\"2\"},{\"nroParte\":\"080005252ds\",\"nombre\":\"Prueba\",\"cantidad\":\"22\"},{\"nroParte\":\"232323233\",\"nombre\":\"dasdasd\",\"cantidad\":\"22\"},{\"nroParte\":\"23eqad\",\"nombre\":\"dasd232\",\"cantidad\":\"22\"}]', '12-12-2025', 'wdqwqdqwd'),
(18, 2, 'Servicio', 'ASDDASD', 'ASDSADDSA', '2322', 'SADASDAS', '22222322222222222', '[{\"nroParte\":\"08000\",\"nombre\":\"prueba\",\"cantidad\":\"22\"},{\"nroParte\":\"12525prubea\",\"nombre\":\"prueba prueba\",\"cantidad\":\"2\"},{\"nroParte\":\"080005252ds\",\"nombre\":\"Prueba\",\"cantidad\":\"22\"},{\"nroParte\":\"232323233\",\"nombre\":\"dasdasd\",\"cantidad\":\"22\"},{\"nroParte\":\"23eqad\",\"nombre\":\"dasd232\",\"cantidad\":\"22\"},{\"nroParte\":\"ASDASD\",\"nombre\":\"W222\",\"cantidad\":\"222\"}]', '12-12-2025', 'ASDASDAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listados`
--

CREATE TABLE `listados` (
  `id` int(11) NOT NULL,
  `id_cotizacion` int(11) NOT NULL,
  `id_usuario_aprueba` int(11) NOT NULL,
  `ids_repuestos` text NOT NULL,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `listados`
--

INSERT INTO `listados` (`id`, `id_cotizacion`, `id_usuario_aprueba`, `ids_repuestos`, `estado`) VALUES
(6, 1, 0, '', 'Pendiente'),
(7, 1, 0, '', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos_aprobados`
--

CREATE TABLE `repuestos_aprobados` (
  `id` int(11) NOT NULL,
  `id_cotizacion` int(11) NOT NULL,
  `id_usuario_aprueba` int(11) NOT NULL,
  `nro_parte` text NOT NULL,
  `nombre_repuesto` varchar(200) NOT NULL,
  `cantidad_repuesto` int(11) NOT NULL,
  `precio_repuesto` double(30,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `cargo` varchar(200) NOT NULL,
  `departamento` varchar(200) NOT NULL,
  `rol` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `pass`, `cargo`, `departamento`, `rol`) VALUES
(2, 'Miguel', 'Ticaray', 'miguelticaray@gmail.com', '$2y$10$O4igYxv7X3a8BKpOyxFULucZCNmXhD4l9uT1i7gEaOxhqYFSMfO3O', 'Soporte Tecnico', 'Servicio', 'admin'),
(3, 'Aurelis', 'Dommar', 'aurelisdc21@gmail.com', '$2y$10$iSRsmwjoBhib6buD8iLXBe.lb.LvLqdKY7G.XEDFSwlCF8Q2KkMJW', 'Soporte Tecnico', 'Servicio', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Solicitante` (`id_users`);

--
-- Indices de la tabla `listados`
--
ALTER TABLE `listados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario que aprueba` (`id_usuario_aprueba`) USING BTREE,
  ADD KEY `cotizacion` (`id_cotizacion`) USING BTREE;

--
-- Indices de la tabla `repuestos_aprobados`
--
ALTER TABLE `repuestos_aprobados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cotizacion` (`id_cotizacion`),
  ADD KEY `usuario que aprueba` (`id_usuario_aprueba`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `listados`
--
ALTER TABLE `listados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `repuestos_aprobados`
--
ALTER TABLE `repuestos_aprobados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
