-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 09:18 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medbay`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `age` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `treatment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `username`, `patient_name`, `age`, `gender`, `email`, `phone_number`, `clinic`, `doctor`, `appointment_date`, `appointment_time`, `treatment`) VALUES
(1, 'karam', 'karam', '1997-05-01', 'Male', 'karam@yahoo.com', '0788803189', 'Dental', 'Sansa Stark', '2021-01-05', '09:00:00', ''),
(3, 'yousef', 'yousef', '1998-04-11', 'Male', 'yousef@yahoo.com', '0786197619', 'Dental', 'Sansa Stark', '2021-01-06', '10:00:00', ''),
(4, 'yousef', 'yousef', '1998-04-11', 'Male', 'yousef@yahoo.com', '0786197619', 'Dental', 'Sansa Stark', '2019-10-01', '10:00:00', ''),
(5, 'karam', 'sara', '2017-01-31', 'Female', 'karam@yahoo.com', '0788803189', 'Dental', 'Sansa Stark', '2021-01-05', '12:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `subject`, `message`) VALUES
(1, 'karam', 'karam.sawalha@yahoo.com', '0788803189', 'great website', 'thank you');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(255) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `dpassword` varchar(255) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `floor` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `dname`, `dpassword`, `clinic`, `experience`, `floor`) VALUES
(1, 'Sansa Stark', 'SS123456', 'Dental', '6 Years', 1),
(2, 'Bob Barker', 'BB123456', 'Dental', '20 Years', 1),
(3, 'Mark Bowman', 'MB123456', 'Dental', '10 Years', 1),
(4, 'Mary Smith', 'MS123456', 'Orthopedic', '5 Years', 2),
(5, 'Marry Lou', 'ML123456', 'Orthopedic', '4 Years', 2),
(6, 'Robert Johnson', 'RJ123456', 'Orthopedic', '8 Years', 2),
(7, 'Thomas Henry', 'TH123456', 'Surgical', '4 Years', 3),
(8, 'Alexandar James', 'AJ123456', 'Surgical', '20 Years', 3),
(9, 'Edward John', 'EJ123456', 'Surgical', '12 Years', 3),
(10, 'Adam Rose', 'AR123456', 'General', '10 Years', 4),
(11, 'Lana Rodriguez', 'LR123456', 'General', '5 Years', 4),
(12, 'Samantha Walker', 'SW123456', 'General', '3 Years', 4);

-- --------------------------------------------------------

--
-- Table structure for table `free_consultation`
--

CREATE TABLE `free_consultation` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `age` date NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `free_consultation`
--

INSERT INTO `free_consultation` (`id`, `name`, `phone`, `email`, `clinic`, `doctor`, `age`, `message`) VALUES
(1, 'karam', '0788803189', 'karam.sawalha@yahoo.com', 'Dental', 'Sansa Stark', '1997-05-08', 'Hello Dr. Sansa \r\nI have a consultation about my orthodontic.'),
(2, 'karam', '0788803189', 'karam@yahoo.com', 'Dental', 'Sansa Stark', '2004-11-18', 'hello dr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'info@medbay.com', '$2y$10$Co6GZFJYXnL03Z3yljq/0ejvOs8K/itz.rs7nPQ0VpGeeFmC1U..e', '2021-01-01 18:19:08'),
(2, 'karam', 'karam.sawalha@yahoo.com', '$2y$10$DlT0Dw29PkYCUP9yq6r9ReMgnyQV9OYbWVn5jPPvMYHj0S2zrtyVO', '2021-01-01 18:20:13'),
(3, 'yousef', 'yousef@yahoo.com', '$2y$10$Rjme2l.V6YVCM2WAxDVTvednX5fn4122JoeAVV/p0/6xIbWLXwrme', '2021-01-01 22:52:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_consultation`
--
ALTER TABLE `free_consultation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `free_consultation`
--
ALTER TABLE `free_consultation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
