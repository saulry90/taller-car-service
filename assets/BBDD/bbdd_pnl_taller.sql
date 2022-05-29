-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2022 a las 18:46:02
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bbdd_pnl_taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `codigo` int(7) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `cp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`codigo`, `mail`, `contrasena`, `nombre`, `apellidos`, `telefono`, `cp`) VALUES
(1, 'javi@gmail.com', '222', 'Javi', 'Gómez', '676222111', '28221'),
(2, 'andre@gmail.com', '222', 'Andrea', 'Sánchez', '682999125', '28003'),
(3, 'alber@msn.com', '222', 'Alberto', 'De la Cruz', '635444567', '28564');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`tipo`) VALUES
('Aceite y filtros'),
('Frenos'),
('Motor'),
('Numáticos'),
('Suspensión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitar`
--

CREATE TABLE `solicitar` (
  `tipo` varchar(40) DEFAULT NULL,
  `codigo` int(7) DEFAULT NULL,
  `user` varchar(15) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitar`
--

INSERT INTO `solicitar` (`tipo`, `codigo`, `user`, `fecha`) VALUES
('Suspensión', 1, 'Mecánico', '2022-05-05'),
('Frenos', 1, 'Mecánico', '2022-05-05'),
('Motor', 3, 'Mecánico', '2022-05-07'),
('Numáticos', 2, 'Mecánico', '2022-06-01'),
('Frenos', 3, 'Mecánico', '2022-06-29'),
('Aceite y filtros', 3, 'Gerente', '2022-05-25'),
('Frenos', 3, 'Gerente', '2022-07-28'),
('Aceite y filtros', 3, 'Gerente', '2022-09-30'),
('Motor', 3, 'Gerente', '2022-09-30'),
('Aceite y filtros', 3, 'Gerente', '2022-09-30'),
('Motor', 3, 'Gerente', '2022-09-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `worker`
--

CREATE TABLE `worker` (
  `user` varchar(15) NOT NULL,
  `passw` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `worker`
--

INSERT INTO `worker` (`user`, `passw`) VALUES
('Gerente', '1111'),
('Mecánico', '1111');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`tipo`);

--
-- Indices de la tabla `solicitar`
--
ALTER TABLE `solicitar`
  ADD KEY `tipo` (`tipo`),
  ADD KEY `codigo` (`codigo`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `codigo` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitar`
--
ALTER TABLE `solicitar`
  ADD CONSTRAINT `solicitar_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `servicio` (`tipo`),
  ADD CONSTRAINT `solicitar_ibfk_2` FOREIGN KEY (`codigo`) REFERENCES `client` (`codigo`),
  ADD CONSTRAINT `solicitar_ibfk_3` FOREIGN KEY (`user`) REFERENCES `worker` (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
