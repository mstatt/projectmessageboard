-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Server version: 5.1.68-community-log
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_communication`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblMessages`
--

CREATE TABLE IF NOT EXISTS `tblMessages` (
  `strMessageID` varchar(36) NOT NULL DEFAULT '',
  `strProjectID` varchar(36) DEFAULT NULL,
  `strmsgAuthor` varchar(100) NOT NULL,
  `strmsgDelegates` varchar(5000) NOT NULL,
  `strmsgType` varchar(50) CHARACTER SET ascii NOT NULL,
  `strMessage` longtext NOT NULL,
  `fileDocument` blob NOT NULL,
  `strDocumentName` varchar(200) NOT NULL,
  `origMsgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`strMessageID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblMessages`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblProjectGroupTypes`
--

CREATE TABLE IF NOT EXISTS `tblProjectGroupTypes` (
  `UUIDGroup` varchar(40) NOT NULL,
  `ProjectUUID` varchar(40) DEFAULT NULL,
  `strGroupName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UUIDGroup`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblProjectGroupTypes`
--

INSERT INTO `tblProjectGroupTypes` (`UUIDGroup`, `ProjectUUID`, `strGroupName`) VALUES
('6871f585-f9e1-2839-233d-dd478833b4ca', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'PROJECT LEADERSHIP'),
('1044c6f5-7fbf-54ce-e7a9-d7f235b75a0b', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'QUALITY ASSURANCE'),
('c1818433-f526-deb2-9fed-c31a1d2b8027', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'SYSTEMS ANALYST'),
('c2c88531-d6a4-371c-9115-242f8e1cc1fc', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'SOFTWARE DEVELOPER'),
('edd2a636-70a1-98e8-42ac-d7f9f555e3f0', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'TESTERS'),
('c0b57533-82ee-7682-9be1-a14827d2b49b', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'STEERING COMMITTEE'),
('31950e3f-66b6-ea1f-2f93-e39308404a1c', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'DATABASE ADMINS'),
('f27d8721-58e4-af25-785a-82db3d363534', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'NETWORK TECHNICIAN'),
('f6a24e8d-9270-a1bc-0f11-4bcda43bc834', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'AUXILLARY UNIT'),
('82317012-378d-8b6b-3942-ccb710620e6e', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'BUSINESS UNIT'),
('797eb3ac-5d54-4386-c141-e281ce9893a0', 'd60a8e43-f6d6-454a-afce-d67c07d60a8e', 'ENTERPRISE ARCHITECT ');

-- --------------------------------------------------------

--
-- Table structure for table `tblProjects`
--

CREATE TABLE IF NOT EXISTS `tblProjects` (
  `UIDProjects` varchar(40) NOT NULL,
  `strProjectName` varchar(100) NOT NULL,
  PRIMARY KEY (`UIDProjects`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblProjects`
--

INSERT INTO `tblProjects` (`UIDProjects`, `strProjectName`) VALUES
('d60a8e43-f6d6-454a-afce-d67c07d60a8e', 'Project Communications');

-- --------------------------------------------------------

--
-- Table structure for table `tblProjectUserGroups`
--

CREATE TABLE IF NOT EXISTS `tblProjectUserGroups` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `GroupUUID` varchar(40) NOT NULL,
  `UserUUID` varchar(40) NOT NULL,
  `UIDProjects` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tblProjectUserGroups`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Auth`
--

CREATE TABLE IF NOT EXISTS `tbl_Auth` (
  `UUIDUSER` varchar(40) NOT NULL,
  `str_Username` varchar(50) NOT NULL DEFAULT '',
  `str_pass` varchar(50) NOT NULL DEFAULT '',
  `int_Status` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `int_User_ID` (`UUIDUSER`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_Auth`
--

INSERT INTO `tbl_Auth` (`UUIDUSER`, `str_Username`, `str_pass`, `int_Status`) VALUES
('27f82bfd-29ff-48d0-9dd0-91432527f82bfd-2', 'admin@admin.com', 'password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Users`
--

CREATE TABLE IF NOT EXISTS `tbl_Users` (
  `UUIDUSER` varchar(40) NOT NULL,
  `str_Fname` varchar(50) NOT NULL DEFAULT '',
  `str_Lname` varchar(50) NOT NULL DEFAULT '',
  `str_Email` varchar(50) NOT NULL DEFAULT '',
  `int_User_Level` int(11) NOT NULL DEFAULT '0' COMMENT 'Access level of system users',
  `strMobilePhone` varchar(14) DEFAULT NULL,
  `strOfficePhone` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`UUIDUSER`),
  UNIQUE KEY `UUIDUSER` (`UUIDUSER`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_Users`
--

INSERT INTO `tbl_Users` (`UUIDUSER`, `str_Fname`, `str_Lname`, `str_Email`, `int_User_Level`, `strMobilePhone`, `strOfficePhone`) VALUES
('27f82bfd-29ff-48d0-9dd0-91432527f82bfd-2', 'System', 'Admin ', 'admin@admin.com', 3, '(000) 000-0000', '(000) 000-0000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
