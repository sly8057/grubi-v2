-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 15:27:56
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
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `idBitacora` int(11) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `executedSQL` varchar(2000) DEFAULT NULL,
  `reverseSQL` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`idBitacora`, `accion`, `user`, `fecha`, `executedSQL`, `reverseSQL`) VALUES
(1, 'update', 'root@localhost', '2024-06-19 11:27:17', 'INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (159, \"Estandar\", \"fgakj\", \"hsdfgkjdg\", 15, 213, \"risk.png\");', 'INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (159, \"Estandar\", \"fgakj\", \"hsdfgkjdg\", 560, 213, \"risk.png\");'),
(2, 'delete', 'root@localhost', '2024-06-19 16:38:11', 'DELETE FROM macetas WHERE sku = 159;', 'INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (159, \"Estandar\", \"fgakj\", \"hsdfgkjdg\", 15, 213, \"risk.png\");');

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
(1, 'Jesus', 'Rostro', 'jesusrostrocontacto@gmail.com', 'HD82d@xd', 'noelle.webp'),
(2, 'Estefania', 'Salazar', 'gamago.net@gmail.com', '8057', ''),
(5, 'dgksfd', 'skahgadfgl', 'dgfdfl@gsdsjkf.com', '15461fhjf', ''),
(6, 'dfhdhhghfghg', 'jgkhlwery57493hwe', 'correo@gmail.com', 'contraseña123', ''),
(7, 'fjhfhafh', 'djkas', 'fkfjah@fhdklf.com', '225516', ''),
(9, 'brenda', 'dfalhfal', 'cliente@gmail.com', '1352', ''),
(10, 'Rosa', 'Santana', 'rsantana@ceti.mx', '1234', ''),
(11, 'diego', 'muñoz', 'diego@hotmail.com', '555', '');

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
(123, 'Deluxe', 'prueba', '10cm de ancho x 5cm de alto', 30.4, 4, 'noelle.webp'),
(1154, 'Deluxe', 'Cyrus', '15cm de ancho x 30cm de alto', 60, 8, 'cyrus.webp'),
(43132, 'Estándar', 'Risk', '15cm de ancho x 15cm de alto', 50.4, 15, 'risk.png');

--
-- Disparadores `macetas`
--
DELIMITER $$
CREATE TRIGGER `after_delete_macetas` AFTER DELETE ON `macetas` FOR EACH ROW BEGIN
				insert into bitacora ( fecha, accion, user, executedSQL, reverseSQL )
				values(
					now(),
					"delete",
					CURRENT_USER(),
					CONCAT("DELETE FROM macetas WHERE sku = ",OLD.sku,";"),
					CONCAT("INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (",OLD.sku,", """,OLD.categoria,""", """,OLD.modelo,""", """,OLD.caracteristicas,""", ",OLD.precio,", ",OLD.unidades,", """,OLD.imagen,""");")
				);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_macetas` AFTER INSERT ON `macetas` FOR EACH ROW BEGIN
				insert into `bitacora` ( fecha, accion, user, executedSQL, reverseSQL )
				values(
					now(),
					"insert",
					CURRENT_USER(),
					CONCAT("INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (",NEW.sku,", """,NEW.categoria,""", """,NEW.modelo,""", """,NEW.caracteristicas,""", ",NEW.precio,", ",NEW.unidades,", """,NEW.imagen,""");"),
					CONCAT("DELETE FROM macetas WHERE sku = ",NEW.sku,";")
				);
			END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_macetas` AFTER UPDATE ON `macetas` FOR EACH ROW BEGIN
				insert into bitacora ( fecha, accion, user, executedSQL, reverseSQL )
				values(
					now(),
					"update",
					CURRENT_USER(),
					CONCAT("INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (",NEW.sku,", """,NEW.categoria,""", """,NEW.modelo,""", """,NEW.caracteristicas,""", ",NEW.precio,", ",NEW.unidades,", """,NEW.imagen,""");"),
					CONCAT("INSERT INTO macetas (sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES (",OLD.sku,", """,OLD.categoria,""", """,OLD.modelo,""", """,OLD.caracteristicas,""", ",OLD.precio,", ",OLD.unidades,", """,OLD.imagen,""");")
				);
			END
$$
DELIMITER ;

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`idBitacora`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `macetas`
--
ALTER TABLE `macetas`
  ADD PRIMARY KEY (`sku`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id_owner`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id_owner` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
