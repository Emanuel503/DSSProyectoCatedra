-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2022 a las 16:22:29
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_libro`
--

CREATE TABLE `estado_libro` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_libro`
--

INSERT INTO `estado_libro` (`id`, `estado`, `descripcion`) VALUES
(1, 'Bueno', 'El libro se encuentra en buen estado, sin ninguna imperfección '),
(2, 'Malo', 'El libro se encuentra en la estado, esta deteriorado y no se prestara');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_prestamo`
--

CREATE TABLE `estado_prestamo` (
  `id` int(11) NOT NULL,
  `prestamo` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_prestamo`
--

INSERT INTO `estado_prestamo` (`id`, `prestamo`, `descripcion`) VALUES
(1, 'Vigente', 'El préstamo esta vigente'),
(2, 'Renovado', 'El préstamo fue renovado un día'),
(3, 'Vencido', 'El préstamo se encuentra vencido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuario`
--

CREATE TABLE `estado_usuario` (
  `id` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_usuario`
--

INSERT INTO `estado_usuario` (`id`, `estado`, `descripcion`) VALUES
(1, 'Activo', 'Usuario activo dentro del sistema'),
(2, 'Sancionado', 'Usuario sancionado por no pagar la multa '),
(3, 'Bloqueado', 'El usuario esta bloqueado dentro del sistema, por el administador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `editorial` varchar(50) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `ejemplares` int(11) NOT NULL,
  `ejemplares_prestados` int(11) NOT NULL,
  `edicion` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `isbn`, `titulo`, `autor`, `editorial`, `id_estado`, `ejemplares`, `ejemplares_prestados`, `edicion`, `imagen`, `fecha_registro`) VALUES
(1, '978-60-776-8615-6', 'Diseño web con CSS', 'Ralph G. Schulz', 'Katana', 1, 20, 0, '4', 'portada.png', '12-03-2003'),
(14, '2344-3443', 'Juego de tronos', 'Miguel', 'Maquinta', 1, 10, 0, '1', 'juego de tronos.jpg', '2022-03-28'),
(15, '12343-1231', 'Harry Potter', 'JK', 'San Jose', 2, 2, 0, '4', 'harry-potter.jpg', '2022-03-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_prestados`
--

CREATE TABLE `libros_prestados` (
  `id` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_prestamo` varchar(30) NOT NULL,
  `fecha_devolucion` varchar(30) NOT NULL,
  `multa` double NOT NULL,
  `id_estado` int(11) NOT NULL,
  `renovar` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `id` int(11) NOT NULL,
  `multa` varchar(30) NOT NULL,
  `costo` double NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `dias_maximos_multa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `multas`
--

INSERT INTO `multas` (`id`, `multa`, `costo`, `descripcion`, `dias_maximos_multa`) VALUES
(1, 'Daños al libro', 20, 'Multa por daños hechos al libro', 0),
(2, 'Dias de retraso', 30, 'Multa por no devolver un libro en la fecha estipulada', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `cantidad_libros` int(11) NOT NULL,
  `dias_maximos_prestamo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `descripcion`, `cantidad_libros`, `dias_maximos_prestamo`) VALUES
(1, 'Administrador', 'Administrador del sistema (bibliotecarios)', 0, 0),
(2, 'Profesor', 'Profesor de la institución', 5, 20),
(3, 'Estudiante', 'Estudiante de la institución', 4, 20),
(4, 'Invitado', 'Invitado de la institución', 2, 20),
(5, 'Empleados', 'Empleados de la institución', 5, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `identificacion` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_rol`, `id_estado`, `email`, `password`, `nombre`, `identificacion`, `telefono`, `direccion`, `fecha_registro`) VALUES
(1, 1, 1, 'emanueljosemolina@gmail.com', 'admin', 'Emanuel José Molina Zúniga', '4534565', '75193453', 'San Salvador', '2022-04-01'),
(2, 3, 2, 'jose@gmail.com', 'jose', 'Jose Manuel Gonzales Jurado', '335435432', '23454334', 'Soyapango', '2022-04-25'),
(3, 5, 1, 'luis.castillo@gmail.com', 'luis', 'Luis Moisés Castillo Arriola', '7678567656', '45676567', 'San Miguel', '2022-04-26'),
(4, 4, 1, 'kevin.larios@gmail.com', 'kevin', 'Kevin Emanuel Larios valladares', '005645563', '76584576', 'Santa Lucia', '2022-04-26'),
(5, 2, 3, 'manuel.zepeda@gmail.com', 'manuel', 'Manuel Omar Zepeda Machuca', '767444567', '61834568', 'Santa Tecla', '2022-04-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado_libro`
--
ALTER TABLE `estado_libro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_prestamo`
--
ALTER TABLE `estado_prestamo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `libros_prestados`
--
ALTER TABLE `libros_prestados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_libro` (`id_libro`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado_libro`
--
ALTER TABLE `estado_libro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_prestamo`
--
ALTER TABLE `estado_prestamo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `libros_prestados`
--
ALTER TABLE `libros_prestados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_libro` (`id`);

--
-- Filtros para la tabla `libros_prestados`
--
ALTER TABLE `libros_prestados`
  ADD CONSTRAINT `libros_prestados_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id`),
  ADD CONSTRAINT `libros_prestados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `libros_prestados_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado_prestamo` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
