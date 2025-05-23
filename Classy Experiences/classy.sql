-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-05-2025 a las 07:01:31
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
-- Base de datos: `classy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `cargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `cargo`) VALUES
(57, 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductor`
--

CREATE TABLE `conductor` (
  `id` int(11) NOT NULL,
  `licencia` varchar(50) DEFAULT NULL,
  `vehiculo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `conductor`
--

INSERT INTO `conductor` (`id`, `licencia`, `vehiculo`) VALUES
(59, 'B2', 'Bus MQU 650');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `id_servicio`, `nombre_cliente`, `fecha`, `cantidad`, `total`) VALUES
(1, 0, 'Maverick', '2025-05-22 22:01:47', 1, 250000.00),
(2, 0, 'John Doe', '2025-05-22 22:03:09', 1, 250000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_turistico`
--

CREATE TABLE `guia_turistico` (
  `id` int(11) NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `idiomas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guia_turistico`
--

INSERT INTO `guia_turistico` (`id`, `especialidad`, `idiomas`) VALUES
(60, 'Logistica', 'Ingeles, español, frances');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas_usuarios`
--

CREATE TABLE `resenas_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `comentario` text NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resenas_usuarios`
--

INSERT INTO `resenas_usuarios` (`id`, `nombre`, `comentario`, `puntuacion`, `fecha`) VALUES
(9, 'hola diaz', 'malllllllllllll', 1, '2025-05-22'),
(10, 'Mile', 'sdasd', 5, '2025-05-23'),
(11, 'Mile', 'sdasd', 5, '2025-05-23'),
(12, 'Mile', 'sdasd', 5, '2025-05-23'),
(13, 'Mile', 'sdasd', 5, '2025-05-23'),
(14, 'Mile', 'sdasd', 5, '2025-05-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` int(11) NOT NULL,
  `nombre_ruta` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `conductor_id` int(11) DEFAULT NULL,
  `guia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `nombre_ruta`, `descripcion`, `fecha`, `conductor_id`, `guia_id`) VALUES
(2, 'Recogida hoteles DYK', 'Recogida en hoteles de bocagrande, castillo grande, laguito./  zona norte, crespo, marbella, boquilla. (hasta sonesta). Centro: Punto de encuentro parque  centenario', '2025-05-24', 59, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'user',
  `fecha_registro` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `user_type`, `fecha_registro`) VALUES
(38, 'Maverick Diaz', 'maverickdiazserna@gmail.com', '$2y$10$Wl2sKPsFwvbr9PWJz5E3lOIv/61BA5QZdQuc3Gozj5e', 'user', '2025-05-21'),
(40, 'cachonContento', 'cachon@gmail.com', '$2y$10$OdpnWkovbhNvI.ci80Uhs.plxON037WueNuQ4Ib3EU8JsrkB4Y3Xy', 'admin', '2025-05-21'),
(41, 'hola', 'adminzazadprod@gmail.com', '$2y$10$lszCT5A4C.OLrlRqpjYabu8QiCfRun5.H5IPCC3rrdq', 'user', '2025-05-21'),
(42, 'Maverick Cachon', 'alegre@gmail.com', '$2y$10$9C0rGLmbGyTJyJgih1UfLun1wzNMclROm7The7R6VAkkZIH3HfWHu', 'user', '2025-05-21'),
(43, 'Admin Rafa', 'adminrafa@gmail.com', '$2y$10$wlQhBxr/ikzIToHKsZRn1evNzMdjo/sMCzEdMK.0h9n', 'admin', '2025-05-21'),
(47, 'Mile', 'agamezmileidys@gmail.com', '$2y$10$dwAt5gVDfLTra0b7UuRphOr98f6y6wXleKtJ1aZRucoDsR.HxIbEO', 'admin', '2025-05-21'),
(48, 'prueba', 'cachones@gmail.com', '$2y$10$W7lb3.EZHRAgUH2K4Gcr6epMy3nusFkoo2KtbSsitW2N.3H9ZvHMi', 'user', '2025-05-21'),
(49, 'Maricones2.0', 'maricones@gmail.com', '$2y$10$62CLHZ46pVyhg/UBSmF/8ehYD82dFrsp3UeZaaWyLxfRdIvMkdOWq', 'user', '2025-05-21'),
(50, 'Sapo', 'santiago@gmail.com', '$2y$10$9rhU3uc2kbz2LCiwkrYo8.fJHX6VwUzm8av6mbvTsFQB9QlWj6U/i', 'admin', '2025-05-21'),
(51, 'sapa', 'mariangel@gmail.com', '$2y$10$UrOYCycD9Dcm/n6hawKrbewSV3T8KdnUZr5loJ4I1JTG7L8KKmiUO', 'admin', '2025-05-21'),
(52, 'prueba222', 'agamezmileidys1@gmail.com', '$2y$10$aIfavK/KNH9EbmnU6BbTu.U.xHZGTD1tzd6dzWU9iVrjN5pU8kTYu', 'user', '2025-05-21'),
(53, 'maldito', '123@gmail.com', '$2y$10$j4RcrAABaOWf22f969gn/e6SG/QjrO3ZilxFqhYk6x1ziQvOdfdD.', 'admin', '2025-05-21'),
(54, 'Maverick Diaz', 'maved18@gmail.com', '$2y$10$5I7IDjMnwlksZkR4i97u0eFkDyjzypDTajJfWs.3XoyBwJ0va5x5e', 'admin', '2025-05-21'),
(55, 'hola diaz', 'holadiaz@gmail.com', '$2y$10$EqTiXtiYWD..M9j/nHzFVeiLZg213AwVAcVoJyPYXYofNARCz3d.S', 'user', '2025-05-21'),
(56, 'Dylan', 'dy@gmail.com', '$2y$10$gllbZSiCtQYEvD5PKXPRXugmaJC8yoSc83RuivCXcyyLlxAE6xiSW', 'user', '2025-05-21'),
(57, 'Rafa', 'r@gmail.com', '$2y$10$KFDRJD38Y2yWNse0K7OJ8uyDKd6z8YQ/GGPY.pQtK95h5IcVYjTKq', 'admin', '2025-05-22'),
(58, 'rafauser', 'popo@popo.com', '$2y$10$SDfjZms7iPtnLKRdiBJuiO5PhEFmqOYhltBW82.BqXBPVyXnyKE3K', 'user', '2025-05-22'),
(59, 'Augusto Mallarino', 'arma@gmail.com', '$2y$10$7wV47SeNTJPt5q1s1b5.w.HZYeufUvVMQ7wx1Rerx5bxC4RYY2pqm', 'conductor', '2025-05-22'),
(60, 'Maverick Diaz', 'mds@gmail.com', '$2y$10$Ev/liUJ8PKVMwYZshX8EbemM99Jq52mknNkMpHt9qz9ZiSeUQrLme', 'guia_turistico', '2025-05-22');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guia_turistico`
--
ALTER TABLE `guia_turistico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resenas_usuarios`
--
ALTER TABLE `resenas_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conductor_id` (`conductor_id`),
  ADD KEY `guia_id` (`guia_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `resenas_usuarios`
--
ALTER TABLE `resenas_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `guia_turistico`
--
ALTER TABLE `guia_turistico`
  ADD CONSTRAINT `guia_turistico_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `rutas_ibfk_1` FOREIGN KEY (`conductor_id`) REFERENCES `conductor` (`id`),
  ADD CONSTRAINT `rutas_ibfk_2` FOREIGN KEY (`guia_id`) REFERENCES `guia_turistico` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
