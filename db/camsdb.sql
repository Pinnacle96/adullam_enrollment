-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2024 at 10:06 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pgapplications`
--

DROP TABLE IF EXISTS `pgapplications`;
CREATE TABLE IF NOT EXISTS `pgapplications` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `UserId` char(10) NOT NULL,
  `Adm_no` varchar(250) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(120) DEFAULT NULL,
  `contadd` varchar(120) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `state` varchar(120) DEFAULT NULL,
  `country` varchar(120) DEFAULT NULL,
  `postalcode` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `Nationality` varchar(120) DEFAULT NULL,
  `salvation` varchar(200) DEFAULT NULL,
  `conversion` varchar(200) DEFAULT NULL,
  `ministry` varchar(350) NOT NULL,
  `calltoministry` varchar(350) NOT NULL,
  `spiritual` varchar(120) DEFAULT NULL,
  `reasons` varchar(120) DEFAULT NULL,
  `churchName` varchar(120) DEFAULT NULL,
  `churchAddress` varchar(120) DEFAULT NULL,
  `ministerName` varchar(120) DEFAULT NULL,
  `ministerEmail` varchar(120) DEFAULT NULL,
  `ministerPhone` varchar(120) DEFAULT NULL,
  `churchActivities` varchar(120) DEFAULT NULL,
  `bwater` varchar(120) DEFAULT NULL,
  `bwaterDate` varchar(120) DEFAULT NULL,
  `tongues` varchar(120) DEFAULT NULL,
  `programApplied` varchar(120) DEFAULT NULL,
  `learningOption` varchar(120) DEFAULT NULL,
  `disability` varchar(120) DEFAULT NULL,
  `mentalIllness` varchar(120) DEFAULT NULL,
  `eatingDisorder` varchar(120) DEFAULT NULL,
  `medicalProblem` varchar(120) DEFAULT NULL,
  `prescribedMed` varchar(120) DEFAULT NULL,
  `specialDiet` varchar(120) DEFAULT NULL,
  `learningDisability` varchar(120) DEFAULT NULL,
  `hobbies` varchar(120) DEFAULT NULL,
  `workExperience` varchar(120) DEFAULT NULL,
  `emergencyName` varchar(120) DEFAULT NULL,
  `emergencyPhone` varchar(120) DEFAULT NULL,
  `emergencyEmail` varchar(120) DEFAULT NULL,
  `ref1Name` varchar(120) DEFAULT NULL,
  `ref1Phone` varchar(120) DEFAULT NULL,
  `ref1Email` varchar(120) DEFAULT NULL,
  `ref2Name` varchar(120) DEFAULT NULL,
  `ref2Phone` varchar(120) DEFAULT NULL,
  `ref2Email` varchar(120) DEFAULT NULL,
  `accommodation` varchar(120) DEFAULT NULL,
  `agreement` varchar(120) DEFAULT NULL,
  `birthCert` varchar(120) DEFAULT NULL,
  `lgaCert` varchar(120) DEFAULT NULL,
  `refLetter` varchar(120) DEFAULT NULL,
  `acadCert` varchar(120) DEFAULT NULL,
  `receipt` varchar(120) DEFAULT NULL,
  `programApplieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` varchar(255) DEFAULT NULL,
  `FeeAmount` decimal(10,0) DEFAULT NULL,
  `AdminStatus` varchar(20) DEFAULT NULL,
  `AdminRemarkDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `userpic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbladmapplications`
--

