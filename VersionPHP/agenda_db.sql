-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2018 a las 16:06:19
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `fecha_inicio` varchar(10) NOT NULL,
  `hora_inicio` varchar(10) DEFAULT NULL,
  `fecha_fin` varchar(10) DEFAULT NULL,
  `hora_fin` varchar(10) DEFAULT NULL,
  `dia_completo` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `usu_id`, `titulo`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `dia_completo`) VALUES
(1, 41, 'esteeseltitulo', '08/03/2018', NULL, NULL, NULL, '1'),
(118, 41, 'asdasd', '2018-03-15', '12:00', '2018-03-18', '18:00', '0'),
(119, 41, 'asdasd', '2018-03-15', '12:00', '2018-03-18', '18:00', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(40) NOT NULL,
  `pass` varchar(70) NOT NULL,
  `id` int(11) NOT NULL,
  `fecha_nacimiento` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `pass`, `id`, `fecha_nacimiento`, `email`) VALUES
('facu', '$2y$10$tBJHeklZi587SKQ.YaZyj.Lbs7CnWwylUZPwzBzEeOijx3Hs/Hd7y', 41, '02/10/1990', 'facu@miemail.com'),
('pepe', '$2y$10$VqjLnGkcBoFMqgfwmkNB5e/gEnF6xdFTHYJbTfSkk48y6KqCyq7A2', 42, '05/12/1990', 'pepe@miemail.com'),
('jose', '$2y$10$T6BnnjhaAGP2kLcr1zzeguHp9T1DZVqTIn6.jbXcZqO9s2LR0.Toa', 43, '10/05/1990', 'jose@miemail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
