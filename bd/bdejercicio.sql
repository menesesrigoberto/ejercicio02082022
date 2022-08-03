-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2022 at 03:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdejercicio`
--

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `fechacompra` datetime NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id`, `fechacompra`, `activo`) VALUES
(1, '2022-08-02 10:17:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compradetalle`
--

CREATE TABLE `compradetalle` (
  `id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `producto` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fecharegistro` datetime DEFAULT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `compradetalle`
--

INSERT INTO `compradetalle` (`id`, `compra_id`, `producto`, `fecharegistro`, `activo`) VALUES
(1, 1, 'Pan', '2022-08-02 10:17:36', 1),
(2, 1, 'Harina', '2022-08-02 10:17:40', 1),
(3, 1, 'Aceite', '2022-08-02 10:17:43', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compradetalle`
--
ALTER TABLE `compradetalle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `compradetalle`
--
ALTER TABLE `compradetalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
