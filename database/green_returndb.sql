-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2023 a las 16:22:44
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `green_returndb`
--
CREATE DATABASE IF NOT EXISTS `green_returndb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `green_returndb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `province`
--

CREATE TABLE `province` (
  `id_province` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE `canton` (
  `id_province` int(11) NOT NULL,
  `id_canton` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `district`
--

CREATE TABLE `district` (
  `id_province` int(11) NOT NULL,
  `id_canton` int(11) NOT NULL,
  `id_district` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL,
  `identification` int(11) NOT NULL,
  `name` varchar(100),
  `surname`  varchar(100),
  `telephone` int,
  `id_province` int(11),
  `id_canton` int(11),
  `id_district` int(11),
  `address` varchar(100),
  `coin` int(11),
  `active` binary
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collection_center`
--

CREATE TABLE `collection_center` (
  `id_collection_center` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_province` int(11),
  `id_canton` int(11),
  `id_district` int(11),
  `address` varchar(100),
  `telephone` int,
  `schedule` varchar(100),
  `id_user` int(11) NOT NULL,
  `active` binary
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100),
  `image_url` varchar(100),
  `measurement_unit` varchar(10),
  `unit_cost` int,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_collection`
--

CREATE TABLE `material_collection` (
  `id_material` int(11) NOT NULL,
  `id_collection_center` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_exchange`
--

CREATE TABLE `material_exchange` (
  `id_exchange` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_collection_center` int(11) NOT NULL,
  `total` int,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exchange_detail`
--

CREATE TABLE `exchange_detail` (
  `id_exchange` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `quantity` int,
  `unit_cost` int,
  `subtotal` int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupon`
--

CREATE TABLE `coupon` (
  `id_coupon` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100),
  `image_url` varchar(100),
  `id_category` int(11) NOT NULL,
  `unit_cost` int,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coupon_exchange`
--

CREATE TABLE `coupon_exchange` (
  `id_coupon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qr_url` varchar(100),
  `unit_cost` int,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id_province`),
  ADD INDEX `idx_province`(`id_province`);
--
-- Indices de la tabla `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`id_canton`, `id_province`),
  ADD INDEX `idx_canton`(`id_canton`, `id_province`);

--
-- Indices de la tabla `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id_district`, `id_canton`, `id_province`),
  ADD INDEX `idx_district`(`id_district`, `id_canton`, `id_province`);

--
-- Indices de la tabla `collection_center`
--
ALTER TABLE `collection_center`
  ADD PRIMARY KEY (`id_collection_center`),
  ADD INDEX `idx_collection_center`(`id_collection_center`);
--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`),
  ADD INDEX `idx_material`(`id_material`);
  
--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`),
  ADD INDEX `idx_color`(`id_color`);
  
--
-- Indices de la tabla `material_collection`
--
ALTER TABLE `material_collection`
  ADD PRIMARY KEY (`id_material`,`id_collection_center`),
  ADD INDEX `idx_material_collection`(`id_material`,`id_collection_center`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD INDEX `idx_role`(`id_role`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD INDEX `idx_user`(`id_user`),
  ADD UNIQUE KEY `user_email` (`email`);
  
--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD INDEX `idx_category`(`id_category`);
  
--
-- Indices de la tabla `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id_coupon`),
  ADD INDEX `idx_coupon`(`id_coupon`);
  
--
-- Indices de la tabla `coupon_exchange`
--
ALTER TABLE `coupon_exchange`
  ADD PRIMARY KEY (`id_coupon`, `id_user`),
  ADD INDEX `idx_coupon_exchange`(`id_coupon`, `id_user`);
  
--
-- Indices de la tabla `material_exchange`
--
ALTER TABLE `material_exchange`
  ADD PRIMARY KEY (`id_exchange`),
  ADD INDEX `idx_material_exchange`(`id_exchange`);
    
--
-- Indices de la tabla `exchange_detail`
--
ALTER TABLE `exchange_detail`
  ADD PRIMARY KEY (`id_exchange`, `id_material`),
  ADD INDEX `idx_exchange_detail`(`id_exchange`, `id_material`);
 
--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `material_exchange`
--
ALTER TABLE `material_exchange`
  MODIFY `id_exchange` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `collection_center`
--
ALTER TABLE `collection_center`
  MODIFY `id_collection_center` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
  
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `coupon`
  MODIFY `id_coupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
  
--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canton`
--
ALTER TABLE `canton`
  ADD CONSTRAINT `fk_canton_province` FOREIGN KEY (`id_province`) REFERENCES `province` (`id_province`);

--
-- Filtros para la tabla `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk_district_canton` FOREIGN KEY (`id_canton`, `id_province`) REFERENCES `canton` (`id_canton`, `id_province`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE user
  add constraint `fk_user_district` foreign key (`id_district` , `id_canton` , `id_province`) references `district` (`id_district` , `id_canton` , `id_province`),
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Filtros para la tabla `collection_center`
--
ALTER TABLE `collection_center`
  add constraint `fk_cc_district` foreign key (`id_district` , `id_canton` , `id_province`) references `district` (`id_district` , `id_canton` , `id_province`),
  ADD CONSTRAINT `fk_cc_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
  
--
-- Filtros para la tabla `material_collection`
--
ALTER TABLE `material_collection`
  ADD CONSTRAINT `fk1_cc_material` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`),
  ADD CONSTRAINT `fk2_cc_material` FOREIGN KEY (`id_collection_center`) REFERENCES `collection_center` (`id_collection_center`);
  
--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_material_color` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`);
  
--
-- Filtros para la tabla `material_exchange`
--
ALTER TABLE `material_exchange`
  ADD CONSTRAINT `fk_material_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `fk_material_cc` FOREIGN KEY (`id_collection_center`) REFERENCES `collection_center` (`id_collection_center`);
  
--
-- Filtros para la tabla `exchange_detail`
--
ALTER TABLE `exchange_detail`
  ADD CONSTRAINT `fk_detail_exchange` FOREIGN KEY (`id_exchange`) REFERENCES `material_exchange` (`id_exchange`),
  ADD CONSTRAINT `fk_detail_material` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`);
  
--
-- Filtros para la tabla `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `fk_coupon_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);
  
--
-- Filtros para la tabla `exchange_detail`
--
ALTER TABLE `coupon_exchange`
  ADD CONSTRAINT `fk1_coupon_exchange` FOREIGN KEY (`id_coupon`) REFERENCES `coupon` (`id_coupon`),
  ADD CONSTRAINT `fk2_coupon_exchange` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
