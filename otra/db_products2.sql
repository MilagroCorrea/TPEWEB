-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2020 a las 21:05:12
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_products`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name_caegory` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `name_caegory`) VALUES
(1, 'anime'),
(2, 'comic'),
(4, 'gamer'),
(5, 'peliculas'),
(6, 'insumos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id_comment`, `comment`, `puntuacion`, `id_user`, `id_product`) VALUES
(29, '4444', 5, 3, 6),
(30, 'papa', 5, 3, 6),
(31, 'pepe', 5, 13, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `stock` tinyint(1) NOT NULL DEFAULT 0,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `image`, `name`, `description`, `price`, `stock`, `id_category`) VALUES
(2, 'pikachu.jpg', 'pikachu', 'figura de pikachu', 1000, 1, 1),
(3, '', 'hulk', 'figura de hulk', 2000, 10, 2),
(5, '', 'alien', 'bakbalabl', 50000, 1, 2),
(6, '', 'wolverine', 'Figura de wolverine', 2530, 8, 5),
(7, '', 'amongus', 'Figura articulada de tripulante', 6000, 80, 4),
(8, '', 'ursa', 'figura fija de ursa (dota2)', 2800, 3, 4),
(9, '', 'batman', 'Figura de Batman con cabezas intercambiables', 4200, 11, 2),
(10, '', 'Filamento PLA', 'Rollo de 1k filamento PLA 1.75mm', 1000, 120, 6),
(11, '', 'Shaka', 'Figura Diorama de Shaka CDZ', 8000, 2, 1),
(13, '', 'Martillo Thor', 'Altura aproximada 40 cm', 2500, 5, 2),
(14, '', 'sfsd', 'assdsd', 120, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `admin`) VALUES
(1, 'juan@juan.com', '$2y$12$eA2jdmNIywD5NdK5q.BmnOkdf.AJnfYO.dNbmAzF8kRuePzquWytG', 0),
(2, 'admin@admin.com', '$2y$12$6IFOB7L3DBRj31NDoSriweeh7HKJrvWxvdTlWg2WmgQz14IZUOnJe', 1),
(3, 'a@a.com', '$2y$12$xiUED0zuHiGFS2DwUWc.qu3Uvw4KfYitOdBMmQEBfb/cvI8m2xGNK', 0),
(5, 'pepe@user.com', '$2y$10$rjZQetVOtk4pR0gMxbgED..a/b2mMSZhkv.jXpBaclLCyS0blptpi', 0),
(7, 'hola@yo.com', '$2y$10$Wdu2aWmirJP514VHupGWbOQJDuD0dl8NMArn07xB5oAEHWAijfDCu', 0),
(13, 'qqqq@d.com', '$2y$10$kvYtxwQHPVz1VrzKUH4VgelGVdqTpnEpY26nb4ZaTr4pvoSL5xeRm', 0),
(19, 'a@a.com', '$2y$10$h47PWh9xeSifOvtQM.CoeO8ii/WYrZgFUH.HClMJSNTXJ6dgTg8nW', 0),
(22, 'sss@p.com', '$2y$10$4pPPK2nUwHLPOju1a4QY2.eF.xqtGBTD9QeXVEiie4/vw3KDP0RmG', 0),
(24, 'sss@p.com', '$2y$10$sgMoftr7dsWvpX2UQ25KheT4Nib3sJifTTB23jdT5Jb9gdwYQGH.m', 0),
(26, 'mili@admin.com', '$2y$10$2YThmLjBDPjhCVy1Mh/yxu1mYvu01YVKRQ/HBDC4E6aCxkMeQ8kT.', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_comment` (`id_comment`),
  ADD KEY `id_comment_2` (`id_comment`),
  ADD KEY `FK_id_product` (`id_product`),
  ADD KEY `FK_id_user` (`id_user`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `FK_id_category` (`id_category`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_id_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
