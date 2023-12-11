-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 03:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `green_returndb`
--
CREATE DATABASE IF NOT EXISTS `green_returndb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `green_returndb`;

-- --------------------------------------------------------

--
-- Table structure for table `canton`
--

CREATE TABLE `canton` (
  `id_province` int(11) NOT NULL,
  `id_canton` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `canton`
--

INSERT INTO `canton` (`id_province`, `id_canton`, `name`) VALUES
(1, 1, 'San Jose'),
(2, 2, 'Alajuela'),
(3, 3, 'Cartago');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name`) VALUES
(1, 'Entertainment'),
(2, 'Healthy Dining'),
(3, 'Eco-Friendly Products'),
(4, 'aaa'),
(5, 'Educational Experiences'),
(6, 'Outdoor Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `collection_center`
--

CREATE TABLE `collection_center` (
  `id_collection_center` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_province` int(11) DEFAULT NULL,
  `id_canton` int(11) DEFAULT NULL,
  `id_district` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `schedule` varchar(100) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `active` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collection_center`
--

INSERT INTO `collection_center` (`id_collection_center`, `name`, `id_province`, `id_canton`, `id_district`, `address`, `telephone`, `schedule`, `id_user`, `active`) VALUES
(1, 'EcoHub Collection Center', 1, 1, 1, 'Green Street', 24501968, 'Monday to Friday: 8:00 AM - 6:00 PM Saturday: 9:00 AM - 4:00 PM', 2, 0x31),
(2, 'Green Recycling Depot', 2, 2, 2, 'Eco Road', 45637896, 'Monday to Saturday: 7:30 AM - 5:00 PM', 3, 0x31),
(3, 'RenewCycle Collection Point', 3, 3, 3, 'Sustainable Drive', 86547832, 'Monday to Friday: 8:30 AM - 5:30 PM', 4, 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id_color`, `name`, `value`) VALUES
(1, 'Paper', '#F5EFE3'),
(2, 'Cardboard', '#E1C19E'),
(3, 'Iron', '#5e5e5e'),
(4, 'White', '#FFFFFF'),
(5, 'Red', '#FF0000'),
(6, 'Green', '#00FF00'),
(7, 'Blue', '#0000FF'),
(8, 'Yellow', '#FFFF00'),
(9, 'Orange', '#FFA500'),
(10, 'Pink', '#FFC0CB'),
(11, 'Brown', '#A52A2A'),
(12, 'Gold', '#FFD700'),
(13, 'Aluminium', '#888B8D'),
(14, 'Bronze', '#967444'),
(15, 'Copper', '#B87333'),
(16, 'Sheet metal', '#A3796F'),
(17, 'Carbide', '#336688'),
(18, 'Stainless steel', '#C0C8D2');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id_coupon` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id_coupon`, `name`, `description`, `image_url`, `id_category`, `unit_cost`, `start_date`, `end_date`) VALUES
(1, 'Movie Night Out', 'Enjoy a movie night with a loved one. Get two tickets for the price of one!', 'http://localhost:81/greenreturn_api/models/photos/1Movie Night Out.png', 1, 50, '2023-11-15 06:00:00', '2023-12-31 06:00:00'),
(2, 'Adventure Park Pass', 'Experience an adventurous day at our local adventure park. Half-price entry for a thrilling time!', 'http://localhost:81/greenreturn_api/models/photos/2Adventure Park Pass.png', 1, 40, '2023-11-01 06:00:00', '2023-12-15 06:00:00'),
(3, 'Live Music Concert', 'Rock out at a live music concert! Redeem this coupon for a discounted ticket to the hottest show in ', '../../assets/error.png', 1, 60, '2023-11-10 06:00:00', '2023-11-30 06:00:00'),
(13, 'Art Workshop Pass', 'Unleash your creativity at an art workshop! Learn from professional artists, explore different mediu', 'http://localhost:81/greenreturn_api/models/photos/Art Workshop Pass.png', 1, 35, '2023-12-08 06:00:00', '2023-12-15 06:00:00'),
(14, 'Escape Room Adventure', 'Gather your team and test your wits in an escape room adventure! Solve puzzles, uncover mysteries, a', 'http://localhost:81/greenreturn_api/models/photos/Escape Room Adventure.png', 1, 45, '2023-12-07 06:00:00', '2023-12-22 06:00:00'),
(15, 'Science Museum Pass', 'Embark on a journey of discovery at the science museum! This pass provides access to interactive exh', 'http://localhost:81/greenreturn_api/models/photos/Science Museum Pass.png', 5, 60, '2023-12-02 06:00:00', '2023-12-21 06:00:00'),
(16, 'Mini Golf Fun Pack', 'Tee off on a mini golf adventure! This fun pack includes rounds of mini-golf for a group, along with', 'http://localhost:81/greenreturn_api/models/photos/Mini Golf Fun Pack.png', 6, 74, '2023-12-08 06:00:00', '2023-12-12 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_exchange`
--

CREATE TABLE `coupon_exchange` (
  `id_exchange` int(11) NOT NULL,
  `id_coupon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qr_url` varchar(100) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coupon_exchange`
--

INSERT INTO `coupon_exchange` (`id_exchange`, `id_coupon`, `id_user`, `qr_url`, `unit_cost`, `date_created`) VALUES
(1, 1, 5, 'qr', 50, '2023-10-31 22:39:04'),
(2, 2, 5, 'qr', 40, '2023-10-31 22:43:56'),
(3, 3, 5, 'qr', 60, '2023-10-31 22:45:03'),
(4, 1, 1, 'sdc', 5, '2023-12-09 00:47:59'),
(5, 1, 1, 'sdc', 5, '2023-12-09 00:48:43'),
(6, 1, 1, 'plpl', 5, '2023-12-09 00:54:10'),
(7, 1, 1, 'plpl', 5, '2023-12-09 00:55:28'),
(15, 14, 9, '', 45, '2023-12-10 23:08:35'),
(16, 15, 9, '', 60, '2023-12-11 02:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id_province` int(11) NOT NULL,
  `id_canton` int(11) NOT NULL,
  `id_district` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id_province`, `id_canton`, `id_district`, `name`) VALUES
(1, 1, 1, 'Carmen'),
(2, 2, 2, 'Alajuela'),
(3, 3, 3, 'Tierra Blanca');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_detail`
--

CREATE TABLE `exchange_detail` (
  `id_exchange` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exchange_detail`
--

INSERT INTO `exchange_detail` (`id_exchange`, `id_material`, `quantity`, `unit_cost`, `subtotal`) VALUES
(1, 1, 10, 1, 10),
(1, 2, 5, 2, 10),
(2, 1, 15, 1, 15),
(2, 2, 10, 2, 20),
(3, 1, 5, 1, 5),
(3, 2, 5, 2, 10),
(4, 1, 5, 1, 5),
(4, 3, 5, 5, 25),
(5, 1, 10, 1, 10),
(5, 2, 5, 2, 10),
(6, 2, 5, 2, 10),
(6, 3, 10, 5, 50);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `id_measurement` int(11) NOT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `id_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id_material`, `name`, `description`, `image_url`, `id_measurement`, `unit_cost`, `id_color`) VALUES
(1, 'Paper', 'Acceptable in recyclable form, including newspapers, magazines, or office paper.', 'http://localhost:81/greenreturn_api/models/photos/paper.png', 1, 1, 1),
(2, 'Cardboard', 'Accepted in recyclable form, including boxes, packaging, and paperboard.', 'http://localhost:81/greenreturn_api/models/photos/cardboard.png', 1, 2, 2),
(3, 'Iron', 'Acceptable in structural forms, like beams, bars, or old machinery parts.', 'http://localhost:81/greenreturn_api/models/photos/iron.png', 1, 6, 3),
(4, 'Aluminium', 'Accepted in various conditions, including cans, foils, and some structural forms.', 'http://localhost:81/greenreturn_api/models/photos/aluminium.png', 1, 10, 13),
(5, 'Gold', 'Accepted in small quantities, including jewelry, small parts, or decorative pieces.', 'http://localhost:81/greenreturn_api/models/photos/gold.png', 1, 100, 12),
(6, 'Bronze', 'Acceptable in the form of sculptures, statues, or industrial scraps.', 'http://localhost:81/greenreturn_api/models/photos/bronze.png', 1, 15, 14),
(7, 'Copper', 'Accepted in various forms, including wires, pipes, or electrical components.', 'http://localhost:81/greenreturn_api/models/photos/copper.png', 1, 25, 15),
(8, 'Sheet metal', 'Accepted in various forms, including steel, aluminum, or copper sheets used in construction.', 'http://localhost:81/greenreturn_api/models/photos/sheet metal.png', 1, 4, 16),
(9, 'Carbide', 'Acceptable in solid forms, like cutting tools or machine parts.', 'http://localhost:81/greenreturn_api/models/photos/9Carbide.png', 1, 8, 17),
(10, 'Stainless steel', 'Accepted in a variety of forms, such as kitchenware, appliances, and structural components.', 'http://localhost:81/greenreturn_api/models/photos/stainless steel.png', 1, 12, 18);

-- --------------------------------------------------------

--
-- Table structure for table `material_collection`
--

CREATE TABLE `material_collection` (
  `id_material` int(11) NOT NULL,
  `id_collection_center` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `material_collection`
--

INSERT INTO `material_collection` (`id_material`, `id_collection_center`) VALUES
(1, 2),
(2, 2),
(2, 3),
(3, 3),
(4, 1),
(5, 2),
(6, 1),
(6, 3),
(7, 1),
(7, 2),
(8, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `material_exchange`
--

CREATE TABLE `material_exchange` (
  `id_exchange` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_collection_center` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `material_exchange`
--

INSERT INTO `material_exchange` (`id_exchange`, `id_user`, `id_collection_center`, `total`, `date_created`) VALUES
(1, 2, 1, 20, '2023-10-31 21:28:43'),
(2, 2, 1, 35, '2023-10-31 22:06:08'),
(3, 2, 1, 15, '2023-10-31 22:07:18'),
(4, 5, 2, 30, '2023-10-31 22:15:00'),
(5, 5, 1, 20, '2023-10-31 22:15:27'),
(6, 5, 3, 60, '2023-10-31 22:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

CREATE TABLE `measurement` (
  `id_measurement` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `measurement`
--

INSERT INTO `measurement` (`id_measurement`, `name`, `value`) VALUES
(1, 'Kilograms', 'Kg'),
(2, 'Pounds', 'Lb'),
(3, 'Litre', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id_province` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id_province`, `name`) VALUES
(1, 'San Jose'),
(2, 'Alajuela'),
(3, 'Cartago');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'Admin'),
(2, 'CC_Admin'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL,
  `identification` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `id_province` int(11) DEFAULT NULL,
  `id_canton` int(11) DEFAULT NULL,
  `id_district` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `coin` int(11) DEFAULT NULL,
  `active` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `id_role`, `identification`, `name`, `surname`, `telephone`, `id_province`, `id_canton`, `id_district`, `address`, `coin`, `active`) VALUES
(1, 'Samirr022004@gmail.com', '$2y$10$PPtz9FIly.gYtw5A8BkxhOGXZn8KPtMO3V70aD8Zjg8y4YoLd3Li6', 1, 208500499, 'Samuel', 'Romero Ramirez', 83211179, 1, 1, 1, 'Calle Bambú', 11, 0x31),
(2, 'Dapp0204@gmail.com', '$2y$10$MRd1IQZ5nAii2PrFuMk7ueXBXOiR/ffVsUQga9CqHbRYFBXR4qZZm', 2, 208490543, 'Carlos', 'Ruiz Vargas', 84695321, 2, 2, 2, 'Calle Almendros', 0, 0x31),
(3, 'Luis2000@gmail.com', '$2y$10$oi.pEkOSnQb.BpaVZ7Nb3ehiPRp2TFpD8SA7pol9FOy9.58chUUCe', 2, 208470295, 'Luis', 'Rodriguez Lopez', 65789658, 3, 3, 3, 'Calle Rosas', 0, 0x31),
(4, 'Sof0345@gmail.com', '$2y$10$61C0/sn5HW2HBKKyMBM4K.IenHpBfC9l5iQZw6.S0jdjcBZVJStfW', 2, 208480789, 'Sofia', 'Valverde Gomez', 87463215, 3, 3, 3, 'Calle Canto', 0, 0x31),
(5, 'Laura123@gmail.com', '$2y$10$rIE4HDy2Ge.yT4RVikATu.4emMtDeJoWy0OPtUH1OH.66BDilLb6a', 3, 207900487, 'Laura', 'Zamora Solorzano', 69854732, 1, 1, 1, 'Calle Verde', 221, 0x31),
(6, 'raquelrg@gmail.com', '$2y$10$kJgaiwTQTq148yeqjrno7.8XxRvG8fQgFhcSlSfL3b.UqTspAjZQq', 2, 107900384, 'Raquel', 'Rodriguez Gomez', 63214598, 1, 1, 1, 'Calle Conejo', 0, 0x31),
(7, 'sararam@gmail.com', '$2y$10$ZQ/fYh7C.//mH5Tf542TIO4Fw9KJj.CfRo3PkZF4MdAWfFmrNnJHe', 2, 901000893, 'Sara', 'Ramirez chaves', 89657412, 1, 1, 1, 'Calle Estadio', 0, 0x31),
(8, 'elci@gmail.com', '$2y$10$Ii76g63dcOwHKsqAP5ub8epLrz0Nyo0eorYTe6zUQLotIYRjHxLte', 2, 208500593, 'Elci', 'Garro Mata', 65987432, 1, 1, 1, 'Calle Cigarro', 0, 0x31),
(9, 'luija2000@gmail.com', '$2y$10$KQIvhj9LHCg7m6GJ22NTEu6kY/L.vTZp4OATjMDzMO034Fp6bowuq', 3, 123456789, 'Luis', 'Campos', NULL, NULL, NULL, NULL, NULL, 140, 0x31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`id_canton`,`id_province`),
  ADD KEY `idx_canton` (`id_canton`,`id_province`),
  ADD KEY `fk_canton_province` (`id_province`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `idx_category` (`id_category`);

--
-- Indexes for table `collection_center`
--
ALTER TABLE `collection_center`
  ADD PRIMARY KEY (`id_collection_center`),
  ADD KEY `idx_collection_center` (`id_collection_center`),
  ADD KEY `fk_cc_district` (`id_district`,`id_canton`,`id_province`),
  ADD KEY `fk_cc_user` (`id_user`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`),
  ADD KEY `idx_color` (`id_color`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id_coupon`),
  ADD KEY `idx_coupon` (`id_coupon`),
  ADD KEY `fk_coupon_category` (`id_category`);

--
-- Indexes for table `coupon_exchange`
--
ALTER TABLE `coupon_exchange`
  ADD PRIMARY KEY (`id_exchange`),
  ADD KEY `idx_coupon_exchange` (`id_exchange`),
  ADD KEY `fk_coupon_exchange` (`id_user`,`id_coupon`),
  ADD KEY `fk1_coupon_exchange` (`id_coupon`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id_district`,`id_canton`,`id_province`),
  ADD KEY `idx_district` (`id_district`,`id_canton`,`id_province`),
  ADD KEY `fk_district_canton` (`id_canton`,`id_province`);

--
-- Indexes for table `exchange_detail`
--
ALTER TABLE `exchange_detail`
  ADD PRIMARY KEY (`id_exchange`,`id_material`),
  ADD KEY `idx_exchange_detail` (`id_exchange`,`id_material`),
  ADD KEY `fk_detail_material` (`id_material`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `idx_material` (`id_material`),
  ADD KEY `fk_material_color` (`id_color`),
  ADD KEY `fk_material_measurement` (`id_measurement`);

--
-- Indexes for table `material_collection`
--
ALTER TABLE `material_collection`
  ADD PRIMARY KEY (`id_material`,`id_collection_center`),
  ADD KEY `idx_material_collection` (`id_material`,`id_collection_center`),
  ADD KEY `fk2_cc_material` (`id_collection_center`);

--
-- Indexes for table `material_exchange`
--
ALTER TABLE `material_exchange`
  ADD PRIMARY KEY (`id_exchange`),
  ADD KEY `idx_material_exchange` (`id_exchange`),
  ADD KEY `fk_material_user` (`id_user`),
  ADD KEY `fk_material_cc` (`id_collection_center`);

--
-- Indexes for table `measurement`
--
ALTER TABLE `measurement`
  ADD PRIMARY KEY (`id_measurement`),
  ADD KEY `idx_measurement` (`id_measurement`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id_province`),
  ADD KEY `idx_province` (`id_province`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`),
  ADD KEY `idx_role` (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email` (`email`),
  ADD KEY `idx_user` (`id_user`),
  ADD KEY `fk_user_district` (`id_district`,`id_canton`,`id_province`),
  ADD KEY `fk_user_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canton`
--
ALTER TABLE `canton`
  MODIFY `id_canton` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `collection_center`
--
ALTER TABLE `collection_center`
  MODIFY `id_collection_center` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id_coupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `coupon_exchange`
--
ALTER TABLE `coupon_exchange`
  MODIFY `id_exchange` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id_district` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material_exchange`
--
ALTER TABLE `material_exchange`
  MODIFY `id_exchange` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `measurement`
--
ALTER TABLE `measurement`
  MODIFY `id_measurement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id_province` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canton`
--
ALTER TABLE `canton`
  ADD CONSTRAINT `fk_canton_province` FOREIGN KEY (`id_province`) REFERENCES `province` (`id_province`);

--
-- Constraints for table `collection_center`
--
ALTER TABLE `collection_center`
  ADD CONSTRAINT `fk_cc_district` FOREIGN KEY (`id_district`,`id_canton`,`id_province`) REFERENCES `district` (`id_district`, `id_canton`, `id_province`),
  ADD CONSTRAINT `fk_cc_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `fk_coupon_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`);

--
-- Constraints for table `coupon_exchange`
--
ALTER TABLE `coupon_exchange`
  ADD CONSTRAINT `fk1_coupon_exchange` FOREIGN KEY (`id_coupon`) REFERENCES `coupon` (`id_coupon`),
  ADD CONSTRAINT `fk2_coupon_exchange` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk_district_canton` FOREIGN KEY (`id_canton`,`id_province`) REFERENCES `canton` (`id_canton`, `id_province`);

--
-- Constraints for table `exchange_detail`
--
ALTER TABLE `exchange_detail`
  ADD CONSTRAINT `fk_detail_exchange` FOREIGN KEY (`id_exchange`) REFERENCES `material_exchange` (`id_exchange`),
  ADD CONSTRAINT `fk_detail_material` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_material_color` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`),
  ADD CONSTRAINT `fk_material_measurement` FOREIGN KEY (`id_measurement`) REFERENCES `measurement` (`id_measurement`);

--
-- Constraints for table `material_collection`
--
ALTER TABLE `material_collection`
  ADD CONSTRAINT `fk1_cc_material` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`),
  ADD CONSTRAINT `fk2_cc_material` FOREIGN KEY (`id_collection_center`) REFERENCES `collection_center` (`id_collection_center`);

--
-- Constraints for table `material_exchange`
--
ALTER TABLE `material_exchange`
  ADD CONSTRAINT `fk_material_cc` FOREIGN KEY (`id_collection_center`) REFERENCES `collection_center` (`id_collection_center`),
  ADD CONSTRAINT `fk_material_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_district` FOREIGN KEY (`id_district`,`id_canton`,`id_province`) REFERENCES `district` (`id_district`, `id_canton`, `id_province`),
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
