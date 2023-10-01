-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2023 a las 09:24:13
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
-- Estructura de tabla para la tabla `tblpartido`
--

CREATE TABLE `tblpartido` (
  `id_partido` int(11) NOT NULL,
  `pista` varchar(5) NOT NULL,
  `fecha` varchar(15) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `jugador1` int(11) NOT NULL,
  `jugador2` int(11) NOT NULL,
  `jugador3` int(11) NOT NULL,
  `jugador4` int(11) NOT NULL
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
  `edad` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `us_rol` int(11) NOT NULL,
  `us_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`id_usuario`, `usuario`, `nombre`, `apellidos`, `edad`, `dni`, `contrasena`, `us_rol`, `us_nivel`) VALUES
(1, 'root', 'Ivan', 'Calvo Sanz', '20', '71224499R', '123r', 1, 0),
(2, 'admin1', 'Tania', 'Fernandez Perez', '28', '88556677X', '123a', 2, 5),
(3, 'admin2', 'Fernando', 'Garcia Martin', '26', '11225577P', '123a', 2, 6),
(4, 'jugador1', 'Ivan', 'Calvo Sanz', '20', '71224499R', '123j', 3, 4),
(5, 'jugador2', 'Tania', 'Fernandez Pulido', '22', '88665522K', '123j', 3, 1),
(6, 'jugador3', 'Fernando', 'Garcia Manrique', '24', '88665522K', '123j', 3, 1),
(7, 'jugador4', 'Ivan', 'Perez Pulido', '35', '11223344K', '123j', 3, 2),
(8, 'jugador5', 'Javier', 'Gomez Muñoz', '38', '55667788K', '123j', 3, 2),
(9, 'jugador6', 'Carlos', 'Torres Navarro', '40', '00668899L', '123j', 3, 4),
(10, 'jugador7', 'Javier', 'Gomez Garcia', '44', '55667788K', '123j', 3, 4),
(11, 'jugador8', 'Fernando', 'Garcia Gomez', '31', '00228888L', '123j', 3, 4),
(12, 'jugador9', 'Fernando', 'Garcia Navarro', '31', '88335544Ñ', '123j', 3, 5),
(13, 'jugador10', 'Tania', 'Fernandez Gomez', '28', '55667788O', '123j', 3, 5),
(14, 'jugador11', 'Ivan', 'Calvo Garcia', '26', '00668844B', '123j', 3, 6),
(15, 'jugador12', 'Fernando', 'Garcia Martinez', '28', '55667788X', '123j', 3, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblnivel`
--
ALTER TABLE `tblnivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Indices de la tabla `tblpartido`
--
ALTER TABLE `tblpartido`
  ADD PRIMARY KEY (`id_partido`),
  ADD KEY `key_jugador1` (`jugador1`),
  ADD KEY `key_jugador2` (`jugador2`),
  ADD KEY `key_jugador3` (`jugador3`),
  ADD KEY `key_jugador4` (`jugador4`);

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
-- AUTO_INCREMENT de la tabla `tblpartido`
--
ALTER TABLE `tblpartido`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblrol`
--
ALTER TABLE `tblrol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblpartido`
--
ALTER TABLE `tblpartido`
  ADD CONSTRAINT `tblPartido_tblUsuario_1` FOREIGN KEY (`jugador1`) REFERENCES `tblusuario` (`id_usuario`),
  ADD CONSTRAINT `tblPartido_tblUsuario_2` FOREIGN KEY (`jugador2`) REFERENCES `tblusuario` (`id_usuario`),
  ADD CONSTRAINT `tblPartido_tblUsuario_3` FOREIGN KEY (`jugador3`) REFERENCES `tblusuario` (`id_usuario`),
  ADD CONSTRAINT `tblPartido_tblUsuario_4` FOREIGN KEY (`jugador4`) REFERENCES `tblusuario` (`id_usuario`);

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