DROP TABLE IF EXISTS `tbladmapplications`;
CREATE TABLE IF NOT EXISTS `tbladmapplications` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `UserId` char(10) NOT NULL,
  `title` varchar(120) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(120) DEFAULT NULL,
  `contadd` varchar(120) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `state` varchar(120) DEFAULT NULL,
  `country` varchar(120) DEFAULT NULL,
  `postalcode` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `Nationality` varchar(120) DEFAULT NULL,
  `salvation` varchar(200) DEFAULT NULL,
  `conversion` varchar(200) DEFAULT NULL,
  `ministry` varchar(350) NOT NULL,
  `calltoministry` varchar(350) NOT NULL,
  `spiritual` varchar(120) DEFAULT NULL,
  `reasons` varchar(120) DEFAULT NULL,
  `churchName` varchar(120) DEFAULT NULL,
  `churchAddress` varchar(120) DEFAULT NULL,
  `ministerName` varchar(120) DEFAULT NULL,
  `ministerEmail` varchar(120) DEFAULT NULL,
  `ministerPhone` varchar(120) DEFAULT NULL,
  `churchActivities` varchar(120) DEFAULT NULL,
  `bwater` varchar(120) DEFAULT NULL,
  `bwaterDate` varchar(120) DEFAULT NULL,
  `tongues` varchar(120) DEFAULT NULL,
  `programApplied` varchar(120) DEFAULT NULL,
  `learningOption` varchar(120) DEFAULT NULL,
  `disability` varchar(120) DEFAULT NULL,
  `mentalIllness` varchar(120) DEFAULT NULL,
  `eatingDisorder` varchar(120) DEFAULT NULL,
  `medicalProblem` varchar(120) DEFAULT NULL,
  `prescribedMed` varchar(120) DEFAULT NULL,
  `specialDiet` varchar(120) DEFAULT NULL,
  `learningDisability` varchar(120) DEFAULT NULL,
  `hobbies` varchar(120) DEFAULT NULL,
  `workExperience` varchar(120) DEFAULT NULL,
  `emergencyName` varchar(120) DEFAULT NULL,
  `emergencyPhone` varchar(120) DEFAULT NULL,
  `emergencyEmail` varchar(120) DEFAULT NULL,
  `ref1Name` varchar(120) DEFAULT NULL,
  `ref1Phone` varchar(120) DEFAULT NULL,
  `ref1Email` varchar(120) DEFAULT NULL,
  `ref2Name` varchar(120) DEFAULT NULL,
  `ref2Phone` varchar(120) DEFAULT NULL,
  `ref2Email` varchar(120) DEFAULT NULL,
  `accommodation` varchar(120) DEFAULT NULL,
  `agreement` varchar(120) DEFAULT NULL,
  `birthCert` varchar(120) DEFAULT NULL,
  `lgaCert` varchar(120) DEFAULT NULL,
  `refLetter` varchar(120) DEFAULT NULL,
  `acadCert` varchar(120) DEFAULT NULL,
  `receipt` varchar(120) DEFAULT NULL,
  `programApplieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` varchar(255) DEFAULT NULL,
  `FeeAmount` decimal(10,0) DEFAULT NULL,
  `AdminStatus` varchar(20) DEFAULT NULL,
  `AdminRemarkDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `userpic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmapplications`
--

INSERT INTO `tbladmapplications` (`ID`, `UserId`, `title`, `dob`, `gender`, `contadd`, `city`, `state`, `country`, `postalcode`, `phone`, `Nationality`, `salvation`, `conversion`, `ministry`, `calltoministry`, `spiritual`, `reasons`, `churchName`, `churchAddress`, `ministerName`, `ministerEmail`, `ministerPhone`, `churchActivities`, `bwater`, `bwaterDate`, `tongues`, `programApplied`, `learningOption`, `disability`, `mentalIllness`, `eatingDisorder`, `medicalProblem`, `prescribedMed`, `specialDiet`, `learningDisability`, `hobbies`, `workExperience`, `emergencyName`, `emergencyPhone`, `emergencyEmail`, `ref1Name`, `ref1Phone`, `ref1Email`, `ref2Name`, `ref2Phone`, `ref2Email`, `accommodation`, `agreement`, `birthCert`, `lgaCert`, `refLetter`, `acadCert`, `receipt`, `programApplieddate`, `AdminRemark`, `FeeAmount`, `AdminStatus`, `AdminRemarkDate`, `userpic`) VALUES
(1, '1', 'Mr.', '1996-09-05', 'Male', 'Makurdi', 'ogbomoso', 'Oyo', 'Nigeria', '910003', '+2347019904438', 'Nigerian', 'Yes', 'saved', 'No', 'Yes', 'singing', 'love', 'adullam', 'makurdi', 'iduh Arome', 'aromeiduh@gmail.com', '070454464596', 'media', 'Yes', '2012-12-28', 'Yes', 'Certificate', 'On-Campus', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'singing', 'i sing', 'Noah', '08066503294', 'noah.peoni@gmail.com', 'adullam', '070700080606', 'adullam@gmail.com', 'daniel', '00054059459', 'daniel@gmail.com', 'Yes', 'Yes', '8ffa14d3a654a1f61e80695eae0fb1ba.pdf', '74e0d88e533dbf762324219a9e5bc3e3.pdf', '3f613d593cb0ea550d38cdb3d089710c.pdf', '74e0d88e533dbf762324219a9e5bc3e3.pdf', '29ef83667143e6fd283b9b66a2a47c3d.jpg', '2024-07-22 15:41:19', 'Admitted', 0, '1', '2024-07-29 12:59:48', 'ee752ebf4e6725eff570b067f5c32f44.jpg'),
(8, '10', 'Mr', '2003-04-14', 'Male', 'auchi', 'auchi', 'Benin', 'Nigeria', '3446966', '+2347032078859', 'Nigerian', 'Yes', 'fjghjfghdfgjsdf', 'No', 'Yes', 'word of wisdom', 'lord', 'jfdjfdfdf', 'gfgdhghsg', 'Sunday ', 'sunday@gmail.com', '00070707', 'Choir', 'Yes', '2021-07-07', 'Yes', 'Postgraduate Degree', 'Online', 'No', 'No', 'No', 'No', 'No', 'Yes', 'Yes', 'Playing', 'Awesome ', 'ggfgjgefg', '0808077', 'sund@mail.com', 'noah', '7077', '7oi7i@mail.com', 'noah', '8009', '7oi7i@mail.com', 'No', 'Yes', '843654fc45ceec458e5e255201a0dcfc.jpg', '6f1d15837029fc536864c65136aea28d.jpg', '12f914740c42acbccbd3eef45f41dbf0.pdf', '67b4c6998122816902aa2ad98eeb0137.jpg', '34dd7314012606fec949e37c2c930073.jpg', '2024-07-29 11:54:15', 'Admitted', 20, '1', '2024-07-29 12:12:29', '9c010471f5a43ccd8e0a94d9ab707b1f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) NOT NULL,
  `MobileNumber` varchar(120) DEFAULT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Noah Abayomi', 'Admin', '2147483647', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2024-07-22 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

DROP TABLE IF EXISTS `tblcontact`;
CREATE TABLE IF NOT EXISTS `tblcontact` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `PhoneNumber` bigint DEFAULT NULL,
  `Message` mediumtext,
  `EnquiryDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsRead` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `PhoneNumber`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Kiran', 'kran@gmail.com', NULL, 'cost of volvo place pritampura to dwarka', '2021-07-05 07:26:24', 1),
(2, 'Sarita Pandey', 'sar@gmail.com', NULL, 'huiyuihhjjkhkjvhknv iyi tuyvuoiup', '2021-07-09 12:48:40', 1),
(3, 'Test', 'test@gmail.com', NULL, 'Want to know price of forest cake', '2021-07-16 12:51:06', 1),
(4, 'Anuj', 'ak330@gmail.com', NULL, 'This is for testing.', '2021-07-18 14:35:50', 1),
(5, 'Nikhil', 'nk@gmail.com', 7798799999, 'hello', '2022-02-28 04:26:49', 1),
(6, 'Anuj', 'ak@gmail.com', 1234567890, 'This is for testing', '2022-03-04 01:29:21', 1),
(7, 'Test', 'test@gmail.com', 12365478910, 'This iis for testing', '2022-03-04 01:45:01', 1),
(8, 'Subhan Raj', 'shubhanraj2002@gmail.com', 9450430095, 'a', '2023-05-19 19:08:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

DROP TABLE IF EXISTS `tblcourse`;
CREATE TABLE IF NOT EXISTS `tblcourse` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `degree` varchar(250) DEFAULT NULL,
  `CourseName` varchar(90) DEFAULT NULL,
  `program` varchar(250) DEFAULT NULL,
  `CourseDescription` mediumtext,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `CourseName` (`CourseName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `degree`, `CourseName`, `program`, `CourseDescription`, `CreationDate`) VALUES
