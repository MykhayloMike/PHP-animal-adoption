-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2015 at 12:13 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angusdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptionrequest`
--

CREATE TABLE IF NOT EXISTS `adoptionrequest` (
  `adoptionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` varchar(50) DEFAULT NULL,
  `animalID` int(11) NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`adoptionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `adoptionrequest`
--

INSERT INTO `adoptionrequest` (`adoptionID`, `userID`, `animalID`, `approved`) VALUES
(1, '1', 1, 1),
(2, '1', 2, NULL),
(3, '1', 4, NULL),
(5, '1', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE IF NOT EXISTS `animal` (
  `animalId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `dateofbirth` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `animalType` varchar(50) NOT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`animalId`),
  UNIQUE KEY `animalId` (`animalId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animalId`, `name`, `dateofbirth`, `description`, `animalType`, `photo`, `available`) VALUES
(1, 'Honey Badger', '2015-05-04 00:00:00', 'The honey badger, also known as the ratel, is a species of mustelid native to Africa, Southwest Asia, and the Indian subcontinent.', ' Land', NULL, 0),
(2, 'Baboon', '2015-03-10 00:00:00', 'The Baboon is a medium to large sized species of Old World Monkey that is found in a variety of different habitats throughout Africa and in parts of Arabia.', 'Land', NULL, 0),
(3, 'Chimpanzee', '2015-02-02 00:00:00', 'The Chimpanzee is a species of ape that is natively found in a variety of different habitats in western and central Africa. ', 'Land', NULL, 0),
(4, 'Cat', '2015-06-01 00:00:00', 'The cat has 4 legs.', 'Land', NULL, 0),
(5, 'Dog', '2015-04-14 00:00:00', 'The dog has 4 legs.', 'Land', NULL, 1),
(6, 'Dolphin', '2015-04-07 00:00:00', 'Dolphins are cetacean mammals closely related to whales and porpoises.', 'Water', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

CREATE TABLE IF NOT EXISTS `own` (
  `userId` varchar(50) DEFAULT NULL,
  `animalId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `own`
--

INSERT INTO `own` (`userId`, `animalId`) VALUES
('1', 1),
('1', 6),
('2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` varchar(50) NOT NULL DEFAULT '',
  `staff` tinyint(1) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `staff`, `password`) VALUES
('1', 0, 'user1'),
('2', 1, 'user2'),
('username5', 0, 'password5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
