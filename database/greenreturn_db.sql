-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 01:59 AM
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
(3, 'Eco-Friendly Products');

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
(1, 'Grey', '#DDDDDA'),
(2, 'Light brown', '#E1C19E'),
(3, 'Burnt orange', '#BB7541'),
(4, 'White', '#FFFFFF'),
(5, 'Red', '#FF0000'),
(6, 'Green', '#00FF00'),
(7, 'Blue', '#0000FF'),
(8, 'Yellow', '#FFFF00'),
(9, 'Orange', '#FFA500'),
(10, 'Pink', '#FFC0CB'),
(11, 'Brown', '#A52A2A');

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
(1, 'Movie Night Out', 'Enjoy a movie night with a loved one. Get two tickets for the price of one!', '../../assets/error.png', 1, 50, '2023-11-15 06:00:00', '2023-12-31 06:00:00'),
(2, 'Adventure Park Pass', 'Experience an adventurous day at our local adventure park. Half-price entry for a thrilling time!', '../../assets/error.png', 1, 40, '2023-11-01 06:00:00', '2023-12-15 06:00:00'),
(3, 'Live Music Concert', 'Rock out at a live music concert! Redeem this coupon for a discounted ticket to the hottest show in ', '../../assets/error.png', 1, 60, '2023-11-10 06:00:00', '2023-11-30 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_exchange`
--

CREATE TABLE `coupon_exchange` (
  `id_coupon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qr_url` varchar(100) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coupon_exchange`
--

INSERT INTO `coupon_exchange` (`id_coupon`, `id_user`, `qr_url`, `unit_cost`, `date_created`) VALUES
(1, 5, 'qr', 50, '2023-10-31 22:39:04'),
(2, 5, 'qr', 40, '2023-10-31 22:43:56'),
(3, 5, 'qr', 60, '2023-10-31 22:45:03');

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
(1, 'Paper', 'We accept clean and dry paper, free from bindings or clips.', '../../assets/paper.png', 1, 1, 1),
(2, 'Cardboard', 'We receive corrugated cardboard and non-waxed cardboard.', '../../assets/cardboard.png', 1, 2, 2),
(3, 'Scrap', 'We receive metals such as aluminum and steel.', '../../assets/scrap.png', 1, 5, 3);

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
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(3, 2),
(3, 3);

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
(1, 'Samirr022004@gmail.com', '123456', 1, 208500499, 'Samuel', 'Romero Ramirez', 83211179, 1, 1, 1, 'San Juan, Calle Bambú 200mts sur', 0, 0x31),
(2, 'Dapp0204@gmail.com', '654321', 2, 208490543, 'Carlos', 'Ruiz Vargas', 84695321, 2, 2, 2, 'Calle Almendros 400mts noroeste', 0, 0x31),
(3, 'Luis2000@gmail.com', '123456', 2, 208470295, 'Luis', 'Rodriguez Lopez', 65789658, 3, 3, 3, 'Calle Rosas 100mts este', 0, 0x31),
(4, 'Sof0345@gmail.com', '654321', 2, 208480789, 'Sofia', 'Valverde Gomez', 87463215, 3, 3, 3, 'Calle Canto 225mts oeste', 0, 0x31),
(5, 'Laura123@gmail.com', '123456', 3, 207900487, 'Laura', 'Zamora Solorzano', 69854732, 1, 1, 1, 'Calle Verde', 0, 0x31),
(6, 'raquelrg@gmail.com', '123456', 2, 107900384, 'Raquel', 'Rodriguez Gomez', 63214598, 1, 1, 1, 'Calle Conejo', 0, 0x31),
(7, 'sararam@gmail.com', '123456', 2, 901000893, 'Sara', 'Ramirez chaves', 89657412, 1, 1, 1, 'Calle Estadio', 0, 0x31),
(8, 'elci@gmail.com', '123456', 2, 208500593, 'Elci', 'Garro Mata', 65987432, 1, 1, 1, 'Calle Cigarro', 0, 0x31);

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
  ADD PRIMARY KEY (`id_coupon`,`id_user`),
  ADD KEY `idx_coupon_exchange` (`id_coupon`,`id_user`),
  ADD KEY `fk2_coupon_exchange` (`id_user`);

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
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collection_center`
--
ALTER TABLE `collection_center`
  MODIFY `id_collection_center` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id_coupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id_district` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
