-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 05:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noiseapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `district_name` varchar(40) NOT NULL,
  `block_name` varchar(40) NOT NULL,
  `block_passwd` varchar(40) NOT NULL,
  `block_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `district_name`, `block_name`, `block_passwd`, `block_status`) VALUES
(1, 'Ganjam', 'Purushottampur', 'purushottampur', 'Stopped'),
(2, 'Kendrapara', 'Rajnagar', 'rajnagar', ''),
(3, 'Ganjam', 'Polasara', 'polasara', ''),
(4, 'Ganjam', 'Rangeilunda', 'rangeilunda', ''),
(6, 'Ganjam', 'Digapahandi', 'digapahandi', ''),
(8, 'Ganjam', 'Chhatrapur', 'chhatrapur', ''),
(10, 'Ganjam', 'Khalikote', 'khalikote', ''),
(12, 'Ganjam', 'Hinjilicut', 'hinjilicut', ''),
(14, 'Kendrapara', 'Pattamundai', 'pattamundai', ''),
(15, 'Kendrapara', 'Rajkanika', 'rajkanika', ''),
(16, 'Puri', 'Chandanpur', 'chandanpur', ''),
(17, 'Puri', 'Brahmagiri', 'brahmagiri', ''),
(18, 'Puri', 'Satyabadi', 'satyabadi', ''),
(19, 'Khordha', 'Begunia', 'begunia', ''),
(20, 'Khordha', 'Jatani', 'jatani', ''),
(21, 'Khordha', 'Khandagiri', 'khandagiri', ''),
(22, 'Cuttack', 'Athagad', 'athagad', ''),
(23, 'Cuttack', 'Kishannagar', 'kishannagar', ''),
(24, 'Cuttack', 'Narasinghpur', 'narasinghpur', ''),
(25, 'Balasore', 'Jaleswar', 'jaleswar', ''),
(26, 'Balasore', 'Soro', 'soro', ''),
(27, 'Balasore', 'Simulia', 'simulia', 'Stopped'),
(28, 'Sambalpur', 'Rengali', 'rengali', ''),
(29, 'Sambalpur', 'Maneswar', 'maneswar', ''),
(30, 'Sambalpur', 'Bamara', 'bamara', ''),
(31, 'Malkangiri', 'Chitrakonda', 'chitrakonda', ''),
(32, 'Malkangiri', 'Khairiput', 'khairiput', ''),
(33, 'Malkangiri', 'Mathili', 'mathili', ''),
(34, 'Koraput', 'Laxmipur', 'laxmipur', ''),
(35, 'Koraput', 'Machhkund', 'machhkund', ''),
(36, 'Koraput', 'Nandapur', 'nandapur', ''),
(37, 'Gajapati', 'Mohara', 'mohara', ''),
(38, 'Gajapati', 'Kasinagar', 'kasinagar', ''),
(39, 'Gajapati', 'Paralakhemundi', 'paralakhemundi', '');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` bigint(20) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`) VALUES
(1, 'Ganjam'),
(2, 'Puri'),
(3, 'Cuttack'),
(4, 'Khordha'),
(5, 'Kendrapara'),
(6, 'Balasore'),
(7, 'Sambalpur'),
(8, 'Malkangiri'),
(9, 'Koraput'),
(10, 'Gajapati');

-- --------------------------------------------------------

--
-- Table structure for table `loginiot`
--

CREATE TABLE `loginiot` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginiot`
--

INSERT INTO `loginiot` (`id`, `username`, `passwd`, `district_name`) VALUES
(1, 'ganjam', 'ganjam', 'Ganjam'),
(2, 'puri', 'puri', 'Puri'),
(3, 'cuttack', 'cuttack', 'Cuttack'),
(4, 'khordha', 'khordha', 'Khordha'),
(5, 'kendrapara', 'kendrapara', 'Kendrapara'),
(6, 'balasore', 'balasore', 'Balasore');

-- --------------------------------------------------------

--
-- Table structure for table `noise_value`
--

