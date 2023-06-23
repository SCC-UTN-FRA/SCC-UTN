-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2023 a las 15:17:20
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `idColores` int(11) NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`idColores`, `color`) VALUES
(1, 'Rojo'),
(2, 'Amarillo'),
(3, 'Azul');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFinal` datetime DEFAULT NULL,
  `fechaPedido` datetime NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1,
  `precioTotal` decimal(10,0) NOT NULL,
  `Estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `fechaInicio`, `fechaFinal`, `fechaPedido`, `habilitado`, `precioTotal`, `Estado`) VALUES
(1, NULL, NULL, '2023-06-23 00:37:12', 1, '0', 2),
(2, NULL, NULL, '2023-06-23 00:37:56', 1, '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renglones`
--

CREATE TABLE `renglones` (
  `idPedidoRenglon` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idRenglon` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `s` int(11) NOT NULL,
  `m` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `xl` int(11) NOT NULL,
  `xxl` int(11) NOT NULL,
  `genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `renglones`
--

INSERT INTO `renglones` (`idPedidoRenglon`, `idPedido`, `idRenglon`, `color`, `s`, `m`, `l`, `xl`, `xxl`, `genero`) VALUES
(1, 1, 1, 'Rojo', 123, 123, 0, 123, 0, 'Hombre'),
(2, 1, 2, 'Rojo', 123, 123, 123, 0, 0, 'Hombre'),
(3, 2, 1, 'Azul', 654, 456, 5345, 34, 345, 'No-Binario'),
(4, 2, 2, 'Amarillo', 34534, 5345, 65, 568, 5656, 'Hombre'),
(5, 2, 3, 'Rojo', 4356, 345, 345, 234, 13, 'Mujer'),
(6, 2, 4, 'Rojo', 1234, 324, 2342, 34234, 66888, 'Hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoestados`
--

CREATE TABLE `tipoestados` (
  `idEstado` int(11) NOT NULL,
  `descripcionEstado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoestados`
--

INSERT INTO `tipoestados` (`idEstado`, `descripcionEstado`) VALUES
(2, 'En proceso'),
(4, 'Finalizado'),
(1, 'No iniciado'),
(3, 'Suspendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipogenero`
--

CREATE TABLE `tipogenero` (
  `idTipoGenero` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Habilitado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipogenero`
--

INSERT INTO `tipogenero` (`idTipoGenero`, `Descripcion`, `Habilitado`) VALUES
(1, 'Hombre', 1),
(2, 'Mujer', 1),
(3, 'No-Binario', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`idColores`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `renglones`
--
ALTER TABLE `renglones`
  ADD PRIMARY KEY (`idPedidoRenglon`);

--
-- Indices de la tabla `tipoestados`
--
ALTER TABLE `tipoestados`
  ADD PRIMARY KEY (`descripcionEstado`);

--
-- Indices de la tabla `tipogenero`
--
ALTER TABLE `tipogenero`
  ADD PRIMARY KEY (`idTipoGenero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `idColores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `renglones`
--
ALTER TABLE `renglones`
  MODIFY `idPedidoRenglon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipogenero`
--
ALTER TABLE `tipogenero`
  MODIFY `idTipoGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