(1, 'Undergraduate', 'Certificate', 'Certificate in Theology', '<b>WHAT YOU WILL LEARN</b><br>\r\n- Establish believers in the foundation of the Christian Faith<br>\r\n- Develop spiritual stamina for Christian living in a failing world<br>\r\n- Develop skills in critical theological research writing.<br>\r\n<b>PROGRAM OPTION</b><br>\r\nWe offer two program options:<br>\r\n- On-Campus: The On-Campus option is a full residency program. The academic activities have three requirements: a class attendance, a ministry practicum and a Field Trip.<br>\r\n- Online: The Online program was created in response to the global needs for spiritual training and equipping of those who cannot make it for the residency On-Campus option. Although designed to be still engaging and impactful, its duration is adjusted and compatible for the work and family demands of everyday life.<br>\r\n\r\n<b>PROGRAM LENGTH</b><br>\r\n- Certificate - 1 year (2 semesters)<br>\r\n<b>ADMISSION REQUIREMENTS</b><br>\r\n- A $10 non-refundable application fee<br>\r\n- A completed Application form (available online)<br>\r\n- A minimum of a Secondary School Certificate or its equivalent<br>\r\n- Two referees<br>\r\n- All International students that wish to learn On-Campus are required to apply for and secure a student visa for the duration of their study in the Nigerian Embassy in their country before travelling in<br>\r\n<b>ENTRY REQUIREMENT</b><br>\r\n- Able to read and write in English Language<br>\r\n- A minimum of a Secondary School Certificate\r\nor its equivalent (For those who are 18 years old or above; if they do not have a Secondary School Certificate, he/she must pass the mature candidate’s exam.)<br>\r\n- Minimum 2 years of ministry experience - Two referees.<hr>\r\n <a class=\"btn btn-secondary btn-theme2 mt-md-5 mt-4\" href=\"user/login.php\">Apply</a>', '2024-07-22 12:30:00'),
(2, 'Undergraduate', 'Diploma', 'Diploma in Theology', '<b>WHAT YOU WILL LEARN</b><br>\r\n- Establish believers in the foundation of the Christian Faith<br>\r\n- Develop spiritual stamina for Christian living in a failing world<br>\r\n- Develop skills in critical theological research writing.<br>\r\n<b>PROGRAM OPTION</b><br>\r\nWe offer two program options:<br>\r\n- On-Campus: The On-Campus option is a full residency program. The academic activities have three requirements: a class attendance, a ministry practicum and a Field Trip.<br>\r\n- Online: The Online program was created in response to the global needs for spiritual training and equipping of those who cannot make it for the residency On-Campus option. Although designed to be still engaging and impactful, its duration is adjusted and compatible for the work and family demands of everyday life.<br>\r\n\r\n<b>PROGRAM LENGTH</b><br>\r\n- Certificate - 2 year (4 semesters)<br>\r\n<b>ADMISSION REQUIREMENTS</b><br>\r\n- A $10 non-refundable application fee<br>\r\n- A completed Application form (available online)<br>\r\n- A minimum of a Secondary School Certificate or its equivalent<br>\r\n- Two referees<br>\r\n- All International students that wish to learn On-Campus are required to apply for and secure a student visa for the duration of their study in the Nigerian Embassy in their country before travelling in<br>\r\n<b>ENTRY REQUIREMENT</b><br>\r\n- Able to read and write in English Language<br>\r\n- A minimum of a Secondary School Certificate\r\nor its equivalent (For those who are 18 years old or above; if they do not have a Secondary School Certificate, he/she must pass the mature candidate’s exam.)<br>\r\n- Minimum 2 years of ministry experience - Two referees.<hr>\r\n <a class=\"btn btn-secondary btn-theme2 mt-md-5 mt-4\" href=\"user/login.php\">Apply</a>', '2024-07-22 12:30:00'),
(3, 'Undergraduate', 'BTH', 'Bachelor of Theology', '<b>WHAT YOU WILL LEARN</b><br>\r\n- Establish believers in the foundation of the Christian Faith<br>\r\n- Develop spiritual stamina for Christian living in a failing world<br>\r\n- Develop skills in critical theological research writing.<br>\r\n<b>PROGRAM OPTION</b><br>\r\nWe offer two program options:<br>\r\n- On-Campus: The On-Campus option is a full residency program. The academic activities have three requirements: a class attendance, a ministry practicum and a Field Trip.<br>\r\n- Online: The Online program was created in response to the global needs for spiritual training and equipping of those who cannot make it for the residency On-Campus option. Although designed to be still engaging and impactful, its duration is adjusted and compatible for the work and family demands of everyday life.<br>\r\n\r\n<b>PROGRAM LENGTH</b><br>\r\n- Certificate - 4 year (8 semesters)<br>\r\n<b>ADMISSION REQUIREMENTS</b><br>\r\n- A $10 non-refundable application fee<br>\r\n- A completed Application form (available online)<br>\r\n- A minimum of a Secondary School Certificate or its equivalent<br>\r\n- Two referees<br>\r\n- All International students that wish to learn On-Campus are required to apply for and secure a student visa for the duration of their study in the Nigerian Embassy in their country before travelling in<br>\r\n<b>ENTRY REQUIREMENT</b><br>\r\n- Able to read and write in English Language<br>\r\n- A minimum of a Secondary School Certificate\r\nor its equivalent (For those who are 18 years old or above; if they do not have a Secondary School Certificate, he/she must pass the mature candidate’s exam.)<br>\r\n- Minimum 2 years of ministry experience - Two referees.<hr>\r\n <a class=\"btn btn-secondary btn-theme2 mt-md-5 mt-4\" href=\"user/login.php\">Apply</a>', '2024-07-22 12:30:00'),
(4, 'Postgraduate', 'PGDT', 'Postgraduate Diploma in Theology', '<b>WHAT YOU WILL LEARN</b><br>\r\n- Develop foundational understanding of Biblical Truth<br>\r\n- Develop contemporary strategies for effective Ministry within various contexts<br>\r\n- How to engage in high-level, publishable critical research, analysis, and writing about theology and its related discipline<br>\r\n<b>PROGRAM OPTION AVAILABLE</b><br>\r\n\r\nWe offer two program options:<br>\r\n- On-campus: The On-campus option is a full residency program. The academic activities has three requirements: a class attendance, a ministry practicum and Field Trip<br>\r\n- Online: The Online program was created in response to the global needs for spiritual training and equipping of those who cannot make it for the residency On-campus option. Although designed to be still engaging and impactful, its duration is extended more than the On-campus option, and compatible for the work and family demands of everyday life.<br>\r\n\r\n<b>PROGRAM LENGTH</b><br>\r\nCampus option: 12 months (with two semesters)<br>\r\nOnline Option: 15 months (with two semesters)<br>\r\n\r\n<b>ADMISSION REQUIREMENTS</b><br>\r\n- A $20 non-refundable application fee<br>\r\n- A completed Application form (available online)<br>\r\n- A minimum of a Bachelor’s degree or its equivalent<br>\r\n- Two referees<br>\r\n- All International students that wish to learn On-campus are required to apply for and secure a student visa for the duration of their study in the Nigerian Embassy in their country before travelling in<br>\r\n<b>Fees</b><br>\r\nOn campus program fees<br>\r\nTuition Fees - $8 to $10 per credit\r\n <hr>\r\n<a class=\"btn btn-secondary btn-theme2 mt-md-5 mt-4\" href=\"user/login.php\">Apply</a>', '2024-07-22 12:30:00'),
(5, 'Postgraduate', 'M.DIV', 'Master of Divinity', 'The Master of Divinity (M.DIV) program is a Two-year postgraduate degree that provides a comprehensive understanding divinity.<hr>\r\n <a class=\"btn btn-secondary btn-theme2 mt-md-5 mt-4\" href=\"user/login.php\">Apply</a>', '2024-07-22 12:30:00'),
(6, 'Postgraduate', 'M.Theology', 'Master of Theology', 'Master of Theology(M.TH) program is a Two-year postgraduate degree that provides a comprehensive understanding Theology.<hr>\r\n<a class=\"btn btn-secondary btn-theme2 mt-md-5 mt-4\" href=\"user/login.php\">Apply</a>', '2024-07-22 12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblfees`
--

DROP TABLE IF EXISTS `tblfees`;
CREATE TABLE IF NOT EXISTS `tblfees` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `UserID` int DEFAULT NULL,
  `PaymentAmount` decimal(10,0) DEFAULT NULL,
  `ModeofPayments` varchar(200) DEFAULT NULL,
  `TransactionNumber` int DEFAULT NULL,
  `DateofTransaction` date DEFAULT NULL,
  `SubmissionDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfees`
--

INSERT INTO `tblfees` (`ID`, `UserID`, `PaymentAmount`, `ModeofPayments`, `TransactionNumber`, `DateofTransaction`, `SubmissionDate`) VALUES
(6, 8, 20, 'Debit Card', 2147483647, '2024-07-22', '2024-07-22 18:56:33'),
(7, 10, 20, 'Debit Card', 406, '2024-07-29', '2024-07-29 12:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblmanage`
--

DROP TABLE IF EXISTS `tblmanage`;
CREATE TABLE IF NOT EXISTS `tblmanage` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(120) NOT NULL,
  `MobileNumber` varchar(120) DEFAULT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmanage`
--

INSERT INTO `tblmanage` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Noah Abayomi', 'Admin', '2147483647', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2024-07-22 11:00:00'),
(3, 'Olajide Bakare', 'adullam', '2147483647', 'olajidebakare@gmail.com', '$2y$10$odraOf4Xj9f0mIDzu5rSfORMgGOrgxD/2iz1NRiNCo.TLoiSCgSzi', '2024-07-29 13:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

DROP TABLE IF EXISTS `tblnotice`;
CREATE TABLE IF NOT EXISTS `tblnotice` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Title` varchar(250) DEFAULT NULL,
  `Decription` varchar(350) DEFAULT NULL,
  `blogpic` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`ID`, `Title`, `Decription`, `blogpic`, `CreationDate`) VALUES
(5, 'Scholarship Application Deadline Extended', 'Important Announcement: The deadline for scholarship applications has been extended to [new deadline date]. This extension provides eligible students with additional time to submit their applications. Don\'t miss this opportunity to avail yourself of financial assistance. Visit the scholarship office or the university website for more information', NULL, '2023-05-19 20:01:04'),
(6, 'Career Fair Announcement', 'Calling all students and recent graduates! We are excited to announce our upcoming Career Fair on [date]. This event will provide an excellent opportunity to meet and network with top employers from various industries. Come prepared with your resumes and dress professionally. Don\'t miss out on this chance to explore potential career opportunities!', NULL, '2023-05-19 20:01:38'),
(9, 'Admission for January 2025 intake is Now Open ', 'Admission for January 2025 intake is Now Open ', '', '2024-07-24 14:37:54'),
(10, 'Admission ', 'Admission ', '', '2024-07-24 14:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

DROP TABLE IF EXISTS `tblpage`;
CREATE TABLE IF NOT EXISTS `tblpage` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext,
  `PageDescription` mediumtext,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'We are producing Kingdom foot soldiers.', '<b>RCN Theology Seminary</b><br>\r\n<b>Our Mission and Values</b>\r\n<br><br>\r\n<b>Our Mission Statement</b> <br>\r\nRCN Theological Seminary – Adullam exists to equip Christ-like leaders through sound biblical doctrine and theology, to bear accurate witness unto Jesus both within the Church and in the marketplace.\r\n<br><br>\r\n<b>Core Values</b><br>\r\nSound Biblical doctrine<br>\r\nIntercessory prayers<br>\r\nGodly lifestyle<br>\r\nAccurate witness', 'rcntsonline@gmail.com', 7032078859, NULL, ''),
(2, 'contactus', 'Contact Us', 'No 4, Remnant Avenue, Opposite State Library, Wurukum, Makurdi, Benue State', 'rcntsonline@gmail.com', 7032078859, NULL, '10:30 am to 7:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

DROP TABLE IF EXISTS `tblsubscriber`;
CREATE TABLE IF NOT EXISTS `tblsubscriber` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(200) DEFAULT NULL,
  `DateofSub` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `middleName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `degree` varchar(250) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FirstName`, `middleName`, `LastName`, `MobileNumber`, `degree`, `Email`, `Password`, `PostingDate`) VALUES
(1, 'Noah', 'Thomson', 'Drake', 7032078859, 'Undergraduate', 'noah.poeni@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2024-07-22 13:49:59'),
(10, 'Favour', 'Ojodomo', 'David', 9034345678, 'Postgraduate', 'joyacheme@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2024-07-29 07:54:30'),
(11, 'drake', 'john', 'adams', 7040606050, 'Undergraduate', 'john@gmail.ocm', '25d55ad283aa400af464c76d713c07ad', '2024-07-29 17:25:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
