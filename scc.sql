-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2023 a las 23:07:18
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
-- Estructura de tabla para la tabla `curvadetalles`
--

CREATE TABLE `curvadetalles` (
  `id_talles` int(11) NOT NULL,
  `talles` varchar(10) NOT NULL,
  `medida_hombro` decimal(10,0) NOT NULL,
  `medida_pecho` decimal(10,0) NOT NULL,
  `medida_cintura` decimal(10,0) NOT NULL,
  `medida_espalda` decimal(10,0) NOT NULL,
  `medida_manga` decimal(10,0) NOT NULL,
  `medida_cuello` decimal(10,0) NOT NULL,
  `tipo_medida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaSuspendido` datetime DEFAULT NULL,
  `fechaFinal` datetime DEFAULT NULL,
  `fechaPedido` datetime NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT 1,
  `precioTotal` decimal(10,0) NOT NULL,
  `Estado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Mujer', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_medida`
--

CREATE TABLE `tipo_medida` (
  `id_tipomedida` int(11) NOT NULL,
  `medida` varchar(5) NOT NULL,
  `descripcion_medida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_medida`
--

INSERT INTO `tipo_medida` (`medida`,`descripcion_medida`) VALUES
('300','metros'),
('300','cm'),
('300','gramos'),
('300','tonelada'),
('300','metros'),
('300','kilometros'),
('300','litros');
--
-- Estructura de tabla para la tabla `tipo_stock`
--

CREATE TABLE `tipo_stock` (
  `id_tipo_stock` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  `Habilitado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_stock`
--

INSERT INTO `tipo_stock` (`Descripcion`) VALUES
('tela'),
('hilo'),
('botones'),
('pintura');

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `idStocks` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_tipo_stock` int(11) NOT NULL,
  `id_tipomedida` int(11) NOT NULL,
  `Habilitado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stocks`
--

INSERT INTO `stocks` (`Descripcion`) VALUES
('','tela'),
('hilo'),
('botones'),
('pintura');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`idColores`);

--
-- Indices de la tabla `curvadetalles`
--
ALTER TABLE `curvadetalles`
  ADD PRIMARY KEY (`id_talles`);

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
-- Indices de la tabla `tipo_medida`
--
ALTER TABLE `tipo_medida`
  ADD PRIMARY KEY (`id_tipomedida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `idColores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `curvadetalles`
--
ALTER TABLE `curvadetalles`
  MODIFY `id_talles` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `renglones`
--
ALTER TABLE `renglones`
  MODIFY `idPedidoRenglon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipogenero`
--
ALTER TABLE `tipogenero`
  MODIFY `idTipoGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_medida`
--
ALTER TABLE `tipo_medida`
  MODIFY `id_tipomedida` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
