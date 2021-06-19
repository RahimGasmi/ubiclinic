-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 01:13 PM
-- Server version: 8.0.24
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ubiclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appid` int NOT NULL,
  `patientid` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `state` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appid`, `patientid`, `date`, `time`, `state`) VALUES
(31, 17, '2021-06-11', '21:18:00', 'waiting'),
(37, 19, '2021-07-09', '20:07:00', 'waiting'),
(39, 20, '2021-06-10', '19:51:00', 'waiting'),
(40, 29, '2021-06-10', '18:10:00', 'complete'),
(41, 21, '2021-06-10', '20:41:00', 'waiting'),
(42, 22, '2021-06-11', '17:52:00', 'complete'),
(43, 22, '2021-06-12', '01:01:00', 'waiting'),
(44, 21, '2021-06-11', '19:06:00', 'complete'),
(45, 30, '2021-06-12', '10:55:00', 'complete'),
(46, 16, '2021-06-12', '18:40:00', 'complete'),
(47, 15, '2021-06-12', '14:34:00', 'complete'),
(48, 28, '2021-06-12', '17:39:00', 'complete'),
(49, 21, '2021-06-12', '20:42:00', 'complete'),
(50, 22, '2021-07-05', '19:31:00', 'waiting'),
(51, 21, '2021-06-14', '12:03:58', 'waiting'),
(52, 16, '2021-06-14', '11:08:14', 'waiting'),
(53, 22, '2021-06-14', '11:09:57', 'waiting'),
(54, 32, '2021-06-19', '11:49:06', 'waiting'),
(55, 19, '2021-06-19', '11:49:13', 'waiting'),
(56, 28, '2021-06-19', '03:49:00', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `idcons` int NOT NULL,
  `idpatient` int NOT NULL,
  `idapp` int NOT NULL,
  `motif` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `diagnose` varchar(100) NOT NULL,
  `bill` int NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`idcons`, `idpatient`, `idapp`, `motif`, `type`, `diagnose`, `bill`, `datecreated`) VALUES
