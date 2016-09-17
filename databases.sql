-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2016 at 07:38 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Marketing-Calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `Calendars`
--

CREATE TABLE `Calendars` (
  `ID` int(11) NOT NULL,
  `Title` varchar(65) NOT NULL,
  `Rows` int(11) NOT NULL,
  `Cols` int(11) NOT NULL,
  `Owner` varchar(25) NOT NULL,
  `createdDate` datetime NOT NULL,
  `lastEditedBy` varchar(25) NOT NULL,
  `lastEditedDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Calendars`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cells`
--

CREATE TABLE `Cells` (
  `ID` int(11) NOT NULL,
  `Row` int(11) NOT NULL,
  `Col` int(11) NOT NULL,
  `Content` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cells`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Calendars`
--
ALTER TABLE `Calendars`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Calendars`
--
ALTER TABLE `Calendars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