CREATE TABLE `noise_value` (
  `id` int(11) NOT NULL,
  `district_name` varchar(40) NOT NULL,
  `block_name` varchar(40) NOT NULL,
  `day_value` float NOT NULL,
  `night_value` float NOT NULL,
  `date` date NOT NULL,
  `average` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `noise_value`
--

INSERT INTO `noise_value` (`id`, `district_name`, `block_name`, `day_value`, `night_value`, `date`, `average`) VALUES
(81, 'Ganjam', 'Purushottampur', 49.1, 51.4, '2021-12-20', 50.25),
(82, 'Ganjam', 'Purushottampur', 48, 45.8, '2021-12-21', 46.9),
(83, 'Ganjam', 'Purushottampur', 43.5, 48.2, '2021-12-22', 45.85),
(84, 'Ganjam', 'Purushottampur', 43.5, 48.3, '2021-12-23', 45.9),
(85, 'Ganjam', 'Purushottampur', 47.1, 46.9, '2021-12-24', 47),
(86, 'Kendrapara', 'Rajnagar', 46.7, 47.9, '2021-12-20', 47.3),
(87, 'Kendrapara', 'Rajnagar', 46.7, 46.2, '2021-12-21', 46.45),
(88, 'Kendrapara', 'Rajnagar', 44.8, 48.3, '2021-12-22', 46.55),
(89, 'Kendrapara', 'Rajnagar', 46.2, 48.3, '2021-12-23', 47.25),
(90, 'Kendrapara', 'Rajnagar', 49.1, 47.5, '2021-12-24', 48.3),
(91, 'Gajapati', 'Mohara', 49.8, 52.2, '2021-12-20', 51),
(92, 'Gajapati', 'Mohara', 46.2, 47.9, '2021-12-21', 47.05),
(93, 'Gajapati', 'Mohara', 49.9, 47.4, '2021-12-22', 48.65),
(94, 'Gajapati', 'Mohara', 50.3, 48.4, '2021-12-23', 49.35),
(95, 'Balasore', 'Soro', 45.5, 51.8, '2021-12-20', 48.65),
(96, 'Balasore', 'Soro', 48.7, 44.9, '2021-12-21', 46.8),
(97, 'Balasore', 'Soro', 50.7, 50.7, '2021-12-22', 50.7),
(98, 'Balasore', 'Soro', 49.8, 47.2, '2021-12-23', 48.5),
(99, 'Balasore', 'Soro', 43.9, 47, '2021-12-24', 45.45),
(100, 'Cuttack', 'Narasinghpur', 52.6, 48.5, '2021-12-20', 50.55),
(101, 'Cuttack', 'Narasinghpur', 48.8, 48.7, '2021-12-21', 48.75),
(102, 'Cuttack', 'Narasinghpur', 42.7, 48.5, '2021-12-22', 45.6),
(103, 'Cuttack', 'Narasinghpur', 47.3, 46.8, '2021-12-23', 47.05),
(104, 'Cuttack', 'Narasinghpur', 46.2, 51.3, '2021-12-24', 48.75),
(105, 'Khordha', 'Begunia', 50.5, 44.6, '2021-12-20', 47.55),
(106, 'Khordha', 'Begunia', 47, 46.3, '2021-12-21', 46.65),
(107, 'Khordha', 'Begunia', 50.6, 49.5, '2021-12-22', 50.05),
(108, 'Khordha', 'Begunia', 45.7, 50.2, '2021-12-23', 47.95),
(109, 'Khordha', 'Begunia', 50.2, 49.2, '2021-12-24', 49.7),
(110, 'Koraput', 'Laxmipur', 46.8, 51, '2021-12-20', 48.9),
(111, 'Koraput', 'Laxmipur', 44.5, 49.7, '2021-12-21', 47.1),
(112, 'Koraput', 'Laxmipur', 45.6, 52.7, '2021-12-22', 49.15),
(113, 'Koraput', 'Laxmipur', 47.5, 46.9, '2021-12-23', 47.2),
(114, 'Koraput', 'Laxmipur', 48, 43, '2021-12-24', 45.5),
(115, 'Malkangiri', 'Chitrakonda', 50.5, 50.8, '2021-12-20', 50.65),
(116, 'Malkangiri', 'Chitrakonda', 46.2, 46.6, '2021-12-21', 46.4),
(117, 'Malkangiri', 'Chitrakonda', 46.7, 44.4, '2021-12-22', 45.55),
(118, 'Malkangiri', 'Chitrakonda', 48.7, 49.5, '2021-12-23', 49.1),
(119, 'Malkangiri', 'Chitrakonda', 47.6, 46, '2021-12-24', 46.8),
(120, 'Puri', 'Satyabadi', 46.7, 47.2, '2021-12-20', 46.95),
(121, 'Puri', 'Satyabadi', 48.2, 49.5, '2021-12-21', 48.85),
(122, 'Puri', 'Satyabadi', 48, 50.3, '2021-12-22', 49.15),
(123, 'Puri', 'Satyabadi', 48, 48.3, '2021-12-23', 48.15),
(124, 'Puri', 'Satyabadi', 47.6, 45.1, '2021-12-24', 46.35),
(125, 'Sambalpur', 'Maneswar', 46, 48.6, '2021-12-20', 47.3),
(126, 'Sambalpur', 'Maneswar', 49.2, 45.1, '2021-12-21', 47.15),
(127, 'Sambalpur', 'Maneswar', 50.4, 46.8, '2021-12-22', 48.6),
(128, 'Sambalpur', 'Maneswar', 47.1, 54.1, '2021-12-23', 50.6),
(129, 'Sambalpur', 'Maneswar', 46.6, 47.4, '2021-12-24', 47),
(130, 'Ganjam', 'Purushottampur', 47.4, 49.1, '2021-12-25', 48.25),
(131, 'Ganjam', 'Purushottampur', 46, 48.7, '2021-12-26', 47.35),
(132, 'Ganjam', 'Purushottampur', 45.8, 48.8, '2021-12-27', 47.3),
(133, 'Ganjam', 'Purushottampur', 49.7, 51.1, '2021-12-28', 50.4),
(134, 'Ganjam', 'Purushottampur', 51.4, 47.1, '2021-12-29', 49.25),
(135, 'Ganjam', 'Purushottampur', 52.1, 49.8, '2021-12-19', 50.95),
(136, 'Ganjam', 'Purushottampur', 51.6, 44.8, '2021-12-18', 48.2),
(137, 'Ganjam', 'Purushottampur', 48.6, 46.5, '2021-12-17', 47.55),
(138, 'Ganjam', 'Purushottampur', 44.8, 52.1, '2021-12-16', 48.45),
(139, 'Ganjam', 'Purushottampur', 43.6, 50.6, '2021-12-15', 47.1),
(140, 'Balasore', 'Simulia', 48.6, 46.9, '2021-12-20', 47.75),
(141, 'Balasore', 'Simulia', 48.6, 47.4, '2021-12-19', 48),
(142, 'Balasore', 'Simulia', 48, 46.9, '2021-12-18', 47.45),
(143, 'Balasore', 'Simulia', 48.1, 48, '2021-12-17', 48.05),
(144, 'Balasore', 'Simulia', 47.2, 50, '2021-12-16', 48.6),
(145, 'Ganjam', 'Chhatrapur', 55.1, 34.4, '2021-12-22', 44.75);

-- --------------------------------------------------------

--
-- Table structure for table `temp_noise_data`
--

CREATE TABLE `temp_noise_data` (
  `id` int(11) NOT NULL,
  `district_name` varchar(40) NOT NULL,
  `block_name` varchar(40) NOT NULL,
  `date_time` datetime NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `loginiot`
--
ALTER TABLE `loginiot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noise_value`
--
ALTER TABLE `noise_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_noise_data`
--
ALTER TABLE `temp_noise_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loginiot`
--
ALTER TABLE `loginiot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `noise_value`
--
ALTER TABLE `noise_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `temp_noise_data`
--
ALTER TABLE `temp_noise_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2408;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
