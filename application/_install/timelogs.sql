-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 16, 2014 at 09:21 PM
-- Server version: 5.5.40
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rab`
--

-- --------------------------------------------------------

--
-- Table structure for table `timelogs`
--

CREATE TABLE IF NOT EXISTS `timelogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  `total_time` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `timelogs`
--

INSERT INTO `timelogs` (`id`, `contact_id`, `event_id`, `time_in`, `time_out`, `total_time`) VALUES
(1, 57, 5, '2014-12-16 21:08:47', '2014-12-16 21:08:51', 0.00),
(2, 59, 5, '2014-12-16 21:08:49', '2014-12-16 21:08:52', 0.00),
(3, 57, 5, '2014-12-16 21:09:42', '2014-12-16 21:09:45', 0.00),
(4, 59, 5, '2014-12-16 21:09:44', '2014-12-16 21:09:47', 0.00),
(5, 57, 5, '2014-12-16 21:10:23', '2014-12-16 21:10:27', 0.00),
(6, 59, 5, '2014-12-16 21:10:25', '2014-12-16 21:10:28', 0.00),
(7, 57, 5, '2014-12-16 21:11:34', '2014-12-16 21:11:38', 0.00),
(8, 59, 5, '2014-12-16 21:11:36', '2014-12-16 21:11:39', 0.00),
(9, 57, 5, '2014-12-16 21:15:57', '2014-12-16 21:15:59', 2.00),
(10, 57, 5, '2014-12-16 21:17:42', '2014-12-16 21:17:44', 2.00),
(11, 57, 5, '2014-12-16 21:19:18', '2014-12-16 21:19:20', 2.00),
(12, 57, 5, '2014-12-16 21:19:48', '2014-12-16 21:19:50', 2.00),
(13, 57, 5, '2014-12-16 21:20:11', '2014-12-16 21:20:19', 8.00);

--
-- Triggers `timelogs`
--
DROP TRIGGER IF EXISTS `Total Time Insert`;
DELIMITER //
CREATE TRIGGER `Total Time Insert` BEFORE INSERT ON `timelogs`
 FOR EACH ROW SET NEW.total_time = TIMEDIFF(NEW.time_out, NEW.time_in)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Total Time Update`;
DELIMITER //
CREATE TRIGGER `Total Time Update` BEFORE UPDATE ON `timelogs`
 FOR EACH ROW SET NEW.total_time = TIMEDIFF(NEW.time_out, NEW.time_in)
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