(9, 22, 42, 'fever', 'sha', 'corona', 9200, '2021-06-11 17:52:54'),
(10, 21, 44, 'headach', 'sc', 'pregnent', 3500, '2021-06-11 19:07:59'),
(11, 30, 45, 'lungs pain', 'sc', 'lungs cancer', 5000, '2021-06-12 10:57:49'),
(12, 16, 46, 'leg pain', 'sha', 'broken', 2500, '2021-06-12 12:46:21'),
(13, 15, 47, 'fever', 'sc', 'corona virus', 2500, '2021-06-12 13:38:21'),
(14, 28, 48, 'pain in teeth', 'mp', 'teeth infuction', 3000, '2021-06-12 13:41:10'),
(15, 21, 49, 'problem seeing', 'mp', 'Hypermetropia', 2000, '2021-06-12 13:44:33'),
(16, 28, 56, 'headach', 'sc', 'malaria', 3800, '2021-06-19 12:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `examan`
--

CREATE TABLE `examan` (
  `idexam` int NOT NULL,
  `nomexam` varchar(100) NOT NULL,
  `cost` int NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examan`
--

INSERT INTO `examan` (`idexam`, `nomexam`, `cost`) VALUES
(1, 'amniocentesis', 1800),
(2, 'Pulmonary angiography', 1000),
(3, 'Antibiogram', 1800),
(4, 'arteriography', 1800),
(5, 'Arthroscopy', 1800),
(6, 'audiometry', 1800),
(7, 'Blood test', 1000),
(8, 'Urodynamic balance', 1000),
(9, 'Capillaroscopy', 1000),
(10, 'karyotype', 1000),
(11, 'colonoscopy', 1000),
(12, 'cystoscopy', 1000),
(13, 'Ecg', 1000),
(14, 'Echocardiography', 1000),
(15, 'Fibroscopy', 1000),
(16, 'Blood count', 1000),
(17, 'Ionogram', 1500),
(18, 'Myelogram', 1000),
(19, 'Pleural puncture', 1000),
(20, 'radiography', 1000),
(21, 'scintigraphy', 2000),
(22, 'scanner', 2000),
(23, 'Spermogram', 2000),
(24, 'spirometry', 2000),
(25, 'tomography', 1000),
(26, 'Urethrocystography', 1000),
(27, 'Ureteroscopy', 1000),
(28, 'Uroscanner', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `examancons`
--

CREATE TABLE `examancons` (
  `idexam` int NOT NULL,
  `idcons` int NOT NULL,
  `idpat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examancons`
--

INSERT INTO `examancons` (`idexam`, `idcons`, `idpat`) VALUES
(1, 9, 22),
(2, 9, 22),
(4, 9, 22),
(5, 9, 22),
(6, 9, 22),
(7, 9, 22),
(1, 10, 21),
(3, 10, 21),
(7, 11, 30),
(15, 11, 30),
(20, 11, 30),
(22, 11, 30),
(20, 12, 16),
(22, 12, 16),
(20, 13, 15),
(22, 13, 15),
(8, 14, 28),
(10, 14, 28),
(19, 14, 28),
(10, 15, 21),
(25, 15, 21),
(2, 16, 28),
(4, 16, 28),
(7, 16, 28);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int NOT NULL,
  `name` varchar(90) NOT NULL,
  `used-for` varchar(120) NOT NULL,
  `dose` int NOT NULL DEFAULT '200',
  `period` int NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `used-for`, `dose`, `period`) VALUES
(1, 'diclofenac', 'headache', 200, 21),
(2, 'albiglutide', 'diabetes', 200, 28),
(3, 'liraglutide ', 'diabetes', 200, 7),
(4, 'Chloroquine.', 'malaria', 250, 7),
(5, 'Abraxane', 'Cancer', 200, 28),
(11, 'ACE inhibitors', 'hypertension', 150, 7),
(12, 'Docusate sodium', 'constipation', 300, 21),
(13, 'Dulcolaxx', 'constipation', 150, 21),
(17, 'CoviVac', 'corona', 200, 7),
(18, 'Cyclophosphamide', 'lung cancer', 40, 28);

-- --------------------------------------------------------

--
-- Table structure for table `medicinecons`
--

CREATE TABLE `medicinecons` (
  `idmedicine` int NOT NULL,
  `idcons` int NOT NULL,
  `idpat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicinecons`
--

INSERT INTO `medicinecons` (`idmedicine`, `idcons`, `idpat`) VALUES
(1, 9, 22),
(3, 9, 22),
(4, 9, 22),
(5, 9, 22),
(11, 9, 22),
(1, 10, 21),
(2, 10, 21),
(3, 10, 21),
(4, 10, 21),
(5, 11, 30),
(1, 12, 16),
(17, 13, 15),
(1, 14, 28),
(3, 14, 28),
(11, 14, 28),
(4, 15, 21),
(5, 15, 21),
(12, 15, 21),
(3, 16, 28),
(4, 16, 28),
(11, 16, 28);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `sender` varchar(50) NOT NULL,
  `msg` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender`, `msg`, `date`, `seen`) VALUES
(17, 'doctor', 'this is a new msg', '2021-06-10 20:44:07', 'yes'),
(18, 'doctor', 'testing this msg', '2021-06-10 20:50:20', 'yes'),
(19, 'doctor', 'from doctor', '2021-06-11 18:05:51', 'yes'),
(20, 'secretaire', 'from secretair', '2021-06-11 18:13:09', 'yes'),
(21, 'secretaire', 'another from secretair', '2021-06-11 18:13:20', 'yes'),
(22, 'secretaire', 'from secretair\r\n', '2021-06-12 13:31:41', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `firstname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` int NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` int NOT NULL,
  `blood` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `weight` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numvisite` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `firstname`, `lastname`, `age`, `gender`, `email`, `phone`, `blood`, `weight`, `height`, `datecreation`, `numvisite`) VALUES
(15, 'farah', 'meriem', 18, 'female', 'test@test.com', 363365985, 'AB-', 50, 180, '2021-05-11 16:51:31', 1),
(16, 'mohammed', 'mahrez', 50, 'male', 'test@test.com', 363365985, 'AB-', 80, 100, '2021-05-11 16:51:31', 1),
(17, 'moualdi', 'karim', 80, 'male', 'moualdi@test.com', 363365985, 'A+', 90, 80, '2021-05-11 16:51:31', 0),
(18, 'redouan', 'hamid', 35, 'male', 'test@test.com', 363365985, 'B-', 95, 190, '2021-05-12 09:32:33', 0),
(19, 'madjid', 'madani', 45, 'male', 'madjid@test.com', 635975633, 'AB+', 150, 175, '2021-05-12 09:34:15', 0),
(20, 'mahmod', 'mahrez', 25, 'male', 'test@test.com', 363365985, 'AB+', 65, 205, '2021-05-12 09:45:31', 0),
(21, 'doe', 'jane', 150, 'female', 'jane@test.com', 726368934, 'AB-', 80, 140, '2021-05-12 09:46:38', 2),
(22, 'ilyes', 'kram', 32, 'male', 'ilyes@test.com', 69753659, 'A+', 120, 157, '2021-05-12 09:48:35', 1),
(23, 'maria', 'necira', 50, 'female', 'hjkdsql@kdsk', 3629358, 'O+', 190, 155, '2021-05-12 09:49:58', 0),
(28, 'salma', 'abid', 45, 'female', 'salma@test.com', 636315368, 'AB+', 75, 165, '2021-05-17 10:06:10', 2),
(29, 'said', 'rabeh', 56, 'male', 'rabeh@test.com', 66666666, 'O+', 80, 160, '2021-06-10 17:06:38', 0),
(30, 'dziri', 'moukhtar', 45, 'male', 'dziri@mokhtar.fr', 64566664, 'A+', 120, 190, '2021-06-11 19:41:50', 1),
(32, 'kchida', 'hamza', 62, 'male', 'test@gmail.com', 362654, 'O+', 70, 150, '2021-06-19 10:48:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` int NOT NULL DEFAULT '666349836',
  `degree` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `degree`) VALUES
(1, 'mohamed', 'rahmani', 'rahmani20', 'test', 'mohamed.rahmani@test.com', 666349836, 'doctor'),
(2, 'meriem', 'slimani', 'slimani20', 'test20', 'test@test.com', 666349836, 'secretaire');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appid`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`idcons`);

--
-- Indexes for table `examan`
--
ALTER TABLE `examan`
  ADD PRIMARY KEY (`idexam`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `idcons` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `examan`
--
ALTER TABLE `examan`
  MODIFY `idexam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
