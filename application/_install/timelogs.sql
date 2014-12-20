-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 20, 2014 at 05:13 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `timelogs`
--

INSERT INTO `timelogs` (`id`, `contact_id`, `event_id`, `time_in`, `time_out`, `total_time`) VALUES
(68, 57, 1, '2014-12-20 16:56:00', '2014-12-20 16:56:48', 0.01),
(69, 59, 1, '2014-12-20 16:56:00', '2014-12-20 16:56:54', 0.02),
(70, 57, 1, '2014-12-20 17:00:00', '2014-12-20 17:10:00', 0.17);

--
-- Triggers `timelogs`
--
DROP TRIGGER IF EXISTS `Total Time Insert`;
DELIMITER //
CREATE TRIGGER `Total Time Insert` BEFORE INSERT ON `timelogs`
 FOR EACH ROW SET NEW.total_time = TIME_TO_SEC(TIMEDIFF(NEW.time_out, NEW.time_in))/3600
//
DELIMITER ;
DROP TRIGGER IF EXISTS `Total Time Update`;
DELIMITER //
CREATE TRIGGER `Total Time Update` BEFORE UPDATE ON `timelogs`
 FOR EACH ROW SET NEW.total_time = TIME_TO_SEC(TIMEDIFF(NEW.time_out, NEW.time_in))/3600
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
