-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2019 at 11:47 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Minecraft'),
(5, 'Rov');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `www` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `alert` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `promotion_tm` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `promotion_tw` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `truewallet_phone` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `truewallet_email` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `truewallet_password` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `website` varchar(255) DEFAULT 'shop.hakko.pw',
  `me` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'https://www.facebook.com/itorkungth',
  `truewallet_msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `truewallet_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nav` enum('primary','dark','success','info','warning','danger') NOT NULL,
  `say` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `title`, `description`, `icon`, `name`, `www`, `alert`, `promotion_tm`, `promotion_tw`, `truewallet_phone`, `truewallet_email`, `truewallet_password`, `website`, `me`, `truewallet_msg`, `truewallet_name`, `nav`, `say`) VALUES
(1, 'iSHOPMC.INFO | ขายไอดีแท้ Minecraft', 'iSHOPMC.INFO, เว็บขายไอดีแท้, ขายไอดีแท้มายคราฟ, ร้านขายIDแท้, ร้านขายไอดี, IDแท้, IDแท้Minecraft, ไอดีแท้มายคราฟ 10บาท, ไอดีแท้มายคราฟถูกๆ, ไอดีMinecraft', 'https://ishopmc.info/favicon.ico', 'iSHOPMC.INFO', 'https://ishopmc.info/', 'เว็บขายไอดีแท้มายคราฟ ISHOPMC.INFO ได้แน่นอน 100,000%', '1', '1.2', '0649085379', 'truewallet@wallet.com', 'password', 'ishopmc.info', 'https://www.facebook.com/MRNaronglit/', '2019', 'ประยุท จันโอชา', 'info', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `ids`
--

CREATE TABLE `ids` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('buy','unbuy') NOT NULL DEFAULT 'unbuy',
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jackpot`
--

CREATE TABLE `jackpot` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `category` int(255) NOT NULL,
  `chance_s` int(255) NOT NULL,
  `chance_f` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jackpot`
--

INSERT INTO `jackpot` (`id`, `name`, `img`, `detail`, `price`, `category`, `chance_s`, `chance_f`) VALUES
(5, 'Test', 'http://google.com', 'fsdfds', 1500, 1, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `log_redeem`
--

CREATE TABLE `log_redeem` (
  `id` int(11) NOT NULL,
  `code` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `time` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log_shop`
--

CREATE TABLE `log_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `lore` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `time` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_shop`
--

INSERT INTO `log_shop` (`id`, `name`, `lore`, `price`, `time`, `username`, `email`, `password`) VALUES
(1, 'Test', '', '1500.00', '1554712669 ', 'admin', 'vir.moh@gmail.com', 'Yoshi2000 \r'),
(2, 'Test', '', '1500.00', '1554712677 ', 'admin', 'vcontorivera@gmail.com', 'yoshi012 \r'),
(3, 'ไอดีแท้มือ2', 'เปลี่ยนได้หมด นอกจากเมล์ รับประกัน 5ชม.', '65.00', '1554712766 ', 'admin', 'wchristianwest@icloud.com', 'Snowboard17 \r'),
(4, 'Test', 'fsdfds', '1500.00', '1554712838 ', 'admin', 'victorng717@yahoo.com', 'Pokemon567 \r'),
(5, 'Test', 'fsdfds', '1500.00', '1554712949 ', 'admin', 'victorlombardi4443@gmail.com', 'Victor44 \r');

-- --------------------------------------------------------

--
-- Table structure for table `log_topup`
--

CREATE TABLE `log_topup` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `transaction` varchar(14) NOT NULL,
  `time` int(11) NOT NULL,
  `point` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(7) DEFAULT 'fail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `status` enum('Redeem','UnRedeem') NOT NULL DEFAULT 'UnRedeem'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id`, `code`, `price`, `status`) VALUES
(1, 'Test', 100, 'UnRedeem');

-- --------------------------------------------------------

--
-- Table structure for table `say`
--

CREATE TABLE `say` (
  `id` int(11) NOT NULL,
  `news` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `say`
--

INSERT INTO `say` (`id`, `news`) VALUES
(1, 'รออัพเดต'),
(2, 'รออัพเดต'),
(3, 'รออัพเดต'),
(4, 'รออัพเดต'),
(5, 'รออัพเดต');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `lore` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `lore`, `category`, `price`, `img`) VALUES
(1, 'ไอดีแท้มือ2', 'เปลี่ยนไม่ได้ อาจโดนแบนบางเซิร์ฟ', '1', '10.00', 'http://www.pngmart.com/files/7/Minecraft-PNG-Photo.png'),
(2, 'ไอดีแท้มือ2', 'เปลี่ยนได้หมด นอกจากเมล์ รับประกัน 5ชม.', '1', '65.00', 'http://www.stickpng.com/assets/images/580b57fcd9996e24bc43c2fc.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `point` decimal(10,2) NOT NULL,
  `ban` varchar(255) NOT NULL DEFAULT 'false',
  `rank` enum('Member','Admin') NOT NULL DEFAULT 'Member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `ip`, `point`, `ban`, `rank`) VALUES
(7, 'admin', '51f77ca0313d66883d7a484cec6e719c', '::1', '9993935.00', 'false', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ids`
--
ALTER TABLE `ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jackpot`
--
ALTER TABLE `jackpot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_redeem`
--
ALTER TABLE `log_redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_shop`
--
ALTER TABLE `log_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_topup`
--
ALTER TABLE `log_topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `say`
--
ALTER TABLE `say`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ids`
--
ALTER TABLE `ids`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `jackpot`
--
ALTER TABLE `jackpot`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_redeem`
--
ALTER TABLE `log_redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_shop`
--
ALTER TABLE `log_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_topup`
--
ALTER TABLE `log_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `say`
--
ALTER TABLE `say`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
