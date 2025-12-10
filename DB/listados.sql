-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2025 a las 22:00:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
-- Estructura de tabla para la tabla `listados`
--

CREATE TABLE `listados` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `departamento` varchar(200) NOT NULL,
  `nombre_cliente` varchar(200) NOT NULL,
  `modelo_carro` varchar(200) NOT NULL,
  `ano_carro` text NOT NULL,
  `placa_carro` text NOT NULL,
  `vin_carro` text NOT NULL,
  `data_repuestos` text NOT NULL,
  `notas` text NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `listados`
--
ALTER TABLE `listados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `listados`
--
ALTER TABLE `listados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `listados`
--
ALTER TABLE `listados`
  ADD CONSTRAINT `listados_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `listados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
