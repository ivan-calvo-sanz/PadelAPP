-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2023 a las 10:27:51
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `padel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblnivel`
--

CREATE TABLE `tblnivel` (
  `id_nivel` int(11) NOT NULL,
  `nombre_nivel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblnivel`
--

INSERT INTO `tblnivel` (`id_nivel`, `nombre_nivel`) VALUES
(0, 'Sin nivel'),
(1, 'Iniciación'),
(2, 'Intermedio'),
(3, 'Intermedio Alto'),
(4, 'Avanzado'),
(5, 'Competición'),
(6, 'Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreserva`
--

CREATE TABLE `tblreserva` (
  `id_reserva` int(5) NOT NULL,
  `pista` varchar(5) NOT NULL,
  `fecha` varchar(15) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `jugador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrol`
--

CREATE TABLE `tblrol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblrol`
--

INSERT INTO `tblrol` (`id_rol`, `nombre_rol`) VALUES
(1, 'ROOT'),
(2, 'Administrador'),
(3, 'Jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

CREATE TABLE `tblusuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `edad` date NOT NULL,
  `dni` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `genero` varchar(25) DEFAULT NULL,
  `adicional` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `us_rol` int(11) NOT NULL,
  `us_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`id_usuario`, `usuario`, `nombre`, `apellidos`, `edad`, `dni`, `contrasena`, `telefono`, `direccion`, `email`, `genero`, `adicional`, `avatar`, `us_rol`, `us_nivel`) VALUES
(1, 'root', 'Iván', 'Calvo Sanz', '1965-10-03', '71224499R', '123', '618 42 58 96', 'Plaza del Sagrado Corazón  Nº1  4ºE', 'iCS@gmail.com', 'Hombre', 'Es el ROTT de la APP', '6531633828d55-avatar_10.png', 1, 3),
(2, 'admin1', 'Tania', 'Fernandez Perez', '1985-12-13', '88556677X', '123', '666 25 36 58', 'C/ Francisco Mendizabal 3 1ºB', 'tFP@hotmail.com', 'Mujer', 'es uno de los administradores de la APP', 'avatar2.png', 2, 0),
(3, 'admin2', 'Fernando', 'Garcia Martin', '2000-10-02', '11225577P', '123', '625 84 56 32', 'C/ Farnesio 5 3ºC', 'fGarciaMartin@gmail.com', 'Hombre', 'es uno de los administradores de la APP', 'avatarDefault.png', 2, 3),
(5, 'jugador2', 'Tamara', 'Fernandez Pulido', '1990-10-03', '88665522K', '123', '635 21 85 96', 'C/ Hernando 10 6ºB', 'TaniaFernandez@yahoo.com', 'Mujer', 'es uno de los jugadores más veteranos de la APP', 'avatar3.png', 3, 6),
(6, 'jugador3', 'Fernan', 'Garcia Manrique', '1995-10-05', '88665522K', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar7.png', 2, 1),
(7, 'jugador4', 'Carla', 'Perez Pulido', '1997-10-25', '11223344K', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar4.png', 2, 2),
(8, 'jugador5', 'Javier', 'Gomez Muñoz', '1998-10-05', '55667788K', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar8.png', 3, 6),
(9, 'jugador6', 'Carlos', 'Torres Navarro', '1981-10-24', '00668899L', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar9.png', 3, 4),
(10, 'jugador7', 'Javi', 'Gomez Garcia', '1999-10-20', '55667788K', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar10.png', 3, 4),
(11, 'jugador8', 'Fer', 'Garcia Gomez', '1986-10-24', '00228888L', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar11.png', 3, 4),
(12, 'jugador9', 'Fer', 'Garcia Navarro', '1984-10-05', '88335544Ñ', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar12.png', 3, 5),
(13, 'jugador10', 'Tatiana', 'Fernandez Gomez', '2002-10-04', '55667788O', '123', '000 00 00 00', '', NULL, 'Mujer', NULL, 'avatar5.png', 3, 6),
(14, 'jugador11', 'Carlota', 'Calvo Garcia', '1985-10-06', '00668844B', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar6.png', 2, 1),
(15, 'jugador12', 'Fermin', 'Garcia Martinez', '1996-10-06', '55667788X', '123', '000 00 00 00', '', NULL, 'Hombre', NULL, 'avatar13.png', 3, 2),
(29, '', 'usuario nuevo', 'nuevo de verdad', '2023-10-25', '71107485R', '', NULL, NULL, NULL, NULL, NULL, 'avatarDefault.png', 2, 5),
(30, '', 'asdas', 'asdasd', '2022-05-11', 'asdasd', '', NULL, NULL, NULL, NULL, NULL, 'avatarDefault.png', 2, 6),
(31, '', 'i', 'cs', '2023-10-18', 'asdad', '', NULL, NULL, NULL, NULL, NULL, 'avatarDefault.png', 3, 0),
(32, '', 'wasd', 'asdas', '2023-10-11', 'asd', '', NULL, NULL, NULL, NULL, NULL, 'avatarDefault.png', 2, 0),
(33, '', 'asd', 'asd', '2023-10-12', '123', '', NULL, NULL, NULL, NULL, NULL, 'avatarDefault.png', 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblnivel`
--
ALTER TABLE `tblnivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `tblReserva-tblUsuario` (`jugador`);

--
-- Indices de la tabla `tblrol`
--
ALTER TABLE `tblrol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_usuario` (`us_rol`),
  ADD KEY `nivel_usuario` (`us_nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblnivel`
--
ALTER TABLE `tblnivel`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  MODIFY `id_reserva` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblrol`
--
ALTER TABLE `tblrol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  ADD CONSTRAINT `tblReserva-tblUsuario` FOREIGN KEY (`jugador`) REFERENCES `tblusuario` (`id_usuario`);

--
-- Filtros para la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD CONSTRAINT `usuario_nivel` FOREIGN KEY (`us_nivel`) REFERENCES `tblnivel` (`id_nivel`),
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`us_rol`) REFERENCES `tblrol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
