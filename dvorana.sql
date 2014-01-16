-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2014 at 03:00 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dvorana`
--
CREATE DATABASE IF NOT EXISTS `dvorana` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dvorana`;

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE IF NOT EXISTS `halls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id`, `name`) VALUES
(1, 'Sala 1'),
(2, 'Sala 2'),
(3, 'Sala 3');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`name`, `value`) VALUES
('limit', '2');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `comment` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hall_id` int(10) unsigned NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `hall_id` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=555 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `date`, `client_id`, `status`, `price`, `comment`, `hall_id`, `start`, `end`) VALUES
(528, '2014-01-16', 16, 'nepotvrđen', '15.00', '', 1, '12:15:00', '13:00:00'),
(529, '2014-01-16', 16, 'nepotvrđen', '35.00', '', 1, '13:15:00', '15:00:00'),
(530, '2014-01-17', 16, 'nepotvrđen', '25.00', '', 1, '14:15:00', '15:30:00'),
(531, '2014-01-18', 16, 'nepotvrđen', '30.00', '', 1, '11:30:00', '13:00:00'),
(532, '2014-01-19', 16, 'nepotvrđen', '30.00', '', 1, '09:15:00', '10:45:00'),
(533, '2014-01-18', 16, 'nepotvrđen', '10.00', '', 1, '09:15:00', '09:45:00'),
(534, '2014-01-15', 9, 'nepotvrđen', '10.00', '', 2, '10:00:00', '10:30:00'),
(535, '2014-01-15', 9, 'nepotvrđen', '10.00', '', 2, '12:30:00', '13:00:00'),
(536, '2014-01-15', 9, 'nepotvrđen', '10.00', '', 2, '15:00:00', '15:30:00'),
(537, '2014-01-15', 9, 'nepotvrđen', '10.00', '', 2, '16:30:00', '17:00:00'),
(538, '2014-01-17', 9, 'nepotvrđen', '10.00', '', 2, '13:30:00', '14:00:00'),
(539, '2014-01-17', 9, 'nepotvrđen', '10.00', '', 2, '14:15:00', '14:45:00'),
(540, '2014-01-17', 9, 'nepotvrđen', '10.00', '', 2, '12:30:00', '13:00:00'),
(541, '2014-01-18', 9, 'nepotvrđen', '10.00', '', 2, '13:30:00', '14:00:00'),
(542, '2014-01-18', 9, 'nepotvrđen', '10.00', '', 2, '14:15:00', '14:45:00'),
(543, '2014-01-18', 9, 'nepotvrđen', '10.00', '', 2, '15:15:00', '15:45:00'),
(544, '2014-01-19', 9, 'nepotvrđen', '10.00', '', 2, '13:30:00', '14:00:00'),
(545, '2014-01-19', 9, 'nepotvrđen', '10.00', '', 2, '14:15:00', '14:45:00'),
(546, '2014-01-19', 9, 'nepotvrđen', '10.00', '', 2, '15:15:00', '15:45:00'),
(547, '2014-01-16', 9, 'nepotvrđen', '10.00', '', 2, '15:15:00', '15:45:00'),
(548, '2014-01-16', 9, 'nepotvrđen', '25.00', '', 2, '16:00:00', '17:15:00'),
(549, '2014-01-17', 9, 'nepotvrđen', '10.00', '', 2, '15:15:00', '15:45:00'),
(550, '2014-01-19', 9, 'nepotvrđen', '10.00', '', 2, '12:30:00', '13:00:00'),
(551, '2014-01-18', 9, 'nepotvrđen', '10.00', '', 2, '12:30:00', '13:00:00'),
(552, '2014-01-16', 9, 'nepotvrđen', '10.00', '', 1, '10:15:00', '10:45:00'),
(553, '2014-01-16', 9, 'nepotvrđen', '10.00', '', 1, '09:45:00', '10:15:00'),
(554, '2014-01-16', 9, 'nepotvrđen', '10.00', '', 1, '11:30:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `password`, `telephone`, `email`, `role`) VALUES
(9, 'Admin', 'Admin', 'admin', 'b5caeecdd42c106e63993e9800fdbbed048e8d40', '22333', 'proba@spam.com', 'Menadžer'),
(10, 'Pero', 'Perić', 'pero', 'f38982b8021f917994918798159817d08cb28e92', '065123456', 'proba@spam.com', 'Klijent'),
(14, 'Marko', 'Marković', 'marko', 'fd534b1f6bb8af9b391fc0b6a20b429d4ddb52dc', '065123456', 'proba@spam.com', 'Menadžer'),
(16, 'Klijent', 'Klijent', 'klijent', '28c2b3e3ebf035c9b6f8a130b9fc2782fbcc3cc7', '22333', 'proba@spam.com', 'Klijent'),
(19, 'proba', 'proba', 'proba', '8569c887fdf1e14adc6cf30e68dfc8ef0f39a0d4', '065111112', 'proba@spam.com', 'Klijent');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `terms`
--
ALTER TABLE `terms`
  ADD CONSTRAINT `halls_fk` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`),
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
