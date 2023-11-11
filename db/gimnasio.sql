-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2023 a las 23:42:04
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` text NOT NULL,
  `Pais_Origen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`ID`, `Nombre`, `Descripcion`, `Pais_Origen`) VALUES
(1, 'Generation Fit', 'Generation Fit es una empresa de nutrición joven y con actitud. Ha llegado al mercado argentino con el apoyo de los principales distribuidores del mercado. Actualmente Generation Fit se encuentra en continua evolución y día a día mejora sus productos para satisfacer las necesidades de sus seguidores.', 'Argentina'),
(2, 'Gentech', 'Gentech Argentina fabrica Suplementos Naturales Deportivos para aumentar la masa muscular, mejorar el rendimiento y perder grasa rápidamente.\r\nGentech actualmente es el auspiciante oficial de la A.F.A. y sobresale en el mundo deportivo por su relación estrecha con el mundo del Crossfit.', 'Estados Unidos'),
(3, 'Optimum Nutrition', 'Es la marca más reconocida de los Estados Unidos. Sus productos tienen varios premium internacionales y se encuentran aprobados por la FDA en USA y por el ministerio de Salud de la República Argentina', 'Estados Unidos'),
(4, 'Star Nutrition', 'Actualmente Star Nutrition (Laboratorio Nutriciencia) es la marca de Suplementos Naturales más vendida de toda la Argentina.\r\nUtilizan materias primas importadas para fabricar sus productos. La marca se encuentra muy relacionada con el deporte a nivel profesional y llevan a cabo varios eventos nacionales.', 'Argentina'),
(5, 'HTN', 'Cualquiera que sea tu objetivo, desde mejorar tu performance, ganar masa muscular, correr tu primera maratón, romperla en tu clase de Crossfit, o simplemente, mejorar tu bienestar diario, la función de HTN Nutrition es apoyarte nutricionalmente en el proceso.', 'Estados Unidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` text NOT NULL,
  `Precio` double NOT NULL,
  `Peso` double NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `ID_Marca` int(11) NOT NULL,
  `Img` text NOT NULL COMMENT 'links img'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Peso`, `Categoria`, `ID_Marca`, `Img`) VALUES
(1, 'Proteína 5 Lbs Fit Whey', 'Excelente calidad. Recuperación, rendimiento. Masa muscular. Saborizada. Se prepara con agua o leche de tipo descremada.', 19028, 2.25, 'Proteina', 1, 'https://www.demusculos.com/shop/665-medium_default/fit-whey-protein.jpg'),
(2, 'Usa Whey Protein', 'Elaborado en base proteínas extraídas del suero de la leche del más alto valor biológico, aportando aminoácidos esenciales, vitaminas y minerales.', 15600, 0.945, 'Proteina', 5, 'https://www.demusculos.com/shop/928-medium_default/proteina-usa-whey-protein-1-kg-de-htn.jpg'),
(3, 'Xplode Cell Pack', 'XPLODE CELL PACK integra en 1 solo suplemento Creatina micronizada, Carbohidratos, Aminoácidos y otros optimizadores del rendimiento como el Ginseng, que logran una mayor y más rápida absorción de los nutrientes en el cuerpo, aportando energía, resistencia y recuperación. ', 12300, 1.44, 'Creatina', 5, 'https://www.demusculos.com/shop/1214-medium_default/xplode-cell-pack-htn.jpg'),
(4, 'Whey Protein Star Nutrition', 'Previene la fatiga muscular. Conserva el tamaño del músculo. Aumenta la masa muscular. Para todo tipo de deportes.', 29890, 0.907, 'Proteina', 4, 'https://www.demusculos.com/shop/24-medium_default/proteina-premium-whey-protein-2-lbs-star-nutrition.jpg'),
(5, 'Creatina de Gentech Micronizada Monohidrato', 'Excelente calidad. Recuperación, rendimiento. Masa muscular. Saborizada. Se prepara con agua o leche de tipo descremada.', 19756, 0.5, 'Creatina', 2, 'https://www.demusculos.com/shop/769-medium_default/creatina-500-gentech.jpg'),
(6, 'Aminoácidos Amino Energy O.N.', 'Contiene: Aminoácidos Micronizados, Beta-Alanina, Cafeína del té verde, Extracto de Té Verde, Extracto de Café Verde. Sin grasas ni azúcar.', 33263, 0.27, 'Aminoacidos', 3, 'https://www.demusculos.com/shop/2588-medium_default/amino-energy-on-30-tomas.jpg'),
(7, 'Usa Amino Pack de HTN', 'Ideal para hombres y mujeres. Aminoácidos naturales. Nutrientes para tu masa muscular. Ideal para todo tipo de deportes', 6473, 1.3, 'Aminoacidos', 5, 'https://www.demusculos.com/shop/1093-medium_default/usa-amino-pack-htn.jpg'),
(8, 'Amino 7600', 'Valor Energetico 61.2 kcal. Carbohidratos 4.3 g. Proteinas 11 g. Grasas Totales 0 g. Sodio 15 mg', 4549, 1.5, 'Aminoacidos', 2, 'https://www.demusculos.com/shop/1023-medium_default/amino-7600-gentech.jpg'),
(9, 'Creatina Powder Optimum Nutrition', 'Es un producto importado con un 100% de monohidrato de creatina en polvo. Ideal para el entrenamiento de fuerza al intensificar la contracción muscular. Aumenta el volumen muscular', 16472, 0.3, 'Creatina', 3, 'https://www.demusculos.com/shop/1566-medium_default/creatina-powder-300-optimum-nutrition.jpg'),
(10, 'Proteína 100% Whey Gold de Optimum Nutrition', '100% Whey Gold Standard es la proteína más vendida en el mundo. Fomenta la recuperación y el desarrollo de la masa muscular. Contiene 24 gr de proteína por servicio de la más alta calidad para ayudar al desarrollo muscular, tan sólo 1 gr de grasa y 3 gr de carbohidratos.', 39200, 0.907, 'Proteina', 3, 'https://www.demusculos.com/shop/1576-medium_default/whey-gold-2-lbs-optimum.jpg'),
(11, 'Proteína de Soja Con Carnitina', 'USA SOY Protein HTN es una importante fuente de proteínas vegetales, totalmente natural, elaborado con 100% Isolated Protein SUPRO SOY, importado directamente desde USA. Fortificado con Vit. B12 y Hiero', 13796, 1, 'Proteina', 5, 'https://www.demusculos.com/shop/971-medium_default/soy-protein-1-kg-htn.jpg'),
(12, 'Veggie Protein Shake', 'La Veggie Protein shake es una proteína vegetal pura a base de arveja. Es una excelente opción para completar el aporte necesario de proteínas diarias, con la suma de muchas vitaminas entre ellas vitamina D y vitamina B12.', 7501, 0.5, 'Proteina', 2, 'https://www.demusculos.com/shop/2656-medium_default/veggie-protein-shake.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `email`, `password`) VALUES
(1, 'Block@gmail.com', 'monki');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Productos_Marca` (`ID_Marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Productos_Marca` FOREIGN KEY (`ID_Marca`) REFERENCES `marcas` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
