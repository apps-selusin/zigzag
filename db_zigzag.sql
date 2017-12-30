-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2017 at 07:46 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_zigzag`
--

-- --------------------------------------------------------

--
-- Table structure for table `t01_ajudok`
--

CREATE TABLE IF NOT EXISTS `t01_ajudok` (
  `ajudok_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_urut` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`ajudok_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t96_userlevelpermissions`
--

CREATE TABLE IF NOT EXISTS `t96_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t96_userlevelpermissions`
--

INSERT INTO `t96_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php', 8),
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf99_underconstruction.php', 8),
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok', 8),
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t96_userlevelpermissions', 0),
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t97_userlevels', 0),
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t98_employees', 0),
(-2, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t99_audittrail', 0),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf01_home.php', 8),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}cf99_underconstruction.php', 8),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t01_ajudok', 8),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t96_userlevelpermissions', 0),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t97_userlevels', 0),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t98_employees', 0),
(0, '{DD5F1A59-0600-49F5-9773-CB635EB1CBA9}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE IF NOT EXISTS `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL,
  PRIMARY KEY (`userlevelid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_employees`
--

CREATE TABLE IF NOT EXISTS `t98_employees` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext,
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `t98_employees`
--

INSERT INTO `t98_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE IF NOT EXISTS `t99_audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2017-12-27 15:52:14', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2017-12-27 15:52:20', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(3, '2017-12-27 15:52:21', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2017-12-27 15:52:28', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(5, '2017-12-27 15:53:22', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(6, '2017-12-27 15:55:31', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(7, '2017-12-27 15:55:55', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(8, '2017-12-27 15:56:27', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(9, '2017-12-27 15:56:46', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(10, '2017-12-27 15:56:51', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(11, '2017-12-27 15:57:14', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(12, '2017-12-27 15:57:55', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(13, '2017-12-27 16:05:20', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(14, '2017-12-27 16:16:01', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(15, '2017-12-27 16:16:14', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(16, '2017-12-27 16:30:46', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(17, '2017-12-27 16:30:47', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(18, '2017-12-27 16:56:10', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(19, '2017-12-27 16:56:13', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(20, '2017-12-27 17:14:23', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(21, '2017-12-27 17:25:16', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(22, '2017-12-27 17:26:11', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(23, '2017-12-27 17:30:42', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(24, '2017-12-27 17:30:54', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(25, '2017-12-27 17:44:51', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(26, '2017-12-27 17:44:58', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(27, '2017-12-27 17:45:15', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(28, '2017-12-27 17:45:18', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(29, '2017-12-27 18:50:48', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(30, '2017-12-27 18:51:03', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(31, '2017-12-27 18:52:19', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(32, '2017-12-27 18:52:38', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(33, '2017-12-27 18:53:07', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(34, '2017-12-27 18:54:21', '/zigzag/login.php', 'admin', 'login', '::1', '', '', '', ''),
(35, '2017-12-27 18:56:30', '/zigzag/logout.php', 'admin', 'logout', '::1', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
