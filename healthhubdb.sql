-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 11:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthhubdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_doctor_children` (IN `doctorId` INT)   BEGIN
                    -- Delete child records based on the doctorId
                    DELETE FROM media WHERE doctorId = doctorId;
                    DELETE FROM feedback WHERE doctorId = doctorId;
                    DELETE FROM workingException WHERE doctorId = doctorId;
                    DELETE FROM doctorHours WHERE doctorId = doctorId;
                END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appId`, `doctorId`, `patientId`, `date`, `time`, `status`) VALUES
(1, 1, 1, '2023-12-13', '12:30:00', 'rejected'),
(2, 1, 1, '2023-12-13', '11:30:00', 'completed'),
(3, 1, 6, '2023-12-30', '12:30:00', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinicId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinicId`, `name`, `description`, `photo`, `icon`) VALUES
(1, 'dentist', 'dentist', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `clinicId` int(11) DEFAULT NULL,
  `phoneNumber` int(11) NOT NULL,
  `profilePic` varchar(200) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorId`, `userId`, `clinicId`, `phoneNumber`, `profilePic`, `deleted`) VALUES
(1, 6, 1, 78909876, NULL, 1),
(2, 11, 1, 76518300, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctorhours`
--

CREATE TABLE `doctorhours` (
  `doctorId` int(11) NOT NULL,
  `day` varchar(200) NOT NULL,
  `fromHour` time DEFAULT NULL,
  `toHour` time DEFAULT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donorId` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `bloodType` varchar(10) NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `published` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `mediaId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicalhours`
--

CREATE TABLE `medicalhours` (
  `day` varchar(200) NOT NULL,
  `fromHour` time DEFAULT NULL,
  `toHour` time DEFAULT NULL,
  `closed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `bloodType` varchar(10) DEFAULT NULL,
  `dateOfBirth` date NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientId`, `userId`, `gender`, `bloodType`, `dateOfBirth`, `phoneNumber`) VALUES
(1, 2, 'female', 'A+', '2023-12-08', 76518348),
(6, 7, 'female', 'A+', '2023-12-14', 71345690),
(7, 8, 'female', 'A+', '2024-10-17', 76518349),
(8, 10, 'female', 'A+', '2024-10-11', 76518890);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminderId` int(11) NOT NULL,
  `reminder` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `urgentbt`
--

CREATE TABLE `urgentbt` (
  `urgentBTId` int(11) NOT NULL,
  `bloodType` varchar(10) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `Fname` varchar(200) NOT NULL,
  `Lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` longtext NOT NULL,
  `role` int(11) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `restricted` int(11) NOT NULL DEFAULT 0,
  `auth_token` varchar(255) DEFAULT NULL,
  `account_activation_hash` varchar(64) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `Fname`, `Lname`, `email`, `password`, `role`, `registrationDate`, `restricted`, `auth_token`, `account_activation_hash`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(2, 'Loreen', 'Baker', 'loreenbak@gmail.com', '$2y$10$7DOeSrH/Xh77DML0LKztHu9i.VgLV/ATnoxIZsl3.3w8OPnH.qP.O', 2, '2023-12-27 20:12:15', 0, NULL, NULL, NULL, NULL),
(6, 'Abbas', 'Bahjat', 'loreenbr@gmail.com', '$2y$10$jKu.8JgJg3rQN1mhSDlgDeGj8MQme3ug.bZvPPhYn3dRPU9C6IVgG', 1, '2023-12-27 20:20:19', 1, '4108cdec89577aa21c5010b116f5eda00d1bfdbd7e535e41a408a6e1f5ffc29f', NULL, NULL, NULL),
(7, 'Raghad', 'Baker', 'Raghad@gamil.com', '$2y$10$g4xNeDOxKvwvhW6KJYeby.cFAWFTEZznI.ZPpjD006wzwP0Gj4ZSu', 2, '2023-12-29 10:43:37', 0, NULL, '74b5b5c78a3dd6ec8d3d2288dfa87173b8c7fbe28c9eedfa5f353633c3a09cad', NULL, NULL),
(8, 'Maryam', 'Baker', 'loreen', '$2y$10$.lbvq/E7MjNRxh8jWzxFtelipcBqnHcDMUeOn2NZTgb/QQokUlofS', 2, '2024-10-17 09:20:19', 0, NULL, 'a1907cb9eab5947ce831c702c5caf168ca935ff141e7c48af9e75e7a6fbe5bb4', NULL, NULL),
(9, 'admin', 'root', 'healthHubAdmin@gmail.com', '$2y$10$hm9cQZJHRikLc3g5sLnYS.aIinr2hS7ZReWjutz2ilB7mfKri5uG.', 0, '2024-10-17 09:27:25', 0, NULL, NULL, NULL, NULL),
(10, 'Mimi', 'Bakerrr', 'loreenbakerr@gmail.com', '$2y$10$VPnDXqQCUpv0C1OOArnFQ.j.hGRPlaXwUu1vDKrbpWQbjJMYK0pb6', 2, '2024-10-17 09:28:06', 0, 'a6dd393e7b5e692e3e6f26298777f6a06644eeee1f9e11ad249a6cd3c7775a40', NULL, NULL, NULL),
(11, 'doctor', 'test', 'loreenbaker6@gmail.com', '$2y$10$4BkEKrNIdfoTotrHe7ivm.tqjVJA1gtFb2UFDQCopbirTaeReJRXS', 1, '2024-10-17 09:33:16', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workingexception`
--

CREATE TABLE `workingexception` (
  `doctorId` int(11) NOT NULL,
  `date` date NOT NULL,
  `fromHour` time DEFAULT NULL,
  `toHour` time DEFAULT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appId`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinicId`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD KEY `userId` (`userId`),
  ADD KEY `clinicId` (`clinicId`);

--
-- Indexes for table `doctorhours`
--
ALTER TABLE `doctorhours`
  ADD PRIMARY KEY (`doctorId`,`day`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donorId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackId`),
  ADD KEY `doctorId` (`doctorId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `medicalhours`
--
ALTER TABLE `medicalhours`
  ADD PRIMARY KEY (`day`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientId`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminderId`);

--
-- Indexes for table `urgentbt`
--
ALTER TABLE `urgentbt`
  ADD PRIMARY KEY (`urgentBTId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `auth_token` (`auth_token`),
  ADD UNIQUE KEY `account_activation_hash` (`account_activation_hash`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Indexes for table `workingexception`
--
ALTER TABLE `workingexception`
  ADD PRIMARY KEY (`doctorId`,`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinicId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `donorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urgentbt`
--
ALTER TABLE `urgentbt`
  MODIFY `urgentBTId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`patientId`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`clinicId`) REFERENCES `clinic` (`clinicId`) ON DELETE SET NULL;

--
-- Constraints for table `doctorhours`
--
ALTER TABLE `doctorhours`
  ADD CONSTRAINT `doctorhours_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`patientId`) REFERENCES `patient` (`patientId`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `workingexception`
--
ALTER TABLE `workingexception`
  ADD CONSTRAINT `workingexception_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
