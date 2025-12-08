-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2025 a las 13:06:51
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
  `año_carro` text NOT NULL,
  `placa_carro` text NOT NULL,
  `vin_carro` text NOT NULL,
  `data_repuestos` text NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `id_users`, `departamento`, `nombre_cliente`, `modelo_carro`, `año_carro`, `placa_carro`, `vin_carro`, `data_repuestos`, `fecha`, `estado`) VALUES
(1, 3, 'Repuestos', 'Cliente prueba', 'Hilux', '2005', 'AD052CD', '11111111111111111', '{\"repuestos\":[\r\n{\r\n\"id\": 1,\r\n\"nro_parte\":00000888882222,\r\n\"nombre\": \"repuesto prueba1\",\r\n\"cantidad\": \"2\"\r\n},\r\n{\r\n\"id\": 2,\r\n\"nro_parte\":00000888882223,\r\n\"nombre\": \"repuesto prueba2\",\r\n\"cantidad\": \"3\"\r\n},\r\n{\r\n\"id\": 3,\r\n\"nro_parte\":00000888882224,\r\n\"nombre\": \"repuesto prueba3\",\r\n\"cantidad\": \"1\"\r\n},\r\n{\r\n\"id\": 4,\r\n\"nro_parte\":00000888882225,\r\n\"nombre\": \"repuesto prueba4\",\r\n\"cantidad\": \"4\"\r\n}\r\n]\r\n}', '2025-12-01', 'aprobado'),
(2, 2, 'Repuestos', 'Cliente prueba', 'Hilux', '2025', 'AD052BN', '11111111111111111', '{\"repuestos\":[\r\n{\r\n\"id\": 1,\r\n\"nro_parte\":00000888882222,\r\n\"nombre\": \"repuesto prueba1\",\r\n\"cantidad\": \"2\"\r\n},\r\n{\r\n\"id\": 2,\r\n\"nro_parte\":00000888882223,\r\n\"nombre\": \"repuesto prueba2\",\r\n\"cantidad\": \"3\"\r\n},\r\n{\r\n\"id\": 3,\r\n\"nro_parte\":00000888882224,\r\n\"nombre\": \"repuesto prueba3\",\r\n\"cantidad\": \"1\"\r\n},\r\n{\r\n\"id\": 4,\r\n\"nro_parte\":00000888882225,\r\n\"nombre\": \"repuesto prueba4\",\r\n\"cantidad\": \"4\"\r\n}\r\n]\r\n}', '2025-10-14', 'pendiente'),
(3, 2, 'Repuestos', 'Cliente prueba', 'Hilux', '2025', 'AD052BN', '11111111111111111', '{\"repuestos\":[\r\n{\r\n\"id\": 1,\r\n\"nro_parte\":00000888882222,\r\n\"nombre\": \"repuesto prueba1\",\r\n\"cantidad\": \"2\"\r\n},\r\n{\r\n\"id\": 2,\r\n\"nro_parte\":00000888882223,\r\n\"nombre\": \"repuesto prueba2\",\r\n\"cantidad\": \"3\"\r\n},\r\n{\r\n\"id\": 3,\r\n\"nro_parte\":00000888882224,\r\n\"nombre\": \"repuesto prueba3\",\r\n\"cantidad\": \"1\"\r\n},\r\n{\r\n\"id\": 4,\r\n\"nro_parte\":00000888882225,\r\n\"nombre\": \"repuesto prueba4\",\r\n\"cantidad\": \"4\"\r\n}\r\n]\r\n}', '2025-09-16', 'rechazado');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
