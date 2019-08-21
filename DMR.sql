-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2019 at 02:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DMR`
--

-- --------------------------------------------------------

--
-- Table structure for table `cont`
--

CREATE TABLE `cont` (
  `aei` varchar(22) NOT NULL,
  `rn` varchar(22) NOT NULL,
  `rqi` varchar(22) NOT NULL,
  `to_` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cont`
--

INSERT INTO `cont` (`aei`, `rn`, `rqi`, `to_`) VALUES
('/S108653822141', 'cont_monitor01', 'm_createCont291286', '/CSE3409165/farm_gatew'),
('/S108653822141', 'gateway_ae', 'm_createCont291286', '/CSE3409165/farm_gatew');

-- --------------------------------------------------------

--
-- Table structure for table `con_ins`
--

CREATE TABLE `con_ins` (
  `con` varchar(22) NOT NULL,
  `cnf` varchar(22) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `con_ins`
--

INSERT INTO `con_ins` (`con`, `cnf`, `datetime`) VALUES
('25', 'text/plains:0', '2019-04-18 12:28:07'),
('25', 'text/plains:0', '2019-04-18 12:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `aei` varchar(22) NOT NULL,
  `api` varchar(22) NOT NULL,
  `rn` varchar(22) NOT NULL,
  `rr` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`aei`, `api`, `rn`, `rr`, `timestamp`) VALUES
('/S336593381621', 'C01.com.farm.app01', 'gateway_ae', '1', '2019-04-18 11:14:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cont`
--
ALTER TABLE `cont`
  ADD PRIMARY KEY (`rn`),
  ADD KEY `aei` (`aei`);

--
-- Indexes for table `con_ins`
--
ALTER TABLE `con_ins`
  ADD KEY `datetime` (`datetime`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`aei`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
