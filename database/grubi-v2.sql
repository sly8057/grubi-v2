-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 04:35:37
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
-- Base de datos: `grubi-v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contra` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `correo`, `contra`, `img`) VALUES
(1, 'Jesus', 'Rostro', 'jesusrostrocontacto@gmail.com', 'HD82d@xd', ''),
(2, 'Estefania', 'Salazar', 'gamago.net@gmail.com', '8057', ''),
(5, 'dgksfd', 'skahgadfgl', 'dgfdfl@gsdsjkf.com', '15461fhjf', ''),
(6, 'dfhdhhghfghg', 'jgkhlwery57493hwe', 'correo@gmail.com', 'contraseña123', ''),
(7, 'fjhfhafh', 'djkas', 'fkfjah@fhdklf.com', '225516', ''),
(9, 'brenda', 'dfalhfal', 'cliente@gmail.com', '1352', ''),
(10, 'Rosa', 'Santana', 'rsantana@ceti.mx', '1234', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id_descuento` int(50) NOT NULL,
  `id_venta` int(50) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `porcentaje` float(10,4) NOT NULL,
  `descuento` float(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `macetas`
--

CREATE TABLE `macetas` (
  `sku` int(50) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `caracteristicas` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `unidades` int(50) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `macetas`
--

INSERT INTO `macetas` (`sku`, `categoria`, `modelo`, `caracteristicas`, `precio`, `unidades`, `imagen`) VALUES
(123, 'Deluxe', 'prueba', '10cm de ancho x 5cm de alto', 30.4, 4, ''),
(1154, 'Deluxe', 'Cyrus', '15cm de ancho x 30cm de alto', 60, 8, 'cyrus.webp'),
(43132, 'Estándar', 'Risk', '15cm de ancho x 15cm de alto', 50.4, 15, 'risk.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musica`
--

CREATE TABLE `musica` (
  `id_cancion` int(50) NOT NULL,
  `id_cliente` int(50) NOT NULL,
  `cancion` varchar(255) NOT NULL,
  `artista` varchar(255) NOT NULL,
  `plataforma` varchar(255) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(50) NOT NULL,
  `id_venta` int(50) NOT NULL,
  `titular` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `numTarjeta` varchar(255) NOT NULL,
  `total` float(10,4) NOT NULL,
  `validacion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalizado`
--

CREATE TABLE `personalizado` (
  `id_custom` int(50) NOT NULL,
  `id_planta` int(50) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `planta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id_planta` int(50) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `tipoPlanta` varchar(255) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `costo` float(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `id_owner` int(50) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contra` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`id_owner`, `nombre`, `apellido`, `correo`, `contra`, `img`) VALUES
(1, 'daniela', 'hernandez vendramini', 'herven@gmail.com', '12345', ''),
(2, 'brenda', 'carrazco angulo', 'carang@gmail.com', 'f124', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(50) NOT NULL,
  `id_descuento` int(50) NOT NULL,
  `id_cliente` int(50) NOT NULL,
  `id_custom` int(50) NOT NULL,
  `precio` float(10,4) NOT NULL,
  `total` float(10,4) NOT NULL,
  `articulo` varchar(255) NOT NULL,
  `validacion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id_descuento`);

--
-- Indices de la tabla `macetas`
--
ALTER TABLE `macetas`
  ADD PRIMARY KEY (`sku`);

--
-- Indices de la tabla `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`id_cancion`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `personalizado`
--
ALTER TABLE `personalizado`
  ADD PRIMARY KEY (`id_custom`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id_planta`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id_owner`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id_descuento` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `musica`
--
ALTER TABLE `musica`
  MODIFY `id_cancion` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personalizado`
--
ALTER TABLE `personalizado`
  MODIFY `id_custom` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id_planta` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id_owner` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
