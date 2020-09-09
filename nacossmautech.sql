-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2018 at 04:39 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nacossmautech`
--

-- --------------------------------------------------------

--
-- Table structure for table `already_voted`
--

CREATE TABLE `already_voted` (
  `id` int(11) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `presidency` varchar(255) NOT NULL,
  `vice_presidency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `already_voted`
--

INSERT INTO `already_voted` (`id`, `studentid`, `presidency`, `vice_presidency`) VALUES
(1, 'SULAIMAN', 'voted', ''),
(2, 'SULAIMAN', 'voted', ''),
(3, 'SULAIMAN', 'voted', ''),
(4, 'CSC/16U/4139', 'voted', ''),
(5, 'CSC/16U/4139', 'voted', ''),
(6, 'CSC/16U/4192', 'voted', ''),
(7, 'CSC/16U/4189', 'voted', ''),
(8, 'CSC/15U/3266', 'voted', ''),
(9, 'CSC/16U/4287', 'voted', '');

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `id` int(11) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `level` int(10) NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contestants`
--

INSERT INTO `contestants` (`id`, `studentid`, `fullname`, `nickname`, `password`, `gender`, `level`, `position`, `email`, `phone_number`, `photo`, `status`, `date`) VALUES
(6, 'CSC/16U/4133', 'MUHAMMAD NIBRAS KOLTAL', 'koltal', '$2y$10$sDOQIPYjvcQqXsrl1yOKteAckrVpEsLrskA9PF9Xm78ZiKsGopNkm', 'MALE', 200, 'PRESIDENT', 'sulaiman@sulaima.com', '09035494020', 'k3.jpg', 'approved', '2018-08-05 08:32:13'),
(7, 'CSC/16U/4132', 'AMINU SULAIMAN BARKINDO', 'nibras', '$2y$10$TXNCpd9kSbYPHpMMKaQzies5verA0FUH.tsIkfDA0Ibq2H/.eyBie', 'MALE', 100, 'PRESIDENT', 'sulaiman@sulaimam.com', '09035494020', 'fadeelah.jpg', 'approved', '2018-08-05 08:33:30'),
(9, 'SULAIMAN', 'AMINU SULAIMAN BARKINDO', 'baraatu', '$2y$10$12Qdl6GTiN.U/2lRMeFV9ek8EQP2sX2X2Vj0Qor1tWn3LGqo7Z4mG', 'MALE', 100, 'PRESIDENT', 'sulaimanaminu22@gmail.com', '09035494020', '8.jpg', 'approved', '2018-08-05 23:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `nacoss`
--

CREATE TABLE `nacoss` (
  `id` int(11) NOT NULL,
  `studentid` varchar(15) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `level` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nacoss`
--

INSERT INTO `nacoss` (`id`, `studentid`, `firstname`, `lastname`, `password`, `gender`, `level`, `email`, `phone_number`, `date`, `status`) VALUES
(12, 'SULAIMAN', 'SULAIMAN', 'AMINU BARKINDO', '$2y$10$vX3a.dzKSCDKtqhSo3YXcOjk3GDnjxa3kUP39QmfrRexj7WDegX26', 'MALE', 200, 'sulaimanaminu028@gmail.com', '09035494020', '06-08-2018 01:09:14', 'unvoted'),
(13, 'CSC/16U/4139', 'AMINU', 'SULAIMAN', '$2y$10$uBGOyYnDKVCl1.aoC7TsrOXgan0f2eBPlVCMsD5qeP8m6ExbzjDFi', 'MALE', 200, 'sulaimanaminu2019@gmail.com', '09035494020', '06-08-2018 13:18:04', 'unvoted'),
(14, 'CSC/16U/4192', 'SULAIMAN', 'AMINU', '$2y$10$gUAYkxm39iiMoadi2g4A8eTU2f3D3332zPl70ZebkXiESMr2PXlse', 'MALE', 200, 'sulaimanaminu2017@gmail.com', '09035494020', '06-08-2018 13:38:32', 'unvoted'),
(15, 'CSC/16U/4189', 'AMINU', 'SULAIMAN', '$2y$10$6IEoNKihYggnnrSDqyT81uXsSY9NdU68l/5YEGQFWSRSTV4DY7cJ.', 'MALE', 300, 'sulaimanaminu2010@gmail.com', '09035494020', '06-08-2018 14:11:19', 'unvoted'),
(16, 'CSC/15U/3266', 'GDSZGFDSF', 'HJJFJDFYF', '$2y$10$IoMpQOiixAtm8BwvyCNQ9ei/mELQDaGnRcGwGGyki4uLVxUuVBl3a', 'BVHJCSFC', 100, 'cfgfghfgcgfxhggdgf@gmail.com', '865454', '06-08-2018 14:24:06', 'unvoted'),
(17, 'CSC/16U/4287', 'UMAR', 'YUSUF', '$2y$10$W.sdJO1sdiUUlkLHSoYCN.OnmCof1zKvGkOx9AVQOazvHcTqjUDZa', 'MALE', 200, 'umaryusuftm6226@gmail.com', '08062264190', '06-08-2018 14:33:10', 'unvoted');

-- --------------------------------------------------------

--
-- Table structure for table `president`
--

CREATE TABLE `president` (
  `id` int(11) NOT NULL,
  `koltal` int(11) NOT NULL,
  `nibras` int(11) NOT NULL,
  `baraatu` int(11) NOT NULL,
  `umar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `president`
--

INSERT INTO `president` (`id`, `koltal`, `nibras`, `baraatu`, `umar`) VALUES
(1, 0, 0, 0, 1),
(2, 0, 0, 0, 1),
(3, 0, 0, 0, 1),
(4, 0, 0, 0, 1),
(5, 0, 0, 0, 1),
(6, 1, 0, 0, 0),
(7, 1, 0, 0, 0),
(8, 0, 0, 0, 1),
(9, 0, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `already_voted`
--
ALTER TABLE `already_voted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nacoss`
--
ALTER TABLE `nacoss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `president`
--
ALTER TABLE `president`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `already_voted`
--
ALTER TABLE `already_voted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `nacoss`
--
ALTER TABLE `nacoss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `president`
--
ALTER TABLE `president`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
