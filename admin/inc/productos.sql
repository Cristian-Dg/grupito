-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2020 a las 18:23:35
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `introDescripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precioOferta` decimal(10,2) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `introDescripcion`, `descripcion`, `imagen`, `precio`, `precioOferta`, `online`) VALUES
(1, 'Yelmo cines', 'Oferta yelmo cines ', 'Entrada de película para yelmo cines a precio reducido', 'yelmo.jpg', '9.10', '5.95', 1),
(2, 'Ps Card', 'Tarjeta de PlayStation +20€ gratis', 'por abrir una cuenta de LiberBank, tienes una tarjeta de débito de PlayStation (mas detalles en la pagina de LiberBank)', 'psCard.jpg', '0.00', '0.00', 1),
(3, 'Telepizza', '1 o 2 pizzas medianas o familiares con 1 o 2 películas con Telepizza (hasta 62% de descuento)', 'Oferta válida para recoger en local o para entrega a domicilio; por cada pizza comprada se tendrá acceso a 1 película', 'telepizza.jpg', '15.95', '5.95', 1),
(4, 'Skicenter - España', 'oferta en clases de esquí', 'Clases de esquí o snowboard para niño o adulto en Skicenter España (hasta 47% de descuento)', 'skiCenter.jpg', '47.00', '30.00', 1),
(5, 'Arepa Olé Street - Vigo', 'Oferta en menú para 2 o 4 personas', 'Menú para 2 o 4 personas con entrante, arepa, postre y bebida en Arepa Ole Street Vigo (hasta 45% de descuento)', 'arepa.jpg', '26.00', '15.00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
