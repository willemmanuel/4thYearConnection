-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2013 at 01:46 AM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs4750aac8mf`
--

-- --------------------------------------------------------

--
-- Table structure for table `City`
--

CREATE TABLE IF NOT EXISTS `City` (
  `cityName` varchar(26) NOT NULL,
  `state` varchar(2) NOT NULL,
  `population` int(11) NOT NULL,
  PRIMARY KEY (`cityName`,`state`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `City`
--

INSERT INTO `City` (`cityName`, `state`, `population`) VALUES
('Arlington', 'VA', 3),
('Austin', 'TX', 1),
('Boston', 'MA', 1),
('Charlotte', 'NC', 1),
('Charlottesville', 'VA', 0),
('Chesapeake', 'VA', 5),
('Denver', 'CO', 2),
('New York City', 'NY', 1),
('Richmond', 'VA', 2),
('Tampa', 'FL', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE IF NOT EXISTS `Company` (
  `companyName` varchar(26) NOT NULL,
  `population` int(11) DEFAULT NULL,
  PRIMARY KEY (`companyName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`companyName`, `population`) VALUES
('Bain', 1),
('CapTech', 2),
('Charlotte High School', 1),
('Colorado State Government ', 1),
('Deloitte', 3),
('Dropbox', 1),
('GE', 4),
('Microsoft', 1),
('Ping Identity', 1),
('Tampa Hospital', 1),
('WillowTree Apps', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lives_in`
--

CREATE TABLE IF NOT EXISTS `lives_in` (
  `computingID` varchar(16) NOT NULL,
  `cityName` varchar(26) NOT NULL,
  `state` varchar(2) NOT NULL,
  KEY `computingID` (`computingID`),
  KEY `cityName` (`cityName`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lives_in`
--

INSERT INTO `lives_in` (`computingID`, `cityName`, `state`) VALUES
('wre9fz', 'Tampa', 'FL'),
('aac8mf', 'Chesapeake', 'VA'),
('jds82u', 'Richmond', 'VA'),
('jsj6rt', 'Charlotte', 'NC'),
('poh9rl', 'Denver', 'CO'),
('erd3ed', 'Tampa', 'FL'),
('pmf7rs', 'Boston', 'MA'),
('rep5fs', 'New York City', 'NY'),
('ghs2yu', 'Arlington', 'VA'),
('loe8nc', 'Arlington', 'VA'),
('aqp6lk', 'Austin', 'TX'),
('cyc7ve', 'Arlington', 'VA'),
('opl9ws', 'Denver', 'CO'),
('nra3st', 'Richmond', 'VA');

-- --------------------------------------------------------

--
-- Table structure for table `member_of`
--

CREATE TABLE IF NOT EXISTS `member_of` (
  `computingID` varchar(16) NOT NULL,
  `cityName` varchar(26) NOT NULL,
  `state` varchar(2) NOT NULL,
  UNIQUE KEY `computingID_2` (`computingID`),
  KEY `computingID` (`computingID`),
  KEY `cityName` (`cityName`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_of`
--

INSERT INTO `member_of` (`computingID`, `cityName`, `state`) VALUES
('aac8mf', 'Chesapeake', 'VA'),
('wre9fz', 'Tampa', 'FL');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `toID` varchar(7) NOT NULL,
  `fromID` varchar(7) NOT NULL,
  `message` text NOT NULL,
  `subject` text,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`toID`, `fromID`, `message`, `subject`, `sent`) VALUES
('wre9fz', 'wre9fz', 'this is test', 'herro', '2013-11-30 19:32:01'),
('jas3kz', 'wre9fz', 'test message', 'test', '2013-12-01 16:45:12'),
('jas3kz', 'wre9fz', 'test3', 'test3', '2013-12-01 16:56:46'),
('jas3kz', 'wre9fz', 'test3', 'test3', '2013-12-01 16:56:56'),
('aac8mf', 'aac8mf', 'To you baby', 'From Self', '2013-12-01 18:18:56'),
('aac8mf', 'wre9fz', 'Test 123', 'Test', '2013-12-02 03:21:26'),
('aac8mf', 'wre9fz', 'ye', 'most recent on top', '2013-12-02 04:47:52'),
('aac8mf', 'naa9ak', 'Sup sup', 'Hello!', '2013-12-02 19:09:51'),
('aac8mf', 'wre9fz', 'a;lsdkfja;lskdjf;laksdjf;lkasdfjhweoriqupwoeirqwerb,qmwnerb,wnebr,mqnwebrluyvouycxiuvbwkenrbq,wer', 'WOAH ', '2013-12-03 02:43:09'),
('aac8mf', 'naa9ak', 'Test Message', 'TEST', '2013-12-03 03:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `offices_in`
--

CREATE TABLE IF NOT EXISTS `offices_in` (
  `companyName` varchar(26) NOT NULL,
  `cityName` varchar(26) NOT NULL,
  `state` varchar(2) NOT NULL,
  KEY `companyName` (`companyName`),
  KEY `cityName` (`cityName`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offices_in`
--

INSERT INTO `offices_in` (`companyName`, `cityName`, `state`) VALUES
('Deloitte', 'Tampa', 'FL'),
('GE', 'Tampa', 'FL'),
('GE', 'Chesapeake', 'VA'),
('CapTech', 'Richmond', 'VA'),
('Charlotte High School', 'Charlotte', 'NC'),
('Colorado State Government ', 'Denver', 'CO'),
('Tampa Hospital', 'Tampa', 'FL'),
('Microsoft', 'Boston', 'MA'),
('Bain', 'New York City', 'NY'),
('Deloitte', 'Arlington', 'VA'),
('Dropbox', 'Austin', 'TX'),
('Ping Identity', 'Denver', 'CO');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE IF NOT EXISTS `Person` (
  `computingID` varchar(16) NOT NULL,
  `firstName` varchar(26) NOT NULL,
  `lastName` varchar(26) NOT NULL,
  `major` varchar(25) DEFAULT NULL,
  `minor` varchar(25) DEFAULT NULL,
  `school` text NOT NULL,
  `searchRoom` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`computingID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`computingID`, `firstName`, `lastName`, `major`, `minor`, `school`, `searchRoom`) VALUES
('aac8mf', 'Alex', 'Charters', 'CS', '', 'CLAS', 0),
('aqp6lk', 'Ashley', 'Patterson', 'Public Policy', 'Statistics', 'PPOL', 0),
('cyc7ve', 'Christina', 'Chen', 'Accounting', '', 'COMM', 0),
('erd3ed', 'Emily', 'Duke', 'Nursing', '', 'NURS', 1),
('ghs2yu', 'Gary', 'Sullivan', 'Global Development', 'Economics', 'CLAS', 0),
('jds82u', 'John', 'Smith', 'Biology', '', 'CLAS', 1),
('jsj6rt', 'James', 'Johnson', 'Education', '', 'Curry', 0),
('loe8nc', 'Liz', 'Eve', 'Finance', 'Management', 'COMM', 1),
('nra3st', 'Nick', 'Allen', 'Global Development', 'CS', 'CLAS', 1),
('opl9ws', 'Olga', 'Lohn', 'Systems Engineering', '', 'ENGR', 0),
('pmf7rs', 'Parker', 'Fullerton', 'Math', 'CS', 'CLAS', 1),
('poh9rl', 'Paul', 'Heller', 'Urban Planning', '', 'ARCH', 1),
('rep5fs', 'Robert', 'Primeau', 'Economics', '', 'CLAS', 0),
('wre9fz', 'Will', 'Emmanuel', 'CS', '', 'CLAS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `cityName` varchar(26) NOT NULL,
  `state` varchar(2) NOT NULL,
  `subject` text,
  `message` text NOT NULL,
  `fromID` varchar(7) NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`cityName`, `state`, `subject`, `message`, `fromID`, `sent`) VALUES
('', '', 'test', 'test 123', 'wre9fz', '2013-12-02 06:34:59'),
('Tampa', 'FL', 'test', 'test', 'wre9fz', '2013-12-02 06:54:41'),
('Tampa', 'FL', 'Another Test', 'Hey guys what''s good ', 'wre9fz', '2013-12-03 04:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `UVAClub`
--

CREATE TABLE IF NOT EXISTS `UVAClub` (
  `clubName` varchar(26) NOT NULL,
  `cityName` varchar(26) NOT NULL,
  `state` varchar(2) NOT NULL,
  `contactMail` varchar(16) NOT NULL,
  `phoneNum` bigint(20) NOT NULL,
  PRIMARY KEY (`cityName`,`state`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UVAClub`
--

INSERT INTO `UVAClub` (`clubName`, `cityName`, `state`, `contactMail`, `phoneNum`) VALUES
('Peake Wahoos', 'Chesapeake', 'VA', 'aac8mf', 7573906988),
('Test Club', 'Tampa', 'FL', 'wre9fz', 123893993);

-- --------------------------------------------------------

--
-- Table structure for table `works_for`
--

CREATE TABLE IF NOT EXISTS `works_for` (
  `computingID` varchar(16) NOT NULL,
  `companyName` varchar(26) NOT NULL,
  `position` varchar(26) NOT NULL,
  KEY `computingID` (`computingID`),
  KEY `companyName` (`companyName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `works_for`
--

INSERT INTO `works_for` (`computingID`, `companyName`, `position`) VALUES
('wre9fz', 'GE', 'Software'),
('aac8mf', 'GE', 'CEO'),
('jds82u', 'CapTech', 'BSA'),
('jsj6rt', 'Charlotte High School', 'Teacher'),
('poh9rl', 'Colorado State Government ', 'Planner'),
('erd3ed', 'Tampa Hospital', 'Nurse'),
('pmf7rs', 'Microsoft', 'Program Manager'),
('rep5fs', 'Bain', 'Consultant'),
('ghs2yu', 'Deloitte', 'Consultant'),
('loe8nc', 'Deloitte', 'Consultant'),
('aqp6lk', 'Dropbox', 'Manager'),
('cyc7ve', 'Deloitte', 'Accountant'),
('opl9ws', 'Ping Identity', 'Developer'),
('nra3st', 'CapTech', 'BSA');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lives_in`
--
ALTER TABLE `lives_in`
  ADD CONSTRAINT `lives_in_ibfk_3` FOREIGN KEY (`state`) REFERENCES `City` (`state`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lives_in_ibfk_1` FOREIGN KEY (`computingID`) REFERENCES `Person` (`computingID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lives_in_ibfk_2` FOREIGN KEY (`cityName`) REFERENCES `City` (`cityName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_of`
--
ALTER TABLE `member_of`
  ADD CONSTRAINT `member_of_ibfk_1` FOREIGN KEY (`computingID`) REFERENCES `Person` (`computingID`),
  ADD CONSTRAINT `member_of_ibfk_2` FOREIGN KEY (`cityName`) REFERENCES `City` (`cityName`),
  ADD CONSTRAINT `member_of_ibfk_3` FOREIGN KEY (`state`) REFERENCES `City` (`state`);

--
-- Constraints for table `offices_in`
--
ALTER TABLE `offices_in`
  ADD CONSTRAINT `offices_in_ibfk_3` FOREIGN KEY (`state`) REFERENCES `City` (`state`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offices_in_ibfk_1` FOREIGN KEY (`companyName`) REFERENCES `Company` (`companyName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offices_in_ibfk_2` FOREIGN KEY (`cityName`) REFERENCES `City` (`cityName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `UVAClub`
--
ALTER TABLE `UVAClub`
  ADD CONSTRAINT `UVAClub_ibfk_1` FOREIGN KEY (`cityName`) REFERENCES `City` (`cityName`),
  ADD CONSTRAINT `UVAClub_ibfk_2` FOREIGN KEY (`state`) REFERENCES `City` (`state`);

--
-- Constraints for table `works_for`
--
ALTER TABLE `works_for`
  ADD CONSTRAINT `works_for_ibfk_2` FOREIGN KEY (`companyName`) REFERENCES `Company` (`companyName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `works_for_ibfk_1` FOREIGN KEY (`computingID`) REFERENCES `Person` (`computingID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
